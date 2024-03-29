@extends('frontend.master')
@section('meta-title', 'Milli Müdafaa')
@section('keywords', 'Milli Müdafaa, Haber, Güncel Haberler, Son Dakika Haberleri, Türkiye, Dünya, Teknoloji, İstanbul,
    TV, savunma, savunma sanayi, savunma sanayii, teknoloji, siber, güvenlik, siber güvenlik, milli teknoloji, milli
    teknoloji hamlesi, aselsan, baykar, havelsan, tai, tusaş, hulusi akar, haluk görgün, selçuk bayraktar, haluk bayraktar,
    temel kotil, mustafa varank, teknopark, turksat, telekom, haberlesme, istihbarat, milli istihbarat, dış politika,
    savunma sanayi haberleri, savunma sanayii haberleri, yerli, milli.')
@section('description', 'Savunma Sanayii haberleri, güncel son dakika gelişmeleri ve bugün yer alan son durum bilgileri
    için tıklayın!')
@section('title', 'Firmalar')

@section('content')
    <!-- Start Main -->

    <style>
        .rt-cart-item .item-img::after {
            background-color: rgba(var(--color-white-rgb), 0);
            border-radius: var(--border-radius-xs);
        }

        @media only screen and (max-width: 600px) {
            .company-content {
                width: 50%;
                padding: 3%;
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
                            {{ __('message.firmalar') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- start rt-sidebar-section-layout-2 -->
        <section class="rt-sidebar-section-layout-2">
            <div class="sticky-coloum-wrap container">
                <div class="row gutter-40 sticky-coloum-wrap">
                    <div class="col-xl-9 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">

                            <div class="ad-banner-img wow fadeInUp mb--40" data-wow-delay="100ms" data-wow-duration="800ms">
                                @if (reklam(34) != null && reklam(34)->status == 1)
                                    <div class="sidebar-wrap mb--40 mt--40">
                                        <div class="ad-banner-img">
                                            @if (reklam(34)->type == 1)
                                                <a href="{{ reklam(34)->adsense_url }}">

                                                    <img src="/{{ reklam(34)->image }}" width="100%" style="height:150px">
                                                </a>
                                            @else
                                                {!! reklam(34)->adsense_url ?? '' !!}
                                            @endif

                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row">

                                @foreach ($data as $item)
                                    <div class="col-md-3 company-content wow fadeInUp" data-wow-delay="100ms"
                                        data-wow-duration="800ms">
                                        <div class="cat-item">
                                            <div class="rt-cart-item" style="background-color: white!important">
                                                <a style="width: 100%"
                                                    href="{{ \Session::get('applocale') == 'en' ? route('front.company.detail_en', \Illuminate\Support\Str::slug($item->title)) : route('front.company.detail', \Illuminate\Support\Str::slug($item->title)) }}">
                                                    <div class="author-img">
                                                        <center>
                                                            <img style="width:170px; height:170px; opacity:0.9;text-align:center!important"
                                                                src="/{{ $item->image }}" alt="{{ $item->title }}">
                                                        </center>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <div class="ad-banner-img wow fadeInUp mb--40 mt--40" data-wow-delay="100ms"
                                data-wow-duration="800ms">
                                @if (reklam(35) != null && reklam(35)->status == 1)
                                    <div class="sidebar-wrap mb--40">
                                        <div class="ad-banner-img">
                                            @if (reklam(35)->type == 1)
                                                <a href="{{ reklam(35)->adsense_url }}">

                                                    <img src="/{{ reklam(35)->image }}" width="100%" style="height:150px">
                                                </a>
                                            @else
                                                {!! reklam(35)->adsense_url ?? '' !!}
                                            @endif

                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- end rt-pagination-area -->

                        </div>
                        <!-- end rt-left-sidebar-sapcer-5 -->
                    </div>
                    <!-- end col-->

                    <div class="col-xl-3 col-lg-8 sticky-coloum-item mx-auto">
                        <div class="rt-sidebar sticky-wrap">

                            <div class="sidebar-wrap mb--40">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.kategoriler') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <ul class="rt-categories">

                                    @foreach ($categories as $item)
                                        <li>
                                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.company.categoryList_en', $item->link) : route('front.company.categoryList', $item->link) }}"
                                                data-bg-image="/{{ $item->image }}">
                                                <span class="cat-name">
                                                    <i class="fas fa-list"
                                                        style="border-right: 2px solid;width: 27px;padding-right: 4px;padding-left: 0px;height: 16px;"></i>
                                                    {{ $item->name }}
                                                </span>
                                                <span class="count"> {{ $item->companyCount() }} </span>
                                            </a>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                            <!-- end slidebar wrap  -->
                            <div class="sidebar-wrap mb--40">
                                <div class="ad-banner-img">
                                    @if (reklam(36) != null && reklam(36)->status == 1)
                                        <div class="sidebar-wrap mb--40">
                                            <div class="ad-banner-img">
                                                @if (reklam(36)->type == 1)
                                                    <a href="{{ reklam(36)->adsense_url }}">

                                                        <img src="/{{ reklam(36)->image }}" alt="" width="300"
                                                            height="600">
                                                    </a>
                                                @else
                                                    {!! reklam(36)->adsense_url ?? '' !!}
                                                @endif

                                            </div>
                                        </div>
                                    @endif
                                </div>
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
    <!-- End Main -->
@endsection
