@extends('template.base')

@section('content')
<div class="container mx-auto max-w-md mt-10">
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div class="c-input">
                <label class="c-input__label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="c-input__element @error('email') border-red-500 @enderror">
                @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="c-input">
                <label class="c-input__label">Contraseña</label>
                <input type="password" name="password" required class="c-input__element @error('password') border-red-500 @enderror">
                @error('password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="text-sm">Recordarme</label>
            </div>

            <button type="submit" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">Entrar</button>

            <div class="flex text-sm mt-2 gap-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
                @endif
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Registrarse</a>
            </div>
        </form>
    </div>
</div>
@endsection
