@extends('frontend.master')
@section('title', 'Arşiv')
@section('content')
    <style>
        .pagination>li>a,
        .pagination>li>span {
            color: rgb(26, 159, 26); // use your own color here
        }

        .tag-link:hover {
            background-color: #749f43;
            color: white;
        }
       
        @media only screen and (max-width: 600px) {
            .mobile-p-image {
                display: block !important;
            }

            .desktop-p-image {
                display: none !important;
            }
            .pag{
                margin:auto!important;
                text-align: center!important;
            }
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
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('message.arşiv') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- start rt-sidebar-section-layout-2 -->
        <section class="rt-sidebar-section-layout-2">
            <div class="container">
                <div class="row gutter-40 sticky-coloum-wrap">
                    <div class="col-xl-9 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">
                            <div class="titile-wrapper mb--40">
                                <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                    <span class="rt-section-text">{{ __('message.arşiv') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>



                                <ul class="nav rt-tab-menu" id="myTab" role="tablist">
                                    <li class="menu-item" role="presentation" style="margin-right: 0.25rem;">
                                        <select class="form-select form-select" aria-label="Default select example"
                                            id="time" onchange="select_cat()">
                                            <option value="all" selected>{{ __('message.tarih seçiniz') }}</option>
                                            @foreach ($dates as $date)
                                                @foreach ($date as $key => $month)
                                                    @if ($key == 0)
                                                        @continue
                                                    @endif
                                                    <option {{ request()->t == $date[0] . '-' . $month ? 'selected' : '' }}
                                                        value="{{ $date[0] . '-' . $month }}">
                                                        {{ (strlen($month) == 1 ? '0' . $month : $month) . '/' . $date[0] }}
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </li>
                                    <li class="menu-item" role="presentation">
                                        <select onchange="select_cat()" class="form-select form-select" id="cat"
                                            aria-label="Default select example">
                                            <option value="all">{{ __('message.kategori seçiniz') }}</option>

                                            @foreach ($cats as $cat)
                                                <option {{ request()->c == $cat->id ? 'selected' : '' }}
                                                    value="{{ $cat->id }}"> {{ $cat->title }} </option>
                                            @endforeach
                                        </select>
                                    </li>
                                </ul>
                            </div>
                            <!-- end titile-wrapper -->

                            <div id="news_content">
                                <div class="post-list-style-4">

                                    @foreach ($data as $key => $item)
                                        @if ($key == 3 && reklam(8) != null)
                                            @if (reklam(8)->status == 1)
                                                <div class="ad-banner-img mt-4 mb-4">
                                                    <a href="{{ reklam(8)->adsense_url }}">
                                                        @if (reklam(8)->type ?? 0 == 1)
                                                            <img src="/{{ reklam(8)->image }}" alt=""
                                                                width="1320" height="91">
                                                        @else
                                                            {!! reklam(8)->adsense_url ?? '' !!}
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                        @endif

                                        @if ($key == 6 && reklam(9) != null && reklam(9)->status == 1)
                                            <div class="ad-banner-img mt-4 mb-4">
                                                <a href="{{ reklam(9)->adsense_url }}">
                                                    @if (reklam(9)->type ?? 0 == 1)
                                                        <img src="/{{ reklam(9)->image }}" alt="" width="1320"
                                                            height="91">
                                                    @else
                                                        {!! reklam(9)->adsense_url ?? '' !!}
                                                    @endif
                                                </a>
                                            </div>
                                        @endif
                                        <div class="post-item wow fadeInUp" data-wow-delay="100ms"
                                            data-wow-duration="800ms">
                                            <div class="rt-post post-md style-9 grid-meta">

                                                <div class="post-img mobile-p-image"  style="display: none">
                                                    <a href="{{ \Session::get('applocale') == 'en' ? (route('front.currentNews.detail_en', $item->link)) : (route('front.currentNews.detail', $item->link)) }}">
                                                        <img style="object-fit: cover" src="/{{ $item->image }}"
                                                            alt="post" width="696" height="491">
                                                    </a>
                                                </div>

                                                <div class="post-content">
                                                    @if (isset($item->Category()[0]))
                                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $item->Category()[0]->link) : route('front.currentNewsCategory.list', $item->Category()[0]->link) }}"
                                                            class="rt-cat-primary">{{ $item->Category()[0]->title }}</a>
                                                    @endif
                                                    <h3 class="post-title">
                                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
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
                                                                    <i class="fa fa-user"></i> <a href=""
                                                                        class="name"> {{ $item->Author->name }}
                                                                        {{ $item->Author->surname }} </a>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="rt-meta">
                                                                    <i class="far fa-calendar-alt icon"></i>
                                                                    {{ $item->live_time->translatedFormat('d M Y') }}
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="rt-meta">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                    {{ $item->viewCounter->view_counter ?? '0' }}
                                                                </span>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="btn-wrap mt--25">
                                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
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
                                                <div class="post-img desktop-p-image">
                                                    <a
                                                        href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}">
                                                        <img style="object-fit: cover"
                                                            src="/{{ $item->image != null ? $item->image : 'url (assets/frontend/media/gallery/post-lg_40.jpg)' }}"
                                                            alt="{{ $item->title }}" width="696" height="491">
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end post-item -->
                                    @endforeach


                                </div>
                                <!-- end post-list-style-4 -->

                                <div class="pag" style="margin-left: 35%; margin-top:15%!important">
                                    {!! $data->appends(request()->input())->onEachSide(1)->links(); !!}
                                </div>
                                <!-- end rt-pagination-area -->

                            </div>
                        </div>
                        <!-- end rt-left-sidebar-sapcer-5 -->
                    </div>
                    <!-- end col-->

                    <div class="col-xl-3 col-lg-8 sticky-coloum-item mx-auto">
                        <div class="rt-sidebar sticky-wrap">

                            <div class="sidebar-wrap mb--40">
                                <div class="search-box">
                                    <form action="#" class="form search-form-box">
                                        <div class="form-group">
                                            <input type="text" name="sarch" id="search" placeholder="Ara..."
                                                class="form-control rt-search-control">
                                            <button type="submit" class="search-submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end sidebar wrap -->

                            <div class="sidebar-wrap mb--40">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.popüler haberler') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="row rt-gutter-10">


                                    @foreach ($top_news as $item)
                                        <div class="col-6">
                                            <div class="rt-post-grid post-grid-md grid-meta">
                                                <div class="post-content">
                                                    @if (isset($item->Category()[0]))
                                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $item->Category()[0]->link) : route('front.currentNewsCategory.list', $item->Category()[0]->link) }}"
                                                            class="rt-cat-primary sidebar_restricted_category_title">
                                                            {{ $item->Category()[0]->title }} </a>
                                                    @endif
                                                    <div class="post-img mb-2">
                                                        <a href="">
                                                            <img src="/{{ $item->image }}" alt="post"
                                                                width="343" height="250">
                                                        </a>
                                                    </div>
                                                    <h4 title="{{ $item->title }}" class="post-title"
                                                        style="font-size:15px">
                                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
                                                            class="">
                                                            {{ Illuminate\Support\Str::words($item->title, 5, '...') }}
                                                        </a>
                                                    </h4>
                                                    <span class="rt-meta">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        {{ $item->live_time->translatedFormat('d M Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col-6 -->
                                    @endforeach


                                </div>
                                <!-- end row -->

                            </div>
                            <!-- end slidebar wrap  -->

                            @if (reklam(10) != null && reklam(10)->status == 1)
                                <div class="sidebar-wrap mb--40">
                                    <div class="ad-banner-img">
                                        <a href="{{ reklam(10)->adsense_url }}">
                                            @if (reklam(10)->type ?? 0 == 1)
                                                <img src="/{{ reklam(10)->image }}" alt="" width="250"
                                                    height="250">
                                            @else
                                                {!! reklam(10)->adsense_url ?? '' !!}
                                            @endif

                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="sidebar-wrap mb--40">
                                <div class="subscribe-box-style-1" data-bg-image="media/elements/elm_3.png">
                                    <div class="subscribe-content">
                                        <h3 class="title">
                                            Haber Bültenimize Abone Ol
                                        </h3>
                                        <p>
                                            Ulusal ve global savunma ile ilgili gündemden daha hızlı haberdar olmak
                                            istiyorsanız, Milli Müdafaa e-posta listesine kayıt olun!
                                        </p>
                                        <form action="#" class="rt-contact-form subscribe-form rt-form">
                                            <div class="rt-form-group">
                                                <input type="email" class="form-control rt-form-control"
                                                    placeholder="E-posta *" name="email" id="email_1"
                                                    data-error="E-posta alanı zorunludur" required>
                                            </div>
                                            <button type="submit" class="rt-submit-btn">Şimdi Abone Ol</button>
                                            <div class="form-response"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end sidebar wrap -->

                            <div class="sidebar-wrap">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.etiketler') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="tag-list">

                                    @foreach ($etiketler->getKeys() as $item)
                                        <a href="{{ route('front.currentNews.tag_list', $item) }}" class="tag-link">
                                            {{ $item }} </a>
                                    @endforeach

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
@endsection
@section('script')
    <script>
        function select_cat() {
            var cat = document.getElementById("cat").value;
            var time = document.getElementById("time").value;
            if (cat == "all" && time == "all") {
                return "ok";
            }
            window.location.replace("{{ route('front.archive.index') }}?c=" + cat + "&t=" + time);
            /*
            $.ajax({
                headers : { "X-CSRF-TOKEN" : "{{ csrf_token() }}"},
                type    : "get",
                data    : "category_id=" + cat + '&time=' + time,
                success : function(response){
                    console.log(response);
                    $("#news_content").html(response);
                }
            })
            */
        }
    </script>
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
