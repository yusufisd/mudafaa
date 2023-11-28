@extends('frontend.master')
@section('title', $data->title)

@section('css')
    <!-- Fancybox CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <style>
        .post-body {
            color: #464847;
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
                        @if ($data->GeneralCategory->link != null)
                            <li class="breadcrumb-item">
                                <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.defenseIndustryCategory.list', $data->GeneralCategory->link)) : (route('front.defenseIndustryCategory.list_en', $data->GeneralCategory->link)) }}">
                                    {{ $data->GeneralCategory->title }}
                                </a>
                            </li>
                        @endif

                        @if ($data->Category->title != null)
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="rt-text-truncate">
                                    {{ $data->Category->title }}
                                </span>
                            </li>
                        @endif

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

        <!-- Start single-post-banner -->
        <div class="single-post-banner rt-gradient-overaly" data-bg-image="/{{ $data->image }}" style="object-fit: cover">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="single-post-content">
                            <span style="background-color:#749f43" class="fashion">{{ $data->Category->title }}</span>
                            <h2 class="post-title">
                                {{ $data->title }}
                            </h2>
                            <div class="post-meta">
                                <ul>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="far fa-calendar-alt icon"></i>
                                            {{ $data->created_at->translatedFormat('d M Y') }}
                                        </span>
                                    </li>
                                    @if ($data->created_at != $data->updated_at)
                                        <li>
                                            <span class="rt-meta">
                                                <b> {{ __('message.son güncelleme') }} :</b>
                                                {{ $data->updated_at->translatedFormat('d M Y H:i') }}
                                            </span>
                                        </li>
                                    @endif
                                    <li>
                                        <span class="rt-meta">
                                            <i class="far fa-clock icon"></i>
                                            {{ $data->read_time == 0 ? '1' : $data->read_time }} DK
                                        </span>
                                    </li>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="far fa-eye icon"></i>
                                            {{ $data->view_counter }}
                                        </span>
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
        <section class="rt-sidebar-section-layout-2">
            <div class="container">
                <div class="row gutter-40">
                    <div class="col-xs-12 col-md-10 mx-auto">

                        <div class="rt-main-post-single layout-2">

                            <div class="post-share-style-1">
                                <div class="inner">

                                    <div class="share-text">
                                        <i class="fas fa-share-alt"></i>
                                        <span> {{ __('message.paylaş') }} </span>
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
                                                <i style="color:black" class="fa-brands fa-square-x-twitter twitter"></i>
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

                            <!-- strat psot body -->
                            <div class="post-body" style="text-align: justify">
                                {!! printDesc($data->description) !!}
                                <br><br>
                                <!-- ad banner -->
                                <div class="ad-banner-img mt--45 mb--40">
                                    <a href="#">
                                        <img src="/assets/frontend/media/gallery/ad-banner_5.jpg" alt="ad-banner"
                                            width="960" height="150">
                                    </a>
                                </div>

                                <div class="wrap mb--30">
                                    <div class="featured-tab-title">
                                        <h2 class="rt-section-heading">
                                            <span class="rt-section-text"> {{ __('message.ürün hakkında') }} </span>
                                            <span class="rt-section-dot"></span>
                                            <span class="rt-section-line"></span>
                                        </h2>

                                        <ul class="nav rt-tab-menu" id="myTab" role="tablist">
                                            <li class="menu-item" role="presentation">
                                                <a class="menu-link active" id="menu-1-tab" data-bs-toggle="tab"
                                                    href="#menu-1" role="tab" aria-controls="menu-1"
                                                    aria-selected="true"> {{ __('message.üretici') }} {{ __('message.firmalar') }} </a>
                                            </li>
                                            <li class="menu-item" role="presentation">
                                                <a class="menu-link" id="menu-2-tab" data-bs-toggle="tab" href="#menu-2"
                                                    role="tab" aria-controls="menu-2" aria-selected="false"> Menşei
                                                </a>
                                            </li>
                                            <li class="menu-item" role="presentation">
                                                <a class="menu-link" id="menu-3-tab" data-bs-toggle="tab" href="#menu-3"
                                                    role="tab" aria-controls="menu-3" aria-selected="false">
                                                    {{ __('message.kullanılan ülkeler') }} </a>
                                            </li>
                                        </ul><!-- end nav tab -->

                                    </div>
                                    <!-- end featured-tab-title -->

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane tab-item animated fadeInUp show active" id="menu-1"
                                            role="tabpanel" aria-labelledby="menu-1-tab">
                                            <div class="row flag_tab">


                                                @foreach ($data->Companies() as $e)
                                                    <div class="col-lg-1 grid-adress" style="width: 150px">

                                                        <img title="{{ $e->title }}" src="/{{ $e->image }}">

                                                    </div>
                                                @endforeach


                                            </div>
                                        </div><!-- end ./tab item -->

                                        <div class="tab-pane tab-item animated fadeInUp" id="menu-2" role="tabpanel"
                                            aria-labelledby="menu-2-tab">
                                            <div class="row flag_tab">

                                                @foreach ($data->Mensei() as $key)
                                                    <div class="col-lg-1">
                                                        <span title="{{ $key->name }}"
                                                            class="fi fi-{{ $key->code }} fa-3x"
                                                            style="border-radius: 10px"></span>
                                                    </div>
                                                @endforeach


                                            </div>
                                        </div><!-- end ./tab item -->

                                        <div class="tab-pane tab-item animated fadeInUp" id="menu-3" role="tabpanel"
                                            aria-labelledby="menu-3-tab">
                                            <div class="row flag_tab">

                                                @foreach ($data->Countries() as $key)
                                                    <div class="col-lg-1">
                                                        <span title="{{ $key->name }}"
                                                            class="fi fi-{{ $key->code }} fa-3x"
                                                            style="border-radius: 10px"></span>
                                                    </div>
                                                @endforeach


                                            </div>
                                        </div><!-- end ./tab item -->

                                    </div> <!-- end /.tab-content -->
                                </div>
                                @if($data->multiple_image != null)

                                <div class="wrap post-wrap mb--30">
                                    <h2 class="rt-section-heading">
                                        <span class="rt-section-text"> {{ __('message.Ürün Görselleri') }} </span>
                                        <span class="rt-section-dot"></span>
                                        <span class="rt-section-line"></span>
                                    </h2>

                                    <!-- Galeri Resimleri -->
                                    <div class="gallery">
                                            @foreach ($data->multiple_image as $item)
                                                <a data-fancybox="gallery" href="/{{ $item }}">
                                                    <img src="/{{ $item }}" alt="">
                                                </a>
                                            @endforeach

                                    </div>


                                </div>
                                <!-- end wrap -->
                                @endif


                                <div class="border-with-spacer-1"></div>
                            </div>
                            <!-- end post body -->

                            <!-- start social-share-box-2 -->
                            <div class="social-share-box-2 mb--20">
                                <div class="row">
                                    <div class="col-xl-7 col-lg-6">
                                        <div class="conent-block">
                                            <h4 class="block-tile mb--20"> {{ __('message.popüler etiketler') }} :</h4>
                                            <div class="tag-list">
                                                @foreach ($data->getKeys() as $key)
                                                    <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.defenseIndustryCategory.tag_list', $key)) : (route('front.defenseIndustryCategory.tag_list_en', $key)) }}"
                                                        class="tag-link" style="text-transform: capitalize">
                                                        {{ $key }} </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end social-share-box-2 -->


                            <!-- start post-pagination-box -->
                            <div class="post-pagination-box mb--20">

                                <div class="row">

                                    <div class="col-lg-6">

                                        @if ($previous_product != null)
                                            <div class="next-prev-wrap">
                                                <div class="item-icon">
                                                    <a
                                                        href="{{ route('front.defenseIndustryContent.detail', $previous_product->link) }}">
                                                        <i class="fas fa-chevron-left"></i>
                                                        {{ __('message.Önceki') }} {{ __('message.ürün') }}
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h4 class="title">
                                                        <a
                                                            href="{{ route('front.defenseIndustryContent.detail', $previous_product->link) }}">
                                                            {{ $previous_product->title }}
                                                        </a>
                                                    </h4>
                                                    <span class="rt-meta">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        {{ $previous_product->created_at->translatedFormat('d M Y') }}

                                                    </span>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                    <div class="col-lg-6">

                                        @if ($next_product != null)
                                            <div class="next-prev-wrap next-wrap">
                                                <div class="item-icon">
                                                    <a
                                                        href="{{ route('front.defenseIndustryContent.detail', $next_product->link) }}">
                                                        {{ __('message.Sonraki') }} {{ __('message.ürün') }}
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h4 class="title">
                                                        <a
                                                            href="{{ route('front.defenseIndustryContent.detail', $next_product->link) }}">
                                                            {{ $next_product->title }} </a>
                                                    </h4>
                                                    <span class="rt-meta">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        {{ substr($next_product->created_at, 0, 10) }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>
                            <!-- end pagination box -->

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
                                <span class="rt-section-text"> {{ __('message.diğer ürünler') }} </span>
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

                        @foreach ($other_product as $item)
                            <div class="swiper-slide">
                                <div class="slide-item">
                                    <div class="rt-post-grid grid-meta">
                                        <div class="post-img">
                                            <a href="{{ route('front.defenseIndustryContent.detail', $item->link) }}">
                                                <img src="/{{ $item->image }}" style="object-fit:cover!important"
                                                    alt="post" width="551" height="431">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            @if (isset($item->GeneralCategory->link))
                                                <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.defenseIndustryCategory.list', $item->GeneralCategory->link)) : (route('front.defenseIndustryCategory.list_en', $item->GeneralCategory->link)) }}"
                                                    class="rt-cat-primary">{{ ($item->GeneralCategory->title) }}</a>
                                            @endif
                                            <h3 class="post-title">
                                                <a href="{{ route('front.defenseIndustryContent.detail', $item->link) }}">
                                                    {{ $item->title }}
                                                </a>
                                            </h3>
                                            <div class="post-meta">
                                                <ul>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="far fa-clock icon"></i>
                                                            {{ $item->read_time == 0 ? '2' : $item->read_time }} DK
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="far fa-eye icon"></i>
                                                            {{ $item->view_counter }}
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
@endsection
@section('script')
    <script>
        /*--------------------------------
                                                           // sidebar title limitation
                                                        -------------------------------*/
        // Select all tags with class .sidebar_restricted_category_title
        $('.sidebar_restricted_category_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > 14) { // If the content is longer than 14 characters
                content = content.slice(0, 14) + '...'; // Select 14 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });
    </script>


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
