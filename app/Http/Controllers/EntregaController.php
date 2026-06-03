<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Etapa;
use App\Models\Grupo;
use App\Models\ProgressoGrupo;
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

    public function index()
    {
        $records = collect();
        $tableExists = Schema::hasTable($this->table);

        if ($tableExists) {
            $user = auth()->user();
            $isStaff = in_array(strtolower(trim((string) $user?->tipo)), ['professor', 'coordenador'], true);

            $records = Entrega::when(! $isStaff, function ($query) use ($user) {
                $query->whereHas('grupo.usuarios', fn ($usuarios) => $usuarios->where('users.id', $user->id));
            })->latest('id_entrega')->paginate(10);
        }

        return view('admin.resources.index', $this->viewData(compact('records', 'tableExists')));
    }

    protected function fields(): array
    {
        return [
            'id_grupo' => ['label' => 'Grupo', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->grupos()],
            'id_etapa' => ['label' => 'Etapa', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->etapas()],
            'nome_arquivo' => ['label' => 'Nome do arquivo', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255']],
            'caminho_arquivo' => ['label' => 'Arquivo da etapa', 'type' => 'file', 'accept' => '.pdf,.doc,.docx,.zip,.rar', 'rules' => ['required', 'file', 'mimes:pdf,doc,docx,zip,rar', 'max:20480']],
            'status_Entrega' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['enviado', 'em_analise', 'aprovado', 'reprovado'])], 'options' => [
                'enviado' => 'Enviado',
                'em_analise' => 'Em analise',
                'aprovado' => 'Aprovado',
                'reprovado' => 'Reprovado',
            ]],
            'observacao' => ['label' => 'Observacao', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
        ];
    }

    protected function rules(?\Illuminate\Database\Eloquent\Model $record = null): array
    {
        $rules = parent::rules($record);

        if ($record) {
            $rules['caminho_arquivo'] = ['nullable', 'file', 'mimes:pdf,doc,docx,zip,rar', 'max:20480'];
        }

        return $rules;
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data = $this->storeUpload($request, $data);

        $entrega = Entrega::create($data);
        $this->syncProgress($entrega, 'entregue', 75);

        return redirect()->route('entregas.index')->with('success', 'Entrega enviada com sucesso.');
    }

    public function update(Request $request, string $id)
    {
        $record = Entrega::findOrFail($id);
        $data = $request->validate($this->rules($record));
        $data = $this->storeUpload($request, $data, $record);

        $record->update($data);
        $this->syncProgress($record, 'entregue', 75);

        return redirect()->route('entregas.index')->with('success', 'Entrega atualizada com sucesso.');
    }

    private function storeUpload(Request $request, array $data, ?Entrega $record = null): array
    {
        if ($request->hasFile('caminho_arquivo')) {
            if ($record?->caminho_arquivo) {
                Storage::disk('public')->delete($record->caminho_arquivo);
            }

            $file = $request->file('caminho_arquivo');
            $data['caminho_arquivo'] = $file->store('entregas', 'public');
            $data['nome_arquivo'] = $data['nome_arquivo'] ?: $file->getClientOriginalName();
        } else {
            unset($data['caminho_arquivo']);
        }

        return $data;
    }

    private function syncProgress(Entrega $entrega, string $status, int $percentual): void
    {
        ProgressoGrupo::updateOrCreate(
            [
                'id_grupo' => $entrega->id_grupo,
                'id_etapa' => $entrega->id_etapa,
            ],
            [
                'status_progresso' => $status,
                'percentual' => $percentual,
                'observacao' => 'Entrega enviada para avaliacao.',
            ]
        );
    }

    private function grupos(): array
    {
        if (! Schema::hasTable('grupos')) {
            return [];
        }

        $user = auth()->user();
        $isStaff = in_array(strtolower(trim((string) $user?->tipo)), ['professor', 'coordenador'], true);

        return Grupo::when(! $isStaff, function ($query) use ($user) {
            $query->whereHas('usuarios', fn ($usuarios) => $usuarios->where('users.id', $user->id));
        })->orderBy('nome_grupo')->pluck('nome_grupo', 'id_grupo')->toArray();
    }

    private function etapas(): array
    {
        if (! Schema::hasTable('etapas')) {
            return [];
        }

        return Etapa::orderBy('ordem_etapa')->pluck('nome_etapa', 'id_etapa')->toArray();
    }
}
