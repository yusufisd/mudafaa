@extends('frontend.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
@endsection
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
                            <a href="/">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/firma/liste">
                                Firmalar
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
            <div class="sticky-coloum-wrap container">
                <div class="row gutter-40 sticky-coloum-wrap">
                    <div class="col-xl-9 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">
                            <div class="author-big-box-style-1 mb--30">
                                <div class="author-img">
                                    <img src="/{{ $data->image }}" alt="author-img_1" width="170" height="170">
                                </div>
                                <div class="w-100">
                                    <h2 class="responsive-title" style="color: #3b4022;"> {{ $data->title }} </h2>
                                    <div class="row">

                                        @foreach ($ekstra as $item)
                                            <div class="col-md-6">
                                                <ul class="mt-3">
                                                    <li class="mb-3">
                                                        {!! $item->icon !!}
                                                        <b>
                                                            <span style="color: #749f43"> {{ $item->title }} : </span>
                                                        </b>
                                                        &nbsp;{{ $item->description }}
                                                    </li>

                                                </ul>
                                            </div>
                                        @endforeach


                                    </div>

                                </div>
                            </div>

                            <div class="mb--30" style="text-align: justify">
                                {!! $data->description !!}
                            </div>

                            <!-- end inner row -->

                            <div class="wrap post-wrap mb--30">
                                <h2 class="rt-section-heading">
                                    <span class="rt-section-text">Ürün Görselleri </span>
                                    <span class="rt-section-dot"></span>
                                    <span class="rt-section-line"></span>
                                </h2>

                                <!-- Galeri Resimleri gallery classı kaldırıldı -->
                                <div class="row">
                                    @foreach ($images as $item)
                                        <div class="col-md-4">
                                            <a data-fancybox="gallery" href="/{{ $item->image }}">
                                                <img src="/{{ $item->image }}" style="width: 100%;"
                                                    alt="Resim 3">
                                            </a>
                                        </div>
                                    @endforeach

                                </div>


                            </div>
                            <!-- end wrap -->

                            <div class="wrap mb--30">
                                <div class="featured-tab-title">
                                    <h2 class="rt-section-heading">
                                        <span class="rt-section-text">İletişim Bilgileri </span>
                                        <span class="rt-section-dot"></span>
                                        <span class="rt-section-line"></span>
                                    </h2>

                                    <ul class="nav rt-tab-menu" id="myTab" role="tablist">
                                        @foreach ($address as $key => $item)
                                            <li class="menu-item" role="presentation">
                                                <a class="menu-link {{ $key == 0 ? 'active' : '' }}" id="menu-1-tab"
                                                    data-bs-toggle="tab" href="#menu-{{ $item->id }}" role="tab"
                                                    aria-controls="menu-1" aria-selected="true"> {{ $item->title }} </a>
                                            </li>
                                        @endforeach



                                    </ul><!-- end nav tab -->
                                </div>
                                <!-- end featured-tab-title -->

                                <div class="tab-content" id="myTabContent">


                                    @foreach ($address as $key => $item)
                                        <div class="tab-pane tab-item animated fadeInUp {{ $key == 0 ? 'show active' : '' }}"
                                            id="menu-{{ $item->id }}" role="tabpanel"
                                            aria-labelledby="menu-{{ $item->id }}-tab">
                                            <div class="row gutter-30">
                                                <div class="col-lg-6 grid-adress">
                                                    <ul class="contact_info">
                                                        <li>
                                                            <h6>Adres</h6>
                                                            <p class="rt-teta">
                                                                <i class="fas fa-home icon"></i>
                                                                {{$item->address}}
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <h6>E-Posta</h6>
                                                            <p class="rt-teta">
                                                                <i class="fas fa-envelope icon"></i>
                                                                {{$item->email}}
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <h6>Telefon</h6>
                                                            <p class="rt-teta">
                                                                <i class="fas fa-phone icon"></i>
                                                                {{$item->phone}}
                                                            </p>

                                                        </li>
                                                        <li>
                                                            <h6>Web Site</h6>
                                                            <p class="rt-teta">
                                                                <i class="fas fa-globe icon"></i>
                                                                {{$item->website}}
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 grid-adress">
                                                    <iframe
                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3057.811030038286!2d32.76457571578375!3d39.96797747942001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14d34bc3fbee31f3%3A0x7dabfd5babe0f38e!2zQXNlbHNhbiBHZW5lbCBNw7xkw7xybMO8aw!5e0!3m2!1str!2str!4v1645201234609!5m2!1str!2str"
                                                        class="iframe-map" allowfullscreen=""></iframe>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>


                        </div>
                        <!-- end rt-left-sidebar-sapcer-5 -->
                    </div>
                    <!-- end col-->

                    <div class="col-xl-3 col-lg-8 sticky-coloum-item mx-auto">
                        <div class="rt-sidebar sticky-wrap">

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

                            <div class="d-none d-md-block sidebar-wrap">
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

<!-- Fancybox CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script>
    // Open slider on clicking pictures
    var galleryImages = document.querySelectorAll('.gallery a');
    galleryImages.forEach(function(image, index) {
        image.addEventListener('click', function() {
            image.setAttribute('data-fancybox',
                'gallery'); // This line makes the gallery share the same group
            image.click();
        });
    });
</script>
    <!-- Fancybox CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        // Open slider on clicking pictures
        var galleryImages = document.querySelectorAll('.gallery a');
        galleryImages.forEach(function(image, index) {
            image.addEventListener('click', function() {
                image.setAttribute('data-fancybox',
                    'gallery'); // This line makes the gallery share the same group
                image.click();
            });
        });
    </script>
@endsection
