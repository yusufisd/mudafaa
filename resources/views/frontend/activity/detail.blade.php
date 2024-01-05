@extends('frontend.master')
@section('title', $data->title ?? 'Milli Müdafaa')
@section('meta-title', $data->title ?? 'Milli Müdafaa')
@section('keywords', $data->seo_key ?? 'Milli Müdafaa, Haber, Güncel Haberler, Son Dakika Haberleri, Türkiye, Dünya,
    Teknoloji, İstanbul, TV, savunma, savunma sanayi, savunma sanayii, teknoloji, siber, güvenlik, siber güvenlik, milli
    teknoloji, milli teknoloji hamlesi, aselsan, baykar, havelsan, tai, tusaş, hulusi akar, haluk görgün, selçuk bayraktar,
    haluk bayraktar, temel kotil, mustafa varank, teknopark, turksat, telekom, haberlesme, istihbarat, milli istihbarat, dış
    politika, savunma sanayi haberleri, savunma sanayii haberleri, yerli, milli.')
@section('description', $data->short_description ?? 'Savunma Sanayii haberleri, güncel son dakika gelişmeleri ve bugün
    yer alan son durum bilgileri için tıklayın!')
@section('simage', asset($data->image) ?? asset('assets/default_act.jpeg'))
@section('stitle', $data->title)
@section('sdescription', $data->short_description)

@section('css')
    <style>
        .post-body {
            color: #464847;
        }

        @media only screen and (max-width: 600) {

            /*
                .single-post-banner {
                    background-size: 600px 500px !important;
                }
                */
        }

        .single-post-banner {
            background-size: cover !important;
            background-position: center center !important;
            background-repeat: no-repeat !important;
        }

        @media screen and (max-width: 600px) {
            .single-post-banner {
                background-size: 100% 95% !important;
                background-position: center center !important;
                background-repeat: no-repeat !important;
            }
        }

        .post-body:intial-letter {
            float: left;
            font-weight: bold;
            font-size: 10px;
            font-size: 4rem;
            line-height: 20px;
            line-height: 2rem;
            height: 4rem;
            text-transform: uppercase;
            padding: 2%;
            margin-left: 2%
        }

        .tag-link:hover {
            background-color: #749f43;
            color: white;
        }
    </style>
@endsection
@section('content')
    <!-- Start Main -->
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
                    <ol class="breadcrumb d-inline-flex">
                        <li class="breadcrumb-item">
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item" aria-label="breadcrumb">
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.activity.list_en') : route('front.activity.list') }}">
                                {{ __('message.etkinlikler') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="">
                                {{ $data->title }}
                            </span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- Start single-post-banner -->
        <div class="single-post-banner rt-gradient-overaly"
            data-bg-image="/{{ $data->image == null ? 'assets/default_act.jpeg' : $data->image }}"
            style="background: url(/{{ $data->image }})">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="single-post-content">
                            <span style="background-color: #749f43" class="fashion">{{ $data->Category->title }}</span>
                            <h2 class="post-title">
                                {{ $data->title }}
                            </h2>
                            <div class="post-meta">
                                <ul>
                                    @if ($data->start_time)
                                        <li>
                                            <span class="rt-meta">
                                                <i class="far fa-calendar-alt icon"></i>
                                                {{ $data->start_time->translatedFormat('d M Y') }}
                                            </span>
                                            @if ($data->finish_time != null)
                                                <span class="rt-meta">
                                                    -
                                                    {{ $data->finish_time->translatedFormat('d M Y') }}
                                                </span>
                                            @endif
                                        </li>
                                    @endif
                                    @if ($data->start_clock)
                                        <li>
                                            <span class="rt-meta">
                                                <i class="fas fa-clock icon"></i>
                                                {{ substr($data->start_clock, 0, 5) }}
                                            </span>
                                            @if ($data->finish_clock != null)
                                                <span class="rt-meta">
                                                    -
                                                    {{ substr($data->finish_clock, 0, 5) }}
                                                </span>
                                            @endif
                                        </li>
                                    @endif
                                    @if ($data->Country)
                                        <li>
                                            <span class="rt-meta">
                                                <i class="fa-solid fa-earth-americas"></i>
                                                {{ $data->Country->name }} / {{ $data->city }}
                                            </span>
                                        </li>
                                    @endif
                                    <li>
                                        @if ($data->address != null)
                                            <span class="rt-meta">
                                                <i class="fas fa-map-marker-alt icon"></i>
                                                {{ $data->address }}
                                            </span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End single-post-banner -->

        <!-- start rt-sidebar-section-layout-2 -->
        <section class="rt-sidebar-section-layout-3 section-padding">
            <div class="container">
                <div class="row gutter-40">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="rt-main-post-single layout-2">
                            <div class="post-share-style-1">
                                <div class="inner">

                                    <div class="share-text">
                                        <i class="fas fa-share-alt"></i>
                                        <span>Paylaş</span>
                                    </div>

                                    <ul class="social-share-style-7">
                                        <li>
                                            <a class="fb" target="_blank"
                                                href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}&text={{ $data->title }}">
                                                <i class="social-icon fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="tw" target="_blank"
                                                href="https://twitter.com/intent/tweet?text={{ $data->title }}&url={{ request()->url() }}">
                                                <i style="color: black" class="fa-brands fa-square-x-twitter twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="fb" target="_blank"
                                                href="https://linkedin.com/sharing/share-offsite/?url={{ request()->url() }}">
                                                <i class="social-icon fab fa-linkedin"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="wh" target="_blank"
                                                href="https://web.whatsapp.com/send?text={{ $data->title }} {{ request()->url() }}">
                                                <i class="social-icon fab fa-whatsapp"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- strat post body -->
                            <div class="post-body mb--40" style="text-align: justify;">
                                {!! printDesc($data->description) !!}
                            </div><br><br><br><br>
                            <!-- end post body -->
                            <!-- start social-share-box-2 -->
                            <div class="social-share-box-2 mb--40">
                                <div class="row gutter-30">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="conent-block">
                                            <h4 class="block-tile mb--20">Popüler Etiketler:</h4>

                                            <div class="tag-list">

                                                @foreach ($data->getKeys() as $item)
                                                    <a href="{{ \Session::get('applocale') == 'en' ? route('front.activity.tag_list_en', $item) : route('front.activity.tag_list', $item) }}"
                                                        class="tag-link" style="text-transform: capitalize">
                                                        {{ $item }} </a>
                                                @endforeach


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end social-share-box-2 -->
                            <div class="border-with-spacer-1"></div>
                            <div class="single-content mb--20">
                                <div class="row">
                                    <ul id="fair_links">
                                        @if ($data->ticket_link != null)
                                            <li>
                                                <h3>
                                                    <a href="{{ $data->ticket_link }}">
                                                        {{ __('message.Online Bilet') }} <i
                                                            class="fas fa-angle-double-right"></i>
                                                    </a>
                                                </h3>
                                            </li>
                                        @endif

                                        @if ($data->subscribe_form != null)
                                            <li>
                                                <h3>
                                                    <a href="{{ $data->subscribe_form }}">
                                                        {{ __('message.Katılımcı Başvuru Formu') }} <i
                                                            class="fas fa-angle-double-right"></i>
                                                    </a>
                                                </h3>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            @if ($data->subscribe_form != null || $data->ticket_link != null)
                                <div class="border-with-spacer-1"></div>
                            @endif

                            <div class="wrap mb--30">
                                <div class="featured-tab-title">
                                    <h2 class="rt-section-heading">
                                        <span class="rt-section-text"> {{ __('message.İletişim Bilgileri') }} </span>
                                        <span class="rt-section-dot"></span>
                                        <span class="rt-section-line"></span>
                                    </h2>
                                </div>
                                <!-- end featured-tab-title -->
                                <div class="row gutter-30">
                                    <div class="col-lg-6 grid-adress">
                                        <ul class="contact_info">
                                            @if ($data->address != null)
                                                <li>
                                                    <h6> {{ __('message.adres') }} </h6>
                                                    <p class="rt-teta">
                                                        <i class="fas fa-home icon"></i>
                                                        {{ $data->address }} / {{ $data->city }}
                                                    </p>
                                                </li>
                                            @endif
                                            @if ($data->email != null)
                                                <li>
                                                    <h6>E-mail</h6>
                                                    <p class="rt-teta">
                                                        <i class="fas fa-envelope icon"></i>
                                                        {{ $data->email }}
                                                    </p>
                                                </li>
                                            @endif
                                            @if ($data->phone != null)
                                                <li>
                                                    <h6> {{ __('message.telefon') }} </h6>
                                                    <p class="rt-teta">
                                                        <i class="fas fa-phone icon"></i>
                                                        {{ $data->phone }}
                                                    </p>
                                                </li>
                                            @endif
                                            @if ($data->website != null)
                                                <li>
                                                    <h6>Website</h6>
                                                    <p class="rt-teta">
                                                        <i class="fas fa-globe icon"></i>
                                                        {{ $data->website }}
                                                    </p>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div style="width:460px!important;height:300px!important"
                                        class="col-lg-6 grid-adress">
                                        <div style="overflow:hidden">
                                            {!! $data->map !!}
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="ad-banner-img mb--40">
                                @if (reklam(25) != null && reklam(25)->status == 1)
                                    <div class="ad-banner-img mt--45 mb--40">
                                        @if (reklam(25)->type == 1)
                                            <a href="{{ reklam(25)->adsense_url }}">

                                                <img src="/{{ reklam(25)->image }}" width="1320px" style="height: 90px">
                                            </a>
                                        @else
                                            {!! reklam(25)->adsense_url ?? '' !!}
                                        @endif
                                    </div>
                                @endif
                            </div>


                        </div>
                    </div>
                    <!-- end col-->
                </div>
                <!-- end row  -->
            </div>
            <!-- end container -->
        </section>
        <!-- end rt-sidebar-section-layout-2 -->

        <!-- editor-choice-section-style-1 -->
        <section class="editor-choice-section-style-1 section-padding overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="titile-wrapper mb--30">

                            <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                <span class="rt-section-text"> {{ __('message.diğer etkinlikler') }} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div class="slider-navigation style-2">
                                <i class="fas fa-chevron-left slider-btn btn-prev"></i>
                                <i class="fas fa-chevron-right slider-btn btn-next"></i>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="swiper-container rt-post-slider-style-3">
                    <div class="swiper-wrapper">

                        @foreach ($other_activity as $item)
                            <div class="swiper-slide">
                                <div class="slide-item">
                                    <div class="rt-post-grid grid-meta">
                                        <div class="post-img">
                                            <a
                                                href="{{ \Session::get('applocale') == 'tr' ? route('front.activity.detail', $item->link) : route('front.activity.detail_en', $item->link) }}">
                                                <img src="/{{ $item->image == null ? 'assets/default_act.jpeg' : $item->image }}"
                                                    alt="post" width="551" height="431">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <a href="{{ \Session::get('applocale') == 'tr' ? route('front.activity.categoryDetail', $item->Category->link) : route('front.activity.categoryDetail_en', $item->Category->link) }}"
                                                class="rt-cat-primary sidebar_restricted_category_title">{{ $item->Category->title }}</a>
                                            <h3 class="post-title">
                                                <a
                                                    href="{{ \Session::get('applocale') == 'tr' ? route('front.activity.detail', $item->link) : route('front.activity.detail_en', $item->link) }}">
                                                    {{ $item->title }}
                                                </a>
                                            </h3>
                                            <div class="post-meta">
                                                <ul>
                                                    @if ($item->start_time)
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->start_time->translatedFormat('d M Y') }}

                                                            </span>
                                                        </li>
                                                    @endif
                                                    @if ($item->Country)
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fas fa-map-marker-alt icon"></i>
                                                                {{ $item->Country->name }}
                                                            </span>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="fa-solid fa-eye"></i>
                                                            {{ $item->view_counter == 0 ? '1' : $item->view_counter }}
                                                        </span>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                    <!-- end swiper wrapper -->
                </div>
                <!-- end swiper container + editor-choice-slider-style-1  -->
            </div>
            <!-- end container -->
        </section>
        <!-- end editor-choice-section-style-1 -->

    </main>
    <!-- End Main -->
@endsection
