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
        .post-body {
            color: #464847;
        }

        .post-body:initial-letter {
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

        .social-connection a i.twitter {
            background-color: #131414;
        }
    </style>
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

        @if ($errors->any())
            @foreach ($errors->all() as $item)
                <div class="alert alert-danger">
                    {{ $item }}
                </div>
            @endforeach
        @endif

        <!-- Start inner page Banner -->
        <div class="banner inner-banner">
            <div class="container">
                <nav class="rt-breadcrumb-wrap" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        @if ($data->category_id != null)
                            <li class="breadcrumb-item">
                                <a href="{{ route('front.currentNewsCategory.list', $data->Category()[0]->link) }}">
                                    {{ $data->Category()[0]->title }}
                                </a>
                            </li>
                        @endif
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



        <!-- start rt-sidebar-section-layout-2 -->
        <section class="rt-sidebar-section-layout-2">
            <div class="container">
                <div class="row gutter-40 sticky-coloum-wrap">

                    <div class="col-xl-9 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">

                            <div class="rt-main-post-single grid-meta">

                                <!-- start post header -->
                                <div class="post-header drop-cap">

                                    @foreach ($data->Category() as $Category)
                                        <span class="rt-cat-primary"
                                            style="background-color: {{ $Category->color_code != null ? $Category->color_code : '' }}">
                                            {{ $Category->title }} </span>
                                    @endforeach

                                    <h2 class="title">
                                        {{ $data->title }}
                                    </h2>
                                    <div class="post-meta">
                                        <ul>
                                            <li>
                                                <span class="rt-meta">
                                                    <i class="fa fa-user"></i>
                                                    <a href="{{ route('front.author.detail', $data->Author->id) }}"
                                                        class="name">{{ $data->Author->name }}
                                                        {{ $data->Author->surname }}</a>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="rt-meta">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    {{ $data->live_time->translatedFormat('d M Y') }}
                                                    @if ($data->created_at != $data->updated_at)
                                                        | <b> {{ __('message.son güncelleme') }} :</b>
                                                        {{ $data->updated_at->translatedFormat('d M Y H:i') }}
                                                    @endif
                                                </span>
                                            </li>
                                            <li>
                                                <span class="rt-meta">
                                                    <i class="fa-solid fa-comments"></i>
                                                    {{ $data->CommentCount() }}
                                                </span>
                                            </li>
                                            <li>
                                                <span class="rt-meta">
                                                    <i class="fa-solid fa-clock"></i>
                                                    {{ $data->read_time }} DK
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
                                    <div class="d-none d-md-flex share-box-area">
                                        <div class="left-area">
                                            <div class="social-share-box">
                                                <div class="share-text mb--10">
                                                    <span class="rt-meta">
                                                        <i class="fas fa-share-alt icon"></i>
                                                        Paylaş: 1,509
                                                    </span>
                                                </div>

                                                <ul class="social-share-style-1 mb--10">


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
                                        <div class="right-area">
                                            <ul class="social-share-style-1 layout-2 mb--10">
                                                <li>
                                                    <a target="_blank"
                                                        href="mailto:?subject={{ $data->title }}&body={{ $data->title }} {{ request()->url() }}">
                                                        <i class="social-icon fas fa-envelope"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- end post-header -->

                                <!-- strat post img -->
                                <figure class="post-img">
                                    <img src="/{{ $data->image }}" alt="post-img" width="960" height="520">
                                </figure>
                                <!-- end post-img -->

                                <!-- strat psot body -->
                                <div class="post-body" id="contentToConvert" style="text-align: justify;">
                                    {!! printDesc($data->description) !!}
                                    <br><br>
                                    <div class="ad-banner-img mt--45 mb--40">
                                        <a href="#">
                                            <img src="/assets/frontend/media/gallery/ad-banner_4.jpg" alt="ad-banner"
                                                width="960" height="150">
                                        </a>
                                    </div>

                                </div>
                                <!-- end post body -->

                                <!-- start social-share-box-2 -->
                                <div class="social-share-box-2 mb--20">
                                    <div class="row gutter-30">
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="conent-block">
                                                <h4 class="block-tile mb--20"> {{ __('message.popüler etiketler') }} :
                                                </h4>
                                                <div class="tag-list">

                                                    @foreach ($data->getKeys() as $item)
                                                        <a href="{{ route('front.currentNews.tag_list', $item) }}"
                                                            class="tag-link" style="text-transform: capitalize">
                                                            {{ $item }} </a>
                                                    @endforeach


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end social-share-box-2 -->

                                <!-- start author box -->
                                <div class="author-box-style-1 mb--35">
                                    <div class="author-img">
                                        <img src="/assets/author-img_1.jpg" alt="author-img_1" width="170"
                                            height="170">
                                    </div>
                                    <div class="author-content">
                                        <h3 class="author-name"> {{ $data->Author->name }} {{ $data->Author->surname }}
                                        </h3>
                                        <p class="user-desc">
                                            {{ substr($data->Author->description, 0, 270) }}...
                                        </p>
                                        <ul class="social-style-5">

                                            @if ($data->Author->facebook != null)
                                                <li>
                                                    <a target="_blank"
                                                        href="https://www.facebook.com/{{ $data->Author->facebook }}">
                                                        <i class="social-icon fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            @if ($data->Author->twitter != null)
                                                <li>
                                                    <a target="_blank"
                                                        href="https://twitter.com/{{ $data->Author->twitter }}">
                                                        <i class="social-icon fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            @if ($data->Author->instagram != null)
                                                <li>
                                                    <a target="_blank"
                                                        href="https://www.instagram.com/{{ $data->Author->instagram }}">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                                <!-- end author box -->

                                <!-- start post-pagination-box -->
                                <div class="post-pagination-box mb--40">

                                    <div class="row gutter-30">
                                        <div class="col-lg-6">

                                            @if ($previous_data != null)
                                                <div class="next-prev-wrap">
                                                    <div class="item-icon">
                                                        <a
                                                            href="{{ route('front.currentNews.detail', $previous_data->link) }}">
                                                            <i class="fas fa-chevron-left"></i>
                                                            {{ __('message.önceki haber') }}
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="title">
                                                            <a
                                                                href="{{ route('front.currentNews.detail', $previous_data->link) }}">
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
                                                        <a
                                                            href="{{ route('front.currentNews.detail', $next_data->link) }}">
                                                            {{ __('message.sonraki haber') }}
                                                            <i class="fas fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="title">
                                                            <a
                                                                href="{{ route('front.currentNews.detail', $next_data->link) }}">
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
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="love" src="https://millimudafaa.com/assets/img/begendim.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="dislike"
                                                    src="https://millimudafaa.com/assets/img/begenmedim.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="clap"
                                                    src="https://millimudafaa.com/assets/img/alkisladim.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="sad" src="https://millimudafaa.com/assets/img/uzuldum.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="angry"
                                                    src="https://millimudafaa.com/assets/img/sinirlendim.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="shocked" src="https://millimudafaa.com/assets/img/sasirdim.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>


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
                                        <h5> {{ __('message.yorumlar') }} ({{ $data->CommentCount() }}) </h5>
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

                                                <input type="hidden" id="com_id" value="{{ $item->id }}"
                                                    name="">

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
                                                        {{ __('message.cevap yaz') }} </span>
                                                    <span class="comment_span mx-2"><i class="far fa-thumbs-up icon"></i>
                                                        0</span>
                                                    <span class="comment_span mx-2"><i
                                                            class="far fa-thumbs-down icon"></i>
                                                        0</span>
                                                </div>

                                            </div>


                                            @foreach ($item->CommentComments() as $comment)
                                                <div class="comment_container">
                                                    <div class="row">
                                                        <div class="col-md-2"></div>
                                                        <div class="d-none d-md-block col-md-3 mb-3">
                                                            <div class="commentator-img">
                                                                <img src="{{ asset('assets/sabit.png') }}"
                                                                    alt="commentator-img_1" width="170"
                                                                    height="170">
                                                            </div>
                                                        </div>

                                                        <input type="hidden" id="com_id" value="{{ $comment->id }}"
                                                            name="">

                                                        <div class="col-md-7">
                                                            <div class="commentator-content">
                                                                <h3 class="commentator-name"> {{ $comment->full_name }}
                                                                </h3>
                                                                <p class="user-desc">
                                                                    {{ $comment->comment }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach


                                        </div>



                                        <hr class="dropdown-divider my-5">
                                    @endforeach



                                </div>
                                <!-- end commentator box -->

                                <!-- start blog-post-comment -->
                                <div class="blog-post-comment mb--40">

                                    <form action="{{ route('front.comment.store', $data->id) }}" method="POST"
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
                                                    <label for="email">Email *</label>
                                                    <input type="email" name="email" id="email"
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
                                                        <input class="form-check-input" required type="checkbox"
                                                            value="" id="comment-form-check1">
                                                        <label class="form-check-label" for="comment-form-check1">
                                                            <a
                                                                href="empty.html">{{ __('message.Kişisel Verilerin Korunması') }}</a>
                                                            {{ __('message.Hakkında Aydınlatma Metnini okudum, onay veriyorum.') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="submit-btn" style="float: right;">
                                                    Gönder
                                                </button>
                                            </div>
                                            <div class="form-response"></div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end blog-post-comment -->

                                <!-- start related-post-box -->
                                <div class="related-post-box">
                                    <div class="titile-wrapper mb--40">
                                        <h2 class="rt-section-heading flex-grow-1 mb-0 me-3">
                                            <span class="rt-section-text"> {{ __('message.ilgili haberler') }} </span>
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

                                            @foreach ($other_news as $single)
                                                <div class="swiper-slide">
                                                    <div class="slide-item">
                                                        <div class="rt-post-grid grid-meta">
                                                            <div class="post-img">
                                                                <a
                                                                    href="{{ route('front.currentNews.detail', $single->link) }}">
                                                                    <img style="object-fit:cover"
                                                                        src="/{{ $single->image }}" alt="post"
                                                                        width="551" height="431">
                                                                </a>
                                                            </div>
                                                            @if (isset($single->Category()[0]))
                                                                <div class="post-content">
                                                                    <a style="background-color: {{ $single->Category()[0]->color_code != null ? $single->Category()[0]->color_code : '' }}"
                                                                        href="{{ route('front.currentNewsCategory.list', $single->Category()[0]->link) }}"
                                                                        class="rt-cat-primary sidebar_restricted_category_title">
                                                                        {{ $single->Category()[0]->title }} </a>
                                                                    <h4 class="post-title">
                                                                        <a href="{{ route('front.currentNews.detail', $single->link) }}"
                                                                            class="restricted_title_2">
                                                                            {{ $single->title }}
                                                                        </a>
                                                                    </h4>

                                                                    <div class="post-meta">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="rt-meta">
                                                                                    <i
                                                                                        class="far fa-calendar-alt icon"></i>
                                                                                    {{ $single->created_at->translatedFormat('d M Y') }}
                                                                                </span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            @endif
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

                            <div class="sidebar-wrap mb--40">
                                <div class="ad-banner-img">
                                    <a href="#">
                                        <img src="/assets/frontend/media/gallery/sports-ad_3.jpg" alt="ad-banner"
                                            width="310" height="425">
                                    </a>
                                </div>
                            </div>
                            <!-- end slidebar wrap  -->

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
                                        <a href="https://twitter.com/millimudafaacom">
                                            <i class="fa-brands fa-square-x-twitter twitter"></i>
                                            <span class="text"><span>20,751</span> Takipçi</span>
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
                                            <i class="fab fa-linkedin-in facebook"></i>
                                            <span class="text"><span>35,999</span> Takipçi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.popüler haberler') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="post-list">

                                    @foreach ($four_news as $item)
                                        <div class="item">
                                            <div class="rt-post post-sm style-1">
                                                <div class="post-img">
                                                    <a href="{{ route('front.currentNews.detail', $item->link) }}">
                                                        <img style="object-fit:cover" src="/{{ $item->image }}"
                                                            alt="post" width="100" height="100">
                                                    </a>
                                                </div>
                                                <div class="post-content ms-4">
                                                    <a style="background-color: {{ $item->Category()[0] != null ? ($item->Category()[0]->color_code != null ? $item->Category()[0]->color_code : '') : '' }}"
                                                        href="{{ route('front.currentNewsCategory.list', $item->Category()[0]->link) }}"
                                                        class="rt-cat-primary sidebar_restricted_category_title">
                                                        {{ $item->Category()[0]->title }} </a>
                                                    <h4 class="post-title">
                                                        <a href="{{ route('front.currentNews.detail', $item->link) }}"
                                                            class="sidebar_restricted_title">
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
                                    @endforeach


                                </div>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <div class="subscribe-box-style-1" data-bg-image="media/elements/elm_3.png">
                                    <div class="subscribe-content">
                                        <h3 class="title">
                                            {{ __('message.Haber Bültenimize Abone Ol') }}
                                        </h3>
                                        <p>
                                            {{ __('message.Ulusal ve küresel savunma gündeminden daha hızlı haberdar olmak istiyorsanız Milli Müdafaa mail listesine kaydolun!') }}
                                        </p>
                                        <form action="#" class="rt-contact-form subscribe-form rt-form">
                                            <div class="rt-form-group">
                                                <input type="email" class="form-control rt-form-control"
                                                    placeholder="E-posta *" name="email" id="email_1"
                                                    data-error="E-posta alanı zorunludur" required>
                                            </div>
                                            <button type="submit" class="rt-submit-btn">
                                                {{ __('message.şimdi abone ol') }} </button>
                                            <div class="form-response"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end sidebar wrap -->

                            <div class="d-none d-md-block sidebar-wrap">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text"> {{ __('message.etiketler') }} </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="tag-list">

                                    @foreach ($data->getKeys() as $key)
                                        <a href="{{ route('front.currentNews.tag_list', $key) }}" class="tag-link"
                                            style="text-transform: capitalize">
                                            {{ $key }} </a>
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
    <script>
        function convertToPDF() {
            const pdf = new jsPDF();

            // Sayfa içeriği eklemek için HTML elementini seç
            const content = document.getElementById('contentToConvert');

            // jsPDF ile PDF'e dönüştür
            pdf.fromHTML(content, 15, 15);

            // PDF'i indir
            pdf.save('converted.pdf');
        }
    </script>
    <!-- EXTRA JS -->
    <script>
        /*--------------------------------
                                                                                    // limit by device width
                                                                                    -------------------------------*/
        // get device width
        var windowWidth = $(window).width();

        // Set limits for different device widths
        var limit_sidebar_restricted_title = 31;
        var limit_restricted_title_2 = 50;
        if (windowWidth <= 768) {
            limit_sidebar_restricted_title = 25;
        } else if (windowWidth <= 1200) {
            limit_sidebar_restricted_title = 50;
        }


        /*--------------------------------
           // sidebar title limitation
        -------------------------------*/
        // Select all tags with class .sidebar_restricted_title
        $('.sidebar_restricted_title').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_sidebar_restricted_title) {
                // If the content is longer thanlimit_sidebar_restricted_title characters
                content = content.slice(0, limit_sidebar_restricted_title) + '...';
                // Select limit_sidebar_restricted_title characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });

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
           // restricted_title_2 limitation
        -------------------------------*/
        // Select all tags with class .restricted_title_2
        $('.restricted_title_2').each(function() {
            var content = $(this).text().trim(); // get the content of a tag
            if (content.length > limit_restricted_title_2) {
                // If the content is longer than limit_restricted_title_2 characters
                content = content.slice(0, limit_restricted_title_2) + '...';
                // Select limit_restricted_title_2 characters and add ellipses
                $(this).text(content); // Restore modified content
            }
        });


        /*--------------------------------
           // clicking the reply button
        -------------------------------*/
        // Clicking the reply link
        $('.comment_span').one("click", function(e) {
            const com_id = document.getElementById("com_id").value;
            e.preventDefault();
            // Create reply field
            var replyField = $(

                '<form action="{{ route('front.comment.storeComment', $item->id) }}" method="POST" class="rt-contact-form comments-form-style-1">' +
                '@csrf' +
                '<div class="row">' +
                '<div class="col-xl-6">' +
                '<div class="rt-form-group">' +
                '<label for="name"> {{ __('message.ad soyad') }} *</label>' +
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
                '<input type="hidden" name="parent_comment" id="com_id2">' +
                '<div class="col-12">' +
                '<div class="rt-form-group">' +
                '<label for="comment">{{ __('message.yorum') }} *</label>' +
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
            document.getElementById('com_id2').value = com_id;

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
                    "post_type": "news",
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
