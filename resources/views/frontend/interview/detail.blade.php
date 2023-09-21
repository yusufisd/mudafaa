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
                            <a href="{{ route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('front.interview.list') }}">
                                Röportajlar
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
                                                <a href="author.html" class="name">Milli Müdafaa</a>
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
                                                <i class="far fa-comments icon"></i>
                                                250
                                            </span>
                                        </li>
                                        <li>
                                            <span class="rt-meta">
                                                <i class="far fa-clock icon"></i>
                                                2 Dk.
                                            </span>
                                        </li>
                                        <li>
                                            <span class="rt-meta">
                                                <i class="far fa-eye icon"></i>
                                                3,250
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
                                <div class="post-body">
                                    {!! $data->description !!}


                                    <br><br>
                                    <!-- end post -->
                                    <div class="single-content">
                                        <div class="thumb-vidided mb--30">
                                            <div class="row gutter-24">


                                                @foreach ($dialogs as $item)
                                                    <div class="single-content">
                                                        <h3 class="title report_title">
                                                            <i class="fas fa-question"
                                                                style="vertical-align: text-top; color:#3b4022;"></i>
                                                            {{ $item->soru }}
                                                        </h3>
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
                                        <a href="#">
                                            <img src="/assets/frontend/media/gallery/ad-banner_4.jpg" alt="ad-banner"
                                                width="960" height="150">
                                        </a>
                                    </div>

                                </div>
                                <!-- end post body -->

                                <!-- start social-share-box-2 -->
                                <div class="social-share-box-2 mb--40">
                                    <div class="row gutter-30">
                                        <div class="col-xl-7 col-lg-6">
                                            <div class="conent-block">
                                                <h4 class="block-tile mb--20">Popüler Etiketler:</h4>
                                                <div class="tag-list">
                                                    <a href="#" class="tag-link">Güzel</a>
                                                    <a href="#" class="tag-link">Seyahat</a>
                                                    <a href="#" class="tag-link">Teknoloji</a>
                                                    <a href="#" class="tag-link">Siyaset</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 col-lg-6 d-flex justify-content-start justify-content-lg-end">
                                            <div class="conent-block">
                                                <h4 class="block-tile mb--20">Paylaş:</h4>
                                                <ul class="social-share-style-1 ">
                                                    <li>
                                                        <a class="fb" target="_blank"
                                                            href="https://www.facebook.com/">
                                                            <i class="social-icon fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="tw" target="_blank" href="https://twitter.com/">
                                                            <i class="social-icon fab fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="yu" target="_blank"
                                                            href="https://www.youtube.com/">
                                                            <i class="social-icon fab fa-youtube"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dr" target="_blank" href="https://dribbble.com/">
                                                            <i class="social-icon fab fa-dribbble"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dw" target="_blank"
                                                            href="https://cloud.google.com/">
                                                            <i class="social-icon fas fa-cloud"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="wh" target="_blank"
                                                            href="https://www.whatsapp.com/">
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
                                                            Önceki Röportaj
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="title">
                                                            <a href="{{ route('front.interview.detail', $data->id - 1) }}">
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
                                                            Sonraki Röportaj
                                                            <i class="fas fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="title">
                                                            <a href="{{ route('front.interview.detail', $data->id + 1) }}">
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
                                                <img id="emoji_heart_eye"
                                                    src="https://millimudafaa.com/assets/img/begendim.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="emoji_dislike"
                                                    src="https://millimudafaa.com/assets/img/begenmedim.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="emoji_like"
                                                    src="https://millimudafaa.com/assets/img/alkisladim.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="emoji_sad" src="https://millimudafaa.com/assets/img/uzuldum.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="emoji_angry"
                                                    src="https://millimudafaa.com/assets/img/sinirlendim.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <img id="emoji_shocked"
                                                    src="https://millimudafaa.com/assets/img/sasirdim.png"
                                                    style="cursor: pointer; width:38px;">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row justify-content-center mb--50">
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="emoji_heart_eye_bar" class="progress-bar"
                                                        style="width: 15%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="emoji_dislike_bar" class="progress-bar" style="width: 2%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="emoji_like_bar" class="progress-bar" style="width: 25%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="emoji_sad_bar" class="progress-bar" style="width: 0%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="emoji_angry_bar" class="progress-bar" style="width: 1%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-1">
                                            <div class="emoji_container">
                                                <div class="progress" role="progressbar" aria-label="Basic example"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    <div id="emoji_shocked_bar" class="progress-bar" style="width: 16%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row mb--20">
                                        <h5>Yorumlar (83) </h5>
                                    </div>

                                    <div class="comment_container">
                                        <div class="row">
                                            <div class="d-none d-md-block col-md-3 mb-3">
                                                <div class="commentator-img">
                                                    <img src="/assets/frontend/media/gallery/post-sm_1.jpg"
                                                        alt="commentator-img_1" width="170" height="170">
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="commentator-content">
                                                    <h3 class="commentator-name">Mehmet Doğan</h3>
                                                    <p class="user-desc">
                                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias
                                                        error itaque quas adipisci beatae possimus, quaerat temporibus
                                                        mollitia non ex consectetur facere sed nobis sunt illum eos
                                                        reiciendis! Obcaecati, praesentium?
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-md-4">
                                                <span class="mx-2 comment_span"><i class="fas fa-pencil-alt"></i> Cevap
                                                    Yaz </span>
                                                <span class="mx-2 comment_span"><i class="far fa-thumbs-up icon"></i>
                                                    0</span>
                                                <span class="mx-2 comment_span"><i class="far fa-thumbs-down icon"></i>
                                                    0</span>
                                            </div>

                                        </div>
                                    </div>

                                    <hr class="dropdown-divider my-5">

                                    <div class="comment_container">
                                        <div class="row">
                                            <div class="d-none d-md-block col-md-3 mb-3">
                                                <div class="commentator-img">
                                                    <img src="/assets/frontend/media/gallery/post-sm_1.jpg"
                                                        alt="commentator-img_1" width="170" height="170">
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="commentator-content">
                                                    <h3 class="commentator-name">Mehmet Doğan</h3>
                                                    <p class="user-desc">
                                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias
                                                        error itaque quas adipisci beatae possimus, quaerat temporibus
                                                        mollitia non ex consectetur facere sed nobis sunt illum eos
                                                        reiciendis! Obcaecati, praesentium?
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-md-4">
                                                <span class="mx-2 comment_span"><i class="fas fa-pencil-alt"></i> Cevap
                                                    Yaz </span>
                                                <span class="mx-2 comment_span"><i class="far fa-thumbs-up icon"></i>
                                                    0</span>
                                                <span class="mx-2 comment_span"><i class="far fa-thumbs-down icon"></i>
                                                    0</span>
                                            </div>

                                        </div>
                                    </div>
                                    <hr class="dropdown-divider my-5">

                                    <div class="comment_container">
                                        <div class="row">
                                            <div class="d-none d-md-block col-md-3 mb-3">
                                                <div class="commentator-img">
                                                    <img src="/assets/frontend/media/gallery/post-sm_1.jpg"
                                                        alt="commentator-img_1" width="170" height="170">
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="commentator-content">
                                                    <h3 class="commentator-name">Mehmet Doğan</h3>
                                                    <p class="user-desc">
                                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias
                                                        error itaque quas adipisci beatae possimus, quaerat temporibus
                                                        mollitia non ex consectetur facere sed nobis sunt illum eos
                                                        reiciendis! Obcaecati, praesentium?
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-md-4">
                                                <span class="mx-2 comment_span"><i class="fas fa-pencil-alt"></i> Cevap
                                                    Yaz </span>
                                                <span class="mx-2 comment_span"><i class="far fa-thumbs-up icon"></i>
                                                    0</span>
                                                <span class="mx-2 comment_span"><i class="far fa-thumbs-down icon"></i>
                                                    0</span>
                                            </div>

                                        </div>
                                    </div>
                                    <hr class="dropdown-divider my-5">

                                    <div class="comment_container">
                                        <div class="row">
                                            <div class="d-none d-md-block col-md-3 mb-3">
                                                <div class="commentator-img">
                                                    <img src="/assets/frontend/media/gallery/post-sm_1.jpg"
                                                        alt="commentator-img_1" width="170" height="170">
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="commentator-content">
                                                    <h3 class="commentator-name">Mehmet Doğan</h3>
                                                    <p class="user-desc">
                                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias
                                                        error itaque quas adipisci beatae possimus, quaerat temporibus
                                                        mollitia non ex consectetur facere sed nobis sunt illum eos
                                                        reiciendis! Obcaecati, praesentium?
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-md-4">
                                                <span class="mx-2 comment_span"><i class="fas fa-pencil-alt"></i> Cevap
                                                    Yaz </span>
                                                <span class="mx-2 comment_span"><i class="far fa-thumbs-up icon"></i>
                                                    0</span>
                                                <span class="mx-2 comment_span"><i class="far fa-thumbs-down icon"></i>
                                                    0</span>
                                            </div>

                                        </div>
                                    </div>

                                    <nav class="rt-pagination-area gap-top-90">
                                        <ul class="pagination rt-pagination justify-content-center">
                                            <li class="page-item prev">
                                                <a class="page-link" href="#"><i
                                                        class="fas fa-angle-double-left"></i></a>
                                            </li>
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">1</span>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                                            <li class="page-item next">
                                                <a class="page-link" href="#"><i
                                                        class="fas fa-angle-double-right"></i></a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <!-- end rt-pagination-area -->


                                </div>
                                <!-- end commentator box -->

                                <!-- start blog-post-comment -->
                                <div class="blog-post-comment mb--50">
                                    <form action="{{route('front.interview.addComment',$data->id)}}" method="POST" class=" comments-form-style-1">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="rt-form-group">
                                                    <label for="name">İsim - Soyisim *</label>
                                                    <input type="text" name="full_name" id="name"
                                                        class="form-control" data-error="Bu alan zorunludur" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="rt-form-group">
                                                    <label for="email">E-posta *</label>
                                                    <input type="text" name="email" id="email"
                                                        class="form-control" data-error="Bu alan zorunludur" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="rt-form-group">
                                                    <label for="comment">Yorum *</label>
                                                    <textarea name="comment" id="comment" class="form-control text-area" data-error="Bu alan zorunludur" required></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="rt-form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="comment-form-check1">
                                                        <label class="form-check-label" for="comment-form-check1">
                                                            <a href="empty.html">Kişisel Verilerin Korunması</a> Hakkında
                                                            Aydınlatma Metni'ni okudum, onay veriyorum.
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="submit-btn">
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
                                        <h2 class="rt-section-heading mb-0 flex-grow-1 me-3">
                                            <span class="rt-section-text">Diğer Röportajlar </span>
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
                                                                <a href="{{ route('front.interview.detail', $item->id) }}">
                                                                    <img src="/{{ $item->image }}" alt="post"
                                                                        width="551" height="431">
                                                                </a>
                                                            </div>
                                                            <div class="post-content">

                                                                <h4 class="post-title">
                                                                    <a href="">
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

                    <div class="col-xl-3 col-lg-8 mx-auto sticky-coloum-item">
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
                                    <span class="rt-section-text">Bİzİ Takİp Edİn</span>
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
                                            <i class="fab fa-twitter twitter"></i>
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
                                            <i class="fab fa-linkedin-in linkedin"></i>
                                            <span class="text"><span>35,999</span> Takipçi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="sidebar-wrap mb--40">
                                <div class="ad-banner-img">
                                    <a href="#">
                                        <img src="/assets/frontend/media/gallery/sports-ad_3.jpg" alt="ad-banner"
                                            width="310" height="425">
                                    </a>
                                </div>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="sidebar-wrap">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text">Etİketler </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="tag-list">
                                    <a href="#" class="tag-link">güzel</a>
                                    <a href="#" class="tag-link">seyahat</a>
                                    <a href="#" class="tag-link">teknoloji</a>
                                    <a href="#" class="tag-link">kimyasak</a>
                                    <a href="#" class="tag-link">siyaset</a>
                                    <a href="#" class="tag-link">işletme</a>
                                    <a href="#" class="tag-link">makyaj</a>
                                    <a href="#" class="tag-link">sosyal</a>
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
            //The id of the bar is found by adding '_bar' to the id of the emoji
            var emoji_progress_bar = $("#" + emoji_id + "_bar").css('width'); //get width property of emoji's bar
            var intValue = parseInt(emoji_progress_bar, 10);
            intValue++; //increase the value
            $("#" + emoji_id + "_bar").css('width', intValue); //update the value  
        });

        
    </script>


@endsection
