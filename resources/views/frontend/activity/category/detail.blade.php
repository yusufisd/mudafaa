@extends('frontend.master')
@section('title',$cat->title)

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

       

        <!-- Start rt-sidebar-section-layout-2 -->
        <div class="rt-sidebar-section-layout-2">
            <div class="container">
               


                <div class="row mb--50">
                    <!-- start related-post-box -->
                    <div class="related-post-box">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                <span class="rt-section-text restricted_section_title"> {{$cat->title ?? 'Arama sonuçları'}} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            
                        </div>
                        <!-- end titile-wrapper -->

                        <div class="rt-post-slider-style-5">
                            <div class="row">

                                @foreach ($data as $item)
                                    <div class="col-md-4">
                                        <div class="rt-post-grid grid-meta">
                                            <div class="post-img">
                                                <a href="{{ route('front.activity.detail', $item->id) }}">
                                                    <img src="/{{ $item->image }}" alt="post" width="551"
                                                        height="431">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{route('front.activity.categoryDetail',$item->Category->id)}}"
                                                        class="rt-cat-primary restricted_category_title">
                                                        {{ $item->Category->title }} </a>
                                                    <h6 class="rt-news-cat-normal text-danger mx-2">
                                                        <i class="far fa-clock icon"></i>
                                                        1 gün, 20 saat , 15 dk.
                                                    </h6>
                                                </div>
                                                <h4 class="post-title">
                                                    <a href="{{ route('front.activity.detail', $item->id) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </h4>
                                                <div class="post-meta">
                                                    <ul>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ substr($item->start_time, 8, 2) }}-{{ substr($item->start_time, 5, 2) }}-{{ substr($item->start_time, 0, 4) }}
                                                                - {{ substr($item->start_time, 10, 6) }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fas fa-map-marker-alt icon"></i>
                                                                {{ $item->Country->name }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-eye icon"></i>
                                                                25
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
                        <!-- end rt-post-slider-style-5  -->

                    </div>
                    <!-- end related-post-box -->
                </div>

                <div class="ad-banner-img mb--40">
                    <a href="#">
                        <img src="/assets/frontend/media/gallery/ad-banner_5.jpg" alt="ad-banner" width="960"
                            height="150">
                    </a>
                </div>

            </div>
        </div>
        <!-- End single-post-banner -->

    </main>
    <!-- End Main -->
@endsection
@section('script')
    <!-- EXTRA JS -->
    <script>
        /*--------------------------------
            // limit by device width
            -------------------------------*/
        // get device width
        var windowWidth = $(window).width();

        var limit_restricted_section_title = 25;

        if (windowWidth <= 768) {
            limit_restricted_section_title = 14;
        } else if (windowWidth <= 1200) {
            limit_restricted_section_title = 25;
        }

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
    </script>
@endsection
