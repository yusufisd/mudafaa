@extends('frontend.master')
@section('title', 'İletişim')
@section('content')
    <style>
        .iframe{
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
                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
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
                                <p >
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
                                                    <a href="mailto:{{ $datas->email ?? 'test' }}"> {{ $datas->email ?? 'Email boş' }} </a>
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
                                                <span><a href="tel:+90{{ $datas->phone ?? '0' }}"> {{ $datas->phone ?? 'Telefon boş' }} </a></span>
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
                                                    <a href="{{ $datas->website ?? '#' }}" rel="nofollow">{{ $datas->website ?? 'Site boş' }}</a>
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
                        <form action="#" class="contact-form-style-1 rt-contact-form">
                            <h4 class="form-title">{{ __('message.Mesaj Bırakın') }}</h4>
                            <div class="form-group">
                                <input type="text" class="form-control rt-form-control" placeholder="İsim *"
                                    name="name" id="name" data-error="İsim alanı zorunludur" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control rt-form-control" placeholder="E-posta *"
                                    name="email" id="email" data-error="E-posta alanı zorunludur" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control rt-form-control" placeholder="Telefon *"
                                    name="phone" id="phone" data-error="Telefon alanı zorunludur" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <textarea name="message" id="message" class="form-control rt-form-control rt-textarea" placeholder="Mesaj *"
                                    data-error="Mesaj alanı zorunludur" required></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="check" id="check_1">
                                <label class="form-check-label" for="check_1">
                                    {{ __('message.Kişisel Verilerin Korunması Hakkında Aydınlatma Metnini okudum, onay veriyorum.') }}
                                </label>
                            </div>
                            <button type="submit" class="submit-btn">Gönder</button>
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
        @if($datas && $datas->map != null)
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
