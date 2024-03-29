@extends('frontend.master')
@section('meta-title', 'Milli Müdafaa')
@section('keywords', 'Milli Müdafaa, Haber, Güncel Haberler, Son Dakika Haberleri, Türkiye, Dünya, Teknoloji, İstanbul,
    TV, savunma, savunma sanayi, savunma sanayii, teknoloji, siber, güvenlik, siber güvenlik, milli teknoloji, milli
    teknoloji hamlesi, aselsan, baykar, havelsan, tai, tusaş, hulusi akar, haluk görgün, selçuk bayraktar, haluk bayraktar,
    temel kotil, mustafa varank, teknopark, turksat, telekom, haberlesme, istihbarat, milli istihbarat, dış politika,
    savunma sanayi haberleri, savunma sanayii haberleri, yerli, milli.')
@section('description', 'Savunma Sanayii haberleri, güncel son dakika gelişmeleri ve bugün yer alan son durum bilgileri
    için tıklayın!')
@section('title', 'İletişim')
@section('content')
    <style>
        .iframe {
            width: 1600px;
            height: 500px;
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
                            {{ __('message.İletişim') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- start contact-section-layout-1 -->
        <div class="contact-section-layout-1 section-padding-2">
            <div class="container">
                <div class="row gutter-30 justify-content-between align-items-center">
                    <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="800ms">
                        <div class="contact-wrap-area-1">

                            <div style="text-align: justify" class="rt-section-heading-style-2">
                                <span class="sub-title">{{ __('message.SİZE NASIL YARDIMCI OLABİLİRİZ') }}</span>
                                <h2 class="heading-tilte">
                                    {{ $datas->title ?? 'Başlık' }}
                                </h2>
                                <p>
                                    {!! $datas->description ?? 'Açıklama boş' !!}
                                </p>
                            </div>

                            <div class="contact-list-area-1">
                                <ul class="contact-list-style-1 clearfix">

                                    @if ($datas && $datas->address != null)
                                        <li class="media list-item">
                                            <div class="list-icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="list-content">
                                                <span> {{ $datas->address ?? 'Adres boş' }} </span>
                                            </div>
                                        </li>
                                    @endif

                                    @if ($datas && $datas->email != null)
                                        <li class="media list-item">
                                            <div class="list-icon">

                                                <i class="far fa-envelope"></i>
                                            </div>
                                            <div class="list-content">
                                                <span>
                                                    <a href="mailto:{{ $datas->email ?? 'test' }}">
                                                        {{ $datas->email ?? 'Email boş' }} </a>
                                                </span>
                                            </div>
                                        </li>
                                    @endif

                                    @if ($datas && $datas->phone != null)
                                        <li class="media list-item">
                                            <div class="list-icon">
                                                <i class="fas fa-phone-alt"></i>
                                            </div>
                                            <div class="list-content">
                                                <span><a href="tel:+90{{ $datas->phone ?? '0' }}">
                                                        {{ $datas->phone ?? 'Telefon boş' }} </a></span>
                                            </div>
                                        </li>
                                    @endif


                                    @if ($datas && $datas->website != null)
                                        <li class="media list-item">
                                            <div class="list-icon">
                                                <i class="fas fa-globe-americas"></i>
                                            </div>
                                            <div class="list-content">
                                                <span>
                                                    <a href="{{ $datas->website ?? '#' }}"
                                                        rel="nofollow">{{ $datas->website ?? 'Site boş' }}</a>
                                                </span>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-5 col-lg-6 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="800ms">
                        <form action="{{ route('front.contactFormPost') }}" method="POST" class="contact-form-style-1 group-required ">
                            @csrf
                            <h4 class="form-title">{{ __('message.Mesaj Bırakın') }}</h4>

                            @if($errors->any())
                                @foreach ($errors->all() as $err)
                                    <div class="alert alert-danger">
                                        {{ $err }}
                                    </div>
                                @endforeach
                            @endif

                            <div class="form-group">
                                <input type="text" class="form-control rt-form-control"
                                    placeholder="{{ __('message.isim') }} *" name="name" value="{{ old('name') }}" id="name"
                                    data-error="{{ __('message.İsim alanı zorunludur') }}" required>
                                <div class="help-block with-errors" style="color:red; font-size:14px"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control rt-form-control" value="{{ old('email') }}" placeholder="E-mail *"
                                    name="email" id="email" data-error="{{ __('message.E-mail alanı zorunludur') }}"
                                    required>
                                <div class="help-block with-errors" style="color:red; font-size:14px"></div>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control rt-form-control"
                                    placeholder="{{ __('message.telefon') }} *" name="phone" value="{{ old('phone') }}" id="phone"
                                    data-error="{{ __('message.Telefon alanı zorunludur') }}" required>
                                <div class="help-block with-errors" style="color:red; font-size:14px"></div>
                            </div>

                            <div class="form-group">
                                <textarea name="message" id="message" class="form-control rt-form-control rt-textarea"
                                    placeholder="{{ __('message.mesaj') }} *" data-error="{{ __('message.Mesaj alanı zorunludur') }}" required>{{ old('message') }}</textarea>
                                <div class="help-block with-errors" style="color:red; font-size:14px"></div>
                            </div>
                            <div class="form-check mb-3">
                                <div class="">
                                    <input type="checkbox" class="form-check-input required" name="check" required
                                        id="check2">
                                    <span for="check">
                                        @if (\Session::get('applocale') == 'en')
                                            @if ($kvkk_en)
                                            <label for="check2">
                                                <a href="{{ route('front.page.detail', 'pdpl') }}">
                                                    {{ __('message.Kişisel Verilerin Korunması') }}
                                                </a>
                                                    {{ __('message.okudum, onay veriyorum') }}
                                                </label>
                                            @else
                                                <label for="check2">
                                                    {{ __("message.Kişisel Verilerin İşlenmesi Aydınlatma Metni'ni okudum kabul ediyorum.") }}
                                                </label>
                                            @endif
                                        @else
                                            @if ($kvkk_tr)
                                            <label for="check2">

                                                <a href="{{ route('front.page.detail', 'kvkk') }}">
                                                    {{ __('message.Kişisel Verilerin Korunması') }}
                                                </a>
                                                    {{ __('message.okudum, onay veriyorum') }}
                                                </label>
                                            @else
                                                <label for="check2">
                                                    {{ __('message.Kişisel Verilerin Korunması Hakkında Aydınlatma Metnini okudum, onay veriyorum.') }}
                                                </label>
                                            @endif
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="submit-btn"> {{ __('message.kaydet') }} </button>
                            <div class="form-response"></div>
                        </form>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end contact-section-layout-1 -->

        <!-- start  Map Section -->
        @if ($datas && $datas->map != null)
            <div class="map-section-style-1">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="map-wrapper" style="text-align: center" style="width: 100%">
                                {!! $datas->map !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- End  Map Section -->

    </main>
@endsection
