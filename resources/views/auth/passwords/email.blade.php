@extends('template.base')

@section('content')
<div class="container max-w-xl mx-auto mt-8">
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-4">Recuperar contraseña</h2>

        @if (session('status'))
            <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div class="c-input">
                <label class="c-input__label">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="c-input__element @error('email') is-invalid @enderror"
                       required autofocus>
                @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <button type="submit"
                    class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">
                Enviar enlace de recuperación
            </button>
        </form>
    </div>
</div>
@endsection
