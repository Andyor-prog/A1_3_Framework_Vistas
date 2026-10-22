<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BaseResourceController extends Controller
{
    protected string $modelClass;
    protected string $title;
    protected string $routeName;
    protected array $fields;
    protected array $createRules;
    protected array $updateRules;

    public function index()
    {
        $modelClass = $this->modelClass;

        return view('records.index', [
            'records' => $modelClass::query()->orderByDesc('id')->paginate(15),
            'fields' => $this->fields,
            'title' => $this->title,
            'routeName' => $this->routeName,
        ]);
    }

    public function create()
    {
        return $this->form(null);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->createRules);
        $modelClass = $this->modelClass;
        $modelClass::create($data);

        return redirect()->route($this->routeName . '.index')->with('success', 'Registro creado correctamente.');
    }

    public function edit(int $id)
    {
        $modelClass = $this->modelClass;

        return $this->form($modelClass::findOrFail($id));
    }

    public function update(Request $request, int $id)
    {
        $modelClass = $this->modelClass;
        $record = $modelClass::findOrFail($id);
        $data = $request->validate($this->rulesForUpdate($record));

        foreach ($this->fields as $fieldName => $field) {
            if (($field['type'] ?? '') === 'password' && empty($data[$fieldName])) {
                unset($data[$fieldName]);
            }
        }

        $record->update($data);

        return redirect()->route($this->routeName . '.index')->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy(int $id)
    {
        $modelClass = $this->modelClass;
        $modelClass::findOrFail($id)->delete();

        return redirect()->route($this->routeName . '.index')->with('success', 'Registro eliminado correctamente.');
    }

    protected function rulesForUpdate(Model $record): array
    {
        return $this->updateRules;
    }

    private function form(?Model $record)
    {
        return view('records.form', [
            'record' => $record,
            'fields' => $this->fields,
            'title' => $this->title,
            'routeName' => $this->routeName,
        ]);
    }
}