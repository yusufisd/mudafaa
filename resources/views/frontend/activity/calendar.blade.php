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
                    <ol class="breadcrumb d-inline-flex">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="activity.html">
                                Etkinlikler
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="rt-text-truncate">
                                Etkinlik Takvimi
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
                            <li class="calendar_activity_category_li">
                                <a class="activity-button cat-1 category-filter" onclick="generateUrlSearch(28)"
                                    href="javascript:void(0);">Fuar</a>
                            </li>
                            <li class="calendar_activity_category_li">
                                <a class="activity-button cat-2 active category-filter" onclick="generateUrlSearch(29)"
                                    href="javascript:void(0);">Etkinlik</a>
                            </li>
                            <li class="calendar_activity_category_li">
                                <a class="activity-button cat-3 category-filter" onclick="generateUrlSearch(30)"
                                    href="javascript:void(0);">Kongre - Sempozyum</a>
                            </li>
                            <li class="calendar_activity_category_li">
                                <a class="activity-button cat-4 category-filter" onclick="generateUrlSearch(31)"
                                    href="javascript:void(0);">Sergi - Gösteri</a>
                            </li>
                            <li class="calendar_activity_category_li">
                                <a class="activity-button cat-5 category-filter" onclick="generateUrlSearch(32)"
                                    href="javascript:void(0);">Online</a>
                            </li>
                            <li class="calendar_activity_category_li">
                                <a class="activity-button cat-6 category-filter" onclick="generateUrlSearch(33)"
                                    href="javascript:void(0);">Konferans</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div id='calendar'></div>
                    </div>

                </div>
            </div>
        </div>

    </main>
    <!-- End Main -->
@endsection
@section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src="{{asset('/assets/frontend/js/fullCalendar.js')}}"></script>



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
        let event_items = JSON.parse(jsonStrWithoutNewlines || null);
        console.log(event_items)

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                initialDate: '2023-07-28',
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                editable: true,
                selectable: true,
                events: event_items,

            });

            calendar.render();
        });
    </script>
@endsection
