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
                    <ol class="breadcrumb d-inline-flex">
                        <li class="breadcrumb-item">
                            <a href="{{ route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Etkinlikler
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- Start rt-sidebar-section-layout-2 -->
        <div class="rt-sidebar-section-layout-2">
            <div class="container">
                <div class="row mb--30">
                    <div class="col mx-auto">
                        <div class="activity-filter-box-style-1 mb--30">
                            <div class="activity-content">

                                <form action="{{route('front.activity.searchActivity')}}" method="POST">
                                    @csrf
                                    <div class="row mb--25">
                                        <h3 class="activity-title">Aradığınız etkinliği kolaylıkla bulun.</h3>
                                        <p class="activity-text">Detaylı arama ile etkinlik yılı, etkinlik ayı ve etkinlik
                                            kategorisi gibi kriterleri belirleyerek aradığınız etkinliği kolaylıkla
                                            bulabilirsiniz.</p>
                                    </div>
                                    <div class="row mb--25">
                                        <div class="col-md-3 mb-3">
                                            <select class="form-select form-select-md" name="ay">
                                                <option value >Ay</option>
                                                <option value="01">Ocak</option>
                                                <option value="02">Şubat</option>
                                                <option value="03">Mart</option>
                                                <option value="04">Nisan</option>
                                                <option value="05">Mayıs</option>
                                                <option value="06">Haziran</option>
                                                <option value="07">Temmuz</option>
                                                <option value="08">Ağustos</option>
                                                <option value="09">Eylül</option>
                                                <option value="10">Ekim</option>
                                                <option value="11">Kasım</option>
                                                <option value="12">Aralık</option>
                                            </select>

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <select class="form-select form-select-md" name="yil"
                                                aria-label="Default select example">
                                                <option value>Yıl</option>
                                                <option value="2023">2023</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                                <option value="2020">2020</option>
                                                <option value="2019">2019</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <select class="form-select form-select-md" name="kategori"
                                                aria-label="Default select example">
                                                <option value>Kategori</option>

                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->title }} </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <select class="form-select form-select-md" name="konum"
                                                aria-label="Default select example">
                                                <option value>Konum</option>

                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                    <div class="row mb--25">
                                        <div class="input-group input-group-md">
                                            <input type="text" class="form-control" name="search" value=""
                                                placeholder="Fuar adı/Anahtar kelime">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="fas fa-search" style="color: #fff;"></i>
                                            </button>

                                        </div>
                                    </div>
                                </form>

                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-2 mx-auto">
                                            <a href="{{route('front.activity.calendar')}}" type="button" class="rt-submit-btn" style="float: right;">
                                                Etkinlik Takvimi
                                            </a>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="ad-banner-img mb--40">
                    <a href="#">
                        <img src="/assets/frontend/media/gallery/ad-banner_5.jpg" alt="ad-banner" width="960"
                            height="150">
                    </a>
                </div>

                <div class="row mb--50">
                    <!-- start related-post-box -->
                    <div class="related-post-box">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                <span class="rt-section-text restricted_section_title">Yaklaşan Etkinlikler </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div>
                                <h6><a href="fair_list.html">Tümünü Gör</a></h6>
                            </div>
                        </div>
                        <!-- end titile-wrapper -->

                        <div class="rt-post-slider-style-5">
                            <div class="row">

                                @foreach ($coming_activity as $item)
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
                                                    <a href="{{ route('front.activity.categoryDetail', $item->Category->id) }}"
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
                <div class="row mb--50">
                    <!-- start related-post-box -->
                    <div class="related-post-box">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                <span class="rt-section-text restricted_section_title"> {{ $cat1_name->title }} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div>
                                <h6><a href="{{ route('front.activity.categoryDetail', $cat1_name->id) }}">Tümünü Gör</a>
                                </h6>
                            </div>
                        </div>
                        <!-- end titile-wrapper -->

                        <div class="rt-post-slider-style-5">
                            <div class="row">

                                @foreach ($cat1_activites as $item)
                                    <div class="col-md-4">
                                        <div class="rt-post-grid grid-meta">
                                            <div class="post-img">
                                                <a href="{{ route('front.activity.detail', $item->id) }}">
                                                    <img src="/{{ $item->image }}" alt="post" width="551"
                                                        height="431">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <a href="{{ route('front.activity.categoryDetail', $item->Category->id) }}"
                                                    class="rt-cat-primary sidebar_restricted_category_title">
                                                    {{ $item->Category->title }} </a>
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
                                    <!-- end item -->
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

                <div class="row mb--50">
                    <!-- start related-post-box -->
                    <div class="related-post-box">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                <span class="rt-section-text restricted_section_title">{{ $cat2_name->title }} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div>
                                <h6><a href="{{ route('front.activity.categoryDetail', $cat2_name->id) }}">Tümünü Gör</a>
                                </h6>
                            </div>
                        </div>
                        <!-- end titile-wrapper -->

                        <div class="rt-post-slider-style-5">
                            <div class="row">

                                @foreach ($cat2_activites as $item)
                                    <div class="col-md-4">
                                        <div class="rt-post-grid grid-meta">
                                            <div class="post-img">
                                                <a href="{{ route('front.activity.detail', $item->id) }}">
                                                    <img src="/{{ $item->image }}" alt="post" width="551"
                                                        height="431">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <a href="{{ route('front.activity.categoryDetail', $item->Category->id) }}"
                                                    class="rt-cat-primary sidebar_restricted_category_title">
                                                    {{ $item->Category->title }} </a>
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
                                    <!-- end item -->
                                @endforeach

                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end rt-post-slider-style-5  -->

                    </div>
                    <!-- end related-post-box -->
                </div>
                <div class="row mb--50">
                    <!-- start related-post-box -->
                    <div class="related-post-box">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                <span class="rt-section-text restricted_section_title"> {{ $cat3_name->title }} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div>
                                <h6><a href="{{ route('front.activity.categoryDetail', $cat3_name->id) }}">Tümünü Gör</a>
                                </h6>
                            </div>
                        </div>
                        <!-- end titile-wrapper -->

                        <div class="rt-post-slider-style-5">
                            <div class="row">

                                @foreach ($cat3_activites as $item)
                                    <div class="col-md-4">
                                        <div class="rt-post-grid grid-meta">
                                            <div class="post-img">
                                                <a href="{{ route('front.activity.detail', $item->id) }}">
                                                    <img src="/{{ $item->image }}" alt="post" width="551"
                                                        height="431">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <a href="{{ route('front.activity.categoryDetail', $item->Category->id) }}"
                                                    class="rt-cat-primary sidebar_restricted_category_title">
                                                    {{ $item->Category->title }} </a>
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
                                    <!-- end item -->
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
