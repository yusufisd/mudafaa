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
                            <a href="/">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Videolar
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <section class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading mb-0 flex-grow-1 me-3">
                                <span class="rt-section-text restricted_title"> {{$cat_first_name->title}} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div>
                                <h6><a href="#">Tümünü Gör</a></h6>
                            </div>
                        </div>
                        <!-- end titile-wrapper -->
                    </div>
                </div>
                <div class="row gutter-24">

                    @foreach ($cat_first as $item)
                        <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms">
                            <div class="rt-post-grid grid-meta">
                                <div class="post-img">
                                    <a href="#">
                                        <img src="/{{$item->image}}" alt="post"
                                            width="551" height="431">
                                    </a>
                                    <a href="{{ route('front.video.detail', $item->id) }}" class="tr-bangladesh rt-meta-over"> test </a>
                                    <a href="http://www.youtube.com/watch?v=1iIZeIy7TqM"
                                        class="play-btn play-btn-white_lg rt-play-over">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endforeach


                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>

        <!-- start rt ad banner -->
        <div class="rt-ad-banner rt-ad-banner-style-1 section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="ad-banner-img">
                            <a href="#">
                                <img src="/assets/frontend/media/gallery/ad-banner_1.jpg" alt="ad-banner" width="1400"
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

        <!-- start travel-main-section-style-3 -->
        <section class="travel-main-section-style-3 section-padding"
            style="background-image: url('media/elements/element_9.png');">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading mb-0 flex-grow-1 me-3">
                                <span class="rt-section-text restricted_title"> {{$cat_second_name->title}} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div>
                                <h6><a href="fair_list.html">Tümünü Gör</a></h6>
                            </div>
                        </div>
                        <!-- end titile-wrapper -->
                    </div>
                </div>
                <div class="row gutter-24">

                    @foreach ($cat_second as $item)

                        <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms">
                            <div class="rt-post-grid grid-meta">
                                <div class="post-img">
                                    <a href="single-post1.html">
                                        <img src="/{{$item->image}}" alt="post"
                                            width="551" height="431">
                                    </a>
                                    <a href="single-post1.html" class="tr-bangladesh rt-meta-over"> test </a>
                                    <a href="http://www.youtube.com/watch?v=1iIZeIy7TqM"
                                        class="play-btn play-btn-white_lg rt-play-over">
                                        <i class="fas fa-play"></i>
                                    </a>
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

        <section class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading mb-0 flex-grow-1 me-3">
                                <span class="rt-section-text restricted_title"> {{$cat_third_name->title}} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div>
                                <h6><a href="reports_list.html">Tümünü Gör</a></h6>
                            </div>
                        </div>
                        <!-- end titile-wrapper -->
                    </div>
                </div>
                <div class="row gutter-24">

                    @foreach ($cat_third as $item)

                        <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms">
                            <div class="rt-post-grid grid-meta">
                                <div class="post-img">
                                    <a href="single-post1.html">
                                        <img src="/{{$item->image}}" alt="post"
                                            width="551" height="431">
                                    </a>
                                    <a href="single-post1.html" class="tr-bangladesh rt-meta-over"> test </a>
                                    <a href="http://www.youtube.com/watch?v=1iIZeIy7TqM"
                                        class="play-btn play-btn-white_lg rt-play-over">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>

        <!-- start rt ad banner -->
        <div class="rt-ad-banner rt-ad-banner-style-1 section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="ad-banner-img">
                            <a href="#">
                                <img src="/assets/frontend/media/gallery/ad-banner_1.jpg" alt="ad-banner" width="1400"
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

    </main>
    <!-- End Main -->
@endsection
@section('script')
    <script>
        /*--------------------------------
            // limit by device width
            -------------------------------*/
        // get device width
        var windowWidth = $(window).width();
        console.log(windowWidth);

        // Set limits for different device widths
        var limit_restricted_title = 25;
        if (windowWidth <= 768) {
            limit_restricted_title = 14;
        } else if (windowWidth <= 1200) {
            limit_restricted_title = 25;
        }

        /*--------------------------------
            // title limitation
         -------------------------------*/
        // Select all tags with class .restricted_title
        $('.restricted_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_restricted_title) {
                // If the content is longer than limit_restricted_title characters
                content = content.slice(0, limit_restricted_title) + '...';
                // Select limit_restricted_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });
    </script>
@endsection
