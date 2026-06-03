<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjetoController extends AdminResourceController
{
    protected string $modelClass = Projeto::class;
    protected string $routeName = 'projetos';
    protected string $title = 'Projeto';
    protected string $table = 'projetos';
    protected string $primaryKey = 'id_projeto';

    public function index()
    {
        $user = auth()->user();
        $isStaff = in_array(strtolower(trim((string) $user?->tipo)), ['professor', 'coordenador'], true);

        $projetos = Projeto::when(! $isStaff, fn ($query) => $query->where('status', 'publicado'))
            ->latest('id_projeto')
            ->paginate(9);

        return view('projetos.index', compact('projetos', 'isStaff'));
    }

    public function show(string $id)
    {
        $user = auth()->user();
        $isStaff = in_array(strtolower(trim((string) $user?->tipo)), ['professor', 'coordenador'], true);

        $projeto = Projeto::when(! $isStaff, fn ($query) => $query->where('status', 'publicado'))
            ->where('id_projeto', $id)
            ->firstOrFail();

        return view('projetos.show', compact('projeto', 'isStaff'));
    }

    protected function fields(): array
    {
        return [
            'titulo' => ['label' => 'Título', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'autor' => ['label' => 'Autor ou grupo', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'descricao' => ['label' => 'Descrição', 'type' => 'textarea', 'rules' => ['required', 'string']],
            'status' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['rascunho', 'publicado', 'arquivado'])], 'options' => [
                'rascunho' => 'Rascunho',
                'publicado' => 'Publicado',
                'arquivado' => 'Arquivado',
            ]],
            'banner_path' => ['label' => 'Banner', 'type' => 'file', 'accept' => 'image/*', 'rules' => ['required', 'image', 'max:4096']],
            'pdf_path' => ['label' => 'PDF do projeto', 'type' => 'file', 'accept' => 'application/pdf', 'rules' => ['required', 'file', 'mimes:pdf', 'max:10240']],
        ];
    }

    protected function rules(?\Illuminate\Database\Eloquent\Model $record = null): array
    {
        $rules = parent::rules($record);

        if ($record) {
            $rules['banner_path'] = ['nullable', 'image', 'max:4096'];
            $rules['pdf_path'] = ['nullable', 'file', 'mimes:pdf', 'max:10240'];
        }

        return $rules;
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data = $this->storeUploads($request, $data);

        Projeto::create($data);

        return redirect()->route('projetos.index')->with('success', 'Projeto cadastrado com banner e PDF.');
    }

    public function update(Request $request, string $id)
    {
        $record = Projeto::findOrFail($id);
        $data = $request->validate($this->rules($record));
        $data = $this->storeUploads($request, $data, $record);

        $record->update($data);

        return redirect()->route('projetos.index')->with('success', 'Projeto atualizado com sucesso.');
    }

    private function storeUploads(Request $request, array $data, ?Projeto $record = null): array
    {
        if ($request->hasFile('banner_path')) {
            if ($record?->banner_path) {
                Storage::disk('public')->delete($record->banner_path);
            }

            $data['banner_path'] = $request->file('banner_path')->store('projetos/banners', 'public');
        } else {
            unset($data['banner_path']);
        }

        if ($request->hasFile('pdf_path')) {
            if ($record?->pdf_path) {
                Storage::disk('public')->delete($record->pdf_path);
            }

            $data['pdf_path'] = $request->file('pdf_path')->store('projetos/pdfs', 'public');
        } else {
            unset($data['pdf_path']);
        }

        return $data;
    }
}
