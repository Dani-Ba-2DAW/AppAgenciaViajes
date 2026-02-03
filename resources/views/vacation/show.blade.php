@extends('template.base')

@section('title', $vacation->title)

@section('header', $vacation->title)

@section('main-image', $vacation->firstPhoto())

@section('content')
<div class="pg-p-tours-detail pg-p-tours-detail-v2">
    <div class="m-booking-bar m-booking-bar--years" data-visibility-limit="m-booking-bar-fixed">
        <div class="m-booking-bar__container s-layout__container">
            <div class="m-booking-bar__col m-booking-bar__col--actions">
                <div class="m-booking-bar__flex-wrap" data-content="medium">
                    <div class="c-price m-booking-bar__price text-align-right">
                        <span class="c-price__from">Desde</span>
                        <span class="c-price__element">{{ $vacation->price }} €</span>
                    </div>
                    @if(!auth()->user() || !auth()->user()->hasVerifiedEmail() || $vacation->isBookedByUser(auth()->user()))
                    <a class="c-btn c-btn--has-radius c-btn--tertiary c-btn--big c-btn--uppercase js-modal-trigger disabled">{{ $vacation->isBookedByUser(auth()->user()) ? 'Ya reservado' : 'No puedes reservar' }}</a>
                    @else
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <input type="hidden" name="vacation_id" value="{{ $vacation->id }}">
                        <button class="c-btn c-btn--has-radius c-btn--tertiary c-btn--big c-btn--uppercase js-modal-trigger">Reservar</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="s-layout s-layout--has-bg-img s-layout--has-bg-img--contain s-layout--has-bg-img--top lazy lazyloaded" data-src-background="https://d1hkxmgwhmmdhs.cloudfront.net/dist/assets/img/halcon/backgrounds/bg-mountains.jpg" data-webproduct-code="M505S" id="main-container" style="background-image: url(&quot;https://d1hkxmgwhmmdhs.cloudfront.net/dist/assets/img/halcon/backgrounds/bg-mountains.jpg&quot;);">
        <div itemprop="description">
            <section class="m-seo-text m-seo-text--theme-2 s-layout s-layout--has-padding-top-medium s-layout--has-padding-bottom-medium" id="anchor-information">
                <div class="s-layout__container">
                    <div class="c-heading c-heading--type-28 c-heading--type-28 c-heading--has-margin-bottom--large">
                        <span>Viaje a {{ $vacation->country }}</span>
                    </div>
                    <p>{{ $vacation->description }}</p>
                </div>
            </section>
            <div class="vacation-gallery flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-3/4">
                    <img
                        id="main-photo"
                        src="{{ $vacation->firstPhoto() }}"
                        alt="{{ $vacation->title }}"
                        class="w-full h-auto rounded shadow">
                </div>
                <div class="flex md:flex-col gap-2 overflow-x-auto md:overflow-y-auto md:w-1/4 md:h-1">
                    @foreach($vacation->photos as $photo)
                    <img
                        src="{{ route('photos.show', $photo) }}"
                        data-full="{{ route('photos.show', $photo) }}"
                        alt="{{ $vacation->title }}"
                        class="cursor-pointer w-20 h-20 object-cover rounded border border-gray-300 hover:border-blue-500">
                    @endforeach
                </div>
            </div>
            <section class="m-seo-text m-seo-text--theme-2 s-layout s-layout--has-padding-top-medium s-layout--has-padding-bottom-medium">
                <div class="s-layout__container">
                    <h2 class="text-xl font-semibold mb-4">
                        Comentarios
                    </h2>

                    @forelse($vacation->comments as $comment)
                    <div class="border-b pb-3 mt-3">
                        <p class="font-semibold text-sm">
                            {{ $comment->user->name }}
                        </p>
                        <p class="text-gray-700">
                            {{ $comment->text }}
                        </p>
                        <p class="text-xs text-gray-500 pb-4 m-0">
                            {{ $comment->created_at->diffForHumans() }}
                        </p>
                        @if(auth()->check() && $comment->canBeDeletedBy(auth()->user()))
                        <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mb-4 dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn" onclick="return confirm('¿Eliminar este comentario?')">
                                Eliminar
                            </button>
                        </form>
                        @endif
                    </div>
                    @empty
                    <p class="text-gray-500">
                        Todavía no hay comentarios.
                    </p>
                    @endforelse

                    @php $user = auth()->user(); @endphp

                    @if($vacation->canBeCommentedBy($user))
                    <form method="POST"
                        action="{{ route('comments.store', $vacation) }}"
                        class="mt-6">

                        @csrf

                        <div class="c-input">
                            <label class="block font-semibold">
                                Añade tu comentario
                            </label>

                            <textarea name="text"
                                class="c-input__element"
                                rows="4">{{ old('text') }}</textarea>

                            @error('text')
                            <span class="text-red-500 text-sm">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="mt-4 dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn">
                            Enviar comentario
                        </button>
                    </form>

                    @elseif(!$user)
                    <p class="text-gray-500 mt-4">
                        Inicia sesión para comentar.
                    </p>

                    @elseif(!$user->hasVerifiedEmail())
                    <p class="text-gray-500 mt-4">
                        Verifica tu email para comentar.
                    </p>

                    @else
                    <p class="text-gray-500 mt-4">
                        Solo los usuarios que han reservado pueden comentar.
                    </p>
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainPhoto = document.getElementById('main-photo');
        const thumbnails = document.querySelectorAll('.vacation-gallery img[data-full]');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                mainPhoto.src = this.dataset.full;

                // Opcional: resaltar miniatura seleccionada
                thumbnails.forEach(t => t.classList.remove('border-blue-500'));
                this.classList.add('border-blue-500');
            });
        });
    });
</script>
@endsection