@extends('frontend.master')
@section('title','Sözlük')

@section('content')
    <!-- Start Main -->
    <style>
        .pagination>li>a,
        .pagination>li>:hover,
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
                            <a href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('message.ss sözlüğü') }}
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
                    <div class="col-xl-12 sticky-coloum-item">
                        <div class="rt-left-sidebar-sapcer-5">


                            <div id="ss_container" class="row gutter-24">
                                <div class="search-box">
                                    <form action="{{ \Session::get('applocale') == 'tr' ? (route('front.dictionary.list')) : (route('front.dictionary.list_en')) }}" method="GET"
                                        class="form search-form-box">
                                        <div class="form-group">
                                            <input type="text" name="search" value="{{ request()->search ?? '' }}"
                                                id="search" placeholder="Ara..." required
                                                class="form-control rt-search-control">
                                            <button type="submit" class="search-submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="post_meta">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        @foreach ($alphabets as $alp)
                                            <li class="nav-item">
                                                <a class="nav-link" style="background-color: {{ $letter == $alp ? 'rgba(23, 34, 43, 0.85); color:white' : '' }}"
                                                    href="{{ \Session::get('applocale') == 'tr' ? (route('front.dictionary.list', ['id' => $alp])) : (route('front.dictionary.list', ['id' => $alp])) }}">{{ $alp }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul class="nav nav-pills" id="pills-tab-mobile" role="tablist">
                                    </ul>
                                </div>


                                @foreach ($data as $key => $item)
                                @if($key==6)
                                    @if (reklam(39) != null && reklam(39)->status == 1)
                                        <div class="sidebar-wrap mb--40">
                                            <div class="ad-banner-img">
                                                <a href="{{ reklam(39)->adsense_url }}">
                                                    @if (reklam(39)->type ?? 0 == 1)
                                                        <img src="/{{ reklam(39)->image }}"
                                                            width="1320px" style="height:90px">
                                                    @else
                                                        {!! reklam(39)->adsense_url ?? '' !!}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if($key==12)
                                    @if (reklam(40) != null && reklam(40)->status == 1)
                                        <div class="sidebar-wrap mb--40">
                                            <div class="ad-banner-img">
                                                <a href="{{ reklam(40)->adsense_url }}">
                                                    @if (reklam(40)->type ?? 0 == 1)
                                                        <img src="/{{ reklam(40)->image }}"
                                                        width="1320px" style="height:90px">
                                                    @else
                                                        {!! reklam(40)->adsense_url ?? '' !!}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                    <div class="col-md-4 wow fadeInUp" data-wow-delay="100ms" data-wow-duration="800ms">
                                        <div class="rt-post-overlay rt-post-overlay-md layout-6">
                                            <div class="post-img">
                                                <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.dictionary.detail', $item->link)) : (route('front.dictionary.detail_en', $item->link)) }}"
                                                    class="img-link">
                                                    <img src="/{{ $item->image == null ? 'media/gallery/post-xl_31.jpg' : $item->image }}" alt="{{ $item->title }}" width="900"
                                                        height="600">
                                                </a>
                                            </div>
                                            <div class="post-content">

                                                <h3 class="post-title">
                                                    <a href="{{ \Session::get('applocale') == 'tr' ? (route('front.dictionary.detail', $item->link)) : (route('front.dictionary.detail_en', $item->link)) }}">
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
                                                                <i class="fa-solid fa-clock"></i>
                                                                {{ $item->read_time == 0 ? '1' : $item->read_time }} DK
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
                                {!! $data->appends(request()->input())->onEachSide(1)->links(); !!}
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
