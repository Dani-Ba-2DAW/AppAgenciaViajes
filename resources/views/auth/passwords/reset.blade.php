@extends('template.base')

@section('content')
<div class="container max-w-xl mx-auto mt-8">
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-4">Restablecer contraseña</h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="c-input">
                <label class="c-input__label">Email</label>
                <input type="email"
                       name="email"
                       value="{{ $email ?? old('email') }}"
                       class="c-input__element @error('email') is-invalid @enderror"
                       required autofocus>
                @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="c-input">
                <label class="c-input__label">Nueva contraseña</label>
                <input type="password"
                       name="password"
                       class="c-input__element @error('password') is-invalid @enderror"
                       required>
                @error('password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="c-input">
                <label class="c-input__label">Confirmar contraseña</label>
                <input type="password"
                       name="password_confirmation"
                       class="c-input__element"
                       required>
            </div>

            <button type="submit"
                    class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">
                Restablecer contraseña
            </button>
        </form>
    </div>
</div>
@endsection
