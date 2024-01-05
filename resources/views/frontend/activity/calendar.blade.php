@extends('frontend.master')
@section('meta-title', $data->title ?? 'Milli Müdafaa')
@section('keywords', 'Milli Müdafaa, Haber, Güncel Haberler, Son Dakika Haberleri, Türkiye, Dünya, Teknoloji, İstanbul,
    TV, savunma, savunma sanayi, savunma sanayii, teknoloji, siber, güvenlik, siber güvenlik, milli teknoloji, milli
    teknoloji hamlesi, aselsan, baykar, havelsan, tai, tusaş, hulusi akar, haluk görgün, selçuk bayraktar, haluk bayraktar,
    temel kotil, mustafa varank, teknopark, turksat, telekom, haberlesme, istihbarat, milli istihbarat, dış politika,
    savunma sanayi haberleri, savunma sanayii haberleri, yerli, milli.')
@section('description', 'Savunma Sanayii haberleri, güncel son dakika gelişmeleri ve bugün yer alan son durum bilgileri
    için tıklayın!')
@section('title', 'Etkinlik Takvimi')

@section('content')
    <style>
        .current_activity {
            position: absolute;
            z-index: 9999;
        }

        .fc-daygrid-event-harness {
            position: relative;
            z-index: 9999;
        }

        .relative {
            position: relative !important;
        }

        .fc-event-time {
            display: none;
        }
    </style>
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
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.home_en') : route('front.home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a
                                href="{{ \Session::get('applocale') == 'en' ? route('front.activity.list_en') : route('front.activity.list') }}">
                                {{ __('message.etkinlikler') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="rt-text-truncate">
                                {{ __('message.etkinlik takvimi') }}
                            </span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End inner page Banner -->

        <div class="rt-sidebar-section-layout-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-3 mb-5">
                        <ul>
                            @foreach ($categories as $category)
                                <li class="calendar_activity_category_li">
                                    <a class="activity-button cat-1 category-filter"
                                        style="background-color: {{ $category->color_code }} !important;"
                                        onclick="generateUrlSearch({{ $category->id }})"
                                        href="javascript:void(0);">{{ $category->title }}</a>
                                </li>
                            @endforeach
                            <li class="calendar_activity_category_li">
                                <a class="activity-button cat-1 category-filter"
                                    style="background-color: transparent !important; color:black; border: 1px solid darkslategrey"
                                    onclick="window.location.replace('{{ route('front.activity.calendar') }}')"
                                    href="javascript:void(0);">Tümü</a>
                            </li>
                        </ul>
                        @if (reklam(26) != null && reklam(26)->status == 1)
                            <div class="ad-banner-img mt--45 mb--40">
                                @if (reklam(26)->type == 1)
                                    <a href="{{ reklam(26)->adsense_url }}">

                                        <img src="/{{ reklam(26)->image }}" alt="" width="300" height="600">
                                    </a>
                                @else
                                    {!! reklam(26)->adsense_url ?? '' !!}
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <div id='calendar'></div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 col-sm-12 col-lg-3 mb-5"></div>
                    <div class="col-md-9">
                        @if (reklam(27) != null && reklam(26)->status == 1)
                            <div class="ad-banner-img">
                                @if (reklam(27)->type == 1)
                                    <a href="{{ reklam(27)->adsense_url }}">

                                        <img src="/{{ reklam(27)->image }}" alt="" width="468" height="60">
                                    </a>
                                @else
                                    {!! reklam(27)->adsense_url ?? '' !!}
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- End Main -->
@endsection
@section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src="{{ asset('/assets/frontend/js/fullCalendar.js') }}"></script>
    <script>
        $(".fc-daygrid-event-harness").mouseenter(() {
            $(this).addClass()
        })
        e.target.classlist.add('')
        }

        function upActivity(e) {
            console.log('ok');
            e.target.classlist.remove('current_activity')
        }
    </script>

    <script>
        function generateUrlSearch(cat) {
            var currentUrl = window.location.href;
            let url = new URL(currentUrl)

            if (cat) {
                let removeToBe = url.searchParams.get('category')
                //alert(removeToBe)
                if (removeToBe == null) {
                    url.searchParams.append('category', cat)
                } else {
                    url.searchParams.set('category', cat)
                }

            } else {
                url.searchParams.delete('category')
            }


            window.location = url

        }
    </script>

    <script>
        let jsonStr =
            '[{"url":"https:\/\/millimudafaa.com\/etkinlikler-detay\/9-savunma-sanayii-gunleri","title":"9. Savunma Sanayii G\u00fcnleri","start":"2021-05-17T09:00:00","end":"2021-05-18T18:00:00","color":"#db8d00"},{"url":"https:\/\/millimudafaa.com\/etkinlikler-detay\/bogazici-savunma-sanayi-zirvesi","title":"Bo\u011fazi\u00e7i Savunma Sanayi Zirvesi","start":"2022-01-08T10:00:00","end":"2022-01-09T18:00:00","color":"#db8d00"},{"url":"https:\/\/millimudafaa.com\/etkinlikler-detay\/teknofest-istanbul-havacilik-uzay-ve-teknoloji-festivali-2021","title":"TEKNOFEST \u0130stanbul Havac\u0131l\u0131k Uzay ve Teknoloji Festivali 2021","start":"2021-09-21T09:00:00","end":"2021-09-26T18:00:00","color":"#db8d00"}]';
        let jsonStrWithoutNewlines = jsonStr.replace(/[\n\r]+/g, '\\n');
        //let event_items = JSON.parse(jsonStrWithoutNewlines || null);
        //console.log(event_items)
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                initialDate: '{{ date('Y-m-d') }}',
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                selectable: false,
                events: [
                    @foreach ($events as $event)
                        {
                            id: "{{ $event->id }}".replace('\n', ''),
                            title: "{{ $event->title }}".replace('\n', ''),
                            start: "{{ $event->start_time }}".replace('\n', ''),
                            end: "{{ $event->finish_time }}".replace('\n', ''),
                            backgroundColor: '{{ $event->Category->color_code }}'.replace('\n', ''),
                            color: '{{ $event->Category->color_code }}'.replace('\n', ''),
                            url: "{{ route('front.activity.detail', $event->link) }}",
                            className: "relative".replace('\n', ''),
                        },
                    @endforeach
                ],

            });

            calendar.render();
        });
    </script>
@endsection
