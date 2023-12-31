@extends('frontend.master')
@section('meta-title',  'Milli Müdafaa')
@section('keywords',  'Milli Müdafaa, Haber, Güncel Haberler, Son Dakika Haberleri, Türkiye, Dünya, Teknoloji, İstanbul, TV, savunma, savunma sanayi, savunma sanayii, teknoloji, siber, güvenlik, siber güvenlik, milli teknoloji, milli teknoloji hamlesi, aselsan, baykar, havelsan, tai, tusaş, hulusi akar, haluk görgün, selçuk bayraktar, haluk bayraktar, temel kotil, mustafa varank, teknopark, turksat, telekom, haberlesme, istihbarat, milli istihbarat, dış politika, savunma sanayi haberleri, savunma sanayii haberleri, yerli, milli.')
@section('description', 'Savunma Sanayii haberleri, güncel son dakika gelişmeleri ve bugün yer alan son durum bilgileri için tıklayın!')
@section('title', $data->name . ' ' . $data->surname)
@section('description', 'Yazar')

@section('content')
<style>
    .pagination>li>a,
    .pagination>li>:hover,
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
                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('front.author.list') }}">
                                Yazarlarımız
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="text-transform: capitalize">
                            {{ $data->name }} {{ $data->surname }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <div class="banner author-banner" data-bg-image="/assets/banner_4.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="author-big-box-style-1">
                            <div class="author-img">
                                <img src="/assets/author-img_1.jpg" alt="author-img_1" width="170" height="170">
                            </div>
                            <div class="author-content">
                                <h2 class="title" style="text-transform: capitalize"> {{ $data->name }}
                                    {{ $data->surname }} </h2>
                                <!-- <span class="designation">Senior Author</span> -->
                                
                            </div>
                            <div class="author-social-area">
                                <ul class="author-social-1 footer-social">

                                    @if ($data->facebook != null)
                                        <li class="social-item">
                                            <a href="https://www.facebook.com/{{ $data->facebook }}" class="social-link fb"
                                                target="_blank">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($data->twitter != null)
                                        <li class="social-item">
                                            <a href="https://twitter.com/{{ $data->twitter }}" class="social-link tw"
                                                target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($data->instagram != null)
                                        <li class="social-item">
                                            <a href="https://instagram.com/{{ $data->instagram }}" class="social-link tw"
                                                target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                    @endif

                                    

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- start rt-sidebar-section-layout-2 -->
        <section class="rt-sidebar-section-layout-2">
            <div class="container">
                <div class="row gutter-40 sticky-coloum-wrap">

                    <div class="col-xl-9 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">

                            <div class="post-list-style-4 layout-2">


                                @foreach ($news as $item)
                                    
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
                                                            <i class="fa-solid fa-eye"></i>
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
                                @endforeach


                            </div>
                            <!-- end post-list-style-4 -->

                            <div style="margin-left: 35%; margin-top:5%">
                                {!! $news->appends(request()->input())->onEachSide(1)->links(); !!}
                            </div>
                            <!-- end rt-pagination-area -->

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

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.popüler haberler') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="row rt-gutter-10">

                                    @foreach ($popular_news as $item)
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
                                                            {{ Illuminate\Support\Str::words($item->title,5,'...') }}
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
