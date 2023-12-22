@extends('frontend.master')
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
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            404
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- start error-section error-layout-1 -->
        <div class="error-section error-layout-1 section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 wow fadeInUp mx-auto" data-wow-delay="300ms" data-wow-duration="800ms">
                        <div class="error-area-style-1 text-center">
                            <div class="item-img">
                                <img src="/media/elements/404.png" alt="404" width="450">
                            </div>
                            <div class="item-content">
                                <h2 class="title">
                                    {{ __('message.Üzgünüz... Sayfa Bulunamadı!')}}
                                </h2>
                                <p>
                                    {{ __('message.Aradığınız sayfa bulunamadı.') }}
                                </p>
                            </div>
                            <div class="btn-wrap">
                                <a href="{{ route('front.home') }}" class="rt-btn-primary">Ana Sayfaya Dön </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end error-section error-layout-1 -->

    </main>
    <!-- End Main -->
@endsection
