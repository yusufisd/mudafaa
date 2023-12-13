@extends('frontend.master')
@section('title', 'Etkinlik')
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
                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('message.etkinlikler') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- Start rt-sidebar-section-layout-2 -->
        <div class="rt-sidebar-section-layout-2">
            <div class="container">
                @if(reklam(17) != null)
                    <div class="ad-banner-img mt--45 mb--40">
                        <a href="{{ reklam(17)->adsense_url }}">
                            @if (reklam(17)->type ?? 0 == 1)
                                <img src="/{{ reklam(17)->image }}" alt="" width="1320px" style="height:90px">
                            @else
                                {!! reklam(17)->adsense_url ?? '' !!}
                            @endif
                        </a>
                    </div>
                @endif
                <div class="row mb--30">
                    <div class="col mx-auto">
                        <div class="activity-filter-box-style-1 mb--30">
                            <div class="activity-content">

                                <form action="{{ route('front.activity.searchActivity') }}" method="POST">
                                    @csrf
                                    <div class="row mb--25">
                                        <h3 class="activity-title">{{ __('message.Aradığınız etkinliği kolayca bulun.') }}</h3>
                                        <p class="activity-text">{{__('message.Detaylı arama ile etkinlik yılı, etkinlik ayı ve etkinlik kategorisi gibi kriterleri belirleyerek aradığınız etkinliği kolaylıkla bulabilirsiniz.')}}</p>
                                    </div>
                                    <div class="row mb--25">
                                        <div class="col-md-3 mb-3">
                                            <select class="form-select form-select-md" name="ay">
                                                <option value> {{ __('message.ay') }} </option>
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
                                                <option value>{{ __('message.yıl') }}</option>
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
                                                <option value> {{ __('message.kategori') }} </option>

                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->title }} </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <select class="form-select form-select-md" name="konum"
                                                aria-label="Default select example">
                                                <option value> {{ __('message.konum') }} </option>

                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                    <div class="row mb--25">
                                        <div class="input-group input-group-md">
                                            <input type="text" class="form-control" name="search" value=""
                                                placeholder="{{ __('message.Fuar adı/Anahtar kelime') }}">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="fas fa-search" style="color: #fff;"></i>
                                            </button>

                                        </div>
                                    </div>
                                </form>

                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-2 mx-auto">
                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.activity.calendar_en') : route('front.activity.calendar') }}" type="button"
                                            class="rt-submit-btn" style="float: right;">
                                            {{ __('message.etkinlik takvimi') }}
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            @if(reklam(175) != null)
                                <div class="ad-banner-img mt--45 mb--40">
                                    <a href="{{ reklam(175)->adsense_url }}">
                                        @if (reklam(175)->type ?? 0 == 1)
                                            <img src="/{{ reklam(175)->image }}" style="height: 90px">
                                        @else
                                            {!! reklam(175)->adsense_url ?? '' !!}
                                        @endif
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 col-sm-12">
                            @if(reklam(18) != null)
                                <div class="ad-banner-img mt--45 mb--40">
                                    <a href="{{ reklam(18)->adsense_url }}">
                                        @if (reklam(18)->type ?? 0 == 1)
                                            <img src="/{{ reklam(18)->image }}" style="height: 90px">
                                        @else
                                            {!! reklam(18)->adsense_url ?? '' !!}
                                        @endif
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                <div class="row mb--50">
                    <!-- start related-post-box -->
                    <div class="related-post-box">
                        <div class="titile-wrapper mb--40">
                            <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                <span class="rt-section-text restricted_section_title">
                                    {{ __('message.yaklaşan etkinlikler') }} </span>
                                <span class="rt-section-dot"></span>
                                <span class="rt-section-line"></span>
                            </h2>

                            <div>
                                <h6><a href="{{ route('front.activity.close_activity') }}"> {{ __('message.tümünü gör') }}
                                    </a></h6>
                            </div>
                        </div>
                        <!-- end titile-wrapper -->

                        <div class="rt-post-slider-style-5">
                            <div class="row">

                                @foreach ($coming_activity as $item)
                                    <div class="col-md-4">
                                        <div class="rt-post-grid grid-meta">
                                            <div class="post-img">
                                                <a href="{{ \Session::get('applocale') == 'en' ? (route('front.activity.detail_en', $item->link)) : (route('front.activity.detail', $item->link)) }}">
                                                    <img style="object-fit: cover" src="/{{ $item->image == null ? 'assets/default_act.jpeg' : $item->image }}"
                                                        alt="post" width="551" height="431">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ \Session::get('applocale') == 'en' ? (route('front.activity.categoryDetail_en', $item->Category->link)) : (route('front.activity.categoryDetail', $item->Category->link)) }}"
                                                        class="rt-cat-primary restricted_category_title">
                                                        {{ $item->Category->title }} </a>
                                                    @if ($item->sayac_yil() || $item->sayac_ay() || $item->sayac_gun())
                                                        <h6 class="rt-news-cat-normal text-danger mx-2">
                                                            <i class="far fa-clock icon"></i>
                                                            {{ $item->sayac_yil() ?? ' ' }} {{ $item->sayac_ay() ?? ' ' }}
                                                            {{ $item->sayac_gun() ?? ' ' }}
                                                        </h6>
                                                    @endif
                                                </div>
                                                <h4 class="post-title">
                                                    <a href="{{ \Session::get('applocale') == 'en' ? (route('front.activity.detail_en', $item->link)) : (route('front.activity.detail', $item->link)) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </h4>
                                                <div class="post-meta">
                                                    <ul>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-calendar-alt icon"></i>
                                                                {{ $item->start_time->translatedFormat('d M Y') }} / {{ substr($item->start_clock,0,5) }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fas fa-map-marker-alt icon"></i>
                                                                <span style="text-transform:capitalize"> {{ strtoupper($item->city) }} </span>

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
                        <!-- end rt-post-slider-style-5  -->

                    </div>
                    <!-- end related-post-box -->
                </div>

                @foreach ($activity_category as $key => $data)
                    @if(reklam($key + 19) != null)
                        <div class="ad-banner-img mt--45 mb--40">
                            <a href="{{ reklam($key + 19)->adsense_url }}">
                                @if (reklam($key + 19)->type ?? 0 == 1)
                                    <img src="/{{ reklam($key + 19)->image }}" width="1320px" style="height: 90px">
                                @else
                                    {!! reklam($key + 19)->adsense_url ?? '' !!}
                                @endif
                            </a>
                        </div>
                    @endif
                    <div class="row mb--50">
                        <!-- start related-post-box -->
                        <div class="related-post-box">
                            <div class="titile-wrapper mb--40">
                                <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                    <span class="rt-section-text restricted_section_title"> {{ $data->title }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>

                                <div>
                                    <h6><a href="{{ \Session::get('applocale') == 'en' ? (route('front.activity.categoryDetail_en', $data->link)) : (route('front.activity.categoryDetail', $data->link)) }}">
                                            {{ __('message.tümünü gör') }} </a></h6>
                                </div>
                            </div>
                            <!-- end titile-wrapper -->

                            <div class="rt-post-slider-style-5">
                                <div class="row">

                                    @foreach ($data->hasActivity() as $item)
                                        <div class="col-md-4">
                                            <div class="rt-post-grid grid-meta">
                                                <div class="post-img">
                                                    <a href="{{ \Session::get('applocale') == 'en' ? (route('front.activity.detail_en', $item->link)) : (route('front.activity.detail', $item->link)) }}">
                                                        <img style="object-fit: cover" src="/{{ $item->image == null ? 'assets/default_act.jpeg' : $item->image }}"
                                                            alt="post" width="551" height="431">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <a href="{{ \Session::get('applocale') == 'en' ? (route('front.activity.categoryDetail_en', $item->Category->link)) : (route('front.activity.categoryDetail', $item->Category->link)) }}"
                                                        class="rt-cat-primary sidebar_restricted_category_title">
                                                        {{ $item->Category->title }} </a>
                                                    @if ($item->sayac_yil() || $item->sayac_ay() || $item->sayac_gun())
                                                        <h6 class="rt-news-cat-normal text-danger mx-2">
                                                            <i class="far fa-clock icon"></i>
                                                            {{ $item->sayac_yil() ?? ' ' }} {{ $item->sayac_ay() ?? ' ' }}
                                                            {{ $item->sayac_gun() ?? ' ' }}
                                                        </h6>
                                                    @endif
                                                    <h4 class="post-title">
                                                        <a href="{{ \Session::get('applocale') == 'en' ? (route('front.activity.detail_en', $item->link)) : (route('front.activity.detail', $item->link)) }}">
                                                            {{ $item->title }}
                                                        </a>
                                                    </h4>
                                                    <div class="post-meta">
                                                        <ul>
                                                            <li>
                                                                <span class="rt-meta">
                                                                    <i class="far fa-calendar-alt icon"></i>
                                                                    {{ $item->start_time->translatedFormat('d M Y') }} / {{ substr($item->start_clock,0,5)}}
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="rt-meta">
                                                                    <i class="fas fa-map-marker-alt icon"></i>
                                                                    <span style="text-transform:capitalize"> {{ strtoupper($item->city) }} </span>
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
                                        <!-- end item -->
                                    @endforeach




                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end rt-post-slider-style-5  -->

                        </div>
                        <!-- end related-post-box -->
                    </div>
                @endforeach





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
