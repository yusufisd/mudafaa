@extends('frontend.master')
@section('title', 'Röportajlar')

@section('content')
    <!-- Start Main -->
    <style>
        .pagination>li>a,
        .pagination>li>:hover,
        .pagination>li>span {
            color: rgb(26, 159, 26); // use your own color here
        }
    </style>
    <style>
        .social-connection li:nth-child(2) a {
            background-image: -webkit-gradient(linear, right top, left top, from(#56c3f0), to(#13a4e7));
            background-image: linear-gradient(-90deg, #909fa5 0%, #151616 100%);
            background-image: -ms-linear-gradient(-90deg, #56c3f0 0%, #13a4e7 100%);
        }

        .social-connection li:nth-child(5) a {
            border-radius: 3px;
            background-image: -webkit-gradient(linear, right top, left top, from(#f43079), to(#f7679d));
            background-image: linear-gradient(-90deg, #5579ad 0%, #1a6be1 100%);
            background-image: -ms-linear-gradient(-90deg, #f43079 0%, #f7679d 100%);
        }

        .tag-link:hover {
            background-color: #749f43;
            color: white;
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
                            {{ __('message.röportajlar') }}
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
                        <div class="rt-left-sidebar-sapcer-5 sticky-wrap">

                            <div class="wrap post-wrap-style-3">

                                @foreach ($data as $key => $item)
                                    @if ($key == 2)
                                        <div class="ad-banner-img mb--40 mt--40">
                                            @if (reklam(28) != null)
                                                <div class="sidebar-wrap mb--40">
                                                    <div class="ad-banner-img">
                                                        <a href="{{ reklam(29)->adsense_url }}">
                                                            @if (reklam(29)->type ?? 0 == 1)
                                                                <img src="/{{ reklam(29)->image }}" alt=""
                                                                width="1320px" style="height:90px">
                                                            @else
                                                                {!! reklam(29)->adsense_url ?? '' !!}
                                                            @endif

                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    
                                    <div class="post-item wow fadeInUp" data-wow-delay="100ms" data-wow-duration="800ms">
                                        <div class="rt-post post-md style-2 style-4 grid-meta">
                                            <div class="post-img">
                                                <a href="{{ route('front.interview.detail', $item->link) }}">
                                                    <img style="object-fit: cover" src="/{{ $item->image }}" alt="post"
                                                        width="696" height="491">
                                                </a>
                                            </div>
                                            <div class="post-content">

                                                <h3 class="post-title">
                                                    <a href="{{ route('front.interview.detail', $item->link) }}"
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
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->created_at->translatedFormat('d M Y') }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fa-solid fa-clock"></i>
                                                                {{ $item->read_time == 0 ? '1' : $item->read_time }} DK
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fa-solid fa-eye"></i>
                                                                {{ $item->view_counter }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="btn-wrap mt--25">
                                                    <a href="{{ route('front.interview.detail', $item->link) }}"
                                                        class="rt-read-more rt-button-animation-out">
                                                        Daha Fazla Oku
                                                        <svg width="34px" height="16px" viewBox="0 0 34.53 16"
                                                            xml:space="preserve">
                                                            <rect class="rt-button-line" y="7.6" width="34"
                                                                height=".4">
                                                            </rect>
                                                            <g class="rt-button-cap-fake">
                                                                <path class="rt-button-cap"
                                                                    d="M25.83.7l.7-.7,8,8-.7.71Zm0,14.6,8-8,.71.71-8,8Z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>

                                    @if ($key == 3)
                                        <div class="ad-banner-img mb--40 mt--40">
                                            @if (reklam(29) != null)
                                                <div class="sidebar-wrap mb--40">
                                                    <div class="ad-banner-img">
                                                        <a href="{{ reklam(29)->adsense_url }}">
                                                            @if (reklam(29)->type ?? 0 == 1)
                                                                <img src="/{{ reklam(29)->image }}" alt=""
                                                                    width="1320px" style="height:90px">
                                                            @else
                                                                {!! reklam(29)->adsense_url ?? '' !!}
                                                            @endif

                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach

                                <!-- end post-item -->



                            </div>
                            <!-- end wrap -->


                            <div class="d-flex justify-content-center" style="padding:10%">
                                {!! $data->appends(request()->input())->onEachSide(1)->links(); !!}
                            </div>

                            <!-- end rt-pagination-area -->

                        </div>
                        <!-- end rt-left-sidebar-sapcer-5 -->
                    </div>
                    <!-- end col-->

                    <div class="col-xl-3 col-lg-8 sticky-coloum-item mx-auto">
                        <div class="rt-sidebar">

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
                                    <span class="rt-section-text"> {{ __('message.popüler röportajlar') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="post-list">

                                    @foreach ($populer_interview as $item)
                                        <div class="item">
                                            <div class="rt-post post-sm style-1">
                                                <div class="post-img">
                                                    <a href="">
                                                        <img src="/{{ $item->image }}" style="object-fit: cover"
                                                            alt="post" width="100" height="100">
                                                    </a>
                                                </div>
                                                <div class="post-content ms-4">

                                                    <h4 class="post-title">
                                                        <a href="" class="sidebar_restricted_title">
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
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="sidebar-wrap mb--40">
                                <div class="ad-banner-img">
                                    @if (reklam(30) != null)
                                        <div class="sidebar-wrap mb--40">
                                            <div class="ad-banner-img">
                                                <a href="{{ reklam(30)->adsense_url }}">
                                                    @if (reklam(30)->type ?? 0 == 1)
                                                        <img src="/{{ reklam(30)->image }}" alt=""
                                                            width="315" height="270">
                                                    @else
                                                        {!! reklam(30)->adsense_url ?? '' !!}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text">Bİzİ Takİp Edİn</span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <ul class="social-connection">
                                    <li>
                                        <a href="https://www.facebook.com/millimudafaacom">
                                            <i class="fab fa-facebook-f facebook"></i>
                                            <span class="text"><span>15,985</span> Takipçi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/millimudafaacom">
                                            <i style="background-color: black"
                                                class="fa-brands fa-square-x-twitter twitter"></i>
                                            <span class="text"><span>20,751</span> Takipçi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/channel/UC6uGHKEHHGh08sTWjhBrG9A">
                                            <i class="fab fa-youtube youtube"></i>
                                            <span class="text"><span>35,999</span> Takipçi</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="https://www.instagram.com/millimudafaacom">
                                            <i class="fab fa-instagram instagram"></i>
                                            <span class="text"><span>35,999</span> Takipçi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/company/milli-m%C3%BCdafaa/">
                                            <i class="fab fa-linkedin-in linkedin"></i>
                                            <span class="text"><span>35,999</span> Takipçi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="sidebar-wrap">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text">Etİketler </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="tag-list">
                                    @foreach ($keys as $key)
                                        @foreach (explode(',', $key) as $tag)
                                            <a href="#" class="tag-link">{{ $tag }}</a>
                                        @endforeach
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
        var limit_sidebar_restricted_title = 21;
        if (windowWidth <= 768) {
            limit_sidebar_restricted_title = 50;
        } else if (windowWidth <= 1200) {
            limit_sidebar_restricted_title = 30;
        }

        /*--------------------------------
           // title limitation
        -------------------------------*/

        // Select all a tags with class .restricted_title
        $('.restricted_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > 90) { // If the content is longer than 90 characters
                content = content.slice(0, 90) + '...'; // Select 90 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // text limitation
        -------------------------------*/

        // Select all tags with class .restricted_text
        $('.restricted_text').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > 225) { // If the content is longer than 225 characters
                content = content.slice(0, 225) + '...'; // Select 225 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        // Select all tags with class .sidebar_restricted_title
        $('.sidebar_restricted_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_sidebar_restricted_title) {
                // If the content is longer thanlimit_sidebar_restricted_title characters
                content = content.slice(0, limit_sidebar_restricted_title) + '...';
                // Select limit_sidebar_restricted_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });
    </script>
@endsection
