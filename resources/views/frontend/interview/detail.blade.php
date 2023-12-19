@extends('frontend.master')
@section('title', $data->title)
@section('meta-title', $data->title)
@section('description', $data->short_description)
@section('simage', asset($data->image))
@section('stitle', $data->title)
@section('sdescription', $data->short_description)

@section('content')
    <!-- Start Main -->
    <style>
        .social-connection li:nth-child(2) a {
            background-image: -webkit-gradient(linear, right top, left top, from(#56c3f0), to(#13a4e7));
            background-image: linear-gradient(-90deg, #909fa5 0%, #151616 100%);
            background-image: -ms-linear-gradient(-90deg, #56c3f0 0%, #13a4e7 100%);
        }

        .social-connection li:nth-child(5) a {
            border-radius: 3px;
            background-image: -webkit-gradient(linear, right top, left top, from(#f43079), to(#f7679d));
            background-image: linear-gradient(-90deg, #5579ad 0%, #1a6be1 100%);
            background-image: -ms-linear-gradient(-90deg, #f43079 0%, #f7679d 100%);
        }

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
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.interview.list_en') : route('front.interview.list') }}">
                                {{ __('message.röportajlar') }}
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

        <!-- start single-post-overlay area -->
        <div class="section-padding pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="rt-post-overlay rt-post-overlay-xl single-post-overlay">
                            <div class="post-img">
                                <a href="" class="img-link">
                                    <img src="/{{ $data->image }}" alt="post-ex_7" width="1320" height="620">
                                </a>
                                @if ($data->youtube != null)
                                    <a href="{{ $data->youtube }}" class="play-btn play-btn-white_xl rt-play-over md-right">
                                        <i class="fas fa-play"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="">
                                        {{ $data->title }}
                                    </a>
                                </h2>
                                <div class="post-meta">
                                    <ul>
                                        <li>
                                            <span class="rt-meta">
                                                <i class="fa fa-user"></i>
                                                <a href="author.html" class="name"> {{ $data->Author->name }}
                                                    {{ $data->Author->surname }} </a>
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
                                                <i class="fa-solid fa-comments"></i>

                                                {{ $data->commentCount() }}
                                            </span>
                                        </li>
                                        <li>
                                            <span class="rt-meta">
                                                <i class="fa-solid fa-clock"></i>
                                                {{ $data->read_time == 0 ? '1' : $data->read_time }} DK
                                            </span>
                                        </li>
                                        <li>
                                            <span class="rt-meta">
                                                <i class="fa-solid fa-eye"></i>
                                                {{ $data->view_counter }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end single-post-overlay  -->
                    </div>
                    <!--  end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end single-post-overlay area -->

        <!-- start rt-sidebar-section-layout-2 -->
        <section class="rt-sidebar-section-layout-2">
            <div class="container">
                <div class="row gutter-40 sticky-coloum-wrap">
                    <div class="col-xl-9 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">

                            <div class="rt-main-post-single grid-meta">

                                <!-- strat psot body -->
                                <div class="post-body" style="text-align: justify">
                                    {!! printDesc($data->description) !!}


                                    <br><br>
                                    <!-- end post -->
                                    <div class="single-content">
                                        <div class="thumb-vidided mb--30">
                                            <div class="row gutter-24">


                                                @foreach ($dialogs as $item)
                                                    <div class="single-content">
                                                        <h3 class="title report_title"><i class="fas fa-question"
                                                                style="vertical-align: text-top; color:#3b4022;"></i><span>
                                                                {{ $item->soru }} </h3>
                                                        <figure class="rt-blockquote-area">
                                                            <blockquote class="rt-blockquote">
                                                                <h4>
                                                                    <i class="fas fa-microphone me-2"
                                                                        style="color: inherit;"></i>
                                                                    {{ $item->cevaplayan }}
                                                                </h4>
                                                                <p>
                                                                    {{ $item->cevap }}
                                                                </p>
                                                            </blockquote>
                                                        </figure>
                                                    </div>
                                                @endforeach




                                            </div>
                                        </div>
                                    </div>

                                    <!-- ad banner -->
                                    <div class="ad-banner-img mt--45 mb--40">
                                        @if (reklam(31) != null)
                                            <div class="sidebar-wrap mb--40">
                                                <div class="ad-banner-img">
                                                    <a href="{{ reklam(31)->adsense_url }}">
                                                        @if (reklam(31)->type ?? 0 == 1)
                                                            <img src="/{{ reklam(31)->image }}" alt=""
                                                            width="1320px" style="height: 90px">
                                                        @else
                                                            {!! reklam(31)->adsense_url ?? '' !!}
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <!-- end post body -->
                                <!-- start social-share-box-2 -->
                                <div class="social-share-box-2 mb--40">
                                    <div class="row gutter-30">
                                        <div class="col-xl-7 col-lg-6">
                                            <div class="conent-block">
                                                <h4 class="block-tile mb--20"> {{ __('message.popüler etiketler') }} </h4>


                                                <div class="tag-list">

                                                    @foreach ($data->getKeys() as $item)
                                                        <a href="#" class="tag-link"> {{ $item }} </a>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 col-lg-6 d-flex justify-content-start justify-content-lg-end">
                                            <div class="conent-block">
                                                <h4 class="block-tile mb--20"> {{ __('message.paylaş') }} </h4>
                                                <ul class="social-share-style-1">
                                                    <li>
                                                        <a class="fb" target="_blank"
                                                            href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}&text={{ $data->title }}">
                                                            <i class="social-icon fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="tw" style="background-color: black" target="_blank"
                                                            href="https://twitter.com/intent/tweet?text={{ $data->title }}&url={{ request()->url() }}">
                                                            <i class="fa-brands fa-square-x-twitter twitter"></i>
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
                                    </div>
                                </div>
                                <!-- end social-share-box-2 -->


                                <!-- start post-pagination-box -->
                                <div class="post-pagination-box mb--40">

                                    <div class="row gutter-30">
                                        <div class="col-lg-6">

                                            @if ($previous_data != null)
                                                <div class="next-prev-wrap">
                                                    <div class="item-icon">
                                                        <a href="{{ route('front.interview.detail', $data->id - 1) }}">
                                                            <i class="fas fa-chevron-left"></i>
                                                            {{ __('message.önceki röportaj') }}
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="title">
                                                            <a
                                                                href="{{ route('front.interview.detail', $data->id - 1) }}">
                                                                {{ $previous_data->title }}
                                                            </a>
                                                        </h4>
                                                        <span class="rt-meta">
                                                            <i class="far fa-calendar-alt icon"></i>
                                                            {{ $previous_data->created_at->translatedFormat('d M Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-6">

                                            @if ($next_data != null)
                                                <div class="next-prev-wrap next-wrap">
                                                    <div class="item-icon">
                                                        <a href="{{ route('front.interview.detail', $data->id + 1) }}">
                                                            {{ __('message.sonraki röportaj') }}
                                                            <i class="fas fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="title">
                                                            <a
                                                                href="{{ route('front.interview.detail', $data->id + 1) }}">
                                                                {{ $next_data->title }}
                                                            </a>
                                                        </h4>
                                                        <span class="rt-meta">
                                                            <i class="far fa-calendar-alt icon"></i>
                                                            {{ $next_data->created_at->translatedFormat('d M Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <!-- end pagination box -->

                                <!-- start commentator box -->
                                <div class="commentator-box-style-1 mb--30">
                                    <div class="row justify-content-center mb--10">
                                        @foreach ($emojies as $emoji => $number)
                                            <div class="col-2 col-md-1">
                                                <div class="emoji_container">
                                                    <img id="{{ $emoji }}"
                                                        src="{{ asset('assets/' . $emoji . '.png') }}"
                                                        style="cursor: pointer; width:38px;">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row justify-content-center mb--50">
                                        @foreach ($emojies as $emoji => $number)
                                            <div class="col-2 col-md-1">
                                                <div class="emoji_container">
                                                    <div class="progress" role="progressbar" aria-label="Basic example"
                                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                        <div id="{{ $emoji }}_bar" class="progress-bar"
                                                            style="width: {{ $number }}%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="row mb--20">
                                        <h5> {{ __('message.yorumlar') }} ({{ $data->commentCount() }}) </h5>
                                    </div>

                                    @foreach ($data->comments() as $item)
                                        <div class="comment_container">
                                            <div class="row">
                                                <div class="d-none d-md-block col-md-3 mb-3">
                                                    <div class="commentator-img">
                                                        <img src="{{ asset('assets/sabit.png') }}"
                                                            alt="commentator-img_1" width="170" height="170">
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="commentator-content">
                                                        <h3 class="commentator-name"> {{ $item->full_name }} </h3>
                                                        <p class="user-desc">
                                                            {{ $item->comment }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-end">
                                                <div class="col-md-4">
                                                    <span class="comment_span mx-2"><i class="fas fa-pencil-alt"></i>
                                                        {{ __('message.cevap yaz') }}
                                                    </span>
                                                    <span class="comment_span mx-2"><i class="far fa-thumbs-up icon"></i>
                                                        0</span>
                                                    <span class="comment_span mx-2"><i
                                                            class="far fa-thumbs-down icon"></i>
                                                        0</span>
                                                </div>

                                            </div>
                                        </div>

                                        <hr class="dropdown-divider my-5">
                                    @endforeach





                                </div>
                                <!-- end commentator box -->


                                <!-- start blog-post-comment -->
                                <div class="blog-post-comment mb--50">
                                    <form action="{{ route('front.interview.addComment', $data->id) }}" method="POST"
                                        class="comments-form-style-1">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="rt-form-group">
                                                    <label for="name"> {{ __('message.ad soyad') }} *</label>
                                                    <input type="text" name="full_name" id="name"
                                                        class="form-control" data-error="Bu alan zorunludur" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="rt-form-group">
                                                    <label for="email">E-mail *</label>
                                                    <input type="text" name="email" id="email"
                                                        class="form-control" data-error="Bu alan zorunludur" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="rt-form-group">
                                                    <label for="comment"> {{ __('message.yorum') }} *</label>
                                                    <textarea name="comment" id="comment" class="form-control text-area" data-error="Bu alan zorunludur" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="rt-form-group">
                                                    <div class="form-check">
                                                        <input required class="form-check-input" type="checkbox"
                                                            value="" id="comment-form-check1">
                                                        <label class="form-check-label" for="comment-form-check1">
                                                            {{ __('message.Kişisel Verilerin Korunması Hakkında Aydınlatma Metnini okudum, onay veriyorum.') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="submit-btn">
                                                    {{ __('message.kaydet') }}
                                                </button>
                                            </div>
                                            <div class="form-response"></div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end blog-post-comment -->

                                @if (reklam(31) != null)
                                    <div class="ad-banner-img mt--45 mb--40">
                                        <div class="sidebar-wrap mb--40">
                                            <div class="ad-banner-img">
                                                <a href="{{ reklam(31)->adsense_url }}">
                                                    @if (reklam(31)->type ?? 0 == 1)
                                                        <img src="/{{ reklam(31)->image }}" alt=""
                                                            width="1320px" style="height: 90px">
                                                    @else
                                                        {!! reklam(31)->adsense_url ?? '' !!}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                <!-- start related-post-box -->
                                <div class="related-post-box">
                                    <div class="titile-wrapper mb--40">
                                        <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                            <span class="rt-section-text"> {{ __('message.diğer röportajlar') }} </span>
                                            <span class="rt-section-dot"></span>
                                            <span class="rt-section-line"></span>
                                        </h2>

                                        <div class="slider-navigation style-2">
                                            <i class="fas fa-chevron-left slider-btn btn-prev"></i>
                                            <i class="fas fa-chevron-right slider-btn btn-next"></i>
                                        </div>
                                    </div>
                                    <!-- end titile-wrapper -->

                                    <div class="swiper-container rt-post-slider-style-5">
                                        <div class="swiper-wrapper">

                                            @foreach ($other_interview as $item)
                                                <div class="swiper-slide">
                                                    <div class="slide-item">
                                                        <div class="rt-post-grid grid-meta">
                                                            <div class="post-img">
                                                                <a
                                                                    href="{{ route('front.interview.detail', $item->link) }}">
                                                                    <img src="/{{ $item->image }}" alt="post"
                                                                        width="551" height="431">
                                                                </a>
                                                            </div>
                                                            <div class="post-content">

                                                                <h4 class="post-title">
                                                                    <ahref="{{ route('front.interview.detail', $item->link) }}">
                                                                        {{ $item->title }}
                                                                    </a>
                                                                </h4>

                                                                <span class="rt-meta">
                                                                    <i class="far fa-calendar-alt icon"></i>
                                                                    {{ $item->created_at->translatedFormat('d M Y') }}
                                                                </span>

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
                                <!-- end related-post-box -->

                            </div>
                            <!-- end rt-main-post-single -->
                        </div>
                        <!-- end rt-left-sidebar-sapcer-5 -->
                    </div>
                    <!-- end col-->

                    <div class="col-xl-3 col-lg-8 sticky-coloum-item mx-auto">
                        <div class="rt-sidebar sticky-wrap">

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <div class="search-box">
                                    <form action="#" class="form search-form-box">
                                        <div class="form-group">
                                            <input type="text" name="sarch" id="search" placeholder="ARA..."
                                                class="form-control rt-search-control">
                                            <button type="submit" class="search-submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end sidebar wrap -->

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.bizi takip edin') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <ul class="social-connection">
                                    <li>
                                        <a href="https://www.facebook.com/millimudafaacom">
                                            <i class="fab fa-facebook-f facebook"></i>
                                            <span class="text"><span>15,985</span> Takipçi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="tw" style="background-color: black!important" target="_blank"
                                            href="https://twitter.com/">
                                            <i style="background-color: black"
                                                class="fa-brands fa-square-x-twitter twitter"></i>
                                            <span class="text"><span>15,985</span> Takipçi</span>

                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/channel/UC6uGHKEHHGh08sTWjhBrG9A">
                                            <i class="fab fa-youtube youtube"></i>
                                            <span class="text"><span>35,999</span> Takipçi</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="https://www.instagram.com/millimudafaacom">
                                            <i class="fab fa-instagram instagram"></i>
                                            <span class="text"><span>35,999</span> Takipçi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/company/milli-m%C3%BCdafaa/">
                                            <i class="fab fa-linkedin-in linkedin"></i>
                                            <span class="text"><span>35,999</span> Takipçi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="sidebar-wrap mb--40">
                                <div class="ad-banner-img">
                                    @if (reklam(33) != null)
                                        <div class="sidebar-wrap mb--40">
                                            <div class="ad-banner-img">
                                                <a href="{{ reklam(33)->adsense_url }}">
                                                    @if (reklam(33)->type ?? 0 == 1)
                                                        <img src="/{{ reklam(33)->image }}" alt=""
                                                            width="310" height="425">
                                                    @else
                                                        {!! reklam(33)->adsense_url ?? '' !!}
                                                    @endif

                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="sidebar-wrap">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.etiketler') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="tag-list">
                                    @foreach ($data->getKeys() as $xkey)
                                        <a href="#" class="tag-link">{{ $xkey }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- end sidebar wrap -->

                        </div>
                        <!-- end rt-sidebar -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row  -->
            </div>
            <!-- end container -->
        </section>
        <!-- end rt-sidebar-section-layout-2 -->

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

        /*--------------------------------
           // clicking the reply button
        -------------------------------*/
        // Clicking the reply link
        $('.comment_span').one("click", function(e) {
            e.preventDefault();
            // Create reply field
            var replyField = $(
                '<form action="#" class="rt-contact-form comments-form-style-1">' +
                '<div class="row">' +
                '<div class="col-xl-6">' +
                '<div class="rt-form-group">' +
                '<label for="name">İsim - Soyisim *</label>' +
                '<input type="text" name="full_name" id="name" class="form-control" data-error="Bu alan zorunludur" required>' +
                '<div class="help-block with-errors"></div>' +
                '</div>' +
                '</div>' +
                '<div class="col-xl-6">' +
                '<div class="rt-form-group">' +
                '<label for="email">E-posta *</label>' +
                '<input type="text" name="email" id="email" class="form-control" data-error="Bu alan zorunludur" required>' +
                '<div class="help-block with-errors"></div>' +
                '</div>' +
                '</div>' +
                '<div class="col-12">' +
                '<div class="rt-form-group">' +
                '<label for="comment">Yorum *</label>' +
                '<textarea name="comment" id="comment" class="form-control text-area" data-error="Bu alan zorunludur" required></textarea>' +
                '<div class="help-block with-errors"></div>' +
                '</div>' +
                '</div>' +
                '<div class="col-12">' +
                '<div class="rt-form-group">' +
                '<div class="form-check">' +
                '<input class="form-check-input" type="checkbox" value="" id="comment-form-check1">' +
                '<label class="form-check-label" for="comment-form-check1">' +
                '<a href="empty.html">Kişisel Verilerin Korunması</a>' +
                "Hakkında Aydınlatma Metni'ni okudum, onay veriyorum." +
                '</label>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-12">' +
                '<button type="submit" class="submit-btn" style="float: right;">' +
                'Gönder' +
                '</button>' +
                '</div>' +
                '<div class="form-response"></div>' +
                '</div>' +
                '</form>'
            );
            $(this).parent().parent().parent().append(replyField); // Add below comment
        });

        /*--------------------------------
          // change emoji percentage
        -------------------------------*/
        $('.emoji_container img').click(function(e) {
            e.preventDefault();
            var emoji_id = $(this)[0].id; //get the id of the printed emoji
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                url: "/setEmoji",
                type: "post",
                data: {
                    "emoji_type": emoji_id,
                    "post_id": "{{ $data->id }}",
                    "post_type": "interview",
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == "success") {
                        var emoji_progress_bar = $("#" + emoji_id + "_bar").css(
                            'width'); //get width property of emoji's bar
                        var intValue = parseInt(emoji_progress_bar, 10);
                        intValue++; //increase the value
                        $("#" + emoji_id + "_bar").css('width', intValue); //update the value
                    } else {
                        alert(response.message);
                    }
                }

            })
            //The id of the bar is found by adding '_bar' to the id of the emoji
            /*
            var emoji_progress_bar = $("#" + emoji_id + "_bar").css('width'); //get width property of emoji's bar
            var intValue = parseInt(emoji_progress_bar, 10);
            intValue++; //increase the value
            $("#" + emoji_id + "_bar").css('width', intValue); //update the value
             */
        });
    </script>
@endsection
