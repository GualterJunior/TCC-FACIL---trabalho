<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TurmaController extends AdminResourceController
{
    protected string $modelClass = Turma::class;
    protected string $routeName = 'turmas';
    protected string $title = 'Turma';
    protected string $table = 'turmas';
    protected string $primaryKey = 'id_turma';

    protected function fields(): array
    {
        return [
            'nome_turma' => ['label' => 'Nome da turma', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'codigo_turma' => ['label' => 'Código', 'type' => 'text', 'rules' => ['nullable', 'string', 'max:255', 'unique:turmas,codigo_turma']],
            'semestre' => ['label' => 'Semestre', 'type' => 'text', 'rules' => ['required', 'string', 'max:50']],
            'descricao' => ['label' => 'Descrição', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
            'status_turma' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['ativa', 'inativa'])], 'options' => [
                'ativa' => 'Ativa',
                'inativa' => 'Inativa',
            ]],
            'id_professor' => ['label' => 'Professor', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->users()],
        ];
    }

    protected function rules(?\Illuminate\Database\Eloquent\Model $record = null): array
    {
        $rules = parent::rules($record);

        if ($record) {
            $rules['codigo_turma'] = ['nullable', 'string', 'max:255', Rule::unique('turmas', 'codigo_turma')->ignore($record->id_turma, 'id_turma')];
        }

        return $rules;
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['codigo_turma'] = $data['codigo_turma'] ?: $this->generateClassCode($data['nome_turma']);

        Turma::create($data);

        return redirect()->route('turmas.index')->with('success', 'Turma cadastrada com código de acesso '.$data['codigo_turma'].'.');
    }

    public function update(Request $request, string $id)
    {
        $record = Turma::findOrFail($id);
        $data = $request->validate($this->rules($record));
        $data['codigo_turma'] = $data['codigo_turma'] ?: $record->codigo_turma;

        $record->update($data);

        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso.');
    }

    private function generateClassCode(string $name): string
    {
        $prefix = Str::upper(Str::substr(Str::slug($name, ''), 0, 4)) ?: 'TCC';

        do {
            $code = $prefix.'-'.now()->format('ym').'-'.Str::upper(Str::random(4));
        } while (Turma::where('codigo_turma', $code)->exists());

        return $code;
    }

    private function users(): array
    {
        if (! Schema::hasTable('users')) {
            return [];
        }

        return User::orderBy('name')->pluck('name', 'id')->toArray();
    }
}
