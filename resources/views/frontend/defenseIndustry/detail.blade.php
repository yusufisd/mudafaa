@extends('frontend.master')
@section('css')
    <!-- Fancybox CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
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
                            <a href="index.html">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="aerial_platforms.html">
                                {{ $data->GeneralCategory->title }}
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

        <!-- Start single-post-banner -->
        <div class="single-post-banner rt-gradient-overaly" data-bg-image="/{{ $data->image }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="single-post-content">
                            <span class="fashion">{{ $data->Category()->title }}</span>
                            <h2 class="post-title">
                                {{ $data->title }}
                            </h2>
                            <div class="post-meta">
                                <ul>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="far fa-calendar-alt icon"></i>
                                            {{ substr($data->created_at, 0, 10) }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="far fa-comments icon"></i>
                                            250
                                        </span>
                                    </li>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="far fa-clock icon"></i>
                                            2 Dk.
                                        </span>
                                    </li>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="far fa-eye icon"></i>
                                            3,250
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
                                        <span>Paylaş</span>
                                    </div>

                                    <ul class="social-share-style-7">
                                        <li>
                                            <a class="fb" target="_blank" href="https://www.facebook.com/">
                                                <i class="social-icon fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="tw" target="_blank" href="https://twitter.com/">
                                                <i class="social-icon fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="yu" target="_blank" href="https://www.youtube.com/">
                                                <i class="social-icon fab fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dr" target="_blank" href="https://dribbble.com/">
                                                <i class="social-icon fab fa-dribbble"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dw" target="_blank" href="https://cloud.google.com/">
                                                <i class="social-icon fas fa-cloud"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- strat psot body -->
                            <div class="post-body">
                                {!! $data->description !!} 
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
                                            <span class="rt-section-text">Ürün Hakkında</span>
                                            <span class="rt-section-dot"></span>
                                            <span class="rt-section-line"></span>
                                        </h2>

                                        <ul class="nav rt-tab-menu" id="myTab" role="tablist">
                                            <li class="menu-item" role="presentation">
                                                <a class="menu-link active" id="menu-1-tab" data-bs-toggle="tab"
                                                    href="#menu-1" role="tab" aria-controls="menu-1"
                                                    aria-selected="true"> Üretici Firmalar </a>
                                            </li>
                                            <li class="menu-item" role="presentation">
                                                <a class="menu-link" id="menu-2-tab" data-bs-toggle="tab" href="#menu-2"
                                                    role="tab" aria-controls="menu-2" aria-selected="false"> Menşei
                                                </a>
                                            </li>
                                            <li class="menu-item" role="presentation">
                                                <a class="menu-link" id="menu-3-tab" data-bs-toggle="tab" href="#menu-3"
                                                    role="tab" aria-controls="menu-3" aria-selected="false">
                                                    Kullanılan Ülkeler </a>
                                            </li>
                                        </ul><!-- end nav tab -->

                                    </div>
                                    <!-- end featured-tab-title -->

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane tab-item animated fadeInUp show active" id="menu-1"
                                            role="tabpanel" aria-labelledby="menu-1-tab">
                                            <div class="row flag_tab">
                                                <div class="col-lg-1 grid-adress">
                                                    <img
                                                        src="https://millimudafaa.com/panel/uploads/savunma/123a9a0dc37aae78e902bbf5419f3bdb5ae9497d.png">
                                                </div>

                                            </div>
                                        </div><!-- end ./tab item -->

                                        <div class="tab-pane tab-item animated fadeInUp" id="menu-2" role="tabpanel"
                                            aria-labelledby="menu-2-tab">
                                            <div class="row flag_tab">

                                                @foreach ($data->Mensei() as $key)
                                                    <div class="col-lg-1 ">
                                                        <span class="fi fi-{{ $key->code }} fa-3x"
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
                                                        <span class="fi  fi-{{ $key->code }} fa-3x"
                                                            style="border-radius: 10px"></span>
                                                    </div>
                                                @endforeach


                                            </div>
                                        </div><!-- end ./tab item -->

                                    </div> <!-- end /.tab-content -->
                                </div>

                                <div class="wrap post-wrap mb--30">
                                    <h2 class="rt-section-heading">
                                        <span class="rt-section-text">Ürün Görselleri </span>
                                        <span class="rt-section-dot"></span>
                                        <span class="rt-section-line"></span>
                                    </h2>

                                    <!-- Galeri Resimleri -->
                                    <div class="gallery">

                                        @foreach ($data->multiple_image as $item)
                                            <a data-fancybox="gallery" href="/{{ $item }}">
                                                <img src="/{{ $item }}" alt="Resim 1">
                                            </a>
                                        @endforeach


                                    </div>


                                </div>
                                <!-- end wrap -->

                                <div class="border-with-spacer-1"></div>
                            </div>
                            <!-- end post body -->

                            <!-- start social-share-box-2 -->
                            <div class="social-share-box-2 mb--20">
                                <div class="row">
                                    <div class="col-xl-7 col-lg-6">
                                        <div class="conent-block">
                                            <h4 class="block-tile mb--20">Popüler Etiketler:</h4>
                                            <div class="tag-list">
                                                <a href="#" class="tag-link">Güzel</a>
                                                <a href="#" class="tag-link">Seyahat</a>
                                                <a href="#" class="tag-link">Teknoloji</a>
                                                <a href="#" class="tag-link">Siyaset</a>
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
                                                    <a href="{{route('front.defenseIndustryContent.detail',$previous_product->id)}}">
                                                        <i class="fas fa-chevron-left"></i>
                                                        Öncekİ Ürün
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h4 class="title">
                                                        <a href="{{route('front.defenseIndustryContent.detail',$previous_product->id)}}">
                                                            {{$previous_product->title}} 
                                                        </a>
                                                    </h4>
                                                    <span class="rt-meta">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        {{substr($previous_product->created_at,0,10)}}
                                                        
                                                    </span>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                    <div class="col-lg-6">

                                        @if ($next_product != null)
                                            <div class="next-prev-wrap next-wrap">
                                                <div class="item-icon">
                                                    <a href="{{route('front.defenseIndustryContent.detail',$next_product->id)}}">
                                                        Sonrakİ Ürün
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h4 class="title">
                                                        <a href="{{route('front.defenseIndustryContent.detail',$next_product->id)}}">
                                                            {{$next_product->title}} </a>
                                                    </h4>
                                                    <span class="rt-meta">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        {{substr($next_product->created_at,0,10)}}
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

                            <h2 class="rt-section-heading mb-0 flex-grow-1 me-3">
                                <span class="rt-section-text">Diğer Ürünler </span>
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
                                        <a href="single-post1.html">
                                            <img src="/{{$item->image}}" alt="post"
                                                width="551" height="431">
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <a href="graphics.html"
                                            class="rt-cat-primary sidebar_restricted_category_title">{{$item->GeneralCategory->title}}</a>
                                        <h3 class="post-title">
                                            <a href="single-post1.html">
                                                {{$item->title}}
                                            </a>
                                        </h3>
                                        <div class="post-meta">
                                            <ul>
                                                <li>
                                                    <span class="rt-meta">
                                                        <i class="far fa-comments icon"></i>
                                                        250
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="rt-meta">
                                                        <i class="far fa-clock icon"></i>
                                                        2 Dk.
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="rt-meta">
                                                        <i class="far fa-eye icon"></i>
                                                        3,250
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
