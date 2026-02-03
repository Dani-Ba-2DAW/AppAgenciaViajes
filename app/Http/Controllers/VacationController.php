<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RoleMiddleware;
use App\Models\Vacation;
use App\Models\Type;
use App\Http\Requests\VacationCreateRequest;
use App\Http\Requests\VacationEditRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VacationController extends Controller
{
    public function __construct()
    {
        $this->middleware(RoleMiddleware::class . ':advanced,admin')
             ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(): View
    {
        $vacations = Vacation::with('type')->get();
        return view('vacation.index', compact('vacations'));
    }

    public function create(): View
    {
        $types = Type::all();
        return view('vacation.create', compact('types'));
    }

    public function store(VacationCreateRequest $request): RedirectResponse
    {
        $result = false;
        $message = ['general' => 'La vacación ha sido creada correctamente.'];

        try {
            $vacation = new Vacation($request->all());
            $result = $vacation->save();
        } catch (\Exception $e) {
            $message['general'] = 'Error inesperado al crear la vacación.';
        }

        if (!$result) {
            return back()->withInput()->withErrors($message);
        }

        return redirect()->route('vacations.index')->with($message);
    }

    public function show(Vacation $vacation): View
    {
        $vacation->load(['type', 'photos', 'comments.user']);
        return view('vacation.show', compact('vacation'));
    }

    public function edit(Vacation $vacation): View
    {
        $types = Type::all();
        return view('vacation.edit', compact('vacation', 'types'));
    }

    public function update(VacationEditRequest $request, Vacation $vacation): RedirectResponse
    {
        $result = false;
        $message = ['general' => 'La vacación ha sido modificada correctamente.'];

        try {
            $result = $vacation->update($request->all());
        } catch (\Exception $e) {
            $message['general'] = 'Error al actualizar la vacación.';
        }

        if (!$result) {
            return back()->withInput()->withErrors($message);
        }

        return redirect()->route('vacations.index')->with($message);
    }

    public function destroy(Vacation $vacation): RedirectResponse
    {
        $result = false;
        $message = ['general' => 'La vacación ha sido eliminada correctamente.'];

        try {
            $result = $vacation->delete();
        } catch (\Exception $e) {
            $message['general'] = 'Error al eliminar la vacación.';
        }

        if (!$result) {
            return back()->withErrors($message);
        }

        return redirect()->route('vacations.index')->with($message);
    }
}
