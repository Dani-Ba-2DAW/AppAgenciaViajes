<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RoleMiddleware;
use App\Models\Type;
use App\Http\Requests\TypeCreateRequest;
use App\Http\Requests\TypeEditRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(RoleMiddleware::class . ':admin');
    }

    public function index(): View
    {
        $types = Type::all();
        return view('type.index', compact('types'));
    }

    public function create(): View
    {
        return view('type.create');
    }

    public function store(TypeCreateRequest $request): RedirectResponse
    {
        $result = false;
        $message = ['general' => 'El tipo ha sido creado correctamente.'];

        try {
            $type = new Type($request->all());
            $result = $type->save();
        } catch (\Exception $e) {
            $message['general'] = 'Error al crear el tipo.';
        }

        if (!$result) {
            return back()->withInput()->withErrors($message);
        }

        return redirect()->route('types.index')->with($message);
    }

    public function edit(Type $type): View
    {
        return view('type.edit', compact('type'));
    }

    public function update(TypeEditRequest $request, Type $type): RedirectResponse
    {
        $result = false;
        $message = ['general' => 'El tipo ha sido modificado correctamente.'];

        try {
            $result = $type->update($request->all());
        } catch (\Exception $e) {
            $message['general'] = 'Error al actualizar el tipo.';
        }

        if (!$result) {
            return back()->withInput()->withErrors($message);
        }

        return redirect()->route('types.index')->with($message);
    }

    public function destroy(Type $type): RedirectResponse
    {
        $result = false;
        $message = ['general' => 'El tipo ha sido eliminado correctamente.'];

        try {
            $result = $type->delete();
        } catch (\Exception $e) {
            $message['general'] = 'Error al eliminar el tipo.';
        }

        if (!$result) {
            return back()->withErrors($message);
        }

        return redirect()->route('types.index')->with($message);
    }
}
