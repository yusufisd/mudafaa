@extends('frontend.master')
@section('title',$cat->title ?? 'Etkinlik')

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
                                <span class="rt-section-text restricted_section_title">  {{$cat->title ?? __('message.Arama sonuçları')}} </span>
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
                                                <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.activity.detail', $item->link)) : (route('front.activity.detail_en', $item->link)) }}">
                                                    <img src="/{{ $item->image == null ? 'assets/default_act.jpeg' : $item->image }}" alt="post" width="551"
                                                        height="431">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.activity.categoryDetail',$item->Category->link)) : (route('front.activity.categoryDetail_en',$item->Category->link))}}"
                                                        class="rt-cat-primary restricted_category_title">
                                                        {{ $item->Category->title }} </a>
                                                    @if($item->sayac_yil() || $item->sayac_ay() || $item->sayac_gun())
                                                        <h6 class="rt-news-cat-normal text-danger mx-2">
                                                            <i class="far fa-clock icon"></i>
                                                            {{ $item->sayac_yil() ?? ' ' }} {{ $item->sayac_ay() ?? ' ' }} {{ $item->sayac_gun() ?? ' ' }}
                                                        </h6>
                                                   @endif
                                                </div>
                                                <h4 class="post-title">
                                                    <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.activity.detail', $item->link)) : (route('front.activity.detail_en', $item->link)) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </h4>
                                                <div class="post-meta">
                                                    <ul>
                                                        @if($item->start_time)
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->start_time->format('d M Y') }}
                                                            </span>
                                                        </li>
                                                        @endif
                                                        @if($item->Country)
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fas fa-map-marker-alt icon"></i>
                                                                {{ $item->Country->name }}
                                                            </span>
                                                        </li>
                                                        @endif

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
                        <!-- end rt-post-slider-style-5  -->

                    </div>
                    <!-- end related-post-box -->
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
