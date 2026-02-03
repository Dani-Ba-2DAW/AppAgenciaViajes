@extends('template.base')

@section('content')
<div class="container max-w-xl mx-auto mt-8">
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-2">Confirmar contraseña</h2>
        <p class="text-gray-600 mb-4">
            Por favor, confirma tu contraseña para continuar.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
            @csrf

            <div class="c-input">
                <label class="c-input__label">Contraseña</label>
                <input type="password"
                       name="password"
                       class="c-input__element @error('password') is-invalid @enderror"
                       required>
                @error('password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="flex items-center gap-4">
                <button type="submit"
                        class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">
                    Confirmar
                </button>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-gray-600 hover:underline">
                        ¿Has olvidado la contraseña?
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
