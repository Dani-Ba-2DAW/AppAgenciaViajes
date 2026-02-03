@extends('template.base')

@section('content')
<div class="container mx-auto max-w-md mt-10">
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-xl font-bold mb-4">Verifica tu correo</h1>

        @if (session('resent'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            Se ha enviado un enlace de verificación.
        </div>
        @endif

        <p class="mb-4">Antes de continuar, revisa tu correo para el enlace de verificación.</p>
        <p class="mb-4">Si no recibiste el correo, pulsa:</p>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">Reenviar enlace</button>
        </form>
    </div>
</div>
@endsections