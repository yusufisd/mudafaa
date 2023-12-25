@extends('frontend.master')
@section('meta-title',  'Milli Müdafaa')
@section('keywords',  'Milli Müdafaa, Haber, Güncel Haberler, Son Dakika Haberleri, Türkiye, Dünya, Teknoloji, İstanbul, TV, savunma, savunma sanayi, savunma sanayii, teknoloji, siber, güvenlik, siber güvenlik, milli teknoloji, milli teknoloji hamlesi, aselsan, baykar, havelsan, tai, tusaş, hulusi akar, haluk görgün, selçuk bayraktar, haluk bayraktar, temel kotil, mustafa varank, teknopark, turksat, telekom, haberlesme, istihbarat, milli istihbarat, dış politika, savunma sanayi haberleri, savunma sanayii haberleri, yerli, milli.')
@section('description', 'Savunma Sanayii haberleri, güncel son dakika gelişmeleri ve bugün yer alan son durum bilgileri için tıklayın!')
@section('title', 'Yazarlar')
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
                            <a href="index.html">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Yazarlarımız
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- start team-seciton-style-1 -->
        <section class="team-seciton-style-1 section-padding-2 motion-effects-wrap">
            <div class="shape-circle">
                <img class="motion-effects5" src="media/elements/element_20.png" alt="element_20" width="528"
                    height="528">
            </div>
            <div class="container">

                <div class="row">
                    <div class="col-xl-5 col-lg-6 mx-auto text-center">
                        <div class="rt-section-heading-style-2">
                            <h2 class="heading-tilte">
                                Takımımızla Tanışın
                            </h2>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, ab minus?
                            </p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row gutter-20">

                    @foreach ($data as $item)
                        <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms">
                            <div class="team-box-style-1">
                                <div class="">
                                    <a href="{{ route('front.author.detail',$item->id) }}">
                                        <img src="/assets/author-img_1.jpg" alt="team_1" width="551" height="610">
                                    </a>
                                </div>
                                <div class="team-content">
                                    <h3 style="text-transform: capitalize" class="name"><a href="{{ route('front.author.detail',$item->id) }}">
                                            {{ $item->name }} {{ $item->surname }} </a></h3>
                                    <ul class="team-social-1 footer-social">
                                        @if ($item->phone)
                                            <li class="social-item">
                                                <a href="https://wa.me/+90{{ $item->phone }}" class="social-link pn" target="_blank">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($item->facebook != null)
                                            <li class="social-item">
                                                <a href="https://www.facebook.com/" class="social-link fb" target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($item->twitter)
                                            <li class="social-item">
                                                <a href="https://twitter.com/" class="social-link tw" target="_blank">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($item->linkedin)
                                            <li class="social-item"><a href="https://www.linkedin.com/"
                                                    class="social-link ln" target="_blank"><i
                                                        class="fab fa-linkedin-in"></i></a></li>
                                        @endif
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    @endforeach


                </div>
                <!-- end row -->

            </div>
            <!-- end container -->
        </section>
        <!-- end team-seciton-style-1 -->

    </main>
    <!-- End Main -->
@endsection
