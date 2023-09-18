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
                            <a href="index.html">
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
                                <div class="row mb--25">
                                    <h3 class="activity-title">Aradığınız etkinliği kolaylıkla bulun.</h3>
                                    <p class="activity-text">Detaylı arama ile etkinlik yılı, etkinlik ayı ve etkinlik
                                        kategorisi gibi kriterleri belirleyerek aradığınız etkinliği kolaylıkla
                                        bulabilirsiniz.</p>
                                </div>
                                <div class="row mb--25">
                                    <div class="col-md-3 mb-3">
                                        <select class="form-select form-select-md" aria-label="Default select example">
                                            <option selected>Yıl</option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <select class="form-select form-select-md" aria-label="Default select example">
                                            <option selected>Ay</option>
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
                                        <select class="form-select form-select-md" aria-label="Default select example">
                                            <option selected>Kategori</option>
                                            <option value="28">Fuar</option>
                                            <option value="29">Etkinlik</option>
                                            <option value="30">Kongre - Sempozyum</option>
                                            <option value="31">Sergi - Gösteri</option>
                                            <option value="32">Online</option>
                                            <option value="33">Konferans</option>
                                        </select>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <select class="form-select form-select-md" aria-label="Default select example">
                                            <option selected>Konum</option>
                                            <option value="1">Türkiye - İstanbul</option>
                                            <option value="2">Türkiye - Ankara</option>
                                            <option value="3">Türkiye - İzmir</option>
                                            <option value="4">Fransa - Paris</option>
                                            <option value="5">Fransa - Marsilya</option>
                                            <option value="6">İtalya - Roma</option>
                                            <option value="10">Türkiye - Samsun</option>
                                            <option value="11">Türkiye - Eskişehir</option>
                                            <option value="13">Japonya - Chiba</option>
                                            <option value="14"> Birleşik Arap Emirlikleri - Abu Dhabi</option>
                                            <option value="15">Singapur - CEC Singapore</option>
                                            <option value="16">Almanya - Nürnberg</option>
                                            <option value="17">Türkiye - Kayseri</option>
                                            <option value="18">Çek Cumhuriyeti - Prag</option>
                                            <option value="19"> Slovenia - Gornja Radgona</option>
                                            <option value="20">Çek Cumhuriyeti - Brno</option>
                                            <option value="21">Katar – Doha</option>
                                            <option value="22">ABD - Las Vegas</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row mb--25">
                                    <div class="input-group input-group-md">
                                        <input type="text" class="form-control" name="search" value=""
                                            placeholder="Fuar adı/Anahtar kelime">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fas fa-search" style="color: #fff;"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-2 mx-auto">
                                        <a href="event_calendar.html" class="rt-submit-btn" style="float: right;">
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
                        <img src="/assets/frontend/media/gallery/ad-banner_5.jpg" alt="ad-banner" width="960" height="150">
                    </a>
                </div>

                <div class="row mb--50">
                    <!-- start related-post-box -->
                    <div class="related-post-box">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading mb-0 flex-grow-1 me-3">
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
                                            <a href="fair_detail.html">
                                                <img src="/{{$item->image}}" alt="post" width="551"
                                                    height="431">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="graphics.html"
                                                    class="rt-cat-primary restricted_category_title"> {{$item->Category->title}} </a>
                                                <h6 class="rt-news-cat-normal mx-2 text-danger">
                                                    <i class="far fa-clock icon"></i>
                                                    1 gün, 20 saat , 15 dk.
                                                </h6>
                                            </div>
                                            <h4 class="post-title">
                                                <a href="fair_detail.html">
                                                    {{$item->title}}
                                                </a>
                                            </h4>
                                            <div class="post-meta">
                                                <ul>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="far fa-calendar-alt icon"></i>
                                                            {{substr($item->start_time,0,10)}}
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="fas fa-map-marker-alt icon"></i>
                                                            {{$item->Country->name}}
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
                            <h2 class="rt-section-heading mb-0 flex-grow-1 me-3">
                                <span class="rt-section-text restricted_section_title"> {{$cat1_name}} </span>
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

                                @foreach ($cat1_activites as $item)
                                    
                                <div class="col-md-4">
                                    <div class="rt-post-grid grid-meta">
                                        <div class="post-img">
                                            <a href="fair_detail.html">
                                                <img src="/assets/frontend/media/gallery/post-md_42.jpg" alt="post" width="551"
                                                    height="431">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <a href="graphics.html"
                                                class="rt-cat-primary sidebar_restricted_category_title"> {{$item->Category->title}} </a>
                                            <h4 class="post-title">
                                                <a href="fair_detail.html">
                                                    {{$item->title}}
                                                </a>
                                            </h4>
                                            <div class="post-meta">
                                                <ul>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="far fa-calendar-alt icon"></i>
                                                            {{substr($item->start_time,0,10)}}
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="fas fa-map-marker-alt icon"></i>
                                                            {{$item->Country->name}}
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
                        <img src="/assets/frontend/media/gallery/ad-banner_5.jpg" alt="ad-banner" width="960" height="150">
                    </a>
                </div>

                <div class="row mb--50">
                    <!-- start related-post-box -->
                    <div class="related-post-box">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading mb-0 flex-grow-1 me-3">
                                <span class="rt-section-text restricted_section_title">{{$cat2_name}} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div>
                                <h6><a href="">Tümünü Gör</a></h6>
                            </div>
                        </div>
                        <!-- end titile-wrapper -->

                        <div class="rt-post-slider-style-5">
                            <div class="row">

                                @foreach ($cat2_activites as $item)
                                    
                                <div class="col-md-4">
                                    <div class="rt-post-grid grid-meta">
                                        <div class="post-img">
                                            <a href="fair_detail.html">
                                                <img src="/{{$item->image}}" alt="post" width="551"
                                                    height="431">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <a href="graphics.html"
                                                class="rt-cat-primary sidebar_restricted_category_title"> {{$item->Category->title}} </a>
                                            <h4 class="post-title">
                                                <a href="fair_detail.html">
                                                    {{$item->title}}
                                                </a>
                                            </h4>
                                            <div class="post-meta">
                                                <ul>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="far fa-calendar-alt icon"></i>
                                                            {{substr($item->start_time,0,10)}}
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="fas fa-map-marker-alt icon"></i>
                                                            {{$item->Country->name}}
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
                            <h2 class="rt-section-heading mb-0 flex-grow-1 me-3">
                                <span class="rt-section-text restricted_section_title"> {{$cat3_name}} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div>
                                <h6><a href="">Tümünü Gör</a></h6>
                            </div>
                        </div>
                        <!-- end titile-wrapper -->

                        <div class="rt-post-slider-style-5">
                            <div class="row">
                               
                                @foreach ($cat3_activites as $item)
                                    
                                <div class="col-md-4">
                                    <div class="rt-post-grid grid-meta">
                                        <div class="post-img">
                                            <a href="fair_detail.html">
                                                <img src="/{{$item->image}}" alt="post" width="551"
                                                    height="431">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <a href="graphics.html"
                                                class="rt-cat-primary sidebar_restricted_category_title"> {{$item->Category->title}} </a>
                                            <h4 class="post-title">
                                                <a href="fair_detail.html">
                                                    {{$item->title}}
                                                </a>
                                            </h4>
                                            <div class="post-meta">
                                                <ul>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="far fa-calendar-alt icon"></i>
                                                            {{substr($item->start_time,0,10)}}
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="rt-meta">
                                                            <i class="fas fa-map-marker-alt icon"></i>
                                                            {{$item->Country->name}}
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
