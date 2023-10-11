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
                            <a href="{{route('front.home')}}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{__('message.hakkımızda')}} 
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- start who-we-are-style-1 -->
        <section class="who-we-are-style-1 motion-effects-wrap">
            <div class="container">
                <div class="row gutter-30 align-items-center">
                    <div class="col-xl-7 col-lg-10 mx-auto">
                        <div class="about-img-gallery-style-1">
                            <ul class="about-img-gallery-list">
                                <li>
                                    <img class="wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="800ms"
                                        src="/{{$data->image1 != null ? $data->image1 : 'media/about/about-img_1.jpg'}}" alt="about-img_1" width="551" height="630">
                                </li>
                                <li>
                                    <img class="wow fadeInRight" data-wow-delay="500ms" data-wow-duration="800ms"
                                        src="/{{$data->image2 != null ? $data->image2 : 'media/about/about-img_2.jpg'}}" alt="about-img_2" width="551" height="555">
                                </li>
                                <li>
                                    <img class="wow fadeInUp" data-wow-delay="700ms" data-wow-duration="800ms"
                                        src="/{{$data->image3 != null ? $data->image3 : 'media/about/about-img_3.jpg'}}" alt="about-img_3" width="551" height="320">
                                </li>
                            </ul>
                            <ul class="shape-list">
                                <li><img class="motion-effects1" src="media/elements/element_17.png" alt="element_17"
                                        width="73" height="28"></li>
                                <li><img class="motion-effects1" src="media/elements/element_18.png" alt="element_18"
                                        width="113" height="104">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-xl-5 col-lg-10 wow fadeInUp mx-auto" data-wow-delay="600ms" data-wow-duration="800ms">
                        <div class="about-content-style-1">
                            <div class="rt-section-heading-style-2 mb-0">
                                <span class="sub-title">Bİz Kİmİz</span>
                                <h2 class="heading-tilte">
                                    {{$data->title}}
                                  </h2> 
                                {!!$data->description!!}
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end who-we-are-style-1 -->

    </main>
    <!-- End Main -->
@endsection