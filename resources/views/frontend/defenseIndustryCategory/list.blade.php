@extends('frontend.master')
@section('meta-title', 'Milli Müdafaa')
@section('keywords', 'Milli Müdafaa, Haber, Güncel Haberler, Son Dakika Haberleri, Türkiye, Dünya, Teknoloji, İstanbul,
    TV, savunma, savunma sanayi, savunma sanayii, teknoloji, siber, güvenlik, siber güvenlik, milli teknoloji, milli
    teknoloji hamlesi, aselsan, baykar, havelsan, tai, tusaş, hulusi akar, haluk görgün, selçuk bayraktar, haluk bayraktar,
    temel kotil, mustafa varank, teknopark, turksat, telekom, haberlesme, istihbarat, milli istihbarat, dış politika,
    savunma sanayi haberleri, savunma sanayii haberleri, yerli, milli.')
@section('description', 'Savunma Sanayii haberleri, güncel son dakika gelişmeleri ve bugün yer alan son durum bilgileri
    için tıklayın!')
@section('title', $defense->title)

@section('content')
    <!-- Start Main -->
    <style>
        .pagination>li>a,
        .pagination>li>:hover,
        .pagination>li>span {
            color: rgb(26, 159, 26); // use your own color here
        }

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

        .post-body {
            color: #464847;
        }

        .rt-cart-item .item-img::after {
            background-color: rgba(var(--color-black-rgb), 0.5);
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


                        @if ($defense->defense != null)
                            <li class="breadcrumb-item active">
                                <a
                                    href="{{ \Session::get('applocale') == 'en' ? route('front.defenseIndustryCategory.list_en', $defense->defense->link) : route('front.defenseIndustryCategory.list', $defense->defense->link) }}">
                                    {{ $defense->defense->title }}
                                </a>
                            </li>
                        @endif

                        <li class="breadcrumb-item {{ $defense->defense == null ? '' : 'active' }}" aria-current="page">
                            {{ $defense->title }}
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
                            <input type="text" name="search" id="search" placeholder="ARA..."
                                value="{{ request()->search }}" class="form-control rt-search-control">
                            <button type="submit" class="search-submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end sidebar wrap -->


            <div class="sticky-coloum-wrap container">
                <div class="row gutter-40 sticky-coloum-wrap">
                    <div class="col-xl-9 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">

                            <div class="row gutter-24">

                                @foreach ($contents_first as $key => $item)

                                    @if ($key == 4)
                                        @if (reklam(13) != null && reklam(13)->status == 1)
                                            <div class="sidebar-wrap mb--20 mt--20">
                                                <div class="ad-banner-img">
                                                    @if (reklam(13)->type == 1)
                                                        <a href="{{ reklam(13)->adsense_url }}">

                                                            <img src="/{{ reklam(13)->image }}" width="938">
                                                        </a>
                                                    @else
                                                        {!! reklam(13)->adsense_url ?? '' !!}
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                    <div class="col-md-6 wow fadeInUp" data-wow-delay="100ms" data-wow-duration="800ms">
                                        <div class="rt-post-overlay rt-post-overlay-md layout-6">
                                            <div class="post-img">
                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.defenseIndustryContent.detail_en', $item->link) : route('front.defenseIndustryContent.detail', $item->link) }}"
                                                    class="img-link">
                                                    <img src="/{{ $item->image }}" alt="post-xl_37" width="900"
                                                        height="600">
                                                    @if ($item->national == 1)
                                                        <span
                                                            style="background-color:red ;position: absolute; border:solid; border-color:red; padding:1%; top: 10px; border-radius:8px ;right: 10px;font-size: 13px;">
                                                            <b style="color:white"> YERLİ ÜRETİM </b>
                                                        </span>
                                                    @endif
                                                </a>

                                            </div>
                                            <div class="post-content">

                                                <a class="tr-america" style="background-color:#749F43"
                                                    href="{{ \Session::get('applocale') == 'en' ? route('front.defenseIndustrySubCategory.list2_en', $item->Category->link) : route('front.defenseIndustrySubCategory.list2', $item->Category->link) }}">
                                                    {{ $item->Category->title }} </a>
                                                <h3 class="post-title">
                                                    <a
                                                        href="{{ \Session::get('applocale') == 'en' ? route('front.defenseIndustryContent.detail_en', $item->link) : route('front.defenseIndustryContent.detail', $item->link) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </h3>
                                                <div class="post-meta">
                                                    <ul>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fa fa-user"></i>
                                                                @if (isset($item->Author))
                                                                <a href="{{ route('front.author.detail', $item->Author->link) }}"
                                                                        class="name">{{ $item->Author->name }}
                                                                        {{ $item->Author->surname }}</a>
                                                                @endif
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
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end inner col -->
                                @endforeach





                            </div>
                            <!-- end inner row -->

                            <div class="d-flex justify-content-center" style="padding-top:10%">
                                {!! $contents_first->appends(request()->input())->onEachSide(1)->links() !!}
                            </div>
                            <!-- end rt-pagination-area -->

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
                                            <input type="text" name="search" id="search" placeholder="ARA..."
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
                                    <span class="rt-section-text"> {{ __('message.kategoriler') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>

                                <div class="top-categories-grid-style-1">


                                    @foreach ($data as $item)
                                        <div class="cat-item">
                                            <div class="rt-cart-item">
                                                <div class="item-img">
                                                    <img src="/{{ $item->image }}" alt="cat-slider" width="696"
                                                        height="491">
                                                    <div class="item-content">
                                                        <h4 class="title" style="font-size: 13px">
                                                            <a
                                                                href="{{ \Session::get('applocale') == 'en' ? route('front.defenseIndustrySubCategory.list2_en', $item->link) : route('front.defenseIndustrySubCategory.list2', $item->link) }}">
                                                                {{ $item->title }} </a>
                                                        </h4>
                                                        <p class="count">
                                                            <span class="anim-overflow"> ({{ $item->adet() }}) </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end cat item -->
                                    @endforeach


                                </div>
                                <!-- end top-categories-grid-style-1 -->

                            </div>
                            <!-- end slidebar wrap  -->

                            @if (reklam(14) != null && reklam(14)->status == 1)
                                <div class="sidebar-wrap mb--40">
                                    <div class="ad-banner-img">
                                        @if (reklam(14)->type == 1)
                                            <a href="{{ reklam(14)->adsense_url }}">

                                                <img src="/{{ reklam(14)->image }}" alt="" width="310"
                                                    height="425">
                                            </a>
                                        @else
                                            {!! reklam(14)->adsense_url ?? '' !!}
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <!-- end slidebar wrap  -->

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.bizi takip edin') }} </span>
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
                                        <a class="tw" style="background-color: black!important" target="_blank"
                                            href="https://twitter.com/">
                                            <i style="background-color: black"
                                                class="fa-brands fa-square-x-twitter twitter"></i>
                                            <span class="text"><span>15,985</span> Takipçi</span>

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

                            <div class="d-none d-md-block sidebar-wrap">
                                <div class="subscribe-box-style-1" data-bg-image="{{ asset('assets/frontend/media/elements/elm_3.webp') }}">
                                    <div class="subscribe-content">
                                        <h3 class="title">
                                            {{ __('message.Haber Bültenimize Abone Ol') }}
                                        </h3>
                                        <p>
                                            {{ __('message.Ulusal ve global savunma ile ilgili gündemden daha hızlı haberdar olmak istiyorsanız, Milli Müdafaa e-posta listesine kayıt olun!') }}
                                        </p>
                                        <form action="{{ route('front.subscribePost') }}" method="POST" class="subscribe-form rt-form">
                                            @csrf
                                            <div class="rt-form-group">
                                                <input type="email" class="form-control rt-form-control"
                                                    placeholder="E-posta *" name="email" id="email_1"
                                                    data-error="E-posta alanı zorunludur" required>
                                            </div>
                                            <div class="center"
                                                style="overflow:hidden; border-right:solid; border-color:#d3d3d3; border-radius:3px">
                                                <div class="g-recaptcha" data-sitekey="{{ getCaptchaSiteKey() }}"
                                                    data-callback="onSubmit">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="">
                                                <input type="checkbox" required name="accept" id="checked">
                                                @if (\Session::get('applocale') == 'en')
                                                    @if ($kvkk_en)
                                                        <a href="{{ route('front.page.detail', 'pdpl') }}">
                                                            <span style="font-size:14px">
                                                                {{ __('message.Kişisel Verilerin Korunması') }}
                                                            </span>
                                                        </a>
                                                        <label for="checked" style="font-size:14px">
                                                            {{ __('message.okudum, onay veriyorum') }}
                                                        </label>
                                                    @else
                                                        <label for="checked" style="font-size:14px">
                                                            {{ __("message.Kişisel Verilerin İşlenmesi Aydınlatma Metni'ni okudum kabul ediyorum.") }}
                                                        </label>
                                                    @endif
                                                @else
                                                    @if ($kvkk_tr)
                                                        <a href="{{ route('front.page.detail', 'kvkk') }}">
                                                            <span style="font-size:14px">
                                                                {{ __('message.Kişisel Verilerin Korunması') }}
                                                            </span>
                                                        </a>
                                                        <label for="checked">
                                                        {{ __('message.okudum, onay veriyorum') }}
                                                    </label>
                                                    @else
                                                        <label for="checked" style="font-size:14px">
                                                            {{ __('message.Kişisel Verilerin Korunması Hakkında Aydınlatma Metnini okudum, onay veriyorum.') }}
                                                        </label>
                                                    @endif
                                                @endif
                                            </div>
                                            <button type="submit" class="rt-submit-btn mt-4">
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
