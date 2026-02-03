@extends('template.base')

@section('title', 'Editar tipo')

@section('header', 'Editar tipo')

@section('content')

<form action="{{ route('types.update', $type) }}"
      method="POST"
      class="bg-white p-6 rounded shadow space-y-4">

    @csrf
    @method('PUT')

    <div class="c-input">
        <label class="block font-semibold">Nombre</label>
        <input type="text"
               class="c-input__element"
               name="name"
               value="{{ old('name', $type->name) }}">
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">
        Actualizar
    </button>

</form>

@endsection
