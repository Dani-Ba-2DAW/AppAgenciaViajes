@extends('template.base')

@section('content')
<div class="pg-o-tours-results">
    <!-- cambiar por template buscador de la home -->

    <section
        class="s-layout s-layout--has-padding-top-big s-layout--has-padding-bottom s-layout--has-bg-img s-layout--has-bg-img--contain s-layout--has-bg-img--top lazy lazyloaded"
        data-src-background="https://d1hkxmgwhmmdhs.cloudfront.net/dist/assets/img/halcon/backgrounds/bg-mountains.jpg"
        style="background-image: url(&quot;https://d1hkxmgwhmmdhs.cloudfront.net/dist/assets/img/halcon/backgrounds/bg-mountains.jpg&quot;);">


        <div class="s-layout__container u-mb-30">
            <div class="gel-layout m-seo">
                <div class="gel-layout__item gel-1/1 ">
                    <h2 class="c-heading c-heading--type-2 c-heading--has-line">
                        <span>Mejores viajes por el mundo</span>
                    </h2>

                    <p class="pg-a-typo-keid u-mt-20">Explorar España es una experiencia inigualable gracias a su
                        rica cultura y su extenso patrimonio. Desde la vibrante Madrid hasta la histórica Sevilla,
                        cada rincón del país ofrece algo único. No olvides las islas Canarias y Baleares, donde la
                        belleza natural se mezcla con la tradición y el encanto local. Y es que los circuitos por
                        España están diseñados para mostrarte lo mejor del país. Ya sea que busques diversión,
                        cultura o simplemente relajarte, hay un viaje perfecto para ti. Sumérgete en la historia, la
                        gastronomía y la calidez de su gente mientras recorres la península Ibérica y sus islas.</p>
                </div>

            </div>
        </div>

        <div class="s-layout__container s-layout__container--tiny s-hotel-list">
            <div class="s-result-heading">
                <div class="s-result-heading__title">
                    <div class="c-heading c-heading--type-3 c-heading--uppercase">
                        <span>Vacaciones</span>
                    </div>
                    <div class="s-result-heading__num" id="layout-content" data-layout-direction="false">
                        <strong><span id="toursNumResults">{{ $vacations->count() }}</span> <span
                                class="lastSpan">circuitos</span></strong>

                    </div>
                </div>
            </div>

            <div class="s-filters-layout" id="layout" data-gtm-activation="view_item_list" data-gtm-results="">
                <aside class="s-filters-layout__sidebar s-filters-layout__sidebar--visible  ">
                    <div class="s-filters-layout__box">
                        <div class="m-filters">
                            <div class="m-filters__title">
                                <span>Filtrar resultados</span>
                                <a class="m-filters__close js-toggle-trigger c-icon c-icon-close c-icon--big"
                                    data-toggle-class="backdrop filters-is-active" data-toggle-target="body"></a>
                            </div>
                            <div class="m-filters__dropdown">
                                <div class="m-filters__dropdown-title c-heading c-heading--type-5 c-heading--uppercase js-toggle-trigger">
                                    <!-- <i class="c-icon c-icon-arrow c-icon-arrow--bottom c-icon--small"></i> -->
                                    Buscador
                                </div>
                                <div class="m-filters__dropdown-box">
                                    <form class="d-flex" role="search" method="get" action="{{ route('main') }}">
                                        @foreach(request()->except(['page', 'q']) as $key => $value)
                                        @if(is_array($value))
                                        @foreach($value as $v)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                        @endforeach
                                        @else
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endif
                                        @endforeach
                                        <input class="c-input__element" name="q" type="search" placeholder="Buscar..." aria-label="Search" value="{{ $q ?? '' }}">
                                        <button class="mt-4 dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn full" type="submit">Buscar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="m-filters__dropdown last-border">
                                <div class="m-filters__dropdown-title c-heading c-heading--type-5 c-heading--uppercase js-toggle-trigger">
                                    Ordenar por
                                </div>
                                <div class="m-filters__dropdown-box">
                                    <ul class="filter-list">
                                        <li><a href="{{ route('main', array_merge(request()->except('page'), ['col' => 'id', 'order' => 'desc'])) }}"><input class="form-check-input" type="radio" name="orderRadius" {{ ($col === 'id' && $order === 'desc') ? 'checked' : '' }}>Más recientes</a></li>
                                        <li><a href="{{ route('main', array_merge(request()->except('page'), ['col' => 'id', 'order' => 'asc'])) }}"><input class="form-check-input" type="radio" name="orderRadius" {{ ($col === 'id' && $order === 'asc') ? 'checked' : '' }}>Más antiguos</a></li>
                                        <li><a href="{{ route('main', array_merge(request()->except('page'), ['col' => 'title', 'order' => 'asc'])) }}"><input class="form-check-input" type="radio" name="orderRadius" {{ ($col === 'title' && $order === 'asc') ? 'checked' : '' }}>Primeros (a-z)</a></li>
                                        <li><a href="{{ route('main', array_merge(request()->except('page'), ['col' => 'title', 'order' => 'desc'])) }}"><input class="form-check-input" type="radio" name="orderRadius" {{ ($col === 'title' && $order === 'desc') ? 'checked' : '' }}>Últimos (z-a)</a></li>
                                        <li><a href="{{ route('main', array_merge(request()->except('page'), ['col' => 'price', 'order' => 'desc'])) }}"><input class="form-check-input" type="radio" name="orderRadius" {{ ($col === 'price' && $order === 'desc') ? 'checked' : '' }}>Más caro</a></li>
                                        <li><a href="{{ route('main', array_merge(request()->except('page'), ['col' => 'price', 'order' => 'asc'])) }}"><input class="form-check-input" type="radio" name="orderRadius" {{ ($col === 'price' && $order === 'asc') ? 'checked' : '' }}>Más barato</a></li>
                                    </ul>
                                </div>
                            </div>
                            <form method="GET" action="{{ route('main') }}">
                                <div class="m-filters__dropdown">
                                    <div class="m-filters__dropdown-title c-heading c-heading--type-5 c-heading--uppercase js-toggle-trigger">
                                        Tipo de viaje
                                    </div>
                                    <div class="m-filters__dropdown-box">
                                        @foreach(request()->except('page', 'typeid') as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endforeach
                                        @foreach($types as $i => $type)
                                        <a class="m-filters__check c-checkbox">
                                            <input id="category-{{ $i }}" name="typeid[]" value="{{ $type->id }}" type="checkbox" {{ in_array($type->id, request()->input('typeid', [])) ? 'checked' : '' }}>
                                            <label for="category-{{ $i }}">{{ $type->name }}</label>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="m-filters__dropdown">
                                    <div class="m-filters__dropdown-title c-heading c-heading--type-5 c-heading--uppercase js-toggle-trigger">
                                        Filtrar por precio (€)
                                    </div>
                                    <input class="c-input__element" name="from" type="number" placeholder="Desde" value="{{ $from ?? '' }}">
                                    <input class="mt-2 c-input__element" name="to" type="number" placeholder="Hasta" value="{{ $to ?? '' }}">
                                </div>
                                <button class="mt-4 dsc-co-header-nav-actions__login dsc-co-header-nav-actions__login-link normal-btn full" type="submit">Filtrar</button>
                            </form>
                        </div>
                    </div>
                </aside>
                <div id="tours-offers-container"
                    class="s-filters-layout__content s-filters-layout__content--vertical" data-gtm-ecommerce="">
                    @foreach($vacations as $vacation)
                    <article class="m-offer-tours a-zoom-image m-offer-tours--has-shadow m-offer-tours--vertical">
                        <div class="m-offer-tours__media">
                            <picture class="m-offer-tours__picture">
                                <img class="lazy lazyloaded"
                                    alt="{{ $vacation->title }}"
                                    src="{{ $vacation->firstPhoto() }}"
                                    itemprop="image" data-prop="image">
                            </picture>
                        </div>
                        <div class="m-offer-tours__content">
                            <div class="m-offer-tours__desc">
                                <h3 class="m-offer-tours__title">
                                    <a class="view-tour-offer-trigger" href="{{ route('vacations.show', $vacation->id) }}">{{ $vacation->title }}</a>
                                </h3>
                            </div>
                            <div class="m-offer-tours__itinerary">
                                <h4 class="m-offer-tours__itinerary-ct">{{ $vacation->country }}</span>
                                </h4>
                            </div>
                            <p class="m-offer-tours__text">{{ $vacation->description }}</p>
                        </div>
                        <div class="m-offer-tours__actions">
                            <a class="m-offer-tours__price c-price c-price--theme-2 view-tour-offer-trigger js-tooltip-trigger" href="{{ route('vacations.show', $vacation->id) }}">
                                <div class="c-price__box">
                                    <span class="c-price__element">Ver más</span>
                                </div>
                                <div class="c-price__box c-price__box--arrow">
                                    <span class="c-price__arrow c-icon c-icon-direction c-icon--medium"></span>
                                </div>
                            </a>
                        </div>
                    </article>
                    @endforeach
                    <div class="s-filters-layout__filters">
                        <div class="s-filters-layout__actions">
                            <div class="m-actions-list m-actions-list--bottom">
                                <div class="m-actions-list__col m-actions-list__col--pagination">
                                    <div class="c-pagination">
                                        @php
                                        $total = $vacations->lastPage();
                                        $current = $vacations->currentPage();
                                        @endphp

                                        {{-- Botón anterior --}}
                                        @if($vacations->onFirstPage())
                                        <span class="c-pagination__page is-disabled">&laquo;</span>
                                        @else
                                        <a class="c-pagination__page" href="{{ $vacations->previousPageUrl() }}">&laquo;</a>
                                        @endif

                                        {{-- Números de página --}}
                                        @for($i = 1; $i <= $total; $i++)
                                            @if($i==$current)
                                            <span class="c-pagination__page is-active" data-page="{{ $i }}">{{ $i }}</span>
                                            @elseif($i <= 5 || $i> $total - 2 || abs($i - $current) <= 1)
                                                    <a class="c-pagination__page" data-page="{{ $i }}" href="{{ $vacations->url($i) }}">{{ $i }}</a>
                                                    @elseif($i == 6 || $i == $total - 2)
                                                    <span class="c-pagination__dots">...</span>
                                                    @endif
                                                    @endfor

                                                    {{-- Botón siguiente --}}
                                                    @if($vacations->hasMorePages())
                                                    <a class="c-pagination__page" href="{{ $vacations->nextPageUrl() }}">&raquo;</a>
                                                    @else
                                                    <span class="c-pagination__page is-disabled">&raquo;</span>
                                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection