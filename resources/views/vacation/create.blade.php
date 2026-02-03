@extends('template.base')

@section('title', 'Crear Vacación')

@section('header', 'Nueva Vacación')

@section('content')

<form action="{{ route('vacations.store') }}"
    enctype="multipart/form-data"
    method="POST" class="space-y-4 bg-white p-6 rounded shadow">
    @csrf
    <div class="c-input">
        <label class="c-input__label">Título</label>
        <input type="text" class="c-input__element" name="title" value="{{ old('title', $vacation->title ?? '') }}">
        @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>
    <div class="c-input">
        <label class="c-input__label">País</label>
        <input type="text" class="c-input__element" name="country" value="{{ old('country', $vacation->country ?? '') }}">
        @error('country')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>
    <div class="c-input">
        <label class="c-input__label">Descripción</label>
        <textarea name="description" class="c-input__element">{{ old('description', $vacation->description ?? '') }}</textarea>
        @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>
    <div class="c-input">
        <label class="c-input__label">Precio (€)</label>
        <input type="number" step="0.01" class="c-input__element" name="price" value="{{ old('price', $vacation->price ?? '') }}">
        @error('price')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>
    <div class="c-select">
        <label class="c-input__label">Tipo</label>
        <select class="c-select__element" name="type_id">
            @foreach($types as $type)
            <option value="{{ $type->id }}"
                {{ old('type_id') == $type->id ? 'selected' : '' }}>
                {{ $type->name }}
            </option>
            @endforeach
        </select>
        <i class="c-select__icon c-icon c-icon-arrow c-icon-arrow--bottom"></i>
        @error('type_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>
    <button type="submit" class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">
        Guardar
    </button>
</form>

@endsection