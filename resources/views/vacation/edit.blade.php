@extends('template.base')

@section('title', 'Editar Vacación')

@section('header', 'Editar Vacación')

@section('content')

<form action="{{ route('vacations.update', $vacation) }}"
    enctype="multipart/form-data"
    method="POST" class="space-y-4 bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')
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
                {{ (old('type_id') == $type->id || $vacation->type_id == $type->id) ? 'selected' : '' }}>
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

<form action="{{ route('photos.store') }}"
    method="POST"
    enctype="multipart/form-data"
    id="photoForm"
    class="bg-white p-4 rounded shadow">

    @csrf
    <input type="hidden" name="vacation_id" value="{{ $vacation->id ?? '' }}">

    <div id="drop-area" class="img-container rounded p-6 text-center cursor-pointer">
        <p class="text-gray-600">Arrastra las imágenes aquí o haz click</p>
        <input type="file"
            id="imageInput"
            name="image[]"
            multiple
            accept="image/*"
            class="hidden">
    </div>

    @error('image')
    <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror

    <div id="preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>

    <button type="submit" class="mt-4 dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">
        Subir imágenes
    </button>
</form>

<form method="POST" action="{{ route('photos.destroy.multiple') }}" class="bg-white p-4 rounded shadow">
    @csrf
    @method('DELETE')

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        @forelse ($vacation->photos as $photo)
            <div class="img-container rounded p-2 relative">
                <img
                    src="{{ route('photos.show', $photo) }}"
                    class="w-full h-320 object-cover rounded mb-2"
                >
                <label class="flex items-center gap-2 text-sm">
                    <input
                        type="checkbox"
                        name="photos[]"
                        value="{{ $photo->id }}"
                        class="rounded"
                    >
                    Eliminar
                </label>
            </div>
        @empty
            <p class="col-span-full text-gray-500">
                No hay imágenes asociadas.
            </p>
        @endforelse

    </div>

    @error('photos')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror

    <button type="submit" class="mt-4 dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">
        Eliminar imágenes seleccionadas
    </button>
</form>

@endsection

@section('scripts')

<script>
    const dropArea = document.getElementById('drop-area');
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    let files = [];

    /* CLICK */
    dropArea.addEventListener('click', () => input.click());

    /* DRAG EVENTS */
    ['dragenter', 'dragover'].forEach(event => {
        dropArea.addEventListener(event, e => {
            e.preventDefault();
            dropArea.classList.add('bg-blue-50');
        });
    });

    ['dragleave', 'drop'].forEach(event => {
        dropArea.addEventListener(event, e => {
            e.preventDefault();
            dropArea.classList.remove('bg-blue-50');
        });
    });

    /* DROP */
    dropArea.addEventListener('drop', e => {
        addFiles(e.dataTransfer.files);
    });

    /* FILE SELECT */
    input.addEventListener('change', e => {
        addFiles(e.target.files);
    });

    /* ADD FILES */
    function addFiles(selectedFiles) {
        [...selectedFiles].forEach(file => {
            if (!file.type.startsWith('image/')) return;
            files.push(file);
        });
        renderPreview();
        updateInputFiles();
    }

    /* RENDER PREVIEW */
    function renderPreview() {
        preview.innerHTML = '';

        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = e => {
                preview.innerHTML += `
                <div class="relative">
                    <img src="${e.target.result}" class="rounded shadow">
                    <button type="button"
                            onclick="removeFile(${index})"
                            class="dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn img-deleter">
                        ✕
                    </button>
                </div>
            `;
            };
            reader.readAsDataURL(file);
        });
    }

    /* REMOVE FILE */
    function removeFile(index) {
        files.splice(index, 1);
        renderPreview();
        updateInputFiles();
    }

    /* UPDATE INPUT */
    function updateInputFiles() {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        input.files = dataTransfer.files;
    }
</script>

@endsection