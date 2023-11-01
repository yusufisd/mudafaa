@extends('frontend.master')
@section('title', $data->title)
@section('meta-title', $data->title)
@section('description', $data->short_description)
@section('simage', asset($data->image))
@section('stitle', $data->title)
@section('sdescription', $data->short_description)

@section('content')
    <style>
        .tag-link:hover {
            background-color: #749f43;
            color: white;
        }

        .post-body:first-letter:first-child {
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
                            <a href="/">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('front.dictionary.list') }}">
                                SS Sözlüğü
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
                            <h2 class="post-title">
                                {{ $data->title }}
                            </h2>
                            <div class="post-meta">
                                <ul>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="fa fa-user icon"></i>
                                            {{ $data->Author->name }} {{ $data->Author->surname }}
                                        </span>
                                    </li>
                                    <li>
                                        <span class="rt-meta">
                                            <i class="far fa-calendar-alt icon"></i>
                                            {{ $data->created_at->translatedFormat('d M Y') }}
                                        </span>
                                    </li>

                                    <li>
                                        <span class="rt-meta">
                                            <i class="far fa-clock icon"></i>
                                            {{ $data->read_time }} DK
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
        <section class="rt-sidebar-section-layout-3 mt-5">
            <div class="container">
                <div class="row gutter-40">
                    <div class="col-xl-9 col-lg-10 mx-auto">

                        <div class="rt-main-post-single layout-2">

                            <div class="post-share-style-1">
                                <div class="inner">

                                    <div class="share-text">
                                        <i class="fas fa-share-alt"></i>
                                        <span>Paylaş</span>
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

                                    </ul>
                                </div>
                            </div>

                            <!-- strat psot body -->
                            <div class="post-body justify-between" style="text-align: justify">
                                {!! printDesc($data->description) !!}
                            </div>
                            <!-- end post body -->

                            <!-- start social-share-box-2 -->
                            <div class="social-share-box-2 mb--40">
                                <div class="row gutter-30">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="conent-block" style="margin-top:3%">
                                            <h4 class="block-tile mb--20">Popüler Etiketler:</h4>
                                            <div class="tag-list">

                                                @foreach ($data->getKeys() as $item)
                                                    <a href="{{ route('front.dictionary.tag_list', $item) }}"
                                                        class="tag-link" style="text-transform: capitalize">
                                                        {{ $item }} </a>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end social-share-box-2 -->

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
        <section class="editor-choice-section-style-1 mt-sm-3 mt-md-5 rt-sidebar-section-layout-2 overflow-hidden">

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="titile-wrapper mb--30">

                            <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                <span class="rt-section-text">Diğer Sözlükler </span>
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

                        @foreach ($other as $item)
                            <div class="swiper-slide">
                                <div class="slide-item">
                                    <div class="rt-post-grid grid-meta">
                                        <div class="post-img">
                                            <a href="{{ route('front.dictionary.detail', $item->link) }}">
                                                <img src="/{{ $item->image == null ? 'media/gallery/post-xl_31.jpg' : $item->image }}"
                                                    alt="post" width="551" height="431">
                                            </a>
                                        </div>
                                        <div class="post-content">

                                            <h3 class="post-title">
                                                <a href="{{ route('front.dictionary.detail', $item->link) }}">
                                                    {{ $item->title }}
                                                </a>
                                            </h3>
                                            <div class="post-meta">
                                                <ul>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="fa fa-user icon"></i>
                                                            {{ $item->Author->name }} {{ $item->Author->surname }}
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="far fa-clock icon"></i>
                                                            {{ $item->read_time }} DK
                                                        </span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end swiper slide -->
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
    <!-- End Main -->
@endsection
@section('script')
    <!-- EXTRA JS -->
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
@endsection
