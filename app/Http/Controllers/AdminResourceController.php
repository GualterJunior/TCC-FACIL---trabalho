<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

abstract class AdminResourceController extends Controller
{
    protected string $modelClass;
    protected string $routeName;
    protected string $title;
    protected string $table;
    protected string $primaryKey = 'id';

    abstract protected function fields(): array;

    protected function rules(?Model $record = null): array
    {
        $rules = [];

        foreach ($this->fields() as $name => $field) {
            $rules[$name] = $field['rules'] ?? ['nullable'];
        }

        return $rules;
    }

    public function index()
    {
        $records = collect();
        $tableExists = Schema::hasTable($this->table);

        if ($tableExists) {
            $model = $this->modelClass;
            $records = $model::latest()->paginate(10);
        }

        return view('admin.resources.index', $this->viewData(compact('records', 'tableExists')));
    }

    public function create()
    {
        return view('admin.resources.form', $this->viewData([
            'record' => null,
            'method' => 'POST',
            'action' => route($this->routeName.'.store'),
        ]));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        if (array_key_exists('password', $data) && filled($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $model = $this->modelClass;
        $model::create($data);

        return redirect()->route($this->routeName.'.index')->with('success', $this->title.' cadastrado com sucesso.');
    }

    public function show(string $id)
    {
        $record = $this->findRecord($id);

        return view('admin.resources.show', $this->viewData(compact('record')));
    }

    public function edit(string $id)
    {
        $record = $this->findRecord($id);

        return view('admin.resources.form', $this->viewData([
            'record' => $record,
            'method' => 'PUT',
            'action' => route($this->routeName.'.update', $record),
        ]));
    }

    public function update(Request $request, string $id)
    {
        $record = $this->findRecord($id);
        $data = $request->validate($this->rules($record));

        if (array_key_exists('password', $data)) {
            if (filled($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
        }

        $record->update($data);

        return redirect()->route($this->routeName.'.index')->with('success', $this->title.' atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $record = $this->findRecord($id);
        $record->delete();

        return redirect()->route($this->routeName.'.index')->with('success', $this->title.' removido com sucesso.');
    }

    protected function findRecord(string $id): Model
    {
        $model = $this->modelClass;

<<<<<<< HEAD
        return $model::findOrFail($id);
=======
        return $model::where($this->primaryKey, $id)->firstOrFail();
>>>>>>> 89fa71c (correção de bugs)
    }

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
