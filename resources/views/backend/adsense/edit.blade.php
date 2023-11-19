@extends('backend.master')
@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar py-lg-10 py-3">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center me-3 flex-wrap">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-primary fw-bold fs-3 flex-column justify-content-center my-0">
                            Reklam Düzenle</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Back-->
                    <div class="page-title d-flex flex-column justify-content-center me-3 flex-wrap">
                        <!--begin::Title-->
                        <a href="javascript:history.back()"
                            class="page-heading d-flex text-dark fw-bold fs-3 justify-content-center text-hover-success my-0">
                            <i class="fa fa-arrow-left mx-2 my-auto"></i>
                            Geri Dön
                        </a>
                        <!--end::Title-->
                    </div>
                    <!--end::Back-->
                </div>
                <!--end::Toolbar container-->
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $e)
                    <div class="alert alert-danger">
                        {{ $e }}
                    </div>
                @endforeach
            @endif

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Header-->
                                <!--<div class="ps-12 pt-12"></div>-->
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Form-->
                                    <form method="POST" enctype="multipart/form-data"
                                        action="{{ route('admin.adsense.store') }}" id="add_ad_form" class="form">
                                        @csrf
                                        <!--begin::Card body-->
                                        <div class="card-body px-0 py-9">

                                            @if ($data->type == 0)
                                                <div id="google_ads_content">

                                                    <img src="/{{ $data->image }}" alt="">

                                                    <div class="row mb-6">
                                                        <label
                                                            class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Reklam
                                                            Adı</label>
                                                        <div class="col-lg-10">
                                                            <div class="row">
                                                                <div class="col-lg-12 fv-row">
                                                                    <input type="text" value="{{ $data->title }}" name="ad_name"
                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                        value="" />
                                                                    <input type="hidden" name="type" value="0" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Reklam
                                                            Açıklaması</label>
                                                        <div class="col-lg-10">
                                                            <div class="row">
                                                                <div class="col-lg-12 fv-row">
                                                                    <textarea name="ad_explanation" class="form-control form-control-lg form-control-solid" value="">{{ $data->description }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label
                                                            class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Google
                                                            Adsense Kodu</label>
                                                        <div class="col-lg-10">
                                                            <div class="row">
                                                                <div class="col-lg-12 fv-row">
                                                                    <textarea name="ad_google_adsense_code" class="form-control form-control-lg form-control-solid" value="">{{ $data->adsense_url }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="separator my-10"></div>
                                                    <div class="row mb-6">
                                                        <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                            <div class="row">
                                                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                                                    Yayın Başlangıç <br>Tarihi
                                                                    </label>
                                                                <div class="col-lg-8">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="date" value="{{ $data->start }}" name="start_date"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                            <div class="row ms-10">
                                                                <label class="col-lg-4 col-form-label fw-bold fs-6"
                                                                    style="padding-top: 0px;">Yayın Bitiş <br> Tarihi
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="date" value="{{ $data->finish }}" name="finish_date"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($data->type == 1)
                                                <div id="sponsered_ads_content">
                                                    <div class="row mb-6">
                                                        <label
                                                            class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Reklam
                                                            Adı</label>
                                                        <div class="col-lg-10">
                                                            <div class="row">
                                                                <div class="col-lg-12 fv-row">
                                                                    <input type="text" value="{{ $data->title }}" name="ad_name"
                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                        value="" />
                                                                    <input type="hidden" name="type"
                                                                        value="1" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Reklam
                                                            Açıklaması</label>
                                                        <div class="col-lg-10">
                                                            <div class="row">
                                                                <div class="col-lg-12 fv-row">
                                                                    <textarea name="ad_explanation" class="form-control form-control-lg form-control-solid" value="">{{ $data->description }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label
                                                            class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Url</label>
                                                        <div class="col-lg-10">
                                                            <div class="row">
                                                                <div class="col-lg-12 fv-row">
                                                                    <input type="text" name="ad_url"
                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                        value="{{ $data->adsense_url }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5"></label>
                                                        <div class="col-lg-10 fv-row">
                                                            <div class="d-flex align-items-center mt-3">
                                                                <label
                                                                    class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                                                    <input class="form-check-input"
                                                                        name="ad_view_status[]" type="radio"
                                                                        value="1" />
                                                                    <span class="fw-semibold fs-6 ps-2">Aynı Sekmede
                                                                        Göster</span>
                                                                    </label>
                                                                <label
                                                                    class="form-check form-check-custom form-check-inline form-check-solid">
                                                                    <input class="form-check-input"
                                                                        name="ad_view_status[]" type="radio"
                                                                        value="2" checked />
                                                                    <span class="fw-semibold fs-6 ps-2">Yeni Sekmede
                                                                        Göster </span>
                                                                    </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Reklam
                                                            Görseli</label>
                                                        <div class="col-lg-10">
                                                            <input type="file" name="image" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="separator my-10"></div>
                                                    <div class="row mb-6">
                                                        <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                            <div class="row">
                                                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                                                    Yayın Başlangıç <br>Tarihi
                                                                    </label>
                                                                <div class="col-lg-8">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="date" name="start_date"
                                                                                class="form-control" value="{{ $data->start }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                            <div class="row ms-10">
                                                                <label class="col-lg-4 col-form-label fw-bold fs-6"
                                                                    style="padding-top: 0px;">Yayın Bitiş <br>
                                                                    Tarihi</label>
                                                                <div class="col-lg-8">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="date" name="finish_date"
                                                                                class="form-control" value="{{ $data->finish }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        <!--end::Card body-->
                                        <!--begin::Actions-->
                                        <div id="card_action"
                                            class="card-footer d-flex justify-content-between px-0 py-6"></div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->

                                </div>
                                <!--begin::Body-->
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>

    </div>
    <!--end:::Main-->
@endsection
@section('script')
    <!--begin:: extra js-->
    <script>
        $(document).ready(function() {

            var selectedOption;

            $('select').on('change', function(e) {
                e.preventDefault();
                $("#google_ads_content").html("");
                $("#sponsered_ads_content").html("");
                $("#card_action").html("");

                selectedOption = $(this).val();

                if (selectedOption === 'google_ads') {


                );



                $("#card_action").append( <
                    div class = "row mb-0" > ' + <
                    label class = "col-lg-8 col-form-label fw-bold fs-6 ps-5" > Durum < /label>' + <
                    div class = "col-lg-4 d-flex align-items-center" > ' + <
                    div class = "form-check form-check-solid form-switch form-check-custom fv-row" >
                    ' + <
                    input class = "form-check-input w-50px h-25px"
                    type = "checkbox"
                    id = "allowactivity_add_ad"
                    checked = "checked" / > ' + <
                    label class = "form-check-label"
                    for = "allow_add_ad" > < /label>' + <
                    /div> + <
                    /div> + <
                    /div> +
                    '<button type="submit" class="btn btn-outline btn-outline-success" id="btn_submit_add_ad"><i class="fa-solid fa-check ps-1"></i> KAYDET</button>'
                );

                if (document.getElementById("add_ad_google_start_calendar")) {
                    new tempusDominus.TempusDominus(document.getElementById(
                        "add_ad_google_start_calendar"), {
                        display: {
                            icons: {
                                time: "bi bi-clock-fill fs-1",
                                date: "bi bi-calendar2-week-fill fs-1",
                                up: "bi bi-chevron-up fs-1",
                                down: "bi bi-chevron-down fs-1",
                                previous: "bi bi-chevron-left fs-1",
                                next: "bi bi-chevron-right fs-1",
                                today: "bi bi-calendar-check-fill fs-1",
                                clear: "bi bi-trash-fill fs-1",
                                close: "bi bi-x-circle-fill fs-1",
                            },
                            buttons: {
                                today: true,
                                clear: true,
                                close: true,
                            },
                        }
                    });

                    new tempusDominus.TempusDominus(document.getElementById("add_ad_google_end_calendar"), {
                        display: {
                            icons: {
                                time: "bi bi-clock-fill fs-1",
                                date: "bi bi-calendar2-week-fill fs-1",
                                up: "bi bi-chevron-up fs-1",
                                down: "bi bi-chevron-down fs-1",
                                previous: "bi bi-chevron-left fs-1",
                                next: "bi bi-chevron-right fs-1",
                                today: "bi bi-calendar-check-fill fs-1",
                                clear: "bi bi-trash-fill fs-1",
                                close: "bi bi-x-circle-fill fs-1",
                            },
                            buttons: {
                                today: true,
                                clear: true,
                                close: true,
                            },
                        }
                    });

                } else {
                    new tempusDominus.TempusDominus(document.getElementById(
                        "add_ad_sponsered_start_calendar"), {
                        display: {
                            icons: {
                                time: "bi bi-clock-fill fs-1",
                                date: "bi bi-calendar2-week-fill fs-1",
                                up: "bi bi-chevron-up fs-1",
                                down: "bi bi-chevron-down fs-1",
                                previous: "bi bi-chevron-left fs-1",
                                next: "bi bi-chevron-right fs-1",
                                today: "bi bi-calendar-check-fill fs-1",
                                clear: "bi bi-trash-fill fs-1",
                                close: "bi bi-x-circle-fill fs-1",
                            },
                            buttons: {
                                today: true,
                                clear: true,
                                close: true,
                            },
                        }
                    });

                    new tempusDominus.TempusDominus(document.getElementById(
                        "add_ad_sponsered_end_calendar"), {
                        display: {
                            icons: {
                                time: "bi bi-clock-fill fs-1",
                                date: "bi bi-calendar2-week-fill fs-1",
                                up: "bi bi-chevron-up fs-1",
                                down: "bi bi-chevron-down fs-1",
                                previous: "bi bi-chevron-left fs-1",
                                next: "bi bi-chevron-right fs-1",
                                today: "bi bi-calendar-check-fill fs-1",
                                clear: "bi bi-trash-fill fs-1",
                                close: "bi bi-x-circle-fill fs-1",
                            },
                            buttons: {
                                today: true,
                                clear: true,
                                close: true,
                            },
                        }
                    });

                }


            });

        });
    </script>
    <!--end:: extra js-->
@endsection
