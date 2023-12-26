@extends('backend.master')
@section('content')
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
                        {{ __('message.sosyal medya ayarları') }}</h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Back-->
                <div class="page-title d-flex flex-column justify-content-center me-3 flex-wrap">
                    <!--begin::Title-->
                    <a href="javascript:history.back()"
                        class="page-heading d-flex text-dark fw-bold fs-3 justify-content-center text-hover-success my-0">
                        <i class="fa fa-arrow-left mx-2 my-auto"></i>
                        {{ __('message.geri dön') }}
                    </a>
                    <!--end::Title-->
                </div>
                <!--end::Back-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <form action="{{ route('admin.social.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Row-->

                    @if ($errors->any())
                        @foreach ($errors->all() as $e)
                            <div class="alert alert-danger">
                                {{ $e }}
                            </div>
                        @endforeach
                    @endif

                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Header-->
                                <!--<div class="ps-12 pt-12"></div>-->
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-5">

                                    <div class="tab-content" id="TabContent_1">
                                        <div class="tab-pane fade show active" id="tab_blog_category_detay" role="tabpanel">
                                            <!--begin::Form-->
                                            <!--begin::Card body-->
                                            <div class="card-body px-3 py-9">


                                                <!--end::Input group-->
                                                <div class="row mb-6">
                                                    <!--begin::Tab-->

                                                    <div class="tab-content" id="TabContent_2">
                                                        <div class="tab-pane fade show active"
                                                            id="tab_blog_category_detail_tr" role="tabpanel">
                                                            <!--begin::Form-->
                                                            <!--begin::Card body-->
                                                            <div class="card-body px-0 py-9">



                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                        FACEBOOK </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text" name="facebook"
                                                                                    value="{{ $data->facebook ?? '' }}"
                                                                                    id="title_tr" id="title_tr"
                                                                                    placeholder="Kullanıcı adı..."
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="" />
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                        TWTİTTER </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text" name="twitter"
                                                                                    value="{{ $data->twitter ?? '' }}"
                                                                                    id="title_tr" id="title_tr"
                                                                                    placeholder="Kullanıcı adı..."
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="" />
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                        İNSTAGRAM </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text" name="instagram"
                                                                                    value="{{ $data->instagram ?? '' }}"
                                                                                    id="title_tr" id="title_tr"
                                                                                    placeholder="Kullanıcı adı..."
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="" />
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                        YOUTUBE </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text" name="youtube"
                                                                                    value="{{ $data->youtube ?? '' }}"
                                                                                    id="title_tr" id="title_tr"
                                                                                    placeholder="Kullanıcı adı..."
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="" />
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>


                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                        LINKEDIN </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text" name="linkedin"
                                                                                    value="{{ $data->linkedin ?? '' }}"
                                                                                    id="title_tr" id="title_tr"
                                                                                    placeholder="Kullanıcı adı..."
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="" />
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>


                                                            </div>

                                                        </div>

                                                        <h3>Mobil Uygulama Linkleri</h3>
                                                        <hr>
                                                        <div class="tab-pane fade show active"
                                                            id="tab_blog_category_detail_tr" role="tabpanel">
                                                            <div class="card-body px-0 py-9">
                                                                <div class="row mb-6">
                                                                    <label
                                                                        class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                        GOOGLE PLAY STORE </label>
                                                                    <div class="col-lg-10">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text"
                                                                                    name="google_play_store"
                                                                                    value="{{ $store->google ?? '' }}"
                                                                                    id="title_tr" id="title_tr"
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <label
                                                                        class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                        APP STORE </label>
                                                                    <div class="col-lg-10">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text" name="app_store"
                                                                                    value="{{ $store->ios ?? '' }}"
                                                                                    id="title_tr" id="title_tr"
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <label
                                                                        class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                        HUAWEİ STORE </label>
                                                                    <div class="col-lg-10">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text" name="huawei_store"
                                                                                    value="{{ $store->huawei ?? '' }}"
                                                                                    id="title_tr" id="title_tr"
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <h3>Google News</h3>
                                                        <hr>
                                                        <div class="card-body px-0 py-9">
                                                            <div class="row mb-6">
                                                                <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                    Google News Link </label>
                                                                <div class="col-lg-10">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 fv-row">
                                                                            <input type="text" name="google_news_link"
                                                                                value="{{ $google_news->google_news_link ?? '' }}"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                value="" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Card body-->
                                            <!--end::Form-->
                                        </div>

                                    </div>
                                    <!--end::Tab-->
                                </div>
                                <!--begin::Body-->
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <div class="right" style="text-align: right">
                        <button type="submit" class="btn btn-primary"> {{ __('message.kaydet') }} </button>
                    </div>

                </div>
                <!--end::Content container-->
            </div>

        </form>
        <!--end::Content-->
    </div>
@endsection
