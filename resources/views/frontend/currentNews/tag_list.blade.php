@extends('frontend.master')
@section('title','etiket')

@section('content')
    <!-- Start Main -->
    <style>
        .pagination>li>a,
        .pagination>li>span {
            color: rgb(26, 159, 26); // use your own color here
        }
    </style>
    <main>
        <!-- theme-switch-box -->
        <div class="theme-switch-box-mobile-wrap">
            <div class="theme-switch-box-mobile">
                <span class="theme-switch-box-mobile__theme-status"><i class="fas fa-cog"></i></span>
                <label class="theme-switch-box-mobile__label" for="themeSwitchCheckboxMobile">
                    <input class="theme-switch-box-mobile__input" type="checkbox" name="themeSwitchCheckboxMobile"
                        id="themeSwitchCheckboxMobile">
                    <span class="theme-switch-box-mobile__main"></span>
                </label>
                <span class="theme-switch-box-mobile__theme-status"><i class="fas fa-moon"></i></span>
            </div>
        </div>
        <!-- end theme-switch-box-mobile -->

        <!-- Start inner page Banner -->
        <div class="banner inner-banner">
            <div class="container">
                <nav class="rt-breadcrumb-wrap" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Etiket
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- start rt-sidebar-section-layout-2 -->
        <section class="rt-sidebar-section-layout-2">
            <div class="d-block d-md-none sidebar-wrap container mb--40">
                <div class="search-box">
                    <form action="#" class="form search-form-box">
                        <div class="form-group">
                            <input type="text" name="sarch" id="search" placeholder="ARA..."
                                class="form-control rt-search-control">
                            <button type="submit" class="search-submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end sidebar wrap -->
            <div class="container">
                <div class="row gutter-40 sticky-coloum-wrap">
                    <div class="col-xl-9 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">

                            <div class="post-list-style-4">

                                @foreach ($datas as $item)
                                    <div class="post-item wow fadeInUp" data-wow-delay="100ms" data-wow-duration="800ms">
                                        <div class="rt-post post-md style-9 grid-meta">
                                            <div class="post-content">
                                                @foreach ($item->Category() as $Category)
                                                    
                                                <a href="{{ route('front.currentNewsCategory.list', $Category->link) }}"
                                                    style="background-color: {{ $Category->color_code != null ? $Category->color_code : '' }}"
                                                    class="rt-cat-primary">{{ $Category->title }}</a>
                                                @endforeach

                                                <h3 class="post-title">
                                                    <a href="{{ route('front.currentNews.detail', $item->link) }}"
                                                        class="restricted_title">
                                                        {{ $item->title }}
                                                    </a>
                                                </h3>
                                                <p class="restricted_text">
                                                    {{ $item->short_description }}
                                                </p>
                                                <div class="post-meta">
                                                    <ul>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fa fa-user"></i> <a href="" class="name">
                                                                    {{ $item->Author->name }} {{ $item->Author->surname }}
                                                                </a>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->created_at->translatedFormat('d M Y') }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-eye icon"></i>
                                                                {{ $item->view_counter }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fas fa-share-alt icon"></i>
                                                                50
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="btn-wrap mt--25">
                                                    <a href="{{ route('front.currentNews.detail', $item->link) }}"
                                                        class="rt-read-more qodef-button-animation-out">
                                                        {{ __('message.daha fazla oku') }}
                                                        <svg width="34px" height="16px" viewBox="0 0 34.53 16"
                                                            xml:space="preserve">
                                                            <rect class="qodef-button-line" y="7.6" width="34"
                                                                height=".4">
                                                            </rect>
                                                            <g class="qodef-button-cap-fake">
                                                                <path class="qodef-button-cap"
                                                                    d="M25.83.7l.7-.7,8,8-.7.71Zm0,14.6,8-8,.71.71-8,8Z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-img">
                                                <a href="{{ route('front.currentNews.detail', $item->link) }}">
                                                    <img style="object-fit: cover" src="/{{ $item->image }}"
                                                        alt="post" width="696" height="491">
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- end post-item -->
                                @endforeach



                            </div>

                            <div class="d-flex justify-content-center" style="padding:10%">
                                {{ $datas->links() }}
                            </div>

                            <div class="items-center" style="padding:15%">
                            </div>

                        </div>
                        <!-- end rt-left-sidebar-sapcer-5 -->
                    </div>
                    <!-- end col-->

                    <div class="col-xl-3 col-lg-8 sticky-coloum-item mx-auto">
                        <div class="rt-sidebar sticky-wrap">

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <div class="search-box">
                                    <form action="#" class="form search-form-box">
                                        <div class="form-group">
                                            <input type="text" name="sarch" id="search" placeholder="ARA..."
                                                class="form-control rt-search-control">
                                            <button type="submit" class="search-submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end sidebar wrap -->

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.kategoriler') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <ul class="rt-categories">

                                    @foreach ($sub_categories as $item)
                                        <li>
                                            <a href="{{ route('front.currentNewsCategory.list', $item->link) }}"
                                                data-bg-image="/{{ $item->image }}">
                                                <span class="cat-name"> {{ $item->title }} </span>
                                                <span class="count">{{ $item->adet() }}</span>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <!-- end slidebar wrap  -->



                            <div class="sidebar-wrap mb--40">
                                <div class="ad-banner-img">
                                    <a href="#">
                                        <img src="/assets/frontend/media/gallery/ad-post_5.jpg" alt="ad-banner"
                                            width="301" height="270">
                                    </a>
                                </div>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.popüler haberler') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="row rt-gutter-10">

                                    @foreach ($other_news as $item)
                                        <div class="col-6">
                                            <div class="rt-post-grid post-grid-md grid-meta">
                                                <div class="post-content">
                                                    <a href="{{ route('front.currentNewsCategory.list', $item->Category()[0]->link) }}"
                                                        style="background-color: {{ $item->Category()[0]->color_code != null ? $item->Category()[0]->color_code : '' }}"
                                                        class="rt-cat-primary sidebar_restricted_category_title">
                                                        {{ $item->Category()[0]->title }}
                                                    </a>
                                                    <div class="post-img mb-2">
                                                        <a href="{{ route('front.currentNews.detail', $item->link) }}">
                                                            <img src="/{{ $item->image }}" alt="post"
                                                                width="343" height="250">
                                                        </a>
                                                    </div>
                                                    <h4 class="post-title">
                                                        <a href="{{ route('front.currentNews.detail', $item->link) }}"
                                                            class="sidebar_restricted_title">
                                                            {{ $item->title }}
                                                        </a>
                                                    </h4>
                                                    <span class="rt-meta">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        {{ $item->created_at->translatedFormat('d M Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <!-- end row -->

                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <div class="subscribe-box-style-1" data-bg-image="media/elements/elm_3.png">
                                    <div class="subscribe-content">
                                        <h3 class="title">
                                            {{ __('message.Haber Bültenimize Abone Ol') }}
                                        </h3>
                                        <p>
                                            {{ __('message.Ulusal ve global savunma ile ilgili gündemden daha hızlı haberdar olmak
                                                                                                                                                                                istiyorsanız, Milli Müdafaa e-posta listesine kayıt olun!') }}
                                        </p>
                                        <form action="#" class="rt-contact-form subscribe-form rt-form">
                                            <div class="rt-form-group">
                                                <input type="email" class="form-control rt-form-control"
                                                    placeholder="E-posta *" name="email" id="email_1"
                                                    data-error="E-posta alanı zorunludur" required>
                                            </div>
                                            <button type="submit" class="rt-submit-btn">
                                                {{ __('message.şimdi abone ol') }} </button>
                                            <div class="form-response"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end sidebar wrap -->


                           

                        </div>
                        <!-- end rt-sidebar -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row  -->
            </div>
            <!-- end container -->
        </section>
        <!-- end rt-sidebar-section-layout-2 -->

    </main>
    <!-- End Main -->
@endsection
@section('script')
    <!-- EXTRA JS -->
    <script>
        /*--------------------------------
                        // limit by device width
                        -------------------------------*/
        // get device width
        var windowWidth = $(window).width();

        // Set limits for different device widths
        var limit_sidebar_restricted_title = 17;
        if (windowWidth <= 768) {
            limit_sidebar_restricted_title = 14;
        } else if (windowWidth <= 1200) {
            limit_sidebar_restricted_title = 17;
        }

        // Set limits for different device widths
        var limit_restricted_title = 120;
        if (windowWidth <= 768) {
            limit_restricted_title = 45;
        } else if (windowWidth <= 1200) {
            limit_restricted_title = 120;
        }

        /*--------------------------------
           // title limitation
        -------------------------------*/
        // Select all tags with class .restricted_title
        $('.restricted_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_restricted_title) {
                // If the content is longer than limit_restricted_title characters
                content = content.slice(0, limit_restricted_title) + '...';
                // Select limit_restricted_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // title limitation
        -------------------------------*/
        // Select all tags with class .restricted_text
        $('.restricted_text').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > 225) { // If the content is longer than 225 characters
                content = content.slice(0, 225) + '...'; // Select 225 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // sidebar title limitation
        -------------------------------*/
        // Select all tags with class .sidebar_restricted_title
        $('.sidebar_restricted_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_sidebar_restricted_title) {
                // If the content is longer than limit_sidebar_restricted_title characters
                content = content.slice(0, limit_sidebar_restricted_title) + '...';
                // Select limit_sidebar_restricted_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // sidebar title limitation
        -------------------------------*/
        // Select all tags with class .sidebar_restricted_category_title
        $('.sidebar_restricted_category_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > 14) { // If the content is longer than 14 characters
                content = content.slice(0, 14) + '...'; // Select 14 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });
    </script>
@endsection