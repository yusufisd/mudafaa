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
                        {{ __('message.güncel') }} {{ __('message.haber') }} {{ __('message.ekle') }} </h1>
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




        <form action="{{ route('admin.currentNews.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <!--begin::Tab-->
                                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-5">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab"
                                                href="#tab_activity_detay">Detay</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab_activity_seo">Seo
                                                Bilgileri</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="TabContent_1">
                                        <div class="tab-pane fade show active" id="tab_activity_detay" role="tabpanel">
                                            <div class="card-body px-3 py-9">

                                                <div class="row mb-6">

                                                    <div class="input">
                                                        <div class="row">
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-4">
                                                                    <label class="col-form-label fw-bold fs-6 ps-5">Görsel
                                                                        <br>
                                                                        <span style="font-weight:normal">( 960px -
                                                                            520px)</span></label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="file" class="form-control col-lg-8"
                                                                        name="image" id="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-4">
                                                                    <label class="col-form-label fw-bold fs-6 ps-5">Hikaye
                                                                        Görsel
                                                                        <br>
                                                                        <span style="font-weight:normal">( 311px -
                                                                            75px)</span></label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="file" class="form-control col-lg-8"
                                                                        name="mobil_image" id="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>






                                                <!--begin::Input group-->
                                                <div class="row mb-6">
                                                    <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                        <div class="row">
                                                            <label
                                                                class="col-lg-2 col-form-label fw-bold fs-6">Kaynak</label>
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text" name="source" id=""
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                        <div class="row ms-10">
                                                            <label class="col-lg-4 required col-form-label fw-bold fs-6">
                                                                Kategori
                                                            </label>
                                                            <div class="col-lg-8">
                                                                <div class="row">
                                                                    <div class="col-lg-12 fv-row">
                                                                        <select name="category[]" aria-label="Seçiniz"
                                                                            data-control="select2"
                                                                            data-placeholder="Seçiniz..." multiple
                                                                            class="select2-selection select2-selection--multiple form-select form-select-solid form-select-lg fw-semibold">
                                                                            <option value="">Seçiniz...</option>
                                                                            @foreach ($categories as $cat)
                                                                                <option value="{{ $cat->id }}">
                                                                                    {{ $cat->title }}
                                                                                </option>
                                                                            @endforeach


                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!--begin::Input group-->
                                                <div class="row mb-6">
                                                    <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                        <div class="row">
                                                            <label
                                                                class="col-lg-2 required col-form-label fw-bold fs-6">Yazar</label>
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-lg-12 fv-row">
                                                                        @if (Auth::guard('admin')->check())
                                                                            <select name="author" aria-label="Seçiniz"
                                                                                data-control="select2"
                                                                                data-placeholder="Seçiniz..."
                                                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                                                                <option value="">Seçiniz...</option>
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id }}">
                                                                                        {{ $user->name ?? '' }}
                                                                                        {{ $user->surname ?? '' }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        @endif
                                                                        @if (Auth::guard('user_model')->check())
                                                                            <input type="hidden" name="author"
                                                                                value="{{ AuthorUser()->id }}"
                                                                                id="">
                                                                            <select disabled name="author"
                                                                                aria-label="Seçiniz"
                                                                                data-control="select2"
                                                                                data-placeholder="Seçiniz..."
                                                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                                                                <option selected
                                                                                    value="{{ AuthorUser()->id }}">
                                                                                    {{ AuthorUser()->name }}
                                                                                    {{ AuthorUser()->surname }} </option>
                                                                            </select>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                        <div class="row ms-10">
                                                            <label
                                                                class="col-lg-4 required col-form-label fw-bold fs-6">Yayın
                                                                Tarihi</label>
                                                            <div class="col-lg-8">
                                                                <div class="row">
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="date"
                                                                            name="activity_on_location_tr" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            value="{{ substr($now, 0, 10) }}" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row mb-6">
                                                    <!--begin::Tab-->
                                                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-5">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab"
                                                                href="#tab_activity_tr">
                                                                <span>
                                                                    <img src="{{ asset('/assets/tr.webp') }}"
                                                                        width="28" height="20" alt="TR"
                                                                        title="TR">
                                                                </span>

                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab"
                                                                href="#tab_activity_en">
                                                                <span>
                                                                    <img src="{{ asset('/assets/en.webp') }}"
                                                                        width="28" height="20" alt="EN"
                                                                        title="EN">
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="TabContent_2">
                                                        <div class="tab-pane fade show active" id="tab_activity_tr"
                                                            role="tabpanel">
                                                            <!--begin::Form-->
                                                            <!--begin::Card body-->
                                                            <div class="card-body px-0 py-9">
                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-1 col-form-label fw-bold fs-6 ps-5">Başlık</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text"
                                                                                    name="activity_name_tr"
                                                                                    onchange="create_slug_tr()"
                                                                                    id="activity_name_tr" required
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="{{ old('activity_name_tr') }}" />
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-1 col-form-label fw-bold fs-6 ps-5">Özet</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11 fv-row">
                                                                        <textarea name="activity_summary_tr" id="ozet_tr" onchange="create_ozet_tr()" required
                                                                            class="form-control form-control-lg form-control-solid" value="">{{ old('activity_summary_tr') }}</textarea>
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-1 col-form-label fw-bold fs-6 mb-5 ps-5">
                                                                        <span>İçerik</span>
                                                                    </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11 fv-row mb-5 ps-5">

                                                                        <textarea id="tinymce_activity_detail_tr" name="tinymce_activity_detail_tr" class="tox-target">{{ old('tinymce_activity_detail_tr') }}</textarea>

                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>

                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-1 col-form-label fw-bold fs-6 ps-5">Url</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <input type="text"
                                                                                            name="activity_url_tr"
                                                                                            id="activity_url_tr" required
                                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                            value="{{ old('activity_url_tr') }}" />
                                                                                    </div>


                                                                                </div>
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Input group-->

                                                            </div>
                                                            <!--end::Card body-->
                                                            <!--begin::Actions-->
                                                            <div
                                                                class="card-footer row d-flex justify-content-between px-0 py-6">


                                                                <div class="col-md-4">
                                                                    <div class="row mb-0">
                                                                        <label
                                                                            class="col-lg-3 col-form-label fw-bold fs-6 ps-5">Durum</label>
                                                                        <div class="col-lg-4 d-flex align-items-center">
                                                                            <div
                                                                                class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                                <input
                                                                                    class="form-check-input w-50px h-25px"
                                                                                    type="checkbox" name="status_tr"
                                                                                    id="allowactivity_detail_tr"
                                                                                    checked="checked" />
                                                                                <label class="form-check-label"
                                                                                    for="allowactivity_detail_tr"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="row mb-0">
                                                                        <label
                                                                            class="col-lg-3 col-form-label fw-bold fs-6 ps-5">Manşet</label>
                                                                        <div class="col-lg-4 d-flex align-items-center">
                                                                            <div
                                                                                class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                                <input
                                                                                    class="form-check-input w-50px h-25px"
                                                                                    type="checkbox" name="manset_tr"
                                                                                    id="allowactivity_detail_tr" />
                                                                                <label class="form-check-label"
                                                                                    for="allowactivity_detail_tr"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="col-md-4">
                                                                    <div class="row mb-0">
                                                                        <label
                                                                            class="col-lg-4 col-form-label fw-bold fs-6 ps-5">E-mail
                                                                            gönder</label>
                                                                        <div class="col-lg-4 d-flex align-items-center">
                                                                            <div
                                                                                class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                                <input
                                                                                    class="form-check-input w-50px h-25px"
                                                                                    type="checkbox" name="send_email"
                                                                                    id="send_email" />
                                                                                <label class="form-check-label"
                                                                                    for="send_email"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="tab-pane fade" id="tab_activity_en" role="tabpanel">
                                                            <!--begin::Form-->
                                                            <!--begin::Card body-->
                                                            <div class="card-body px-0 py-9">
                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-1 col-form-label fw-bold fs-6 ps-5">Başlık</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text"
                                                                                    name="activity_name_en"
                                                                                    id="activity_name_en"
                                                                                    onchange="create_slug_en()" required
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="{{ old('activity_name_en') }}" />
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-1 col-form-label fw-bold fs-6 ps-5">Özet</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11 fv-row">
                                                                        <textarea name="activity_summary_en" id="ozet_en" onchange="create_ozet_en()" required
                                                                            class="form-control form-control-lg form-control-solid">{{ old('activity_summary_en') }}</textarea>
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-1 col-form-label fw-bold fs-6 mb-5 ps-5">
                                                                        <span>İçerik</span>
                                                                    </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11 fv-row mb-5 ps-5">
                                                                        <textarea id="tinymce_activity_detail_en" name="tinymce_activity_detail_en" class="tox-target">{{ old('tinymce_activity_detail_en') }}</textarea>
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>


                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-1 col-form-label fw-bold fs-6 ps-5">Url</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <input type="text"
                                                                                            name="activity_url_en"
                                                                                            id="activity_url_en" required
                                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                            value="{{ old('activity_url_en') }}" />
                                                                                    </div>


                                                                                </div>
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Input group-->

                                                            </div>


                                                            <div
                                                                class="card-footer row d-flex justify-content-between px-0 py-6">


                                                                <div class="col-md-4">
                                                                    <div class="row mb-0">
                                                                        <label
                                                                            class="col-lg-3 col-form-label fw-bold fs-6 ps-5">Durum</label>
                                                                        <div class="col-lg-4 d-flex align-items-center">
                                                                            <div
                                                                                class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                                <input
                                                                                    class="form-check-input w-50px h-25px"
                                                                                    type="checkbox" name="status_en"
                                                                                    id="allowactivity_detail_tr"
                                                                                    checked="checked" />
                                                                                <label class="form-check-label"
                                                                                    for="allowactivity_detail_tr"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="row mb-0">
                                                                        <label
                                                                            class="col-lg-3 col-form-label fw-bold fs-6 ps-5">Manşet</label>
                                                                        <div class="col-lg-4 d-flex align-items-center">
                                                                            <div
                                                                                class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                                <input
                                                                                    class="form-check-input w-50px h-25px"
                                                                                    type="checkbox" name="manset_en"
                                                                                    id="allowactivity_detail_tr"
                                                                                    checked="checked" />
                                                                                <label class="form-check-label"
                                                                                    for="allowactivity_detail_tr"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="col-md-4">

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Card body-->
                                            <!--end::Form-->
                                        </div>
                                        <div class="tab-pane fade" id="tab_activity_seo" role="tabpanel">
                                            <!--begin::Tab-->
                                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-5">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tab_seo_tr">
                                                        <span>
                                                            <img src="{{ asset('/assets/tr.webp') }}" width="28"
                                                                height="20" alt="TR" title="TR">
                                                        </span>

                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tab_seo_en">
                                                        <span>
                                                            <img src="{{ asset('/assets/en.webp') }}" width="28"
                                                                height="20" alt="EN" title="EN">
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="TabContent_3">
                                                <div class="tab-pane fade show active" id="tab_seo_tr" role="tabpanel">
                                                    <!--begin::Form-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body px-3 py-9">
                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
                                                                Başlığı</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text" name="activity_seo_title_tr"
                                                                            id="activity_seo_title_tr" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            value="{{ old('activity_seo_title_tr') }}" />
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
                                                                Açıklaması</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10 fv-row">
                                                                <textarea name="activity_seo_description_tr" id="seo_description_tr" required
                                                                    class="form-control form-control-lg form-control-solid" value="">{{ old('activity_seo_description_tr') }}</textarea>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
                                                                Anahtar Kelimeleri</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text"
                                                                            id="activity_seo_keywords_tr"
                                                                            name="activity_seo_keywords_tr[]" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            value="{{ old('activity_seo_keywords_tr[]') }}" />
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->

                                                    </div>
                                                    <!--end::Card body-->
                                                    <!--begin::Actions-->

                                                    <!--end::Actions-->
                                                    <!--end::Form-->
                                                </div>
                                                <div class="tab-pane fade" id="tab_seo_en" role="tabpanel">
                                                    <!--begin::Form-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body px-3 py-9">
                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
                                                                Başlığı</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text" name="activity_seo_title_en"
                                                                            id="activity_seo_title_en" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            value="{{ old('activity_seo_title_en') }}" />
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
                                                                Açıklaması</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10 fv-row">
                                                                <textarea name="activity_seo_description_en" id="seo_description_en" required
                                                                    class="form-control form-control-lg form-control-solid" value="">{{ old('activity_seo_description_en') }}</textarea>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
                                                                Anahtar Kelimeleri</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text"
                                                                            id="activity_seo_keywords_en"
                                                                            name="activity_seo_keywords_en[]" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            value="{{ old('activity_seo_keywords_en[]') }}" />
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->

                                                    </div>
                                                    <!--end::Card body-->
                                                    <!--begin::Actions-->

                                                    <!--end::Actions-->
                                                    <!--end::Form-->
                                                </div>
                                            </div>

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
    <!--end::Content wrapper-->
@endsection
@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="{{ asset('assets/backend/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/custom/tinymce/langs/tr.js') }}"></script>

    <script>
        function create_slug_tr() {
            var Text = $("#activity_name_tr").val();
            Text2 = (slug(Text));
            $("#activity_url_tr").val(Text2);
            $("#activity_seo_title_tr").val(Text);
        }

        function create_slug_en() {
            var Text = $("#activity_name_en").val();
            Text2 = (slug(Text));
            $("#activity_url_en").val(Text2);
            $("#activity_seo_title_en").val(Text);
        }

        function create_ozet_tr() {
            var Text = $("#ozet_tr").val();
            $("#seo_description_tr").val(Text);
        }

        function create_ozet_en() {
            var Text = $("#ozet_en").val();
            $("#seo_description_en").val(Text);
        }


        var slug = function(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from =
                "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆĞÍÌÎÏİŇÑÓÖÒÔÕØŘŔŠŞŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇğíìîïıňñóöòôõøðřŕšşťúůüùûýÿžþÞĐđßÆa·/_,:;";
            var to =
                "AAAAAACCCDEEEEEEEEGIIIIINNOOOOOORRSSTUUUUUYYZaaaaaacccdeeeeeeeegiiiiinnooooooorrsstuuuuuyyzbBDdBAa------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        };
        var input1 = document.querySelector("#activity_seo_keywords_tr");
        new Tagify(input1, {
            maxTags: 5
        });

        var input2 = document.querySelector("#activity_seo_keywords_en");
        new Tagify(input2, {
            maxTags: 5
        });

        $(document).ready(function() {
            tinymce.init({
                selector: "#tinymce_activity_detail_tr",
                height: "480",
                language: 'tr',
                menubar: false,
                toolbar: ["styleselect fontselect fontsizeselect",
                    "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                    "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code",
                    "table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol"

                ],
                plugins: "advlist autolink link image lists charmap print preview code table",
                images_upload_handler: function(blobInfo, success, failure) {
                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.currentNews.content_image') }}',
                        data: formData,
                        headers : { "X-CSRF-TOKEN" : "{{ csrf_token() }}"},
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            success(response.location);
                        },
                        error: function(error) {
                            failure('Görsel yüklemede hata. Daha sonra tekrar deneyin.');
                        }
                    });
                }
            });

            tinymce.init({
                selector: "#tinymce_activity_detail_en",
                height: "480",
                language: 'tr',
                menubar: false,
                toolbar: ["styleselect fontselect fontsizeselect",
                    "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                    "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code",
                    "table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol"

                ],
                plugins: "advlist autolink link image lists charmap print preview code table",
                images_upload_handler: function(blobInfo, success, failure) {
                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.currentNews.content_image') }}',
                        data: formData,
                        headers : { "X-CSRF-TOKEN" : "{{ csrf_token() }}"},
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            success(response.location);
                        },
                        error: function(error) {
                            failure('Görsel yüklemede hata. Daha sonra tekrar deneyin.');
                        }
                    });
                }
            });

        });
    </script>
    <!--end:: extra js-->
@endsection
