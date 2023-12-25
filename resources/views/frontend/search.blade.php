@extends('frontend.master')
@section('meta-title',  'Milli Müdafaa')
@section('keywords',  'Milli Müdafaa, Haber, Güncel Haberler, Son Dakika Haberleri, Türkiye, Dünya, Teknoloji, İstanbul, TV, savunma, savunma sanayi, savunma sanayii, teknoloji, siber, güvenlik, siber güvenlik, milli teknoloji, milli teknoloji hamlesi, aselsan, baykar, havelsan, tai, tusaş, hulusi akar, haluk görgün, selçuk bayraktar, haluk bayraktar, temel kotil, mustafa varank, teknopark, turksat, telekom, haberlesme, istihbarat, milli istihbarat, dış politika, savunma sanayi haberleri, savunma sanayii haberleri, yerli, milli.')
@section('description', 'Savunma Sanayii haberleri, güncel son dakika gelişmeleri ve bugün yer alan son durum bilgileri için tıklayın!')
@section('title', 'Ara')
@section('content')
    <!-- Start Main -->
    <style>
        .pagination>li>a,
        .pagination>li>span {
            color: rgb(26, 159, 26);
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
                            <a href="{{ route('front.search') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('ara') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <!-- start rt-sidebar-section-layout-2 -->
        <section class="rt-sidebar-section-layout-2">
            <div class="sticky-coloum-wrap container">
                <div class="row gutter-40 sticky-coloum-wrap">
                    <div class="col-xl-12 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">


                            <div id="ss_container" class="row gutter-24">
                                <div class="search-box">
                                    <form action="{{ route('front.search') }}" method="GET" class="form search-form-box">
                                        <div class="form-group">
                                            <input type="text" name="s" value="{{ request()->s ?? '' }}"
                                                id="search" placeholder="Ara..." required
                                                class="form-control rt-search-control">
                                            <button type="submit" class="search-submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>


                                @foreach ($data as $item)
                                    <div class="col-md-4 wow fadeInUp" data-wow-delay="100ms" data-wow-duration="800ms">
                                        <div class="rt-post-overlay rt-post-overlay-md layout-6">
                                            <div class="post-img">

                                                <a class="img-link"
                                                    href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}">
                                                    <img src="/{{ $item->image }}" alt="{{ $item->title }}" width="900"
                                                        height="600">
                                                </a>
                                            </div>
                                            <div class="post-content">

                                                <h3 class="post-title">
                                                    <a 
                                                    href="{{ \Session::get('applocale') == 'en' ? route('front.currentNews.detail_en', $item->link) : route('front.currentNews.detail', $item->link) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </h3>
                                                <div class="post-meta">
                                                    <ul>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="fa fa-user"></i>
                                                                @if (isset($item->Author))
                                                                    <a href="#" class="name">
                                                                        {{ $item->Author->name }}
                                                                        {{ $item->Author->surname }}
                                                                    </a>
                                                                @endif
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span class="rt-meta">
                                                                <i class="far fa-clock icon"></i>
                                                                {{ $item->read_time }} DK
                                                            </span>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- end inner row -->

                            <div style="margin-left: 45%; margin-top:5%">
                            </div>

                            <!-- end rt-pagination-area -->

                        </div>
                        <!-- end rt-left-sidebar-sapcer-5 -->
                    </div>
                    <!-- end col-->

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
        document.addEventListener('DOMContentLoaded', function() {
            const firstPage = 'A'.charCodeAt(0); // Unicode value of the first page (A)
            const lastPage = 'Z'.charCodeAt(0); // Unicode value of the last page (Z)
            const currentPage = 'C'.charCodeAt(0); // Current page's Unicode value (e.g., C)
            const visiblePages = 2; // Number of visible pages in the navigation

            const pagination = document.getElementById('pills-tab-mobile');
            const pagesToShow = [];

            // Add the first 3 pages
            for (let i = firstPage; i <= Math.min(lastPage, firstPage + visiblePages - 1); i++) {
                pagesToShow.push(i);
                addPaginationItem(String.fromCharCode(i)); // Convert Unicode value to character
            }

            if (currentPage - visiblePages > firstPage) {
                pagination.appendChild(createEllipsis());
            }

            // Add the current page and the next 3 pages
            for (let i = currentPage; i <= Math.min(currentPage + visiblePages, lastPage); i++) {
                if (!pagesToShow.includes(i)) {
                    pagesToShow.push(i);
                    addPaginationItem(String.fromCharCode(i)); // Convert Unicode value to character
                }
            }

            if (currentPage + visiblePages < lastPage) {
                pagination.appendChild(createEllipsis());
            }

            // Add the last 3 pages
            for (let i = lastPage - Math.min(lastPage, visiblePages - 1); i <= lastPage; i++) {
                if (!pagesToShow.includes(i)) {
                    addPaginationItem(String.fromCharCode(i)); // Convert Unicode value to character
                }
            }

            function addPaginationItem(pageNumber) {
                const li = document.createElement('li');
                li.classList.add('nav-item');
                const link = document.createElement('a');
                link.href = `page_${pageNumber}.html`; // Update the page links accordingly
                link.textContent = pageNumber;
                li.appendChild(link);
                pagination.appendChild(li);
            }

            function createEllipsis() {
                const li = document.createElement('li');
                li.classList.add('nav-item');
                li.textContent = '...';
                return li;
            }
        });
    </script>
@endsection
