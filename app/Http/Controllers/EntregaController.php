<?php

namespace App\Http\Controllers;

use App\Models\Correcao;
use App\Models\Entrega;
use App\Models\Etapa;
use App\Models\Grupo;
use App\Models\ProgressoGrupo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EntregaController extends AdminResourceController
{
    protected string $modelClass = Entrega::class;

    protected string $routeName = 'entregas';

    protected string $title = 'Entrega';

    protected string $table = 'entrega';

    protected string $primaryKey = 'id_entrega';

    /**
     * Verifica se usuário é professor/coordenador
     */
    private function isStaff($user): bool
    {
        return in_array(
            strtolower(trim((string) $user?->tipo)),
            ['professor', 'coordenador'],
            true
        );
    }

    /**
     * Formulario de envio de entrega
     */
    public function create()
    {
        $this->authorize('create', $this->modelClass);

        return view(
            'entregas.create',
            $this->viewData([
                'isStaff' => $this->isStaff(auth()->user()),
            ])
        );
    }

    /**
     * Lista entregas
     */
    public function index()
    {
        $records = collect();

        $tableExists = Schema::hasTable($this->table);

        $user = auth()->user();

        $isStaff = $this->isStaff($user);

        if ($tableExists) {

            $query = Entrega::with([
                'grupo.turma',
                'grupo.usuarios',
                'etapa',
                'ultimaValidacao',
                'correcoes.professor',
            ]);

            /**
             * Aluno só vê entregas do próprio grupo
             */
            if (! $isStaff && $user) {

                $query->whereHas(
                    'grupo.usuarios',
                    function ($q) use ($user) {

                        $q->where(
                            'users.id',
                            $user->id
                        );
                    }
                );
            }

            $records = $query
                ->latest('id_entrega')
                ->paginate(10);
        }

        return view(
            'entregas.index',
            $this->viewData(
                compact(
                    'records',
                    'tableExists',
                    'isStaff'
                )
            )
        );
    }

    /**
     * Visualizar entrega
     */
    public function show(string $id)
    {
        $user = auth()->user();

        $isStaff = $this->isStaff($user);

        $query = Entrega::with([
            'grupo.turma',
            'grupo.usuarios',
            'etapa',
            'validacoes.professor',
            'correcoes.professor',
        ]);

        /**
         * Aluno só vê entrega do próprio grupo
         */
        if (! $isStaff && $user) {

            $query->whereHas(
                'grupo.usuarios',
                function ($q) use ($user) {

                    $q->where(
                        'users.id',
                        $user->id
                    );
                }
            );
        }

        $entrega = $query
            ->where('id_entrega', $id)
            ->firstOrFail();

        return view(
            'entregas.show',
            compact('entrega', 'isStaff')
        );
    }

    /**
     * Campos formulário
     */
    protected function fields(): array
    {
        $isStaff = $this->isStaff(
            auth()->user()
        );

        $fields = [

            'id_grupo' => [
                'label' => 'Grupo',
                'type' => 'select',
                'rules' => ['required', 'integer'],
                'options' => $this->grupos(),
            ],

            'id_etapa' => [
                'label' => 'Etapa',
                'type' => 'select',
                'rules' => ['required', 'integer'],
                'options' => $this->etapas(),
            ],

            'nome_arquivo' => [
                'label' => 'Nome do arquivo',
                'type' => 'text',
                'rules' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
            ],

            'caminho_arquivo' => [
                'label' => 'Arquivo da etapa',
                'type' => 'file',
                'accept' => '.pdf,.doc,.docx,.zip,.rar',
                'rules' => [
                    'required',
                    'file',
                    'mimes:pdf,doc,docx,zip,rar',
                    'max:20480',
                ],
            ],

            'observacao' => [
                'label' => 'Observação',
                'type' => 'textarea',
                'rules' => [
                    'nullable',
                    'string',
                ],
            ],
        ];

        /**
         * Apenas staff pode alterar status
         */
        if ($isStaff) {

            $fields['status_Entrega'] = [

                'label' => 'Status',

                'type' => 'select',

                'rules' => [
                    'required',
                    Rule::in([
                        'enviado',
                        'em_analise',
                        'aprovado',
                        'reprovado',
                    ]),
                ],

                'options' => [
                    'enviado' => 'Enviado',
                    'em_analise' => 'Em análise',
                    'aprovado' => 'Aprovado',
                    'reprovado' => 'Reprovado',
                ],
            ];
        }

        return $fields;
    }

    /**
     * Regras validação
     */
    protected function rules(?Model $record = null): array
    {
        $rules = parent::rules($record);

        /**
         * Editando entrega
         */
        if ($record) {

            $rules['caminho_arquivo'] = [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,zip,rar',
                'max:20480',
            ];
        }

        return $rules;
    }

    /**
     * Criar entrega
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            $this->rules()
        );

        /**
         * Status automático
         */
        $data['status_Entrega'] =
            $data['status_Entrega']
            ?? 'enviado';

        $data = $this->storeUpload(
            $request,
            $data
        );

        $entrega = Entrega::create($data);

        $this->syncProgress(
            $entrega,
            'entregue',
            75
        );

        return redirect()
            ->route('entregas.index')
            ->with(
                'success',
                'Entrega enviada com sucesso.'
            );
    }

    /**
     * Atualizar entrega
     */
    public function update(
        Request $request,
        string $id
    ) {
        $record = Entrega::findOrFail($id);

        $data = $request->validate(
            $this->rules($record)
        );

        /**
         * Mantém status atual
         */
        $data['status_Entrega'] =
            $data['status_Entrega']
            ?? $record->status_Entrega;

        $data = $this->storeUpload(
            $request,
            $data,
            $record
        );

        $record->update($data);

        $this->syncProgress(
            $record,
            'entregue',
            75
        );

        return redirect()
            ->route('entregas.index')
            ->with(
                'success',
                'Entrega atualizada com sucesso.'
            );
    }

    /**
     * Reenviar entrega
     */
    public function reenviar(
        Request $request,
        string $id
    ) {
        $entrega = Entrega::with([
            'grupo.usuarios',
            'grupo.turma',
        ])->findOrFail($id);

        $user = $request->user();

        $isStaff = $this->isStaff($user);

        $isOwner = $entrega
            ->grupo?->usuarios
            ->contains('id', $user->id);

        abort_unless(
            $isStaff || $isOwner,
            403
        );

        $data = $request->validate([

            'caminho_arquivo' => [
                'required',
                'file',
                'mimes:pdf,doc,docx,zip,rar',
                'max:20480',
            ],

            'observacao' => [
                'nullable',
                'string',
            ],
        ]);

        $data = $this->storeUpload(
            $request,
            array_merge(
                $entrega->only([
                    'id_grupo',
                    'id_etapa',
                    'nome_arquivo',
                    'status_Entrega',
                    'observacao',
                ]),
                $data
            ),
            $entrega
        );

        $data['status_Entrega'] = 'enviado';

        $entrega->update($data);

        $this->syncProgress(
            $entrega,
            'reenviado',
            75,
            'Entrega reenviada para nova avaliação.'
        );

        Correcao::create([

            'id_entrega' => $entrega->id_entrega,

            'id_professor' =>
                $entrega->grupo?->turma?->id_professor
                ?? $user->id,

            'status_correcao' => 'reenviado',

            'comentario' =>
                $request->input('observacao')
                ?: 'Arquivo reenviado pelo grupo.',
        ]);

        return redirect()
            ->route('entregas.show', $entrega)
            ->with(
                'success',
                'Entrega reenviada com sucesso.'
            );
    }

    /**
     * Upload arquivo
     */
    private function storeUpload(
        Request $request,
        array $data,
        ?Entrega $record = null
    ): array {

        if (! $request->hasFile('caminho_arquivo')) {

            unset($data['caminho_arquivo']);

            return $data;
        }

        /**
         * Remove arquivo antigo
         */
        if ($record?->caminho_arquivo) {

            Storage::disk('public')->delete(
                $record->caminho_arquivo
            );
        }

        $file = $request->file(
            'caminho_arquivo'
        );

        $data['caminho_arquivo'] = $file->store(
            'entregas',
            'public'
        );

        $data['nome_arquivo'] =
            $data['nome_arquivo']
            ?: $file->getClientOriginalName();

        return $data;
    }

    /**
     * Atualiza progresso grupo
     */
    private function syncProgress(
        Entrega $entrega,
        string $status,
        int $percentual,
        string $observacao =
            'Entrega enviada para avaliação.'
    ): void {

        ProgressoGrupo::updateOrCreate(

            [
                'id_grupo' => $entrega->id_grupo,
                'id_etapa' => $entrega->id_etapa,
            ],

            [
                'status_progresso' => $status,
                'percentual' => $percentual,
                'observacao' => $observacao,
            ]
        );
    }

    /**
     * Lista grupos
     */
    private function grupos(): array
    {
        if (! Schema::hasTable('grupos')) {
            return [];
        }

        $user = auth()->user();

        $isStaff = $this->isStaff($user);

        $query = Grupo::query();

        /**
         * Aluno vê apenas grupos dele
         */
        if (! $isStaff && $user) {

            $query->whereHas(
                'usuarios',
                function ($q) use ($user) {

                    $q->where(
                        'users.id',
                        $user->id
                    );
                }
            );
        }

        return $query
            ->orderBy('nome_grupo')
            ->pluck(
                'nome_grupo',
                'id_grupo'
            )
            ->toArray();
    }

    /**
     * Lista etapas
     */
    private function etapas(): array
    {
        if (! Schema::hasTable('etapas')) {
            return [];
        }

        return Etapa::orderBy(
            'ordem_etapa')
        ->pluck(
            'nome_etapa',
            'id_etapa'
        )
        ->toArray();
    }
}
