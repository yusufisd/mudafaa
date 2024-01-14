@extends('frontend.master')
@section('meta-title', 'Milli Müdafaa')
@section('keywords', 'Milli Müdafaa, Haber, Güncel Haberler, Son Dakika Haberleri, Türkiye, Dünya, Teknoloji, İstanbul,
    TV, savunma, savunma sanayi, savunma sanayii, teknoloji, siber, güvenlik, siber güvenlik, milli teknoloji, milli
    teknoloji hamlesi, aselsan, baykar, havelsan, tai, tusaş, hulusi akar, haluk görgün, selçuk bayraktar, haluk bayraktar,
    temel kotil, mustafa varank, teknopark, turksat, telekom, haberlesme, istihbarat, milli istihbarat, dış politika,
    savunma sanayi haberleri, savunma sanayii haberleri, yerli, milli.')
@section('description', 'Savunma Sanayii haberleri, güncel son dakika gelişmeleri ve bugün yer alan son durum bilgileri
    için tıklayın!')
@section('title', $data->title)

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
@endsection
@section('content')

    <style>
        .post-body {
            color: #464847;
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
    </style>
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
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.company.list_en') : route('front.company.list') }}">
                                {{ __('message.firmalar') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="rt-text-truncate">
                                {{ $data->title }}
                            </span>
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
                            <div class="author-big-box-style-1 mb--30">
                                <center>
                                    <div style="background-image: url({{ asset('assets/black_fon.jpeg') }});background-opacity:0.7;border-radius:5px; width:170px;"
                                        class="author-img">
                                        <img style="opacity:0.9;" src="/{{ $data->image }}" alt="{{ $data->title }}">
                                    </div>
                                </center>
                                <div class="w-90">
                                    <h2 class="responsive-title" style="color: #3b4022;"> {{ $data->title }} </h2>
                                    <div class="row">

                                        @if (\Session::get('applocale') == 'en')
                                            @if ($data->Title() != null)
                                                @foreach ($data->Title() as $item)
                                                    <div class="col-md-6">
                                                        <ul class="mt-3">
                                                            <li class="mb-3">
                                                                @if ($item->titleIcon() != null)
                                                                    {!! $item->titleIcon()->icon_en ?? ' ' !!}
                                                                    &nbsp;&nbsp;
                                                                    <b>
                                                                        <span style="color: #749f43">
                                                                            {{ $item->titleIcon()->title_en ?? '' }} :
                                                                        </span>
                                                                    </b>
                                                                @endif
                                                                {{ $item->description ?? '' }}
                                                            </li>

                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @else
                                            @foreach ($data->Title() as $item)
                                                <div class="col-md-6">
                                                    <ul class="mt-3">
                                                        <li class="" style="margin-top: -8px">
                                                            @if ($item->titleIcon() != null)
                                                                {!! $item->titleIcon()->icon_tr ?? ' ' !!}
                                                                &nbsp;&nbsp;

                                                                <b>
                                                                    <span style="color: #749f43">
                                                                        {{ $item->titleIcon()->title_tr ?? '' }} :
                                                                    </span>
                                                                </b>
                                                            @endif
                                                            {{ $item->description ?? '' }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mb--60" style="text-align: justify">
                                {!! printDesc($data->description) !!}

                            </div>

                            <!-- end inner row -->
                            @if ($images->count() != 0)
                                <div class="wrap post-wrap mb--30">
                                    <h2 class="rt-section-heading">
                                        <span class="rt-section-text"> {{ __('message.Ürün Görselleri') }} </span>
                                        <span class="rt-section-dot"></span>
                                        <span class="rt-section-line"></span>
                                    </h2>

                                    <!-- Galeri Resimleri gallery classı kaldırıldı -->
                                    <div class="row">
                                        @foreach ($images as $item)
                                            <div class="col-md-4">
                                                <a data-fancybox="gallery" href="/{{ $item->image }}">
                                                    <img src="/{{ $item->image }}" style="width: 100%; object-fit:cover!important" alt="Resim 3">
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>


                                </div>
                            @endif
                            <!-- end wrap -->

                            <div class="wrap mb--30">
                                <div class="featured-tab-title">
                                    <h2 class="rt-section-heading">
                                        <span class="rt-section-text"> {{ __('message.İletişim Bilgileri') }} </span>
                                        <span class="rt-section-dot"></span>
                                        <span class="rt-section-line"></span>
                                    </h2>

                                    <ul class="nav rt-tab-menu" id="myTab" role="tablist">
                                        @foreach ($address as $key => $item)
                                            <li class="menu-item" role="presentation">
                                                <a class="menu-link {{ $key == 0 ? 'active' : '' }}" id="menu-1-tab"
                                                    data-bs-toggle="tab" href="#menu-{{ $item->id }}" role="tab"
                                                    aria-controls="menu-1" aria-selected="true"> {{ $item->title }} </a>
                                            </li>
                                        @endforeach



                                    </ul><!-- end nav tab -->
                                </div>
                                <!-- end featured-tab-title -->

                                <div class="tab-content" id="myTabContent">


                                    @foreach ($address as $key => $item)
                                        <div class="tab-pane tab-item animated fadeInUp {{ $key == 0 ? 'show active' : '' }}"
                                            id="menu-{{ $item->id }}" role="tabpanel"
                                            aria-labelledby="menu-{{ $item->id }}-tab">
                                            <div class="row gutter-30">
                                                <div class="col-lg-6 grid-adress">
                                                    <ul class="contact_info">
                                                        @if ($item->address != null)
                                                            <li>
                                                                <h6> {{ __('message.adres') }} </h6>
                                                                <p class="rt-teta">
                                                                    <i class="fas fa-home icon"></i>
                                                                    {{ $item->address }}
                                                                </p>
                                                            </li>
                                                        @endif
                                                        @if ($item->email != null)
                                                            <li>
                                                                <h6>E-mail</h6>
                                                                <p class="rt-teta">
                                                                    <i class="fas fa-envelope icon"></i>
                                                                    {{ $item->email }}
                                                                </p>
                                                            </li>
                                                        @endif
                                                        @if ($item->phone != null)
                                                            <li>
                                                                <h6> {{ __('message.telefon') }} </h6>
                                                                <p class="rt-teta">
                                                                    <i class="fas fa-phone icon"></i>
                                                                    {{ $item->phone }}
                                                                </p>

                                                            </li>
                                                        @endif
                                                        @if ($item->website != null)
                                                            <li>
                                                                <h6> Website </h6>
                                                                <p class="rt-teta">
                                                                    <i class="fas fa-globe icon"></i>
                                                                    {{ $item->website }}
                                                                </p>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div style="width:460px!important;height:300px!important"
                                                    class="col-lg-6 grid-adress">
                                                    <div style="overflow:hidden">
                                                        {!! $item->map !!}

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>


                        </div>
                        <!-- end rt-left-sidebar-sapcer-5 -->
                    </div>
                    <!-- end col-->

                    <div class="col-xl-3 col-lg-8 sticky-coloum-item mx-auto">
                        <div class="rt-sidebar sticky-wrap">

                            <div class="sidebar-wrap mb--40">
                                <div class="ad-banner-img">
                                    @if (reklam(37) != null && reklam(37)->status == 1)
                                        <div class="sidebar-wrap mb--40">
                                            <div class="ad-banner-img">
                                                @if (reklam(37)->type == 1)
                                                    <a href="{{ reklam(37)->adsense_url }}">

                                                        <img src="/{{ reklam(37)->image }}" alt=""
                                                            width="310" height="425">
                                                    </a>
                                                @else
                                                    {!! reklam(37)->adsense_url ?? '' !!}
                                                @endif

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
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
                                <div class="subscribe-box-style-1" data-bg-image="media/elements/elm_3.png">
                                    <div class="subscribe-content">
                                        <h3 class="title">
                                            {{ __('message.Haber Bültenimize Abone Ol') }}
                                        </h3>
                                        <p>
                                            {{ __('message.Ulusal ve global savunma ile ilgili gündemden daha hızlı haberdar olmak istiyorsanız, Milli Müdafaa e-posta listesine kayıt olun!') }}
                                        </p>
                                        <form action="#" class="rt-contact-form subscribe-form rt-form">
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
                                            <button type="submit" class="rt-submit-btn"> {{ __('message.Abone ol') }}
                                            </button>
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
    <!-- Fancybox CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        // Open slider on clicking pictures
        var galleryImages = document.querySelectorAll('.gallery a');
        galleryImages.forEach(function(image, index) {
            image.addEventListener('click', function() {
                image.setAttribute('data-fancybox',
                    'gallery'); // This line makes the gallery share the same group
                image.click();
            });
        });
    </script>
@endsection
