@extends('frontend.master')
@section('title', $data->title ?? 'Milli Müdafaa')
@section('meta-title', $data->title ?? 'Milli Müdafaa')
@section('keywords',
    $data->seo_key ??
    'Milli Müdafaa, Haber, Güncel Haberler, Son Dakika Haberleri, Türkiye, Dünya,
    Teknoloji, İstanbul, TV, savunma, savunma sanayi, savunma sanayii, teknoloji, siber, güvenlik, siber güvenlik, milli
    teknoloji, milli teknoloji hamlesi, aselsan, baykar, havelsan, tai, tusaş, hulusi akar, haluk görgün, selçuk bayraktar,
    haluk bayraktar, temel kotil, mustafa varank, teknopark, turksat, telekom, haberlesme, istihbarat, milli istihbarat, dış
    politika, savunma sanayi haberleri, savunma sanayii haberleri, yerli, milli.')
@section('description',
    $data->short_description ??
    'Savunma Sanayii haberleri, güncel son dakika gelişmeleri ve bugün
    yer alan son durum bilgileri için tıklayın!')
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

        @media only screen and (max-width: 600px) {
            .meta1 {
                display: none !important;
            }

            .meta2 {
                display: block !important;
            }
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
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        @if ($data->category_id != null)
                            <li class="breadcrumb-item">
                                <a
                                    href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $data->Category()[0]->link) : route('front.currentNewsCategory.list', $data->Category()[0]->link) }}">
                                    {{ $data->Category()[0]->title }}
                                </a>
                            </li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="">
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
                                        <div class="meta2" style="display: none">
                                            <ul>
                                                <li>
                                                    <span class="rt-meta">
                                                        <i class="fa fa-user"></i>
                                                        <a href="{{ route('front.author.detail', $data->Author->link) }}"
                                                            class="name">{{ $data->Author->name }}
                                                            {{ $data->Author->surname }}</a>
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
                                                        {{ $data->viewCounter->view_counter ?? '0' }}
                                                    </span>
                                                </li>
                                            </ul>
                                            <ul>

                                                <li>
                                                    <span class="rt-meta">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        {{ $data->live_time->translatedFormat('d M Y') }}
                                                        @if ($data->created_at != $data->updated_at)
                                                            | <b> {{ __('message.güncelleme') }} :</b>
                                                            {{ $data->updated_at->translatedFormat('d M Y H:i') }}
                                                        @endif
                                                    </span>
                                                </li>
                                            </ul>

                                        </div>
                                        <ul class="meta1">
                                            <li>
                                                <span class="rt-meta">
                                                    <i class="fa fa-user"></i>
                                                    <a href="{{ route('front.author.detail', $data->Author->link) }}"
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
                                                    {{ $data->viewCounter->view_counter ?? '0' }}
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
                                                        Paylaş: {{ $data->ShareCounter() }}
                                                    </span>
                                                </div>

                                                <ul class="social-share-style-1 mb--10">


                                                    <li>
                                                        <a class="fb" target="_blank" onclick="share_count()"
                                                            href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}&text={{ $data->title }}">
                                                            <i class="social-icon fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="tw"
                                                            style="background-color: black;border:solid;border-color:gray"
                                                            onclick="share_count()" target="_blank"
                                                            href="https://twitter.com/intent/tweet?text={{ $data->title }}&url={{ request()->url() }}">
                                                            <i class="fa-brands fa-square-x-twitter twitter"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="fb" target="_blank" onclick="share_count()"
                                                            href="https://linkedin.com/sharing/share-offsite/?url={{ request()->url() }}">
                                                            <i class="social-icon fab fa-linkedin"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="wh" target="_blank" onclick="share_count()"
                                                            href="https://web.whatsapp.com/send?text={{ $data->title }} {{ request()->url() }}">
                                                            <i class="social-icon fab fa-whatsapp"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="tw" target="_blank" onclick="share_count()"
                                                            href="https://t.me/share/url?url={{ request()->url() }}&text={{ $data->title }}">
                                                            <i class="social-icon fab fa-telegram"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="right-area">

                                            <ul class="social-share-style-1 layout-2 mb--10">
                                                <li>
                                                    @if ($google_news)
                                                        <div class="image">
                                                            <a style="width:100px" target="_blank"
                                                                href="{{ $google_news->google_news_link }}">
                                                                <img src="{{ asset('assets/news_google.webp') }}"
                                                                    style="width: 100%;" alt="">
                                                            </a>
                                                        </div>
                                                    @endif
                                                </li>
                                                <li>
                                                    <a target="_blank"
                                                        href="mailto:?subject={{ $data->title }}&body={{ $data->title }} {{ request()->url() }}">
                                                        <i class="social-icon fas fa-envelope"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a target="_blank" onclick="window.print();return false;">
                                                        <i class="social-icon fas fa-print"></i>
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
                                </div>
                                <!-- end post body -->

                                @if ($data->Source && $data->Source->source)
                                    <div class="social-share-box-2 mb--20 mt--20">
                                        <div class="row gutter-30">
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="conent-block">
                                                    <h6> {{ __('message.kaynak') }} : {{ $data->Source->source }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (reklam(11) != null && reklam(11)->status == 1)
                                    <div class="ad-banner-img mt--40 mb--40">
                                        <a href="{{ reklam(11)->adsense_url }}">
                                            @if (reklam(11)->type == 1)
                                                <img src="/{{ reklam(11)->image }}"
                                                    style="height: 150px; width:100%!important">
                                            @else
                                                {!! reklam(11)->adsense_url ?? '' !!}
                                            @endif
                                        </a>
                                    </div>
                                @endif

                                <!-- start social-share-box-2 -->
                                <div class="social-share-box-2 mb--20">
                                    <div class="row gutter-30">
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="conent-block">
                                                <h4 class="block-tile mb--20"> {{ __('message.popüler etiketler') }} :
                                                </h4>
                                                <div class="tag-list">

                                                    @foreach ($data->getKeys() as $item)
                                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.tag_list_en', $item) : route('front.currentNews.tag_list', $item) }}"
                                                            class="tag-link" style="text-transform: capitalize">
                                                            {{ $item }} </a>
                                                    @endforeach


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end social-share-box-2 -->


                                <!-- start post-pagination-box -->
                                <div class="post-pagination-box mb--40">

                                    <div class="row gutter-30">
                                        <div class="col-lg-6">
                                            @if ($data->previousData() != null)
                                                <div class="next-prev-wrap" style="height: 100%">
                                                    <div class="item-icon">
                                                        <a
                                                            href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $data->previousData()->link) : route('front.currentNews.detail', $data->previousData()->link) }}">
                                                            <i class="fas fa-chevron-left"></i>
                                                            {{ __('message.önceki haber') }}
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="title">
                                                            <a
                                                                href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $data->previousData()->link) : route('front.currentNews.detail', $data->previousData()->link) }}">
                                                                {{ $data->previousData()->title }}
                                                            </a>
                                                        </h4>
                                                        <span class="rt-meta">
                                                            <i class="far fa-calendar-alt icon"></i>
                                                            {{ $data->previousData()->live_time->translatedFormat('d M Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        <div class="col-lg-6">

                                            @if ($data->nextData() != null)
                                                <div class="next-prev-wrap next-wrap" style="height: 100%">
                                                    <div class="item-icon">
                                                        <a
                                                            href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $data->nextData()->link) : route('front.currentNews.detail', $data->nextData()->link) }}">
                                                            {{ __('message.sonraki haber') }}
                                                            <i class="fas fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="title">
                                                            <a
                                                                href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $data->nextData()->link) : route('front.currentNews.detail', $data->nextData()->link) }}">
                                                                {{ $data->nextData()->title }}
                                                            </a>
                                                        </h4>
                                                        <span class="rt-meta">
                                                            <i class="far fa-calendar-alt icon"></i>
                                                            {{ $data->nextData()->live_time->translatedFormat('d M Y') }}

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
                                                <img id="love" src="{{ asset('assets/reaction/love.webp') }}"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="dislike" src="{{ asset('assets/reaction/dislike.webp') }}"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="clap" src="{{ asset('assets/reaction/clap.webp') }}"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="sad" src="{{ asset('assets/reaction/sad.webp') }}"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="angry" src="{{ asset('assets/reaction/angry.webp') }}"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="shocked" src="{{ asset('assets/reaction/shocked.webp') }}"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row justify-content-center mb--50">
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="love_bar" class="progress-bar"
                                                        style="width: {{ $data->emojiData(0) }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="dislike_bar" class="progress-bar"
                                                        style="width: {{ $data->emojiData(1) }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="clap_bar" class="progress-bar"
                                                        style="width: {{ $data->emojiData(2) }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="sad_bar" class="progress-bar"
                                                        style="width: {{ $data->emojiData(3) }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="angry_bar" class="progress-bar"
                                                        style="width: {{ $data->emojiData(4) }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="shocked_bar" class="progress-bar"
                                                        style="width: {{ $data->emojiData(5) }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb--20">
                                        <h5> {{ __('message.yorumlar') }} ({{ $data->CommentCount() }}) </h5>
                                    </div>

                                    @foreach ($data->comments() as $item)
                                        <div class="comment_container">
                                            <div class="row">
                                                <div class="d-none d-md-block col-md-3 mb-3">
                                                    <div class="commentator-img">
                                                        <img src="{{ asset('assets/sabit.webp') }}"
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
                                                                <img src="{{ asset('assets/sabit.webp') }}"
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
                                                                    href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $single->link) : route('front.currentNews.detail', $single->link) }}">
                                                                    <img style="object-fit:cover"
                                                                        src="/{{ $single->image }}" alt="post"
                                                                        width="551" height="431">
                                                                </a>
                                                            </div>
                                                            @if (isset($single->Category()[0]))
                                                                <div class="post-content">
                                                                    <a style="background-color: {{ $single->Category()[0]->color_code != null ? $single->Category()[0]->color_code : '' }}"
                                                                        href="{{ \Session::get('applocale') == 'en' ? route('front.currentNewsCategory.list_en', $single->Category()[0]->link) : route('front.currentNewsCategory.list', $single->Category()[0]->link) }}"
                                                                        class="rt-cat-primary sidebar_restricted_category_title">
                                                                        {{ $single->Category()[0]->title }} </a>
                                                                    <h4 class="post-title">
                                                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $single->link) : route('front.currentNews.detail', $single->link) }}"
                                                                            class="">
                                                                            {{ $single->title }}
                                                                        </a>
                                                                    </h4>

                                                                    <div class="post-meta">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="rt-meta">
                                                                                    <i
                                                                                        class="far fa-calendar-alt icon"></i>
                                                                                    {{ $single->live_time->translatedFormat('d M Y') }}
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

                            @if (reklam(12) != null && reklam(12)->status == 1)
                                <div class="sidebar-wrap mb--40">
                                    <div class="ad-banner-img">
                                        @if (reklam(12)->type == 1)
                                            <a href="{{ reklam(12)->adsense_url }}">

                                                <img src="/{{ reklam(12)->image }}" alt="" width="300"
                                                    style="250">
                                            </a>
                                        @else
                                            {!! reklam(12)->adsense_url ?? '' !!}
                                        @endif
                                    </div>
                                </div>
                            @endif
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
                                                    <a
                                                        href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}">
                                                        <img title="{{ $item->title }}" style="object-fit:cover"
                                                            src="/{{ $item->image }}" alt="post" width="100"
                                                            height="100">
                                                    </a>
                                                </div>
                                                <div class="post-content ms-4">

                                                    <h4 class="post-title" style="font-size:15px"
                                                        title="{{ $item->title }}">
                                                        <a href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}"
                                                            class="">
                                                            {{ Illuminate\Support\Str::words($item->title, 8, '...') }}
                                                        </a>
                                                    </h4>
                                                    <span class="rt-meta">
                                                        <i class="far fa-calendar-alt icon"></i>
                                                        {{ $item->live_time->translatedFormat('d M Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="d-none d-md-block sidebar-wrap mb--40">
                                <div class="subscribe-box-style-1"
                                    data-bg-image="{{ asset('assets/frontend/media/elements/elm_3.webp') }}">
                                    <div class="subscribe-content">
                                        <h3 class="title">
                                            {{ __('message.Haber Bültenimize Abone Ol') }}
                                        </h3>
                                        <p>
                                            {{ __('message.Ulusal ve küresel savunma gündeminden daha hızlı haberdar olmak istiyorsanız Milli Müdafaa mail listesine kaydolun!') }}
                                        </p>
                                        <form action="{{ route('front.subscribePost') }}" method="POST"
                                            class="subscribe-form rt-form">
                                            @csrf
                                            <div class="rt-form-group">
                                                <input type="email" class="form-control rt-form-control"
                                                    placeholder="E-posta *" name="email" id="email_1"
                                                    data-error="E-posta alanı zorunludur" required>
                                            </div>
                                            <div class="center"
                                                style="overflow:hidden; border-right:solid; border-color:#d3d3d3; border-radius:3px">
                                                <div class="g-recaptcha" data-sitekey="{{ getCaptchaSiteKey() }}"
                                                    data-callback="onSubmit">
                                                </div>
                                            </div>
                                            <br>

                                            <div class="">
                                                <input required type="checkbox" name="accept" id="checked">
                                                @if (\Session::get('applocale') == 'en')
                                                    @if ($kvkk_en)
                                                        <a href="{{ route('front.page.detail', 'pdpl') }}">
                                                            <span style="font-size:14px">
                                                                {{ __('message.Kişisel Verilerin Korunması') }}
                                                            </span>
                                                        </a>
                                                        <label for="checked" style="font-size:14px">
                                                            {{ __('message.okudum, onay veriyorum') }}
                                                        </label>
                                                    @else
                                                        <label for="checked" style="font-size:14px">
                                                            {{ __("message.Kişisel Verilerin İşlenmesi Aydınlatma Metni'ni okudum kabul ediyorum.") }}
                                                        </label>
                                                    @endif
                                                @else
                                                    @if ($kvkk_tr)
                                                        <a href="{{ route('front.page.detail', 'kvkk') }}">
                                                            <span style="font-size:14px">
                                                                {{ __('message.Kişisel Verilerin Korunması') }}
                                                            </span>
                                                        </a>
                                                        <label for="checked">
                                                            {{ __('message.okudum, onay veriyorum') }}
                                                        </label>
                                                    @else
                                                        <label for="checked" style="font-size:14px">
                                                            {{ __('message.Kişisel Verilerin Korunması Hakkında Aydınlatma Metnini okudum, onay veriyorum.') }}
                                                        </label>
                                                    @endif
                                                @endif
                                            </div>
                                            <button type="submit" class="rt-submit-btn mt-4">
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
        function share_count() {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                url: "/paylas-sayi",
                type: "post",
                data: {
                    "id": "{{ $data->id }}",
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                }

            })
        }

        function convertToPDF() {
            const pdf = new jsPDF();

            // Sayfa içeriği eklemek için HTML elementini seç
            const content = document.getElementById('contentToConvert');

            // jsPDF ile PDF'e dönüştür
            pdf.fromHTML(content, 15, 15);

            // PDF'i indir
            pdf.save('converted.pdf');
        }
        
        $(document).ready(function() {

            var windowWidth = $(window).width();
            // Set limits for different device widths
            var limit_sidebar_restricted_title = 31;
            var limit_restricted_title_2 = 50;
            if (windowWidth <= 768) {
                limit_sidebar_restricted_title = 25;
            } else if (windowWidth <= 1200) {
                limit_sidebar_restricted_title = 50;
            }


            $('.sidebar_restricted_title').each(function() {
                var content = $(this).text().trim(); // get the content of a tag
                if (content.length > limit_sidebar_restricted_title) {
                    // If the content is longer thanlimit_sidebar_restricted_title characters
                    content = content.slice(0, limit_sidebar_restricted_title) + '...';
                    // Select limit_sidebar_restricted_title characters and add ellipses
                    $(this).text(content); // Restore modified content
                }
            });

            $('.sidebar_restricted_category_title').each(function() {
                var content = $(this).text().trim(); // get the content of a tag
                if (content.length > 14) { // If the content is longer than 14 characters
                    content = content.slice(0, 14) + '...'; // Select 14 characters and add ellipses
                    $(this).text(content); // Restore modified content
                }
            });


            $('.restricted_title_2').each(function() {
                var content = $(this).text().trim(); // get the content of a tag
                if (content.length > limit_restricted_title_2) {
                    // If the content is longer than limit_restricted_title_2 characters
                    content = content.slice(0, limit_restricted_title_2) + '...';
                    // Select limit_restricted_title_2 characters and add ellipses
                    $(this).text(content); // Restore modified content
                }
            });
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
