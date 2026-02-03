@extends('template.base')

@section('title', 'Nuevo tipo')

@section('header', 'Crear tipo')

@section('content')

<form action="{{ route('types.store') }}"
      method="POST"
      class="space-y-4 bg-white p-6 rounded shadow">

    @csrf

    <div class="c-input">
        <label class="block font-semibold">Nombre</label>
        <input type="text"
               class="c-input__element"
               name="name"
               value="{{ old('name') }}">
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">
        Guardar
    </button>

</form>

@endsection
