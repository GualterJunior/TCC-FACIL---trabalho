<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

abstract class AdminResourceController extends Controller
{
    use AuthorizesRequests;
    protected string $modelClass;
    protected string $routeName;
    protected string $title;
    protected string $table;
    protected string $primaryKey = 'id';
    /**
     * Campos do formulário
     */
    abstract protected function fields(): array;
    /**
     * Regras de validação
     */
    protected function rules(?Model $record = null): array
    {
        $rules = [];

        foreach ($this->fields() as $name => $field) {
            $rules[$name] = $field['rules'] ?? ['nullable'];
        }

        return $rules;
    }
    /**
     * Lista registros
     */
    public function index()
    {
        $records = collect();

        $tableExists = Schema::hasTable($this->table);

        if ($tableExists) {

            // autorização automática
            $this->authorize('viewAny', $this->modelClass);

            $model = $this->modelClass;

            $records = $model::latest()->paginate(10);
        }

        return view(
            'admin.resources.index',
            $this->viewData(
                compact('records', 'tableExists')
            )
        );
    }
    /**
     * Formulário de criação
     */
    public function create()
    {
        $this->authorize('create', $this->modelClass);

        return view('admin.resources.form', $this->viewData([
            'record' => null,
            'method' => 'POST',
            'action' => route($this->routeName . '.store'),
        ]));
    }
    /**
     * Salvar registro
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->modelClass);

        $data = $request->validate(
            $this->rules()
        );

        if (
            array_key_exists('password', $data)
            && filled($data['password'])
        ) {
            $data['password'] = Hash::make(
                $data['password']
            );
        }

        $model = $this->modelClass;

        $record = $model::create($data);

        return redirect()
            ->route($this->routeName . '.index')
            ->with(
                'success',
                $this->title . ' cadastrado com sucesso.'
            );
    }
    /**
     * Visualizar registro
     */
    public function show(string $id)
    {
        $record = $this->findRecord($id);

        $this->authorize('view', $record);

        return view(
            'admin.resources.show',
            $this->viewData(compact('record'))
        );
    }
    /**
     * Formulário de edição
     */
    public function edit(string $id)
    {
        $record = $this->findRecord($id);

        $this->authorize('update', $record);

        return view('admin.resources.form', $this->viewData([
            'record' => $record,
            'method' => 'PUT',
            'action' => route(
                $this->routeName . '.update',
                $record
            ),
        ]));
    }
    /**
     * Atualizar registro
     */
    public function update(Request $request, string $id)
    {
        $record = $this->findRecord($id);

        $this->authorize('update', $record);

        $data = $request->validate(
            $this->rules($record)
        );

        if (array_key_exists('password', $data)) {

            if (filled($data['password'])) {

                $data['password'] = Hash::make(
                    $data['password']
                );

            } else {

                unset($data['password']);
            }
        }

        $record->update($data);

        return redirect()
            ->route($this->routeName . '.index')
            ->with(
                'success',
                $this->title . ' atualizado com sucesso.'
            );
    }
    /**
     * Remover registro
     */
    public function destroy(string $id)
    {
        $record = $this->findRecord($id);

        $this->authorize('delete', $record);

        $record->delete();

        return redirect()
            ->route($this->routeName . '.index')
            ->with(
                'success',
                $this->title . ' removido com sucesso.'
            );
    }

    /**
     * Buscar registro
     */
    protected function findRecord(string $id): Model
    {
        $model = $this->modelClass;

        return $model::where(
            $this->primaryKey,
            $id
        )->firstOrFail();
    }

    /**
     * Dados compartilhados das views
     */
    protected function viewData(array $extra = []): array
    {
        return array_merge([
            'title' => $this->title,
            'routeName' => $this->routeName,
            'fields' => $this->fields(),
            'primaryKey' => $this->primaryKey,
        ], $extra);
    }
}
