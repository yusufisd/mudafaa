<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Milli Müdafaa | Ana Sayfa </title>

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

                            <div class="col-lg-7">
                                <div class="rt-trending rt-trending-style-1">
                                    <p class="trending-title">
                                        <i class="fas fa-bullhorn icon"></i>
                                        SON DAKİKA
                                    </p>
                                    <div class="rt-treding-slider1 swiper-container">
                                        <div class="swiper-wrapper">

                                            @foreach (headline() as $item)
                                                <div class="swiper-slide">
                                                    <div class="item">
                                                        <p class="trending-slide-title">
                                                            {{ $item->title }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-5">
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
                                            <li>
                                                <a href="https://www.facebook.com/millimudafaacom" target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/millimudafaacom" target="_blank">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.instagram.com/millimudafaacom" target="_blank">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.youtube.com/channel/UC6uGHKEHHGh08sTWjhBrG9A"
                                                    target="_blank">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.linkedin.com/company/milli-m%C3%BCdafaa/"
                                                    target="_blank">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="ms-2 meta-wrap">
                                        <span class="rt-meta">
                                            <a href="">
                                                <img alt="image" width="30"
                                                    src="https://gaviapanel.gaviaworks.org/assets/images/svg/englandx.svg">
                                            </a>
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
                                    <a class="dark-logo" href="index.html">
                                        <img src="/assets/frontend/media/logo/logo-light.png" width="250"
                                            height="52" src="" alt="neeon">

                                    </a>
                                    <a class="light-logo" href="index.html">
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
                                                <a class="animation" href="index.html"><i
                                                        class="fa fa-home fa-md"></i></a>
                                            </li>
                                            <li class="main-menu__nav_sub list">
                                                <a class="animation" href="javascript:void(0)">Güncel Haberler</a>
                                                <ul class="main-menu__dropdown">

                                                    @foreach (currentCats() as $item)
                                                        <li><a
                                                                href="{{ route('front.currentNewsCategory.list', $item->id) }}">
                                                                {{ $item->title }} </a></li>
                                                    @endforeach


                                                </ul>
                                            </li>
                                            <li class="main-menu__nav_sub list">
                                                <a class="animation" href="javascript:void(0)">Savunma Sanayi </a>
                                                <ul class="main-menu__dropdown">

                                                    @foreach (defenseIndustryCat() as $item)
                                                        <li><a
                                                                href="{{ route('front.defenseIndustryCategory.list', $item->id) }}">
                                                                {{ $item->title }} </a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </li>
                                            <li>
                                                <a class="animation"
                                                    href="{{ route('front.activity.list') }}">Etkinlikler</a>
                                            </li>
                                            <li>
                                                <a class="animation" href="{{route('front.interview.list')}}">Röportajlar</a>
                                            </li>
                                            <li>
                                                <a class="animation" href="{{route('front.company.list')}}">Firmalar</a>
                                            </li>
                                            <li>
                                                <a class="animation" href="{{route('front.dictionary.list')}}">SS Sözlüğü</a>
                                            </li>
                                            <li>
                                                <a class="animation"
                                                    href="{{ route('front.video.list') }}">Videolar</a>
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
                            <a href="index.html">
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
                                        <a class="animation" href="index.html">Ana Sayfa</a>
                                    </li>
                                    <li class="list menu-item-has-children">
                                        <a class="animation" href="javascript:void(0)">Güncel Haberler</a>
                                        <ul class="main-menu__dropdown sub-menu">
                                            @foreach (currentCats() as $item)
                                                <li><a
                                                        href="{{ route('front.currentNewsCategory.list', $item->id) }}">
                                                        {{ $item->title }} </a></li>
                                            @endforeach
                                        </ul>

                                    </li>
                                    <li class="list menu-item-has-children">
                                        <a class="animation" href="javascript:void(0)">Savunma Sanayi</a>
                                        <ul class="main-menu__dropdown sub-menu">
                                            @foreach (defenseIndustryCat() as $item)
                                                <li><a href="aerial_platforms.html"> {{ $item->title }} </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a class="animation" href="activity.html">Etkinlikler</a></li>
                                    <li><a class="animation" href="reports_list.html">Röportajlar</a></li>
                                    <li><a class="animation" href="companies.html">Firmalar</a></li>
                                    <li><a class="animation" href="ss.html">SS Sözlüğü</a></li>
                                    <li><a class="animation" href="videos.html">Videolar</a></li>
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
                                        <a class="dark-logo" href="index.html">
                                            <img width="250" height="52"
                                                src="/assets/frontend/media/logo/mm-beyaz.svg" alt="neeon">
                                        </a>
                                    </div>
                                    <p class="text footer-text">
                                        <span style="color: #fff;font-size:1.2rem">www.millimudafaa.com</span> internet
                                        sitesinde yayınlanan yazı, haber, video ve fotoğrafların her türlü hakkı Dada
                                        İst Ajans’a aittir. İzin alınmadan, kaynak gösterilerek dahi iktibas edilemez.
                                    </p>
                                    <ul class="footer-social gutter-15">
                                        <li class="social-item">
                                            <a href="https://www.facebook.com/millimudafaacom" class="social-link"
                                                target="_blank">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li class="social-item">
                                            <a href="https://twitter.com/millimudafaacom" class="social-link"
                                                target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="social-item">
                                            <a href="https://www.instagram.com/millimudafaacom" class="social-link"
                                                target="_blank">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li class="social-item">
                                            <a href="https://www.youtube.com/channel/UC6uGHKEHHGh08sTWjhBrG9A"
                                                class="social-link" target="_blank">
                                                <i class="fab fa-youtube youtube"></i>
                                            </a>
                                        </li>
                                        <li class="social-item">
                                            <a href="https://www.linkedin.com/company/milli-m%C3%BCdafaa/"
                                                class="social-link" target="_blank">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
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
                                                    <a href="corporate.html" class="widget-list-link">
                                                        Hakkımızda
                                                    </a>
                                                </li>
                                                <li class="widget-list-item">
                                                    <a href="empty.html" class="widget-list-link">
                                                        Yayın İlkeleri
                                                    </a>
                                                </li>
                                                <li class="widget-list-item">
                                                    <a href="empty.html" class="widget-list-link">
                                                        Kullanım Şartları
                                                    </a>
                                                </li>
                                                <li class="widget-list-item">
                                                    <a href="empty.html" class="widget-list-link">
                                                        Gizlilik Politikası
                                                    </a>
                                                </li>
                                                <li class="widget-list-item">
                                                    <a href="empty.html" class="widget-list-link">
                                                        Çerez Politikası
                                                    </a>
                                                </li>
                                                <li class="widget-list-item">
                                                    <a href="" class="widget-list-link">
                                                        Kişisel Verilerin Korunması
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-6 list_responsive">
                                            <!-- <h3 class="footer-widget-title">Diğer</h3> -->
                                            <ul class="widget-list cat-list">
                                                <li class="widget-list-item">
                                                    <a href="tag.html" class="widget-list-link">
                                                        Künye
                                                    </a>
                                                </li>
                                                <li class="widget-list-item">
                                                    <a href="contact.html" class="widget-list-link">
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
                                                    <a href="archive.html" class="widget-list-link">
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
                            <p class="copyright-text mb-0 wow fadeInUp" data-wow-delay="200ms"
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
            <form class="search-form">
                <input type="search" value="" placeholder="Ara.." />
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
