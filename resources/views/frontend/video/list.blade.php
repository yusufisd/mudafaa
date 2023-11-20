@extends('frontend.master')
@section('title','Videolar')

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

        @foreach ($categories as $cat)
            <section class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="titile-wrapper mb--40">
                                <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                    <span class="rt-section-text restricted_title"> {{ $cat->title }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>

                                <div>
                                    <h6><a href="{{ \Session::get('applocale') == 'tr' ? (route('front.video.category_list',$cat->link)) : route('front.video.category_list_en',$cat->link) }}">{{ __('message.tümünü gör')}}</a></h6>
                                </div>
                            </div>
                            <!-- end titile-wrapper -->
                        </div>
                    </div>
                    <div class="row gutter-24">

                        @foreach ($cat->CategoryProduct() as $item)
                            <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="800ms">
                                <div class="slide-item">
                                    <div class="rt-post-grid grid-meta">
                                        <div class="post-img">
                                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.video.detail_en',$item->link) : route('front.video.detail',$item->link) }}">
                                                <img src="/{{ $item->image }}" alt="post" width="551"
                                                    height="431">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                           
                                            <h4 class="post-title">
                                                <a href="{{ route('front.video.detail',$item->link) }}"
                                                    class="restricted_title_2">
                                                    {{ $item->title }}
                                                </a>
                                            </h4>

                                            <div class="post-meta">
                                                <ul>
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

                            </div>
                        @endforeach


                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </section>
        @endforeach


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
