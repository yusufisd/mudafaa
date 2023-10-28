<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Milli Müdafaa | @yield('title') </title>
    <meta name="title" content="@yield('meta-title')" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />

    <meta property="og:title" content="@yield('stitle')">
    <meta property="og:description" content="@yield('sdescription')">
    <meta property="og:image" content="@yield('simage')">
    <meta name="robots" content="index, follow">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/media/favicon.png') }}">

    <!-- Dependency Stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/frontend/dependencies/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/frontend/dependencies/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/dependencies/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/dependencies/swiper/css/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/frontend/dependencies/magnific-popup/css/magnific-popup.css') }}">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/style.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.11.0/css/flag-icons.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"
        integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('css')


</head>

<body>

    <!-- Start wrapper -->
    <div id="wrapper" class="wrapper">

        <!-- start perloader -->
        <div class="pre-loader" id="preloader">
            <div class="loader"></div>
        </div>
        <!-- end perloader -->

        <!-- Start main-content -->
        <div id="main_content" class="footer-fixed">

            <!-- Header -->
            <header class="rt-header sticky-on">

                <!-- sticky-placeholder -->
                <div id="sticky-placeholder"></div>

                <!-- start  topbar -->
                <div class="topbar topbar-style-1" id="topbar-wrap">
                    <div class="container">
                        <div class="row align-items-center">

                            <div class="col-lg-8">
                                <div class="rt-trending rt-trending-style-1">
                                    <p class="trending-title">
                                        <i class="fas fa-bullhorn icon"></i>
                                        {{ __('message.son dakika') }}
                                    </p>
                                    <div class="rt-treding-slider1 swiper-container">
                                        <div class="swiper-wrapper">

                                            @foreach (headline() as $item)
                                                <div class="swiper-slide">
                                                    <div class="item">
                                                        <p class="trending-slide-title">
                                                            {{ substr($item->title, 0, 60) }} ...
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-4">
                                <div class="rt-topbar-right">
                                    <div class="meta-wrap">
                                        <span class="rt-meta">
                                            <i class="far fa-calendar-alt icon"></i>
                                            <span class="">
                                                {{ currentDate()->translatedFormat('d M Y') }}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="social-wrap d-none d-xl-block">
                                        <ul class="rt-top-social">
                                            @if (SocialMedia())
                                                <li>
                                                    <a href="https://www.facebook.com/{{ SocialMedia()->facebook != null ? SocialMedia()->facebook : '' }}"
                                                        target="_blank">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (SocialMedia())
                                                <li>
                                                    <a href="https://twitter.com/{{ SocialMedia()->twitter != null ? SocialMedia()->twitter : '' }}"
                                                        target="_blank">
                                                        <img src="/assets/x.png" style="width: 13px" alt="">
                                                    </a>
                                                </li>
                                            @endif
                                            @if (SocialMedia())
                                                <li>
                                                    <a href="https://www.instagram.com/{{ SocialMedia()->instagram != null ? SocialMedia()->instagram : '' }}"
                                                        target="_blank">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (SocialMedia())
                                                <li>
                                                    <a href="https://www.youtube.com/channel/{{ SocialMedia()->youtube != null ? SocialMedia()->youtube : '' }}"
                                                        target="_blank">
                                                        <i class="fab fa-youtube"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (SocialMedia())
                                                <li>
                                                    <a href="https://www.linkedin.com/company/{{ SocialMedia()->linkedin != null ? SocialMedia()->linkedin : '' }}"
                                                        target="_blank">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                    <div class="meta-wrap ms-2">
                                        <span class="rt-meta">
                                            @if (langua() == 'tr')
                                                <a href="{{ route('chaange.lang', ['en']) }}">
                                                    <img alt="image" width="30"
                                                        src="{{ asset('/assets/en.png') }}">
                                                </a>
                                            @endif
                                            @if (langua() == 'en')
                                                <a href="{{ route('chaange.lang', 'tr') }}">
                                                    <img alt="image" width="30"
                                                        src="{{ asset('/assets/tr.png') }}">
                                                </a>
                                            @endif
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <!-- end col -->

                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container -->
                </div>
                <!-- end topbar -->

                <!-- Header Main -->
                <div class="header-main header-main-style-1 navbar-wrap" id="navbar-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-between">

                                <!-- start logo here -->
                                <div class="site-branding">
                                    <a class="dark-logo" href="{{ route('front.home') }}">
                                        <img src="/assets/frontend/media/logo/logo-light.png" width="250"
                                            height="52" src="" alt="neeon">

                                    </a>
                                    <a class="light-logo" href="{{ route('front.home') }}">
                                        <img src="/assets/frontend/media/logo/logo-light.png" width="250"
                                            height="52" alt="neeon">
                                    </a>
                                </div>
                                <!-- end logo here -->

                                <!-- start main menu -->
                                <div class="main-menu">
                                    <nav class="main-menu__nav">
                                        <ul>
                                            <li class="active">
                                                <a class="animation" href="{{ route('front.home') }}"><i
                                                        class="fa fa-home fa-md"></i></a>
                                            </li>
                                            <li
                                                class="main-menu__nav_sub list {{ Route::is('front.currentNewsCategory.list') || Route::is('front.currentNews.detail') ? 'active' : '' }}">
                                                <a class="animation" href="javascript:void(0)">
                                                    {{ __('message.güncel haberler') }} </a>
                                                <ul class="main-menu__dropdown">

                                                    @foreach (currentCats() as $item)
                                                        <li><a
                                                                href="{{ route('front.currentNewsCategory.list', $item->link) }}">
                                                                {{ $item->title }} </a></li>
                                                    @endforeach


                                                </ul>
                                            </li>
                                            <li
                                                class="main-menu__nav_sub list {{ Route::is('front.defenseIndustryCategory.list') || Route::is('front.defenseIndustryContent.detail') || Route::is('front.defenseIndustrySubCategory.list2') ? 'active' : '' }}">
                                                <a class="animation" href="javascript:void(0)">
                                                    {{ __('message.savunma sanayi') }} </a>
                                                <ul class="main-menu__dropdown">

                                                    @foreach (defenseIndustryCat() as $item)
                                                        <li><a
                                                                href="{{ route('front.defenseIndustryCategory.list', $item->link) }}">
                                                                {{ $item->title }} </a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </li>
                                            <li
                                                class="{{ Route::is('front.activity.detail') || Route::is('front.activity.list') || Route::is('front.activity.detail') ? 'active' : '' }}">
                                                <a class="animation" href="{{ route('front.activity.list') }}">
                                                    {{ __('message.etkinlikler') }} </a>
                                            </li>
                                            <li
                                                class="{{ Route::is('front.interview.list') || Route::is('front.interview.detail') ? 'active' : '' }}">
                                                <a class="animation" href="{{ route('front.interview.list') }}">
                                                    {{ __('message.röportajlar') }} </a>
                                            </li>
                                            <li
                                                class="{{ Route::is('front.company.list') || Route::is('front.company.detail') ? 'active' : '' }}">
                                                <a class="animation" href="{{ route('front.company.list') }}">
                                                    {{ __('message.firmalar') }} </a>
                                            </li>
                                            <li
                                                class="{{ Route::is('front.dictionary.list') || Route::is('front.dictionary.detail') ? 'active' : '' }}">
                                                <a class="animation" href="{{ route('front.dictionary.list') }}">
                                                    {{ __('message.ss sözlüğü') }}
                                                </a>
                                            </li>
                                            <li
                                                class="{{ Route::is('front.video.list') || Route::is('front.video.detail') ? 'active' : '' }}">
                                                <a class="animation" href="{{ route('front.video.list') }}">
                                                    {{ __('message.videolar') }} </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- end main menu -->

                                <!-- start header actions -->
                                <ul class="header-action-items">
                                    <li class="item">
                                        <a href="#template-search"><i class="fas fa-search"></i></a>
                                    </li>

                                </ul>
                                <!-- end header actions -->

                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container -->
                </div>
                <!-- End Header Main -->

            </header>
            <!-- end header -->

            <!-- start rt-mobile-header -->
            <div class="rt-mobile-header mobile-sticky-on">

                <div id="mobile-sticky-placeholder"></div>
                <!-- end mobile-sticky-placeholder -->

                <div class="mobile-menu-bar-wrap" id="mobile-menu-bar-wrap">
                    <div class="mobile-menu-bar">
                        <div class="logo">
                            <a href="{{ route('front.home') }}">
                                <img src="/assets/frontend/media/logo/mm.svg" alt="neeon" width="162"
                                    height="52">
                            </a>
                        </div>
                        <span class="sidebarBtn">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </span>
                    </div>
                    <div class="rt-slide-nav">
                        <div class="offscreen-navigation">
                            <nav class="menu-main-primary-container">
                                <ul class="menu">
                                    <li>
                                        <a class="animation" href="{{ route('front.home') }}">
                                            {{ __('message.anasayfa') }} </a>
                                    </li>
                                    <li class="list menu-item-has-children">
                                        <a class="animation"
                                            href="javascript:void(0)">{{ __('message.güncel haberler') }}</a>
                                        <ul class="main-menu__dropdown sub-menu">
                                            @foreach (currentCats() as $item)
                                                <li><a
                                                        href="{{ route('front.currentNewsCategory.list', $item->id) }}">
                                                        {{ $item->title }} </a></li>
                                            @endforeach
                                        </ul>

                                    </li>
                                    <li class="list menu-item-has-children">
                                        <a class="animation" href="javascript:void(0)">
                                            {{ __('message.savunma sanayi') }} </a>
                                        <ul class="main-menu__dropdown sub-menu">
                                            @foreach (defenseIndustryCat() as $item)
                                                <li><a
                                                        href="{{ route('front.defenseIndustryCategory.list', $item->id) }}">
                                                        {{ $item->title }} </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a class="animation" href="{{ route('front.activity.list') }}">
                                            {{ __('message.etkinlikler') }} </a></li>
                                    <li><a class="animation" href="{{ route('front.interview.list') }}">
                                            {{ __('message.röportajlar') }} </a></li>
                                    <li><a class="animation" href="{{ route('front.company.list') }}">
                                            {{ __('message.firmalar') }} </a>
                                    </li>
                                    <li><a class="animation" href="{{ route('front.dictionary.list') }}">
                                            {{ __('message.ss sözlüğü') }} </a></li>
                                    <li><a class="animation" href="{{ route('front.video.list') }}">
                                            {{ __('message.videolar') }} </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end rt-mobile-header -->

            @yield('content')

            <!-- Start Footer -->
            <footer class="footer" style="position: static">

                <div class="footer-top footer-style-1">
                    <div class="container">
                        <div class="row gutter-30">

                            <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms"
                                data-wow-duration="800ms">
                                <div class="footer-widget">
                                    <div class="logo footer-logo">
                                        <a class="dark-logo" href="{{ route('front.home') }}">
                                            <img width="250" height="52"
                                                src="/assets/frontend/media/logo/mm-beyaz.svg" alt="neeon">
                                        </a>
                                    </div>
                                    <p class="text footer-text">
                                        <span style="color: #fff;font-size:1.2rem">www.millimudafaa.com</span>
                                        {{ __('message.Sitede yayınlanan yazı, haber, video ve fotoğrafların tüm hakları Dada İst Ajans a aittir. Kaynak gösterilerek dahi olsa izin alınmadan alıntı yapılamaz') }}
                                    </p>
                                    <ul class="footer-social gutter-15">
                                        @if (SocialMedia())
                                            <li class="social-item">
                                                <a href="https://www.facebook.com/{{ SocialMedia()->facebook != null ? SocialMedia()->facebook : '' }}"
                                                    class="social-link" target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (SocialMedia())
                                            <li class="social-item">
                                                <a href="https://twitter.com/{{ SocialMedia()->twitter != null ? SocialMedia()->twitter : '' }}"
                                                    class="social-link" target="_blank">
                                                    <i class="fab fa-x-twitter"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (SocialMedia())
                                            <li class="social-item">
                                                <a href="https://www.instagram.com/{{ SocialMedia()->instagram != null ? SocialMedia()->instagram : '' }}"
                                                    class="social-link" target="_blank">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (SocialMedia())
                                            <li class="social-item">
                                                <a href="https://www.youtube.com/channel/{{ SocialMedia()->youtube != null ? SocialMedia()->youtube : '' }}"
                                                    class="social-link" target="_blank">
                                                    <i class="fab fa-youtube youtube"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (SocialMedia())
                                            <li class="social-item">
                                                <a href="https://www.linkedin.com/company/{{ SocialMedia()->linkedin != null ? SocialMedia()->linkedin : '' }}"
                                                    class="social-link" target="_blank">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                    <ul class="footer-social mt--20">
                                        <li>
                                            <a href="#" style="width: 5.5rem; margin-right:2px">
                                                <img src="https://millimudafaa.com/assets/img/app-store.png">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" style="width: 5.5rem; margin-right:2px">
                                                <img src="https://millimudafaa.com/assets/img/google-play.png">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" style="width: 5.5rem; margin-right:2px">
                                                <img src="https://millimudafaa.com/assets/img/huawei-app.png">
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-xl-6 col-md-12 wow fadeInUp" data-wow-delay="400ms"
                                data-wow-duration="800ms">
                                <div class="footer-widget">
                                    <div class="row">
                                        <div class="col-6 list_responsive">
                                            <!-- <h3 class="footer-widget-title">Diğer</h3> -->
                                            <ul class="widget-list cat-list">
                                                <li class="widget-list-item">
                                                    <a href="{{ route('front.about.detail') }}"
                                                        class="widget-list-link">
                                                        {{ __('message.hakkımızda') }}
                                                    </a>
                                                </li>

                                                @foreach (sayfalar() as $item)
                                                    <li class="widget-list-item">
                                                        <a href="{{ route('front.page.detail', $item->id) }}"
                                                            class="widget-list-link">
                                                            {{ $item->title }}
                                                        </a>
                                                    </li>
                                                @endforeach


                                            </ul>
                                        </div>
                                        <div class="col-6 list_responsive">
                                            <!-- <h3 class="footer-widget-title">Diğer</h3> -->
                                            <ul class="widget-list cat-list">
                                                <li class="widget-list-item">
                                                    <a href="{{ route('front.kunye') }}" class="widget-list-link">
                                                        Künye
                                                    </a>
                                                </li>
                                                <li class="widget-list-item">
                                                    <a href="{{ route('front.contact') }}" class="widget-list-link">
                                                        İletişim
                                                    </a>
                                                </li>
                                                <li class="widget-list-item">
                                                    <a href="" class="widget-list-link">
                                                        Reklam
                                                    </a>
                                                </li>
                                                <li class="widget-list-item">
                                                    <a href="" class="widget-list-link">
                                                        İş Birliği
                                                    </a>
                                                </li>
                                                <li class="widget-list-item">
                                                    <a href="{{ route('front.archive.index') }}"
                                                        class="widget-list-link">
                                                        Arşiv
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- end col -->

                            <div class="d-none d-md-block col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="600ms"
                                data-wow-duration="800ms">
                                <div class="footer-widget">
                                    <h3 class="footer-widget-title">Instagram</h3>
                                    <div class="insta-gallery">
                                        <div class="galleryitem">
                                            <a href="https://www.instagram.com/">
                                                <img src="/assets/frontend/media/gallery/ins-gallery_1.jpg"
                                                    width="100" height="90" alt="gallery1">
                                            </a>
                                        </div>
                                        <div class="galleryitem">
                                            <a href="https://www.instagram.com/">
                                                <img src="/assets/frontend/media/gallery/ins-gallery_2.jpg"
                                                    width="100" height="90" alt="gallery2">
                                            </a>
                                        </div>
                                        <div class="galleryitem">
                                            <a href="https://www.instagram.com/">
                                                <img src="/assets/frontend/media/gallery/ins-gallery_3.jpg"
                                                    width="100" height="90" alt="gallery3">
                                            </a>
                                        </div>
                                        <div class="galleryitem">
                                            <a href="https://www.instagram.com/">
                                                <img src="/assets/frontend/media/gallery/ins-gallery_4.jpg"
                                                    width="100" height="90" alt="gallery4">
                                            </a>
                                        </div>
                                        <div class="galleryitem">
                                            <a href="https://www.instagram.com/">
                                                <img src="/assets/frontend/media/gallery/ins-gallery_5.jpg"
                                                    width="100" height="90" alt="gallery5">
                                            </a>
                                        </div>
                                        <div class="galleryitem">
                                            <a href="https://www.instagram.com/">
                                                <img src="/assets/frontend/media/gallery/ins-gallery_6.jpg"
                                                    width="100" height="90" alt="gallery6">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                        </div>
                    </div>
                </div>
                <!-- End footer top -->

                <div class="footer-bottom">
                    <div class="container">
                        <div class="footer-bottom-area d-flex align-items-center justify-content-center">
                            <p class="copyright-text wow fadeInUp mb-0" data-wow-delay="200ms"
                                data-wow-duration="800ms">
                                <span class="currentYear"></span> © Copyright 2022 | Milli Müdafaa | Tüm Hakları
                                Saklıdır.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End footer bottom -->

            </footer>
            <!-- End  Footer -->

        </div>
        <!-- End main-content -->



        <!-- Start Search  -->
        <div id="template-search" class="template-search">
            <button type="button" class="close">×</button>
            <form class="search-form" action="{{ route('front.search') }}">
                <input type="search" value="" name="s" placeholder="Ara.." />
                <button type="submit" class="search-btn btn-ghost style-1">
                    <i class="flaticon-search"></i>
                </button>
            </form>
        </div>
        <!-- End Search -->

        <!-- theme-switch-box -->
        <div class="theme-switch-box-wrap">
            <div class="theme-switch-box">
                <span class="theme-switch-box__theme-status"><i class="fas fa-cog"></i></span>
                <label class="theme-switch-box__label" for="themeSwitchCheckbox">
                    <input class="theme-switch-box__input" type="checkbox" name="themeSwitchCheckbox"
                        id="themeSwitchCheckbox">
                    <span class="theme-switch-box__main"></span>
                </label>
                <span class="theme-switch-box__theme-status"><i class="fas fa-moon"></i></span>
            </div>
        </div>
        <!-- end theme-switch-box -->

        <!-- start back to top -->
        <a href="javascript:void(0)" id="back-to-top">
            <img src="/assets/frontend/media/elements/warplane-white.png" width="70%" alt="">
        </a>
        <!-- End back to top -->

    </div>
    <!-- End wrapper -->


    <!-- Dependency Scripts -->
    <script src="{{ asset('assets/frontend/dependencies/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/popper.js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/appear/appear.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/swiper/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/masonry/masonry.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/magnific-popup/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/theia-sticky-sidebar/resize-sensor.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/theia-sticky-sidebar/theia-sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/validator/validator.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/tween-max/tween-max.js') }}"></script>
    <script src="{{ asset('assets/frontend/dependencies/wow/js/wow.min.js') }}"></script>

    <!-- custom -->
    <script src="{{ asset('assets/frontend/js/app.js') }}"></script>


    @yield('script')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')



</body>

</html>
