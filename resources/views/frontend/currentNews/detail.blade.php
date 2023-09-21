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
                            <a href="index.html">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="black_news.html">
                                {{ $data->Category->title }}
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

        <!-- start rt-sidebar-section-layout-2 -->
        <section class="rt-sidebar-section-layout-2">
            <div class="container">
                <div class="row gutter-40 sticky-coloum-wrap">

                    <div class="col-xl-9 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">

                            <div class="rt-main-post-single grid-meta">

                                <!-- start post header -->
                                <div class="post-header">
                                    <span class="rt-cat-primary"> {{ $data->Category->title }} </span>
                                    <h2 class="title">
                                        {{ $data->title }}
                                    </h2>
                                    <div class="post-meta">
                                        <ul>
                                            <li>
                                                <span class="rt-meta">
                                                    <i class="fa fa-user"></i>
                                                    <a href="" class="name">{{ $data->Author->name }}
                                                        {{ $data->Author->name }}</a>
                                                </span>
                                            </li>
                                            <li>
                                                <span class="rt-meta">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    {{ $data->created_at->translatedFormat('d M Y H:i') }} | <b>Son
                                                        Güncelleme:</b>
                                                    {{ $data->updated_at->translatedFormat('d M Y H:i') }}
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
                                                        <a class="fb" target="_blank" href="https://www.facebook.com/">
                                                            <i class="social-icon fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="tw" target="_blank" href="https://twitter.com/">
                                                            <i class="social-icon fab fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="yu" target="_blank" href="https://www.youtube.com/">
                                                            <i class="social-icon fab fa-youtube"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dr" target="_blank" href="https://dribbble.com/">
                                                            <i class="social-icon fab fa-dribbble"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dw" target="_blank" href="https://cloud.google.com/">
                                                            <i class="social-icon fas fa-cloud"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="wh" target="_blank" href="https://www.whatsapp.com/">
                                                            <i class="social-icon fab fa-whatsapp"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="right-area">
                                            <ul class="social-share-style-1 layout-2 mb--10">
                                                <li>
                                                    <a target="_blank" href="https://www.facebook.com/">
                                                        <i class="social-icon fas fa-envelope"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a target="_blank" href="https://twitter.com/">
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
                                <div class="post-body">

                                    {!! $data->description !!}

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
                                <div class="social-share-box-2 mb--20">
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
                                                <h4 class="block-tile mb--20">Bu Haberi Paylaş:</h4>
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

                                <!-- start author box -->
                                <div class="author-box-style-1 mb--35">
                                    <div class="author-img">
                                        <img src="/assets/frontend/media/gallery/author-img_1.jpg" alt="author-img_1"
                                            width="170" height="170">
                                    </div>
                                    <div class="author-content">
                                        <h3 class="author-name">Ayşe Yılmaz</h3>
                                        <p class="user-desc">
                                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias error itaque
                                            quas adipisci beatae possimus, quaerat temporibus mollitia non ex consectetur
                                            facere sed nobis sunt illum eos reiciendis! Obcaecati, praesentium?
                                        </p>
                                        <ul class="social-style-5">

                                            <li>
                                                <a target="_blank" href="https://www.facebook.com/">
                                                    <i class="social-icon fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="https://twitter.com/">
                                                    <i class="social-icon fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="https://www.pinterest.com/">
                                                    <i class="fab fa-pinterest-p"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="https://www.instagram.com/">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>

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
                                                        <a href="#">
                                                            <i class="fas fa-chevron-left"></i>
                                                            Öncekİ Haber
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="title">
                                                            <a href="#">
                                                                Japon Donanmasının Yeni Nesil 30FFM Çok Amaçlı Fırkateyni
                                                                Görüldü
                                                            </a>
                                                        </h4>
                                                        <span class="rt-meta">
                                                            <i class="far fa-calendar-alt icon"></i>
                                                            17.07.2023
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        <div class="col-lg-6">

                                            @if ($next_data != null)
                                                <div class="next-prev-wrap next-wrap">
                                                    <div class="item-icon">
                                                        <a href="#">
                                                            Sonrakİ Haber
                                                            <i class="fas fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="title">
                                                            <a href="#">
                                                                Katar Emiri Donanmasına Ait İlk Açık Deniz Karakol Gemisi
                                                                Denize
                                                                İndirildi
                                                            </a>
                                                        </h4>
                                                        <span class="rt-meta">
                                                            <i class="far fa-calendar-alt icon"></i>
                                                            18.07.2023
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
                                <div class="blog-post-comment mb--40">

                                    <form action="{{route('front.comment.store',$data->id)}}" method="POST" class=" comments-form-style-1">
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
                                        <h2 class="rt-section-heading mb-0 flex-grow-1 me-3">
                                            <span class="rt-section-text">İlgili Haberler </span>
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
                                                                <a href="single-post1.html">
                                                                    <img src="/{{$single->image}}"
                                                                        alt="post" width="551" height="431">
                                                                </a>
                                                            </div>
                                                            <div class="post-content">
                                                                <a href="graphics.html"
                                                                    class="rt-cat-primary sidebar_restricted_category_title"> {{$single->Category->title}} </a>
                                                                <h4 class="post-title">
                                                                    <a href="single-post1.html"
                                                                        class="restricted_title_2">
                                                                        {{$single->title}}
                                                                    </a>
                                                                </h4>

                                                                <div class="post-meta">
                                                                    <ul>
                                                                        <li>
                                                                            <span class="rt-meta">
                                                                                <i class="far fa-calendar-alt icon"></i>
                                                                                {{$single->created_at->translatedFormat('d M Y')}}
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

                            <div class="sidebar-wrap mb--40">
                                <div class="ad-banner-img">
                                    <a href="#">
                                        <img src="/assets/frontend/media/gallery/sports-ad_3.jpg" alt="ad-banner"
                                            width="310" height="425">
                                    </a>
                                </div>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="d-none d-md-block  sidebar-wrap mb--40">
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

                            <div class="d-none d-md-block  sidebar-wrap mb--40">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text">PopÜler Haberler </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="post-list">

                                    @foreach ($four_news as $item)
                                        
                                    <div class="item">
                                        <div class="rt-post post-sm style-1">
                                            <div class="post-img">
                                                <a href="single-post1.html">
                                                    <img src="/{{$item->image}}" alt="post"
                                                        width="100" height="100">
                                                </a>
                                            </div>
                                            <div class="ms-4 post-content">
                                                <a href=""
                                                    class="rt-cat-primary sidebar_restricted_category_title">Sports</a>
                                                <h4 class="post-title">
                                                    <a href="single-post1.html" class="sidebar_restricted_title">
                                                        {{$item->title}}
                                                    </a>
                                                </h4>
                                                <span class="rt-meta">
                                                    <i class="far fa-calendar-alt icon"></i>
                                                    {{$item->created_at->translatedFormat('d M Y')}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach

                                    
                                </div>
                            </div>
                            <!-- end slidebar wrap  -->

                            <div class="d-none d-md-block  sidebar-wrap mb--40">
                                <div class="subscribe-box-style-1" data-bg-image="media/elements/elm_3.png">
                                    <div class="subscribe-content">
                                        <h3 class="title">
                                            Haber Bültenimize Abone Ol
                                        </h3>
                                        <p>
                                            Ulusal ve global savunma ile ilgili gündemden daha hızlı haberdar olmak
                                            istiyorsanız, Milli Müdafaa e-posta listesine kayıt olun!
                                        </p>
                                        <form action="#" class="rt-contact-form subscribe-form rt-form">
                                            <div class="rt-form-group">
                                                <input type="email" class="form-control rt-form-control"
                                                    placeholder="E-posta *" name="email" id="email_1"
                                                    data-error="E-posta alanı zorunludur" required>
                                            </div>
                                            <button type="submit" class="rt-submit-btn">Şimdi Abone Ol</button>
                                            <div class="form-response"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end sidebar wrap -->

                            <div class="d-none d-md-block  sidebar-wrap">
                                <h2 class="rt-section-heading style-2 mb--30">
                                    <span class="rt-section-text">Etİketler </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>
                                <div class="tag-list">

                                    @foreach ($data->tags as $key)
                                        <a href="#" class="tag-link"> {{ $key }} </a>
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
            e.preventDefault();
            // Create reply field
            var replyField = $(
                '<form action="{{route("front.comment.store")}}" method="POST" class="rt-contact-form comments-form-style-1">' +
                '@csrf' +
                '<div class="row">' +
                '<div class="col-xl-6">' +
                '<div class="rt-form-group">' +
                '<label for="name">İsim - Soyisim *</label>' +
                '<input type="text" name="name" id="name" class="form-control" data-error="Bu alan zorunludur" required>' +
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
