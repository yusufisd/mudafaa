@extends('frontend.master')
@section('title', $defense->title)

@section('content')
    <!-- Start Main -->
    <style>
        .pagination>li>a,
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
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>



                        <li class="breadcrumb-item active" aria-current="page">
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
                            <input type="text" name="sarch" id="search" placeholder="ARA..."
                                class="form-control rt-search-control">
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

                                @foreach ($contents_first as $item)
                                    <div class="col-md-6 wow fadeInUp" data-wow-delay="100ms" data-wow-duration="800ms">
                                        <div class="rt-post-overlay rt-post-overlay-md layout-6">
                                            <div class="post-img">
                                                <a href="{{ \Session::get('applocale') == 'tr' ? route('front.defenseIndustryContent.detail', $item->link) : route('front.defenseIndustryContent.detail_en', $item->link) }}"
                                                    class="img-link">
                                                    <img src="/{{ $item->image }}" alt="post-xl_37" width="900"
                                                        height="600">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <h3 class="post-title">
                                                    <a
                                                        href="{{ \Session::get('applocale') == 'tr' ? route('front.defenseIndustryContent.detail', $item->link) : route('front.defenseIndustryContent.detail_en', $item->link) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </h3>
                                                <div class="post-meta">
                                                    <ul>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fa fa-user"></i>
                                                                @if (isset($item->Author))
                                                                    <a href="#"
                                                                        class="name">{{ $item->Author->name }}
                                                                        {{ $item->Author->surname }}</a>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->created_at->translatedFormat('d M Y') }}
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

                            <div class="d-flex justify-content-center" style="padding:10%">
                                {{ $contents_first->links() }}
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
                                            <input type="text" name="sarch" id="search" placeholder="ARA..."
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
                                                                href="{{ \Session::get('applocale') == 'tr' ? route('front.defenseIndustrySubCategory.list2', $item->link) : route('front.defenseIndustrySubCategory.list2_en', $item->link) }}">
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

                            <div class="sidebar-wrap mb--40">
                                <div class="ad-banner-img">
                                    <a href="#">
                                        <img src="/assets/frontend/media/gallery/sports-ad_3.jpg" alt="ad-banner"
                                            width="310" height="425">
                                    </a>
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
                                        <a href="https://twitter.com/millimudafaacom">
                                            <i class="fab fa-twitter twitter"></i>
                                            <span class="text"><span>20,751</span> Takipçi</span>
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
