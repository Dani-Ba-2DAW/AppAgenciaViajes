@extends('template.base')

@section('content')
<div class="container mx-auto max-w-md mt-10">
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Editar perfil</h1>

        <form method="POST" action="{{ route('home.update') }}" class="space-y-4">
            @csrf
            @method('put')

            <div class="c-input">
                <label class="c-input__label">Nombre</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="c-input__element @error('name') border-red-500 @enderror">
                @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="c-input">
                <label class="c-input__label">Correo</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="c-input__element @error('email') border-red-500 @enderror">
                @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="c-input">
                <label class="c-input__label">Contraseña actual</label>
                <input type="password" name="current-password" class="c-input__element @error('current-password') border-red-500 @enderror">
                @error('current-password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="c-input">
                <label class="c-input__label">Nueva contraseña</label>
                <input type="password" name="password" class="c-input__element @error('password') border-red-500 @enderror">
                @error('password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="c-input">
                <label class="c-input__label">Repetir nueva contraseña</label>
                <input type="password" name="password_confirmation" class="c-input__element">
            </div>

            <button type="submit" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">Guardar cambios</button>
        </form>
    </div>
</div>
@endsection