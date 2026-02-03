@extends('template.base')

@section('content')
<div class="container mx-auto max-w-md mt-10">
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Registro</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="c-input">
                <label class="c-input__label">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus class="c-input__element @error('name') border-red-500 @enderror">
                @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="c-input">
                <label class="c-input__label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="c-input__element @error('email') border-red-500 @enderror">
                @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="c-input">
                <label class="c-input__label">Contraseña</label>
                <input type="password" name="password" required class="c-input__element @error('password') border-red-500 @enderror">
                @error('password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="c-input">
                <label class="c-input__label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" required class="c-input__element">
            </div>

            <button type="submit" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">Registrarse</button>
            <div class="flex text-sm mt-2">
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Iniciar sesión</a>
            </div>
        </form>
    </div>
</div>
@endsection
