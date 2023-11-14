@extends('frontend.master')
@section('title', 'Anasayfa')
@section('css')
    <style>
        #story_container .swiper-container {
            width: 100%;
            overflow: hidden;
        }

        #story_container .swiper-slide {
            width: 115px;
            /* İstediğiniz genişliği ayarlayın */
            text-align: center;
        }

        #story_container .swiper-slide img {
            max-width: 100%;
            height: auto;
        }

        #story_container .swiper-content {
            margin-top: 0.5rem;
        }

        .trueAnswer {
            background-color: #749f43 !important;
            z-index: 999 !important;
        }

        .falseAnswer {
            background-color: #a43939 !important;
            z-index: 999 !important;
        }

        .selectedAnswer {
            background-color: #e17f10 !important;
            z-index: 999 !important;
        }

  
    </style>


@endsection
@section('content')

    <!-- story -->
    <div class="d-block d-md-none mt--30" data-bg-image="media/elements/element_1.png">
        <div id="story_container" class="container">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @if (count($cats))

                        @foreach ($cats as $variable)
                            <div class="swiper-slide">
                                <a
                                    href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $variable->link) : route('front.currentNews.detail', $variable->link) }}">
                                    <img style="height: 100%"
                                        src="{{ $variable->mobil_image != null ? $variable->mobil_image : $variable->image }}"
                                        alt="slide-1">
                                </a>
                                <div class="swiper-content">
                                    @if ($variable->Category()[0] != null)
                                        <a href="{{ \Session::get('applocale') == 'en' ? (route('front.currentNewsCategory.list_en', $variable->Category()[0]->link)) : (route('front.currentNewsCategory.list', $variable->Category()[0]->link)) }}"
                                            style="background-color: {{ $variable->Category()[0]->color_code != null ? $variable->Category()[0]->color_code : '#749f43' }}"
                                            class="rt-cat-primary restricted_story_title">{{ $variable->Category()[0]->title }}</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
            <div class="swiper-button-prev" style="position: absolute; top:14vh;left:1vh;color: #749f43;"></div>
            <div class="swiper-button-next" style="position: absolute; top:14vh;right: 1vh;color:#749f43"></div>
        </div>
    </div>

    <!-- start feature-section-style-1  -->
    <section class="d-none d-md-block rt-feature-section feature-section-style-1 overflow-hidden"
        data-bg-image="media/elements/element_1.png">
        <div class="container">
            <div class="row gutter-24">

                @foreach ($cats as $variable)
                    <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms">
                        <div class="rt-post post-sm style-1">
                            <div class="post-img">
                                <a
                                    href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $variable->link) : route('front.currentNews.detail', $variable->link) }}">
                                    <img style="object-fit:cover!important"
                                        src="{{ $variable->mobil_image != null ? $variable->mobil_image : $variable->image }}"
                                        alt="post" width="100" height="100">
                                </a>
                            </div>
                            <div class="post-content ms-4">
                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $variable->Category()[0]->link) : route('front.currentNewsCategory.list', $variable->Category()[0]->link) }}"
                                    style="background-color: {{ $variable->Category()[0]->color_code != null ? $variable->Category()[0]->color_code : '#749f43' }}"
                                    class="rt-cat-primary restricted_category_title">
                                    {{ $variable->Category()[0]->title }}
                                </a>
                                <h3 class="post-title">
                                    <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $variable->link) : route('front.currentNews.detail', $variable->link) }}"
                                        class="top_restricted_title">
                                        {{ $variable->title }}
                                    </a>
                                </h3>
                                <span class="rt-meta">
                                    <i class="far fa-calendar-alt icon"></i>
                                    {{ $variable->live_time->translatedFormat('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                @endforeach


                <!-- end col -->




            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end feature-section-style-1  -->
    <!-- start main post section style 1 -->
    <section class="d-none d-md-block rt-main-post-section main-post-section-style-1 section-padding">
        <div class="container">
            <div class="row rt-gutter-5 justify-content-between">
                <div class="col-xl-8 col-lg-6 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="800ms">

                    <div class="rt-post-overlay rt-post-overlay-xl layout-2">
                        <div class="post-img">
                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $tek_haber->link) : route('front.currentNews.detail', $tek_haber->link) }}"
                                class="img-link">
                                <img src="/{{ $tek_haber->image }}" alt="travel-xl_1" width="900" height="600">
                            </a>
                        </div>
                        <div class="post-content">

                            @if (isset($tek_haber->Category()[0]))
                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $tek_haber->Category()[0]->link) : route('front.currentNewsCategory.list', $tek_haber->Category()[0]->link) }}"
                                    style="background-color: {{ $tek_haber->Category()[0]->color_code != null ? $tek_haber->Category()[0]->color_code : '#749f43' }}"
                                    class="tr-america restricted_category_title">
                                    {{ $tek_haber->Category()[0]->title }}
                                </a>
                            @endif

                            <h3 class="post-title">
                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $tek_haber->link) : route('front.currentNews.detail', $tek_haber->link) }}"
                                    class="section_2_title_style_1">
                                    {{ $tek_haber->title }}
                                </a>
                            </h3>
                            <div class="post-meta">
                                <ul>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="fa fa-user"></i> <a href="" class="name">
                                                {{ $tek_haber->Author->name }} {{ $tek_haber->Author->surname }}
                                            </a>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="far fa-calendar-alt icon"></i>
                                            {{ $tek_haber->live_time->translatedFormat('d M Y') }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="fa-solid fa-eye"></i>
                                            {{ $tek_haber->view_counter }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="rt-meta">
                                           <i class="fas fa-share-alt icon"></i>
                                           {{ $tek_haber->ShareCounter() }}
                                        </span>
                                     </li>
                                    

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end col -->
                <div class="col-xl-4 col-lg-6 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="800ms">
                    <div class="row rt-gutter-5">
                        @foreach ($iki_haber as $item)
                            <div class="col-12">
                                <div class="rt-post-overlay rt-post-overlay-md layout-3">
                                    <div class="post-img">
                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail', $item->link) : route('front.currentNews.detail_en', $item->link) }}"
                                            class="img-link">
                                            <img src="{{ $item->image }}" alt="travel-xl_2" width="900" height="600">
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        @foreach ($item->Category() as $Category)
                                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $Category->link) : route('front.currentNewsCategory.list', $Category->link) }}"
                                                style="background-color: {{ $Category->color_code != null ? $Category->color_code : '#749f43' }}"
                                                class="tr-europe restricted_category_title">
                                                {{ $Category->title }}
                                            </a>
                                        @endforeach


                                        <h4 class="post-title">
                                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
                                                class="section_2_title_style_2">
                                                {{ $item->title }}
                                            </a>
                                        </h4>
                                        <div class="post-meta">
                                            <ul>
                                                <li>
                                                    <span class="rt-meta">
                                                        <i class="fa fa-user"></i> <a href="" class="name">
                                                            {{ $item->Author->name }}
                                                            {{ $item->Author->surname }}
                                                        </a>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="rt-meta">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        {{ $item->live_time->translatedFormat('d M Y') ?? '' }}
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="rt-meta">
                                                        <i class="fa-solid fa-eye"></i>
                                                        {{ $item->view_counter }}
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="rt-meta">
                                                       <i class="fas fa-share-alt icon"></i>
                                                       {{ $item->ShareCounter() }}
                                                    </span>
                                                 </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end main post section style 1 -->

    <!-- start what's new section -->
    <section class="whats-new-style-1 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wrap">
                        <div class="featured-tab-title">
                            <h2 class="rt-section-heading">
                                <span class="rt-section-text"> {{ __('message.güncel haberler') }} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <ul class="nav rt-tab-menu" id="myTab-2" role="tablist">
                                @foreach ($uc_kategori as $item)
                                    <li class="menu-item" role="presentation">
                                        <a class="menu-link {{ $item->id == 1 ? 'active' : '' }}" id="menu-11-tab"
                                            data-bs-toggle="tab" href="#menu-{{ $item->id }}" role="tab"
                                            aria-controls="menu-11" aria-selected="true"> {{ $item->title }} </a>
                                    </li>
                                @endforeach


                            </ul><!-- end nav tab -->
                        </div>
                        <!-- end featured-tab-title -->


                        <div class="tab-content" id="myTabContent-2">
                            <div class="tab-pane tab-item animated fadeInUp show active" id="menu-1" role="tabpanel"
                                aria-labelledby="menu-11-tab">
                                <div class="row gutter-24">

                                    <div class="col-xl-4 col-lg-6">
                                        <div class="rt-post-overlay rt-post-overlay-md">
                                            <div class="post-img">
                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $ilk_kategori_icerigi->link) : route('front.currentNews.detail', $ilk_kategori_icerigi->link) }}"
                                                    class="img-link">
                                                    <img style="object-fit:cover"
                                                        src="{{ $ilk_kategori_icerigi->image }}" alt="post-xl-3"
                                                        width="900" height="600">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                @foreach ($ilk_kategori_icerigi->Category() as $Category)
                                                    <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $Category->link) : route('front.currentNewsCategory.list', $Category->link) }}"
                                                        style="background-color: {{ $Category->color_code != null ? $Category->color_code : '#749f43' }}"
                                                        class="music restricted_category_title">
                                                        {{ $Category->title }} </a>
                                                @endforeach

                                                <h3 class="post-title">
                                                    <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $ilk_kategori_icerigi->link) : route('front.currentNews.detail', $ilk_kategori_icerigi->link) }}"
                                                        class="section_4_title_style_1">
                                                        {{ $ilk_kategori_icerigi->title }}
                                                    </a>
                                                </h3>

                                                <div class="post-meta">
                                                    <ul>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fa fa-user"></i>
                                                                <a href="{{ route('front.author.detail', $ilk_kategori_icerigi->Author->id) }}"
                                                                    class="name">{{ $ilk_kategori_icerigi->Author->name }}
                                                                    {{ $ilk_kategori_icerigi->Author->surname }}</a>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $ilk_kategori_icerigi->live_time->translatedFormat('d M Y') }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fa-solid fa-eye"></i>
                                                                {{ $ilk_kategori_icerigi->view_counter }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                               <i class="fas fa-share-alt icon"></i>
                                                               {{ $ilk_kategori_icerigi->ShareCounter() }}
                                                            </span>
                                                         </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-lg-6">

                                        <div class="post-grid-md-list gutter-24">

                                            @foreach ($cat1_news1 as $item)
                                                <div class="item">
                                                    <div class="rt-post post-md style-8">
                                                        <div class="post-img">
                                                            <a
                                                                href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}">
                                                                <img src="{{ $item->image }}" alt="post"
                                                                    width="343" height="250">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $item->Category()[0]->link) : route('front.currentNewsCategory.list', $item->Category()[0]->link) }}"
                                                                style="background-color: {{ $item->Category()[0]->color_code != null ? $item->Category()[0]->color_code : '#749f43' }}"
                                                                class="rt-cat-primary restricted_category_title">
                                                                {{ $item->Category()[0]->title }} </a>
                                                            <h4 class="post-title">
                                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
                                                                    class="section_4_title_style_2">
                                                                    {{ $item->title }}
                                                                </a>
                                                            </h4>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->live_time->translatedFormat('d M Y') }}
                                                            </span>
                                                            <span class="rt-meta ms-2">
                                                                <i class="fa-solid fa-eye"></i>
                                                                {{ $item->view_counter }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach



                                        </div>

                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-lg-6">

                                        <div class="post-grid-md-list gutter-24">

                                            @foreach ($cat1_news2 as $item)
                                                <div class="item">
                                                    <div class="rt-post post-md style-8">
                                                        <div class="post-img">
                                                            <a
                                                                href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->id) : route('front.currentNews.detail', $item->id) }}">
                                                                <img src="{{ $item->image }}" alt="post"
                                                                    width="343" height="250">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $item->Category()[0]->link) : route('front.currentNewsCategory.list', $item->Category()[0]->link) }}"
                                                                style="background-color: {{ $item->Category()[0]->color_code != null ? $item->Category()[0]->color_code : '#749f43' }}"
                                                                class="rt-cat-primary restricted_category_title">{{ $item->Category()[0]->title }}</a>
                                                            <h4 class="post-title">
                                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
                                                                    class="section_4_title_style_2">
                                                                    {{ $item->title }}
                                                                </a>
                                                            </h4>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->live_time->translatedFormat('d M Y') }}
                                                            </span>
                                                            <span class="rt-meta ms-2">
                                                                <i class="fa-solid fa-eye"></i>
                                                                {{ $item->view_counter }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>

                                    </div>

                                </div>
                            </div>


                            <div class="tab-pane tab-item animated fadeInUp" id="menu-2" role="tabpanel"
                                aria-labelledby="menu-22-tab">
                                <div class="row gutter-24">

                                    <div class="col-xl-4 col-lg-6">
                                        <div class="rt-post-overlay rt-post-overlay-md">
                                            <div class="post-img">
                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $ikinci_kategori_icerigi->link) : route('front.currentNews.detail', $ikinci_kategori_icerigi->link) }}"
                                                    class="img-link">
                                                    <img src="{{ $ikinci_kategori_icerigi->image }}" alt="post-xl-3"
                                                        width="900" height="600">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <h3 class="post-title">
                                                    <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $ikinci_kategori_icerigi->link) : route('front.currentNews.detail', $ikinci_kategori_icerigi->link) }}"
                                                        class="section_4_title_style_2">
                                                        {{ $ikinci_kategori_icerigi->title }}
                                                    </a>
                                                </h3>

                                                <div class="post-meta">
                                                    <ul>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fa fa-user"></i>
                                                                <a href="{{ route('front.author.detail', $ikinci_kategori_icerigi->Author->id) }}"
                                                                    class="name">{{ $ikinci_kategori_icerigi->Author->name }}
                                                                    {{ $ikinci_kategori_icerigi->Author->surname }}</a>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $ikinci_kategori_icerigi->live_time->translatedFormat('d M Y') }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                               <i class="fas fa-share-alt icon"></i>
                                                               {{ $ikinci_kategori_icerigi->ShareCounter() }}
                                                            </span>
                                                         </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-lg-6">

                                        <div class="post-grid-md-list gutter-24">

                                            @foreach ($cat2_news1 as $item)
                                                <div class="item">
                                                    <div class="rt-post post-md style-8">
                                                        <div class="post-img">
                                                            <a
                                                                href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}">
                                                                <img src="{{ $item->image }}" alt="post"
                                                                    width="343" height="250">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            @if ($item->Category()[0] != null)
                                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $item->Category()[0]->link) : route('front.currentNewsCategory.list', $item->Category()[0]->link) }}"
                                                                    style="background-color: {{ $item->Category()[0]->color_code != null ? $item->Category()[0]->color_code : '#749f43' }}"
                                                                    class="rt-cat-primary restricted_category_title">{{ $item->Category()[0]->title }}</a>
                                                            @endif
                                                            <h4 class="post-title">
                                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
                                                                    class="section_4_title_style_2">
                                                                    {{ $item->title }}
                                                                </a>
                                                            </h4>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->live_time->translatedFormat('d M Y') }}
                                                            </span>
                                                            <span class="rt-meta ms-2">
                                                                <i class="fa-solid fa-eye"></i>
                                                                {{ $item->view_counter }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                    </div>

                                    <div class="col-xl-4 col-lg-6">
                                        <div class="post-grid-md-list gutter-24">

                                            @foreach ($cat2_news2 as $item)
                                                <div class="item">
                                                    <div class="rt-post post-md style-8">
                                                        <div class="post-img">
                                                            <a
                                                                href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}">
                                                                <img src="{{ $item->image }}" alt="post"
                                                                    width="343" height="250">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            @if ($item->Category()[0] != null)
                                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $item->Category()[0]->link) : route('front.currentNewsCategory.list', $item->Category()[0]->link) }}"
                                                                    style="background-color: {{ $item->Category()[0]->color_code != null ? $item->Category()[0]->color_code : '#749f43' }}"
                                                                    class="rt-cat-primary restricted_category_title">{{ $item->Category()[0]->title }}</a>
                                                            @endif
                                                            <h4 class="post-title">
                                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
                                                                    class="section_4_title_style_2">
                                                                    {{ $item->title }}
                                                                </a>
                                                            </h4>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->live_time->translatedFormat('d M Y') }}
                                                            </span>
                                                            <span class="rt-meta ms-2">
                                                                <i class="fa-solid fa-eye"></i>
                                                                {{ $item->view_counter }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach



                                        </div>
                                        <!-- end post grid md list -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end innrer row -->
                            </div>
                            <!-- end ./tab item -->

                            <div class="tab-pane tab-item animated fadeInUp" id="menu-3" role="tabpanel"
                                aria-labelledby="menu-33-tab">
                                <div class="row gutter-24">
                                    @if ($ucuncu_kategori_icerigi != null)


                                        <div class="col-xl-4 col-lg-6">
                                            <div class="rt-post-overlay rt-post-overlay-md">
                                                <div class="post-img">
                                                    <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $ucuncu_kategori_icerigi->link) : route('front.currentNews.detail', $ucuncu_kategori_icerigi->link) }}"
                                                        class="img-link">
                                                        <img src="/{{ $ucuncu_kategori_icerigi->image }}" alt="post-xl-3"
                                                            width="900" height="600">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    @if ($ucuncu_kategori_icerigi != null)
                                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $ucuncu_kategori_icerigi->Category()[0]->link) : route('front.currentNewsCategory.list', $ucuncu_kategori_icerigi->Category()[0]->link) }}"
                                                            style="background-color: {{ $ucuncu_kategori_icerigi->Category()[0]->color_code != null ? $ucuncu_kategori_icerigi->Category()[0]->color_code : '#749f43' }}"
                                                            class="music restricted_category_title">
                                                            {{ $ucuncu_kategori_icerigi->Category()[0]->title }} </a>
                                                    @endif
                                                    <h3 class="post-title">
                                                        @if ($ucuncu_kategori_icerigi != null)
                                                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $ucuncu_kategori_icerigi->link) : route('front.currentNews.detail', $ucuncu_kategori_icerigi->link) }}"
                                                                class="section_4_title_style_2">
                                                                {{ $ucuncu_kategori_icerigi->title }}
                                                            </a>
                                                        @endif
                                                    </h3>

                                                    <div class="post-meta">
                                                        <ul>
                                                            <li>
                                                                <span class="rt-meta">
                                                                    <i class="fa fa-user"></i>
                                                                    <a href="{{ route('front.author.detail', $ucuncu_kategori_icerigi->Author->id) }}"
                                                                        class="name">{{ $ucuncu_kategori_icerigi->Author->name }}
                                                                        {{ $ucuncu_kategori_icerigi->Author->surname }}</a>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="rt-meta">
                                                                    <i class="far fa-calendar-alt icon"></i>
                                                                    {{ $ucuncu_kategori_icerigi->live_time->format('d M Y') }}
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="rt-meta">
                                                                   <i class="fas fa-share-alt icon"></i>
                                                                   {{ $ucuncu_kategori_icerigi->ShareCounter() }}
                                                                </span>
                                                             </li>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- end col -->

                                    <div class="col-xl-4 col-lg-6">

                                        <div class="post-grid-md-list gutter-24">

                                            @foreach ($cat3_news1 as $item)
                                                <div class="item">
                                                    <div class="rt-post post-md style-8">
                                                        <div class="post-img">
                                                            <a
                                                                href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail', $item->link) : route('front.currentNews.detail', $item->link) }}">
                                                                <img src="{{ $item->image }}" alt="post"
                                                                    width="343" height="250">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $item->Category()[0]->link) : route('front.currentNewsCategory.list', $item->Category()[0]->link) }}"
                                                                style="background-color: {{ $item->Category()[0]->color_code != null ? $item->Category()[0]->color_code : '#749f43' }}"
                                                                class="rt-cat-primary restricted_category_title">
                                                                {{ $item->Category()[0]->title }} </a>
                                                            <h4 class="post-title">
                                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
                                                                    class="section_4_title_style_2">
                                                                    {{ $item->title }}
                                                                </a>
                                                            </h4>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->live_time->translatedFormat('d M Y') }}
                                                            </span>
                                                            <span class="rt-meta ms-2">
                                                                <i class="fa-solid fa-eye"></i>
                                                                {{ $item->view_counter }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <!-- end post grid md list -->

                                    </div>
                                    <!-- end col -->

                                    <div class="col-xl-4 col-lg-6">

                                        <div class="post-grid-md-list gutter-24">

                                            @foreach ($cat3_news2 as $item)
                                                <div class="item">
                                                    <div class="rt-post post-md style-8">
                                                        <div class="post-img">
                                                            <a
                                                                href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}">
                                                                <img src="{{ $item->image }}" alt="post"
                                                                    width="343" height="250">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $item->Category()[0]->link) : route('front.currentNewsCategory.list', $item->Category()[0]->link) }}"
                                                                style="background-color: {{ $item->Category()[0]->color_code != null ? $item->Category()[0]->color_code : '#749f43' }}"
                                                                class="rt-cat-primary restricted_category_title">
                                                                {{ $item->Category()[0]->title }} </a>
                                                            <h4 class="post-title">
                                                                <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
                                                                    class="section_4_title_style_2">
                                                                    {{ $item->title }}
                                                                </a>
                                                            </h4>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->live_time->translatedFormat('d M Y') }}
                                                            </span>
                                                            <span class="rt-meta ms-2">
                                                                <i class="fa-solid fa-eye"></i>
                                                                {{ $item->view_counter }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <!-- end post grid md list -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end innrer row -->
                            </div>
                            <!-- end ./tab item -->

                        </div>
                        <!-- end /.tab-content -->

                    </div>
                    <!-- end  wrap  -->
                </div>
                <!-- end col  -->
            </div>
            <!-- end row -->
        </div>
        <!--  end container -->
    </section>
    <!-- end what's new section -->

    <!-- start travel-main-section-style-3 -->
    <section class="travel-main-section-style-3 section-padding"
        style="background-image: url('media/elements/element_9.png');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="titile-wrapper mb--40">
                        <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                            <span class="rt-section-text restricted_section_title">
                                {{ __('message.yaklaşan etkinlikler') }} </span>
                            <span class="rt-section-dot"></span>
                            <span class="rt-section-line"></span>
                        </h2>

                        <div>
                            <h6><a
                                    href="{{ \Session::get('applocale') == 'en' ? route('front.activity.close_activity_en') : route('front.activity.close_activity') }}">
                                    {{ __('message.tümünü gör') }} </a></h6>
                        </div>
                    </div>
                    <!-- end titile-wrapper -->
                </div>
            </div>
            <div class="row gutter-24 justify-content-center">

                @foreach ($activity as $item)
                    <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms">
                        <div class="rt-post-grid grid-meta">
                            <div class="post-img">
                                <a
                                    href="{{ \Session::get('applocale') == 'en' ? route('front.activity.detail_en', $item->link) : route('front.activity.detail', $item->link) }}">
                                    <img src="/{{ $item->image == null ? 'assets/default_act.jpeg' : $item->image }}"
                                        alt="post" width="551" height="431">
                                </a>
                            </div>
                            <div class="post-content">
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($item->Category != null)
                                        <a href="graphics.html" class="rt-cat-primary restricted_category_title">
                                            {{ substr($item->Category->title, 0, 10) }} ...</a>
                                    @endif
                                    @if ($item->sayac_yil() || $item->sayac_ay() || $item->sayac_gun())
                                        <h6 class="rt-news-cat-normal text-danger mx-2">
                                            <i class="far fa-clock icon"></i>
                                            {{ $item->sayac_yil() ?? ' ' }} {{ $item->sayac_ay() ?? ' ' }}
                                            {{ $item->sayac_gun() ?? ' ' }}
                                        </h6>
                                    @endif
                                </div>

                                <h4 class="post-title">
                                    <a href="{{ \Session::get('applocale') == 'en' ? route('front.activity.detail_en', $item->link) : route('front.activity.detail', $item->link) }}"
                                        class="title_style_2">
                                        {{ $item->title }}
                                    </a>
                                </h4>
                                <div class="post-meta">
                                    <ul>
                                        <li>
                                            <span class="rt-meta">
                                                <i class="far fa-calendar-alt icon"></i>
                                                {{ $item->start_time->translatedFormat('d M Y') }}
                                            </span>
                                        </li>
                                        <li>
                                            <span class="rt-meta">
                                                <i class="fas fa-map-marker-alt icon"></i>
                                                {{ substr($item->city, 0, 10) }}...
                                            </span>
                                        </li>
                                        <li>
                                            <span class="rt-meta">
                                                <i class="fa-solid fa-eye"></i>
                                                {{ $item->view_counter }}
                                            </span>
                                        </li>
                                        
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end travel-main-section-style-3 -->

    <!-- start popular post  -->
    <section class="section-padding">
        <div class="container">
            <div class="row gutter-30">

                <div class="col-xl-9">
                    <div class="featured-area-style-5 mx-auto">
                        <div class="wrap">
                            <h2 class="rt-section-heading mb--30">
                                <span class="rt-section-text restricted_section_title">
                                    {{ __('message.popüler haberler') }} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>


                            <div class="rt-post post-md style-7 grid-meta bold-underline mb--20">
                                <div class="post-img">
                                    <a
                                        href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $populer_haber_first->link) : route('front.currentNews.detail', $populer_haber_first->link) }}">
                                        <img src="{{ $populer_haber_first->image }}" alt="post" width="696"
                                            height="491">
                                    </a>
                                </div>
                                <div class="post-content">
                                    @if ($populer_haber_first->Category()[0] != null)
                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $populer_haber_first->Category()[0]->link) : route('front.currentNewsCategory.list', $populer_haber_first->Category()[0]->link) }}"
                                            style="background-color: {{ $populer_haber_first->Category()[0]->color_code != null ? $populer_haber_first->Category()[0]->color_code : '#749f43' }}"
                                            class="world"> {{ $populer_haber_first->Category()[0]->title }} </a>
                                    @endif
                                    <h3 class="post-title">
                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $populer_haber_first->link) : route('front.currentNews.detail', $populer_haber_first->link) }}"
                                            class="restricted_title">
                                            {{ $populer_haber_first->title }}
                                        </a>
                                    </h3>
                                    <p class="restricted_text">
                                        {{ $populer_haber_first->short_description }}

                                    </p>
                                    <div class="post-meta">
                                        <ul>
                                            <li>
                                                <span class="rt-meta">
                                                    <i class="fa fa-user"></i>
                                                    <a href="{{ route('front.author.detail', $populer_haber_first->Author->id) }}"
                                                        class="name">{{ $populer_haber_first->Author->name }}
                                                        {{ $populer_haber_first->Author->surname }}</a>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="rt-meta">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    {{ $populer_haber_first->live_time->translatedFormat('d M Y') }}
                                                </span>
                                            </li>
                                            <li>
                                                <span class="rt-meta">
                                                    <i class="fa-solid fa-eye"></i>
                                                    {{ $populer_haber_first->view_counter }}
                                                </span>
                                            </li>
                                            <li>
                                                <span class="rt-meta">
                                                   <i class="fas fa-share-alt icon"></i>
                                                   {{ $populer_haber_first->ShareCounter() }}
                                                </span>
                                             </li>
                                        </ul>
                                    </div>
                                    <div class="btn-wrap mt--25">
                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $populer_haber_first->link) : route('front.currentNews.detail', $populer_haber_first->link) }}"
                                            class="rt-read-more rt-button-animation-out">
                                            {{ __('message.daha fazla oku') }}
                                            <svg width="34px" height="16px" viewBox="0 0 34.53 16"
                                                xml:space="preserve">
                                                <rect class="rt-button-line" y="7.6" width="34" height=".4">
                                                </rect>
                                                <g class="rt-button-cap-fake">
                                                    <path class="rt-button-cap"
                                                        d="M25.83.7l.7-.7,8,8-.7.71Zm0,14.6,8-8,.71.71-8,8Z"></path>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">


                                @foreach ($populer_haber_three as $item)
                                    <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="200ms"
                                        data-wow-duration="800ms">
                                        <div class="rt-post-grid grid-meta">
                                            <div class="post-img">
                                                <a
                                                    href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}">
                                                    <img src="{{ $item->image }}" alt="post" width="551"
                                                        height="431">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <?php
                                                $a = 0;
                                                ?>

                                                @foreach ($item->Category() as $Category)
                                                    <?php
                                                    if (++$a == 3) {
                                                        break;
                                                    }
                                                    
                                                    ?>

                                                    <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $Category->link) : route('front.currentNewsCategory.list', $Category->link) }}"
                                                        style="background-color: {{ $Category->color_code != null ? $Category->color_code : '#749f43' }}"
                                                        class="tr-america restricted_category_title">{{ $Category->title }}</a>
                                                @endforeach

                                                <h3 class="post-title">
                                                    <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
                                                        class="title_style_2">
                                                        {{ $item->title }}
                                                    </a>
                                                </h3>
                                                <span class="rt-meta">
                                                    <i class="fa fa-user"></i>
                                                    <a href="{{ route('front.author.detail', $item->Author->id) }}"
                                                        class="name">{{ $item->Author->name }}
                                                        {{ $item->Author->surname }}</a>
                                                </span>
                                                <span class="rt-meta me-2">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    {{ $item->live_time->translatedFormat('d M Y') }}
                                                </span>
                                                <span class="rt-meta">
                                                    <i class="fa-solid fa-eye"></i>
                                                    {{ $item->view_counter }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                @endforeach




                            </div>
                            <!-- end inner row -->
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3 col-lg-8 mx-auto">
                    <div class="rt-sidebar" style="margin-top: 1.2vh;">
                        <div class="sidebar-wrap">
                            <h2 class="rt-section-heading style-2 mb--30">
                                <span class="rt-section-text restricted_section_title">Anket</span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>
                            @if ($anket)
                                <div class="rt-post-grid">
                                    <div class="post-img">
                                        <a href="single-post1.html" class="img-link">
                                            <img src="/{{ $anket->image != null ? $anket->image : 'media/gallery/travel-md_8.jpg' }}"
                                                alt="post" width="492" height="340">
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <h3 class="post-title">
                                            <a href="single-post1.html">
                                                {{ $anket->question }}
                                            </a>
                                        </h3>
                                    </div>
                                    <form class="vote-status-box">
                                        <input id="anket" type="hidden" value="{{ $anket->id }}">
                                        @foreach ($anket->cevaplar() as $cevap)
                                            <div class="vote-status-box-item box-{{ $cevap->id }} {{ $anket->isVoted() != null ? ($anket->isVoted()->answer_id == $cevap->id ? ($cevap->is_true ? 'trueAnswer' : 'falseAnswer') : ($cevap->is_true ? 'trueAnswer' : '')) : '' }}"
                                                onclick="selectOpt({{ $cevap->id }})">
                                                <div class="radio-box">
                                                    <input type="radio"
                                                        {{ $anket->isVoted() != null && $anket->isVoted()->answer_id == $cevap->id ? 'checked' : '' }}
                                                        class="aknetOpts" value="{{ $cevap->answer }}" name="vote"
                                                        id="{{ $cevap->id }}">
                                                    <label class="custom-radio-circle"
                                                        for="{{ $cevap->id }}"></label>
                                                    <label for="{{ $cevap->id }}">{{ $cevap->answer }}</label>
                                                </div>
                                                <div class="percent-box">
                                                    <span class="vote-percent"
                                                        data-vote-percent="{{ $cevap->katilim() }}">{{ $cevap->katilim() }}</span>%
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ($anket->isVoted() == null)
                                            <button id="submitAnket" type="button" class="rt-submit-btn">
                                                Gönder
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            @else
                                <p>Anket bulunamadı</p>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- start popular post  -->

    <!-- start rt ad banner -->
    <div class="rt-ad-banner rt-ad-banner-style-1 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="ad-banner-img">
                        <a href="#">
                            <img src="assets/frontend/media/gallery/ad-banner_1.jpg" alt="ad-banner" width="1400"
                                height="181">
                        </a>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end rt ad banner -->

    <!-- start top-games-section-style-1 -->
    <section class="top-video-section-style-2 section-padding motion-effects-wrap">
        <div class="video-text d-none d-xl-block">
            <img class="motion-effects1" src="assets/frontend/media/elements/element_11.png" alt="game-text"
                width="181" height="753">
        </div>
        <div class="circle-shape d-none d-xl-block">
            <img class="motion-effects6" src="assets/frontend/media/elements/element_12.png" alt="circle"
                width="528" height="378">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="mb--30 d-flex align-items-center justify-content-between flex-wrap">
                        <h2 class="rt-section-heading flex-grow-1 white-style mb-2 me-3">
                            <span class="rt-section-text restricted_section_title"> MM Video
                            </span>
                            <span class="d-none d-md-block rt-section-dot"></span>
                            <span class="d-none d-md-block rt-section-line"></span>
                        </h2>

                        <div class="mb-2">
                            <a href="{{ route('front.video.list') }}"
                                class="rt-read-more-white rt-button-animation-out">
                                {{ __('message.tümünü gör') }}
                                <svg width="34px" height="16px" viewBox="0 0 34.53 16" xml:space="preserve">
                                    <rect class="rt-button-line" y="7.6" width="34" height=".4">
                                    </rect>
                                    <g class="rt-button-cap-fake">
                                        <path class="rt-button-cap" d="M25.83.7l.7-.7,8,8-.7.71Zm0,14.6,8-8,.71.71-8,8Z">
                                        </path>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gutter-24 justify-content-center">

                @foreach ($videos as $item)
                    <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms">

                        <div class="rt-post-overlay rt-post-overlay-lg layout-6">
                            <div class="post-img">
                                <a href="{{ route('front.video.detail', $item->link) }}" class="img-link">
                                    <img src="{{ $item->image }}" alt="post-xl_31" width="900" height="600">
                                </a>
                                <a href="{{ $item->youtube }}" class="play-btn play-btn-transparent right-top">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                            <div class="post-content">
                                <a style="background-color:#749f43"
                                    href="{{ \Session::get('applocale') == 'en' ? (route('front.video.category_list_en', $item->Category->link)) : (route('front.video.category_list', $item->Category->link)) }}"
                                    class="mission restricted_category_title">
                                    {{ $item->Category->title }} </a>
                                <h3 class="post-title">
                                    <a href="{{ route('front.video.detail', $item->link) }}"
                                        class="section_6_restricted_title">
                                        {{ $item->title }}
                                    </a>
                                </h3>
                                <div class="post-meta">
                                    <ul>
                                        <li>
                                            <span class="rt-meta">
                                                <i class="far fa-calendar-alt icon"></i>
                                                {{ $item->live_date->translatedFormat('d M Y') }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach



            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end top-games-section-style-1 -->

    <!-- start travel-main-section-style-3 -->
    <section class="travel-main-section-style-3 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="titile-wrapper mb--40">
                        <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                            <span class="rt-section-text restricted_section_title"> {{ __('message.röportajlar') }}
                            </span>
                            <span class="rt-section-dot"></span>
                            <span class="rt-section-line"></span>
                        </h2>

                        <div>
                            <h6><a
                                    href="{{ \Session::get('applocale') == 'en' ? route('front.interview.list_en') : route('front.interview.list') }}">
                                    {{ __('message.tümünü gör') }} </a></h6>
                        </div>
                    </div>
                    <!-- end titile-wrapper -->
                </div>
            </div>
            <div class="row gutter-24 justify-content-center">

                @foreach ($interview as $item)
                    <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms">
                        <div class="rt-post-grid grid-meta">
                            <div class="post-img">
                                <a href="{{ route('front.interview.detail', $item->link) }}">
                                    <img src="{{ $item->image }}" alt="post" width="551" height="431">
                                </a>
                            </div>
                            <div class="post-content">
                                <h3 class="post-title">
                                    <a href="{{ route('front.interview.detail', $item->link) }}" class="title_style_2">
                                        {{ $item->title }}
                                    </a>
                                </h3>
                                <div class="post-meta">
                                    <ul>

                                        <li>
                                            <span class="rt-meta">
                                                <i class="fa fa-user"></i> <a href="" class="name">
                                                    {{ $item->Author->name }} {{ $item->Author->surname }}
                                                </a>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="rt-meta">
                                                <i class="far fa-calendar-alt icon"></i>
                                                {{ $item->live_time->translatedFormat('d M Y') }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end travel-main-section-style-2 -->

    <!-- start subscribe section -->
    <div class="section subscribe-section-style-1 section-padding"
        style="background-image: url('media/elements/element_9.png');">
        <div class="container">
            <div class="row justify-content-evenly">

                <div class="col-lg-4 align-self-end wow fadeInLeft d-none d-lg-block" data-wow-delay="300ms"
                    data-wow-duration="800ms">
                    <div class="subscribe-img bouncing-bubble-animation">
                        <img src="/assets/haber-bulten.webp" alt="subscrible" width="401" height="327">
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6 align-self-center wow fadeInRight" data-wow-delay="600ms" data-wow-duration="800ms">
                    <h4 style="font-size:20px">
                        {{ __("message.Milli Müdafa'nın güncel haberlerini takip etmek için E-posta adresiniz ile bültenimize kayıt olun.") }}
                    </h4>
                    <br>
                    <form action="#" id="demo-form" class="rt-contact-form subscribe-form-style-2">
                        <div class="rt-subs-group">
                            <input type="email" name="email" id="email_2" class="subscribe-form"
                                placeholder="E-posta" data-error="E-posta alanı zorunludur" required>

                            <button class="subscribe-btn" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                type="submit"> {{ __('message.Abone ol') }}
                            </button>
                            <div class="form-response"></div>
                        </div>
                        <br>
                        <center>
                            <div class="center">
                                <div class="g-recaptcha"
                                    data-sitekey="{{ getCaptchaSiteKey() }}" 
                                    data-callback="onSubmit">
                                </div>
                            </div>
                        </center>
                        <br>
                        <div>
                            <input type="checkbox"  name="" id="check">
                            <label for="check">
                                {{ __("message.Kişisel Verilerin İşlenmesi Aydınlatma Metni'ni okudum kabul ediyorum.") }}
                            </label>
                        </div>


                        <div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end subscribe section -->

    </main>
    <!-- End Main -->
@endsection
@section('script')

    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }
    </script>
    <script>
        var windowWidth = $(window).width();

        // Set limits for different device widths
        var limit_restricted_title = 110;
        var limit_restricted_category_title = 14;
        var limit_top_restricted_title = 30;
        var limit_section_2_title_style_1 = 85;
        var limit_section_2_title_style_2 = 62;
        var limit_restricted_text = 261;
        var limit_title_style_2 = 47;
        var limit_section_4_title_style_1 = 59;
        var limit_section_4_title_style_2 = 39;
        var limit_section_6_restricted_title = 69;
        var limit_restricted_section_title = 25;
        var limit_restricted_story_title = 10;
        if (windowWidth <= 280) {
            limit_restricted_title = 82;
            limit_restricted_category_title = 14;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_top_restricted_title = 14;
            limit_restricted_text = 261;
            limit_title_style_2 = 50;
            limit_section_4_title_style_1 = 59;
            limit_section_4_title_style_2 = 39;
            limit_section_6_restricted_title = 87;
            limit_restricted_section_title = 14;
        } else if (windowWidth <= 360) {
            limit_restricted_title = 82;
            limit_restricted_category_title = 14;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_top_restricted_title = 14;
            limit_restricted_text = 261;
            limit_title_style_2 = 55;
            limit_section_4_title_style_1 = 40;
            limit_section_4_title_style_2 = 27;
            limit_section_6_restricted_title = 75;
            limit_restricted_section_title = 11;
        } else if (windowWidth <= 375) {
            limit_restricted_title = 87;
            limit_restricted_category_title = 30;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_top_restricted_title = 55;
            limit_restricted_text = 261;
            limit_title_style_2 = 69;
            limit_section_4_title_style_1 = 50;
            limit_section_4_title_style_2 = 30;
            limit_section_6_restricted_title = 80;
            limit_restricted_section_title = 13;
        } else if (windowWidth <= 390) {
            limit_restricted_title = 87;
            limit_restricted_category_title = 30;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_top_restricted_title = 50;
            limit_restricted_text = 261;
            limit_title_style_2 = 55;
            limit_section_4_title_style_1 = 50;
            limit_section_4_title_style_2 = 30;
            limit_section_6_restricted_title = 80;
            limit_restricted_section_title = 13;
        } else if (windowWidth <= 393) {
            limit_restricted_title = 87;
            limit_restricted_category_title = 30;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_top_restricted_title = 55;
            limit_restricted_text = 261;
            limit_title_style_2 = 60;
            limit_section_4_title_style_1 = 50;
            limit_section_4_title_style_2 = 30;
            limit_section_6_restricted_title = 80;
            limit_restricted_section_title = 13;
        } else if (windowWidth <= 412) {
            limit_restricted_title = 100;
            limit_restricted_category_title = 30;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_top_restricted_title = 60;
            limit_restricted_text = 261;
            limit_title_style_2 = 65;
            limit_section_4_title_style_1 = 50;
            limit_section_4_title_style_2 = 30;
            limit_section_6_restricted_title = 85;
            limit_restricted_section_title = 13;
        } else if (windowWidth <= 414) {
            limit_restricted_title = 100;
            limit_restricted_category_title = 30;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_top_restricted_title = 60;
            limit_restricted_text = 261;
            limit_title_style_2 = 75;
            limit_section_4_title_style_1 = 50;
            limit_section_4_title_style_2 = 30;
            limit_section_6_restricted_title = 85;
            limit_restricted_section_title = 13;
        } else if (windowWidth <= 540) {
            limit_restricted_title = 87;
            limit_restricted_category_title = 30;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_top_restricted_title = 55;
            limit_restricted_text = 261;
            limit_title_style_2 = 69;
            limit_section_4_title_style_1 = 50;
            limit_section_4_title_style_2 = 30;
            limit_section_6_restricted_title = 80;
            limit_restricted_section_title = 13;
        } else if (windowWidth <= 768) {
            limit_restricted_title = 90;
            limit_restricted_category_title = 14;
            limit_section_2_title_style_1 = 70;
            limit_section_2_title_style_2 = 100;
            limit_top_restricted_title = 35;
            limit_restricted_text = 261;
            limit_title_style_2 = 50;
            limit_section_4_title_style_1 = 90;
            limit_section_4_title_style_2 = 65;
            limit_section_6_restricted_title = 70;
            limit_restricted_section_title = 30;
        } else if (windowWidth <= 820) {
            limit_restricted_title = 90;
            limit_restricted_category_title = 14;
            limit_section_2_title_style_1 = 70;
            limit_section_2_title_style_2 = 100;
            limit_top_restricted_title = 35;
            limit_restricted_text = 261;
            limit_title_style_2 = 50;
            limit_section_4_title_style_1 = 90;
            limit_section_4_title_style_2 = 65;
            limit_section_6_restricted_title = 70;
            limit_restricted_section_title = 30;
        } else if (windowWidth <= 912) {
            limit_restricted_title = 82;
            limit_restricted_category_title = 14;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_top_restricted_title = 14;
            limit_restricted_text = 261;
            limit_title_style_2 = 50;
            limit_section_4_title_style_1 = 59;
            limit_section_4_title_style_2 = 39;
            limit_section_6_restricted_title = 87;
            limit_restricted_section_title = 14;
        } else if (windowWidth <= 1024) {
            limit_restricted_title = 82;
            limit_restricted_category_title = 14;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_top_restricted_title = 14;
            limit_restricted_text = 261;
            limit_title_style_2 = 50;
            limit_section_4_title_style_1 = 59;
            limit_section_4_title_style_2 = 39;
            limit_section_6_restricted_title = 87;
            limit_restricted_section_title = 14;
        } else if (windowWidth <= 1280) {
            limit_restricted_title = 82;
            limit_restricted_category_title = 14;
            limit_top_restricted_title = 14;
            limit_section_2_title_style_1 = 85;
            limit_section_2_title_style_2 = 62;
            limit_restricted_text = 261;
            limit_title_style_2 = 50;
            limit_section_4_title_style_1 = 59;
            limit_section_4_title_style_2 = 39;
            limit_section_6_restricted_title = 87;
            limit_restricted_section_title = 25;
        }

        /*--------------------------------
           // top category title limitation
        -------------------------------*/
        // Select all tags with class .restricted_category_title
        $('.restricted_category_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_restricted_category_title) {
                // If the content is longer than limit_restricted_category_title characters
                content = content.slice(0, limit_restricted_category_title) + '...';
                // Select limit_restricted_category_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // top story title limitation
        -------------------------------*/
        // Select all tags with class .restricted_story_title
        $('.restricted_story_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_restricted_story_title) {
                // If the content is longer than limit_restricted_story_title characters
                content = content.slice(0, limit_restricted_story_title) + '...';
                // Select limit_restricted_story_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // top title limitation
        -------------------------------*/
        // Select all tags with class .top_restricted_title
        $('.top_restricted_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_top_restricted_title) {
                // If the content is longer than limit_top_restricted_title characters
                content = content.slice(0, limit_top_restricted_title) + '...';
                // Select limit_top_restricted_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // section title limitation
        -------------------------------*/
        // Select all tags with class .restricted_section_title
        $('.restricted_section_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_restricted_section_title) {
                // If the content is longer than limit_restricted_section_title characters
                content = content.slice(0, limit_restricted_section_title) + '...';
                // Select limit_restricted_section_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // section_2_title_style_1 limitation
        -------------------------------*/
        // Select all tags with class .section_2_title_style_1
        $('.section_2_title_style_1').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_section_2_title_style_1) {
                // If the content is longer than limit_section_2_title_style_1 characters
                content = content.slice(0, limit_section_2_title_style_1) + '...';
                // Select limit_section_2_title_style_1 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // section_2_title_style_2 limitation
        -------------------------------*/
        // Select all tags with class .section_2_title_style_2
        $('.section_2_title_style_2').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_section_2_title_style_2) {
                // If the content is longer than limit_section_2_title_style_2 characters
                content = content.slice(0, limit_section_2_title_style_2) + '...';
                // Select limit_section_2_title_style_2 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // section 3 title limitation
        -------------------------------*/
        // Select all tags with class .restricted_title
        $('.restricted_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length >
                limit_restricted_title) { // If the content is longer than limit_restricted_title characters
                content = content.slice(0, limit_restricted_title) +
                    '...'; // Select limit_restricted_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // section 3 text limitation
        -------------------------------*/
        // Select all tags with class .restricted_text
        $('.restricted_text').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length >
                limit_restricted_text) { // If the content is longer than limit_restricted_text characters
                content = content.slice(0, limit_restricted_text) +
                    '...'; // Select limit_restricted_text characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // style_2 title limitation
        -------------------------------*/
        // Select all tags with class .title_style_2
        $('.title_style_2').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length >
                limit_title_style_2) { // If the content is longer than limit_title_style_2 characters
                content = content.slice(0, limit_title_style_2) +
                    '...'; // Select limit_title_style_2 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // section_4_title_style_1 limitation
        -------------------------------*/
        // Select all tags with class .section_4_title_style_1
        $('.section_4_title_style_1').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_section_4_title_style_1) {
                // If the content is longer than limit_section_4_title_style_1 characters
                content = content.slice(0, limit_section_4_title_style_1) + '...';
                // Select limit_section_4_title_style_1 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // section_4_title_style_2 limitation
        -------------------------------*/
        // Select all tags with class .section_4_title_style_2
        $('.section_4_title_style_2').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_section_4_title_style_2) {
                // If the content is longer than limit_section_4_title_style_2 characters
                content = content.slice(0, limit_section_4_title_style_2) + '...';
                // Select limit_section_4_title_style_2 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

        /*--------------------------------
           // section 6 title limitation
        -------------------------------*/
        // Select all tags with class .section_6_restricted_title
        $('.section_6_restricted_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_section_6_restricted_title) {
                // If the content is longer than limit_section_6_restricted_title characters
                content = content.slice(0, limit_section_6_restricted_title) + '...';
                // Select limit_section_6_restricted_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });


        function anket() {
            var soru_id = document.getElementById('question_id').value;
            var cevap = document.getElementByClassname('vote').value;
            console.log(soru_id);

        }


        var swiper = new Swiper('#story_container .swiper-container', {
            slidesPerView: 'auto', // Resimleri otomatik olarak sığdır
            spaceBetween: 10, // Resimler arasındaki boşluk
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        function selectOpt(id) {
            $(".aknetOpts").each(() => {
                $(this).prop('checked', false);
            });
            $("#" + id).prop('checked', true);
        }
    </script>
    <script>
        // submit_survey_btn
        $('#submitAnket').on("click", function(e) {
            $("#submitAnket").remove();

            let anket = $("#anket").val();
            let answer = 'okx';
            let options = $(".aknetOpts");
            let selectedRadio = "";
            for (var i = 0; i < options.length; i++) {
                if (options[i].checked == true) {
                    answer = options[i].id;
                    selectedRadio = options[i];
                }
            }

            if (answer != '') {
                answer = parseInt(answer);
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    url: "{{ env('APP_URL') }}/anket/ekle",
                    type: "post",
                    data: {
                        "question_id": anket,
                        "cevap": answer
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {
                            console.log(response.true_answer, answer);
                            console.log(response.true_answer == answer);
                            if (response.true_answer == answer) {
                                $(".box-" + answer).addClass("trueAnswer");
                            } else {
                                $(".box-" + response.true_answer).addClass('trueAnswer');
                                $(".box-" + answer).addClass('falseAnswer');
                            }
                        } else {
                            alert(response.message);
                        }

                    }

                })

            }

        });
    </script>
@endsection
