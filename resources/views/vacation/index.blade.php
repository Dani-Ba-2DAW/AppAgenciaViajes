@extends('template.base')

@section('title', 'Vacaciones')

@section('header', 'Explora Vacaciones')

@section('content')
<div class="mt-4 s-layout__container">
    @if(session('general'))
    <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
        {{ session('general') }}
    </div>
    @endif

    <a href="{{ route('vacations.create') }}" class="mb-4 dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">
        Nueva vacacion
    </a>

    <table class="w-full bg-white shadow rounded overflow-hidden">
        <thead class="text-white" style="background: #d52620">
            <tr>
                <th class="p-3">ID</th>
                <th class="p-3">Nombre</th>
                <th class="p-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacations as $vacation)
            <tr>
                <td class="border p-2">{{ $vacation->id }}</td>
                <td class="border p-2">{{ $vacation->title }}</td>
                <td class="border p-2 space-x-2">
                    <a href="{{ route('vacations.show', $vacation) }}" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn blue unset">
                        Ver
                    </a>
                    <a href="{{ route('vacations.edit', $vacation) }}" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn yellow unset">
                        Editar
                    </a>
                    <form action="{{ route('vacations.destroy', $vacation) }}"
                        method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn unset" onclick="return confirm('¿Eliminar vacacion?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection