<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow">
    <title>@yield('title', 'Agencia de viajes')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://d1hkxmgwhmmdhs.cloudfront.net/dist/assets/css/halcon/main.css?v=010220261522">
    <link rel="stylesheet"
        href="https://d1hkxmgwhmmdhs.cloudfront.net/dist/assets/css/halcon/tours/main.css?v=010220261522">
    <link rel="stylesheet" href="https://d3ilgqc24d94mp.cloudfront.net/css/halcon/main.css">
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
</head>

<body class="s-loading showcase tours circuitos" itemscope="">
    <section data-plugin="header" class="dsc-co-header-wrapper plugin-ready">
        <header id="headerWrapper" class="dsc-co-header">
            <div class="dsc-co-header__inner">
                <div class="dsc-co-header__brand"> <button
                        class="dsc-co-header__menu-button dsc-plugin-menu-toggle-trigger hidden"> <i
                            class="dsc-co-icon dsc-co-header__menu-icon | size-6 text-[#1C1F21] dsc-co-icon-menu"></i>
                    </button> <a class="shrink-0 dsc-co-header__logo-container" href="{{ route('main') }}">
                        <img alt="Halcon Viajes" title="HALCÓN VIAJES® - Tu agencia online"
                            src="https://d3ilgqc24d94mp.cloudfront.net/assets/images/brands/halcon/logo.svg"
                            class="dsc-co-header__logo"> </a> </div>
                <nav class="dsc-co-header-nav-actions dsc-co-header-nav-actions--desktop flex">
                    @guest
                    <div class="dsc-co-header-nav-actions__login" id="user-not-logged-container-body">
                        <a class="dsc-co-header-nav-actions__login-link" rel="nofollow" aria-expanded="false" href="{{ route('login') }}">
                            <i class="dsc-co-icon dsc-co-icon-user w-3 h-3.5"></i>
                            <span class="dsc-co-header-nav-actions__login-label">Área usuario</span>
                        </a>
                    </div>
                    @else
                    <div class="dsc-co-header-nav-actions__login" id="user-logged-container-body">
                        <a class="dsc-co-header-nav-actions__login-link" rel="nofollow" aria-expanded="false" href="{{ route('home') }}">
                            <i class="dsc-co-icon dsc-co-icon-user w-3 h-3.5"></i>
                            <span class="dsc-co-header-nav-actions__login-label" id="user-logged-container-name">Hola, {{ Auth::user()->name }}</span>
                        </a>
                    </div>
                    <div class="dsc-co-header-nav-actions__login" id="user-logged-container-body">
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dsc-co-header-nav-actions__login-link" rel="nofollow" aria-expanded="false">
                                <i class="dsc-co-icon dsc-co-icon-exit w-3 h-3.5"></i>
                                <span class="dsc-co-header-nav-actions__login-label" id="user-logged-container-name">Cerrar sesión</span>
                            </button>
                        </form>
                    </div>
                    @endguest
                </nav>
            </div>
        </header>
        @if(auth()->user() && auth()->user()->rol !== 'user')
        <div class="dsc-co-header__nav-wrapper dsc-co-header__nav-wrapper--visible">
            <div class="dsc-co-header-nav-container">
                <ul class="dsc-co-header-nav plugin-ready dsc-co-header-nav--fit dsc-co-header-nav--relative">
                    <a class="mr-2">Panel de datos:</a>
                    <li class="dsc-co-header-nav__item plugin-ready">
                        <a class="dsc-co-menu-tab dsc-co-menu-tab--md dsc-co-menu-tab--default" href="{{ route('vacations.index') }}">
                            <span class="dsc-co-menu-tab__label">Vacaciones</span>
                        </a>
                    </li>
                    @if(auth()->user()->rol === 'admin')
                    <li class="dsc-co-header-nav__item plugin-ready">
                        <a class="dsc-co-menu-tab dsc-co-menu-tab--md dsc-co-menu-tab--default" href="{{ route('types.index') }}">
                            <span class="dsc-co-menu-tab__label">Tipos</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        @endif
    </section>
    <div class="pg-o-searcher-tours pg-o-searcher-tours--results">
        <div class="pg-o-slider-with-searcher" id="s-search-lite">
            <div class="pg-o-slider-with-searcher__slider">
                <div class="m-slider">
                    <div class="m-slider__init m-slider__init--loaded">
                        <div class="m-slider__outer">
                            <div class="m-slider__inner"
                                style="transform: translate3d(0px, 0px, 0px); transition: all;">
                                <div class="m-slider__item active">
                                    <div class="m-slider__box">
                                        <div class="m-hero">
                                            <picture class="m-slider__picture">
                                                <img class="m-slider__image lazy lazyloaded" src="@yield('main-image', 'https://d2l4159s3q6ni.cloudfront.net/dam/photos/81/77/4c/b9/5382dd98931aad39128aebb474444b50496d5a23570f8faebb50c11b.jpg')">
                                            </picture>
                                        </div>
                                        <h1 class="m-slider__caption m-slider__caption--top-left" itemprop="name"
                                            content="Circuitos España" data-cms="FLX tours-destination espana HALCON">
                                            <!-- <span class="m-slider__caption-claim">Circuitos</span> -->
                                            <span class="m-slider__caption-title">@yield('header')</span>
                                            <div class="m-slider__video">

                                            </div>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-slider__nav-container disabled">
                            <div class="m-slider__nav m-slider__nav--prev disabled"></div>
                            <div class="m-slider__nav m-slider__nav--next disabled"></div>
                        </div>
                        <div class="m-slider__dots disabled"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    @yield('scripts')
</body>

</html>