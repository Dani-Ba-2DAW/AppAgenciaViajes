@extends('template.base')

@section('content')
<div class="container mx-auto mt-10">

    <div class="bg-white shadow rounded p-6 mb-6">
        <h1 class="text-2xl font-bold mb-4">Panel de usuario</h1>
        <p><strong>{{ Auth::user()->name }}</strong> | {{ Auth::user()->email }} | Rol: {{ Auth::user()->rol }}</p>
        <a href="{{ route('home.edit') }}" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">Editar perfil</a>
    </div>

    @if($bookings->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4">
            No tienes reservas activas.
        </div>
    @else
        <table class="w-full bg-white shadow rounded overflow-hidden">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="p-3">Vacación</th>
                    <th class="p-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr class="border-b">
                        <td class="p-2"><a href="{{ route('vacations.show', $booking->vacation) }}">{{ $booking->vacation->title }}</a></td>
                        <td class="p-2 space-x-2">
                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn" onclick="return confirm('¿Cancelar reserva?')">Cancelar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
