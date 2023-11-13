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
                        Firma
                        {{ __('message.düzenle') }}</h1>
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
        <form action="{{ route('admin.companyModel.update', $data_tr->id) }}" method="POST" enctype="multipart/form-data">
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
                                                href="#tab_blog_category_detay">Detay</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#adresler">Adresler</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#basliklar">Başlıklar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#gorseller">Görseller</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab_blog_category_seo">Seo
                                                Bilgileri</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="TabContent_1">
                                        <div class="tab-pane fade show active" id="tab_blog_category_detay" role="tabpanel">
                                            <!--begin::Form-->
                                            <!--begin::Card body-->
                                            <div class="card-body px-3 py-9">

                                                <div style="text-align: center; margin-bottom:3%">
                                                    <img src="/{{ $data_tr->image }}"
                                                        style="width: 300px; border-radius:15px" alt="">
                                                </div>

                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">
                                                        {{ __('message.görsel') }} <span style="font-weight: normal">( 310px
                                                            - 75px)</span></label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">
                                                        <!--begin::Row-->
                                                        <div class="row">
                                                            <!--begin::Col-->
                                                            <div class="col-lg-12 fv-row">
                                                                <input type="file" name="image"
                                                                    class="form-control form-control-lg mb-lg-0 mb-3"
                                                                    value="" />
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Row-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--begin::Input group-->
                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                        <span class="required"> {{ __('message.kategori') }} </span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10 fv-row">
                                                        <select name="category" aria-label="Seçiniz" data-control="select2"
                                                            data-placeholder="Seçiniz..."
                                                            class="form-select form-select-solid form-select-lg fw-semibold">
                                                            <option value="">Seçiniz...</option>

                                                            @foreach ($categories as $item)
                                                                <option
                                                                    {{ $data_tr->category == $item->id ? 'selected' : '' }}
                                                                    value="{{ $item->id }}"> {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>


                                                <!--end::Input group-->
                                                <div class="row mb-6">
                                                    <!--begin::Tab-->
                                                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-5">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab"
                                                                href="#tab_blog_category_detail_tr">
                                                                <span>
                                                                    <img src="{{ asset('/assets/tr.png') }}" width="28"
                                                                        height="20" alt="TR" title="TR">
                                                                </span>

                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab"
                                                                href="#tab_blog_category_detail_en">
                                                                <span>
                                                                    <img src="{{ asset('/assets/en.png') }}" width="28"
                                                                        height="20" alt="EN" title="EN">
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
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
                                                                        class="col-lg-1 col-form-label required fw-bold fs-6 ps-5">
                                                                        {{ __('message.başlık') }} </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-11 fv-row">
                                                                                <input type="text" name="title_tr"
                                                                                    id="title_tr" id="title_tr"
                                                                                    onchange="create_slug_tr()"
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="{{ $data_tr->title }}" />
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
                                                                        class="col-lg-1 col-form-label fw-bold fs-6 mb-5 ps-5">
                                                                        <span>İçerik</span>
                                                                    </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11 fv-row mb-5 ps-5">

                                                                        <textarea id="editor" name="description_tr" class="tox-target ckeditor"> {{ $data_tr->description }} </textarea>


                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>

                                                            </div>
                                                            <!--end::Card body-->
                                                            <!--begin::Actions-->
                                                            <div
                                                                class="card-footer d-flex justify-content-between px-0 py-6">

                                                                <!--begin::Input group-->
                                                                <div class="row mb-0">
                                                                    <label
                                                                        class="col-lg-8 col-form-label fw-bold fs-6 ps-5">
                                                                        {{ __('message.status') }} </label>
                                                                    <div class="col-lg-4 d-flex align-items-center">
                                                                        <div
                                                                            class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                            <input class="form-check-input w-50px h-25px"
                                                                                type="checkbox" name="status_tr"
                                                                                {{ $data_tr->status == 1 ? 'checked' : '' }}
                                                                                id="allowblog_category_detail_tr" />
                                                                            <label class="form-check-label"
                                                                                for="allowblog_category_detail_tr"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end::Input group-->

                                                            </div>
                                                            <!--end::Actions-->
                                                            <!--end::Form-->
                                                        </div>
                                                        <div class="tab-pane fade" id="tab_blog_category_detail_en"
                                                            role="tabpanel">
                                                            <!--begin::Form-->
                                                            <!--begin::Card body-->
                                                            <div class="card-body px-0 py-9">
                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-1 col-form-label required fw-bold fs-6 ps-5">Başlık</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-11 fv-row">
                                                                                <input type="text" name="title_en"
                                                                                    id="title_en"
                                                                                    onchange="create_slug_en()"
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="{{ $data_en->title }}" />
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
                                                                        class="col-lg-1 col-form-label fw-bold fs-6 mb-5 ps-5">
                                                                        <span>İçerik</span>
                                                                    </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11 fv-row mb-5 ps-5">

                                                                        <textarea id="editor2" name="description_en" class="tox-target ckeditor">{{ $data_en->description }}</textarea>


                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Input group-->

                                                            </div>
                                                            <!--end::Card body-->
                                                            <!--begin::Actions-->
                                                            <div
                                                                class="card-footer d-flex justify-content-between px-0 py-6">

                                                                <!--begin::Input group-->
                                                                <div class="row mb-0">
                                                                    <label
                                                                        class="col-lg-8 col-form-label fw-bold fs-6 ps-5">
                                                                        {{ __('message.status') }} </label>
                                                                    <div class="col-lg-4 d-flex align-items-center">
                                                                        <div
                                                                            class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                            <input name="status_en"
                                                                                {{ $data_en->status == 1 ? 'checked' : '' }}
                                                                                class="form-check-input w-50px h-25px"
                                                                                type="checkbox"
                                                                                id="allowblog_category_detail_en" />
                                                                            <label class="form-check-label"
                                                                                for="allowblog_category_detail_en"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end::Input group-->


                                                            </div>
                                                            <!--end::Actions-->
                                                            <!--end::Form-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Card body-->
                                            <!--end::Form-->
                                        </div>
                                        <div class="tab-pane fade" id="tab_blog_category_seo" role="tabpanel">
                                            <!--begin::Tab-->
                                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-5">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab"
                                                        href="#tab_blog_category_seo_tr">
                                                        <span>
                                                            <img src="{{ asset('/assets/tr.png') }}" width="28"
                                                                height="20" alt="TR" title="TR">
                                                        </span>

                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab"
                                                        href="#tab_blog_category_seo_en">
                                                        <span>
                                                            <img src="{{ asset('/assets/en.png') }}" width="28"
                                                                height="20" alt="EN" title="EN">
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="TabContent_3">
                                                <div class="tab-pane fade show active" id="tab_blog_category_seo_tr"
                                                    role="tabpanel">
                                                    <!--begin::Form-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body px-3 py-9">
                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                {{ __('message.seo başlık') }} </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text" id="seo_title_tr"
                                                                            name="seo_title_tr"
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            value="{{ $data_tr->seo_title }}" />
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
                                                                class="col-lg-2 col-form-label fw-bold fs-6 ps-5">{{ __('message.seo açıklama') }}</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10 fv-row">
                                                                <textarea name="seo_description_tr" id="seo_description_tr" class="form-control form-control-lg form-control-solid">{{ $data_tr->seo_description }}</textarea>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-2 col-form-label fw-bold fs-6 ps-5">{{ __('message.seo anahtar') }}</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text" name="seo_key_tr[]"
                                                                            id="seo_key_tr"
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            value="{{ json_encode($data_tr->getKeys()) }}" />
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
                                                <div class="tab-pane fade" id="tab_blog_category_seo_en" role="tabpanel">
                                                    <!--begin::Form-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body px-3 py-9">
                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-2 col-form-label fw-bold fs-6 ps-5">{{ __('message.seo başlık') }}</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text" name="seo_title_en"
                                                                            id="seo_title_en"
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            value="{{ $data_en->seo_title }}" />
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
                                                                class="col-lg-2 col-form-label fw-bold fs-6 ps-5">{{ __('message.seo açıklama') }}</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10 fv-row">
                                                                <textarea name="seo_descriptipn_en" id="seo_description_en" class="form-control form-control-lg form-control-solid"> {{ $data_en->seo_description }} </textarea>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-2 col-form-label fw-bold fs-6 ps-5">{{ __('message.seo anahtar') }}</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text" name="seo_key_en[]"
                                                                            id="seo_key_en"
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            value="{{ json_encode($data_en->getKeys()) }}" />
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

                                        <div class="tab-pane fade container" id="basliklar" role="tabpanel"><br>

                                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-5"
                                                role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#baslik_tr"
                                                        aria-selected="false" role="tab" tabindex="-1">
                                                        <span>
                                                            <img src="https://mudafaa.test/assets/tr.png" width="28"
                                                                height="20" alt="TR" title="TR">
                                                        </span>

                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#baslik_en"
                                                        aria-selected="true" role="tab">
                                                        <span>
                                                            <img src="https://mudafaa.test/assets/en.png" width="28"
                                                                height="20" alt="EN" title="EN">
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content" id="TabContent_2_baslik">
                                                <div class="tab-pane fade active show" id="baslik_tr" role="tabpanel">




                                                    <div class="row" style="padding: 1%;margin-left:0" id="show_item">
                                                        <div class="col-md-5">
                                                            <div class="col-lg-11 fv-row">
                                                                <select name="company_title[]" class="form-select form-control-solid" id="">
                                                                    <option value="">Lütfen başlık seçin</option>
                                                                    @foreach ($title_tr as $title)
                                                                        <option value="{{ $title->id }}">{{ $title->title_tr }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-lg-11 fv-row">
                                                                <input type="text" placeholder="Açıklama"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="company_description[]" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1"
                                                            style="text-align: right;padding-right:0;padding-left:0">
                                                            <button style="width:100%" style="text-align: right"
                                                                class="btn btn-primary btn-sm add_item_buton">EKLE</button>
                                                        </div>
                                                    </div>

                                                    @if (isset($basliklar))
                                                        @foreach ($basliklar as $baslik)
                                                            <div class="row pt-10" style="margin-left:0;padding:1%"
                                                                id="show_item">
                                                                <div class="col-md-5">
                                                                    <div class="col-lg-11 fv-row">
                                                                        <select name="company_title[]" class="form-select form-control-solid" id="">
                                                                            <option value="">Lütfen başlık seçin</option>
                                                                            @foreach ($title_tr as $title)
                                                                                <option {{ $baslik->icon_title_id == $title->id ? 'selected' : '' }} value="{{ $title->id }}">{{ $title->title_tr }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="col-lg-11 fv-row">
                                                                        <input type="text" placeholder="Açıklama"
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="company_description[]" id=""  value="{{ $baslik->description }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"
                                                                    style="text-align:right;padding-right:0">
                                                                    <button style="width:100px"
                                                                        class="btn btn-danger delete_item_buton">SİL</button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="tab-pane" id="baslik_en" role="tabpanel">

                                                    <div class="row" style="padding: 1%;margin-left:0"
                                                        id="show_item_en">
                                                        <div class="col-md-5">
                                                            <div class="col-lg-11 fv-row">
                                                                <select name="company_title_en[]" class="form-select form-control-solid" id="">
                                                                    <option value="">Lütfen seçin</option>
                                                                    @foreach ($title_tr as $title)
                                                                        <option value="{{ $title->id }}">{{ $title->title_en }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-lg-11 fv-row">
                                                                <input type="text" placeholder="Açıklama"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="company_description_en[]" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1"
                                                        style="text-align: right;padding-right:0;padding-left:0">
                                                            <button style="width:100%" style="text-align: right"
                                                                class="btn btn-primary btn-sm add_item_buton_en">EKLE</button>
                                                        </div>
                                                    </div>

                                                    @if ($basliklar_en != null)
                                                        @foreach ($basliklar_en as $baslik_en)
                                                            <div class="row pt-10" style="margin-left:0; padding:1%"
                                                                id="show_item">
                                                                <div class="col-md-5">
                                                                    <div class="col-lg-11 fv-row">
                                                                        <select name="company_title_en[]" class="form-select form-control-solid" id="">
                                                                            <option value="">Lütfen seçin</option>
                                                                            @foreach ($title_tr as $title)
                                                                                <option {{ $baslik_en->icon_title_id == $title->id ? 'selected' : '' }} value="{{ $title->id }}">{{ $title->title_en }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="col-lg-11 fv-row">
                                                                        <input type="text" placeholder="Açıklama"
                                                                            value="{{ $baslik_en->description }}"
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="company_description_en[]"
                                                                            id="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"
                                                                    style="text-align:right;padding-right:0">
                                                                    <button style="width:100px"
                                                                        class="btn btn-danger delete_item_buton_en">SİL</button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade container" id="gorseller" role="tabpanel"><br>
                                            @if(count($gorseller) <= 0)
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="col-lg-11 fv-row">
                                                            <input type="file"
                                                                   class="form-control form-control-lg mb-lg-0 mb-3 w-full"
                                                                   name="gorseller_image[]" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="col-lg-11 fv-row">
                                                            <input type="number" placeholder="Sıralama"
                                                                   class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                   name="gorseller_queue[]" value="1"
                                                                   id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button style="width:90px"
                                                                class="btn btn-primary add_item_buton3">EKLE</button>
                                                    </div>
                                                </div>
                                            @endif
                                            @foreach ($gorseller as $gkey => $item)
                                                <div class="row" style="padding: 1%">
                                                    <div class="col-md-4" style="text-align:center">
                                                        <img src="/{{ $item->image }}"
                                                            style="width: 150px; border-radius:15px" alt="">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-lg-11 fv-row">
                                                            <input type="file"
                                                                class="form-control form-control-lg mb-lg-0 mb-3 w-full"
                                                                name="gorseller_image[]" id="">
                                                            <input type="hidden" name="image_id[]" value="{{ $item->id}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-lg-11 fv-row">
                                                            <input type="number" placeholder="Sıralama"
                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                name="gorseller_queue[{{ $item->id }}]" value="{{ $item->queue }}"
                                                                id="">
                                                        </div>
                                                    </div>
                                                    @if($gkey == 0)
                                                        <div class="col-md-2">
                                                            <button style="width:90px"
                                                                    class="btn btn-primary add_item_buton3">EKLE</button>
                                                        </div>
                                                    @else
                                                        <div class="col-md-2">
                                                            <button style="width:100px"
                                                                    class="btn btn-danger delete_item_buton3">SİL</button>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="tab-pane fade container" id="adresler" role="tabpanel"><br>

                                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-5"
                                                role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#adres_tr"
                                                        aria-selected="true" role="tab">
                                                        <span>
                                                            <img src="https://mudafaa.test/assets/tr.png" width="28"
                                                                height="20" alt="TR" title="TR">
                                                        </span>

                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#adres_en"
                                                        aria-selected="false" tabindex="-1" role="tab">
                                                        <span>
                                                            <img src="https://mudafaa.test/assets/en.png" width="28"
                                                                height="20" alt="EN" title="EN">
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content" id="TabContent_2">
                                                <div class="tab-pane fade active show" id="adres_tr" role="tabpanel">

                                                    <div id="show_item2">
                                                        <div style="padding:2%">
                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                    <span class=""> Başlık</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10 fv-row">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                        name="address_title[]" id="">
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>

                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                    <span class=""> Adres</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10 fv-row">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                        name="address_address[]" id="">
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                            <span class=""> Website</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="text"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_website[]" id="">
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                            <span class=""> Harita <br>
                                                                                <p
                                                                                    style="  font-weight: normal;font-size:13px;">
                                                                                    (iframe linki)</p>
                                                                            </span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="text"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_map[]" id="">
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                            <span class=""> Email</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="text"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_email[]" id="">
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                            <span class=""> Telefon </span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="number"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_phone[]" id="">
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="text-align: center" class="py-6">
                                                            <button style="width:100px" type="button"
                                                                class="btn btn-primary add_item_buton2">EKLE</button>
                                                        </div>
                                                    </div>


                                                    @if (isset($adresler))
                                                        @foreach ($adresler as $adres_tr)
                                                            <div id="show_item2">
                                                                <div style="padding:2%">
                                                                    <hr>
                                                                    <div class="row mb-6" style="margin-top:5%">
                                                                        <label
                                                                            class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                            <span class=""> Başlık</span>
                                                                        </label>
                                                                        <div class="col-lg-10 fv-row">
                                                                            <input type="text"
                                                                                value="{{ $adres_tr->title }}"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_title[]" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-6">
                                                                        <label
                                                                            class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                            <span class=""> Adres</span>
                                                                        </label>
                                                                        <div class="col-lg-10 fv-row">
                                                                            <input type="text"
                                                                                value="{{ $adres_tr->address }}"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_address[]" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="row mb-6">
                                                                                <label
                                                                                    class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                                    <span class=""> Website</span>
                                                                                </label>
                                                                                <div class="col-lg-8 fv-row">
                                                                                    <input type="text"
                                                                                        value="{{ $adres_tr->website }}"
                                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                        name="address_website[]"
                                                                                        id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row mb-6">
                                                                                <label
                                                                                    class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                                    <span class=""> Harita <br>
                                                                                        <p
                                                                                            style="  font-weight: normal;font-size:13px;">
                                                                                            (iframe linki)
                                                                                        </p>
                                                                                    </span>
                                                                                </label>
                                                                                <div class="col-lg-8 fv-row">
                                                                                    <input type="number"
                                                                                        value="{{ $adres_tr->map }}"
                                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                        name="address_map[]"
                                                                                        id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="row mb-6">
                                                                                <label
                                                                                    class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                                    <span class=""> Email</span>
                                                                                </label>
                                                                                <div class="col-lg-8 fv-row">
                                                                                    <input type="text"
                                                                                        value="{{ $adres_tr->email }}"
                                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                        name="address_email[]"
                                                                                        id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row mb-6">
                                                                                <label
                                                                                    class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                                    <span class=""> Telefon </span>
                                                                                </label>
                                                                                <div class="col-lg-8 fv-row">
                                                                                    <input type="text"
                                                                                        value="{{ $adres_tr->phone }}"
                                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                        name="address_phone[]"
                                                                                        id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="text-align: center" class="py-6">
                                                                        <button style="width:150px" type="button"
                                                                            class="btn btn-danger delete_item_buton2">SİL</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <div class="tab-pane fade" id="adres_en" role="tabpanel">
                                                    <div id="show_item2_en">
                                                        <div style="padding:2%">
                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                    <span class=""> Başlık</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10 fv-row">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                        name="address_title_en[]" id="">
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>

                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                    <span class=""> Adres</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10 fv-row">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                        name="address_address_en[]" id="">
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                            <span class=""> Website</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="text"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_website_en[]"
                                                                                id="">
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                            <span class=""> Harita <br>
                                                                                <p
                                                                                    style="  font-weight: normal;font-size:13px;">
                                                                                    (iframe linki)</p>
                                                                            </span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="text"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_map_en[]" id="">
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                            <span class=""> Email</span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="text"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_email_en[]" id="">
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                            <span class=""> Telefon </span>
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="number"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_phone_en[]" id="">
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="text-align: center" class="py-6">
                                                            <button style="width:100px" type="button"
                                                                class="btn btn-primary add_item_buton2_en">EKLE</button>
                                                        </div>
                                                    </div>

                                                    @if (isset($adresler_en))
                                                        @foreach ($adresler_en as $adres_en)
                                                            <div id="show_item2">
                                                                <div style="padding:2%">
                                                                <hr>
                                                                    <div class="row mb-6"  style="margin-top:5%">
                                                                        <label
                                                                            class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                            <span class=""> Başlık</span>
                                                                        </label>
                                                                        <div class="col-lg-10 fv-row">
                                                                            <input type="text"
                                                                                value="{{ $adres_en->title }}"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_title_en[]" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-6">
                                                                        <label
                                                                            class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                            <span class=""> Adres</span>
                                                                        </label>
                                                                        <div class="col-lg-10 fv-row">
                                                                            <input type="text"
                                                                                value="{{ $adres_en->address }}"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                name="address_address_en[]"
                                                                                id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="row mb-6">
                                                                                <label
                                                                                    class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                                    <span class=""> Website</span>
                                                                                </label>
                                                                                <div class="col-lg-8 fv-row">
                                                                                    <input type="text"
                                                                                        value="{{ $adres_en->website }}"
                                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                        name="address_website_en[]"
                                                                                        id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row mb-6">
                                                                                <label
                                                                                    class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                                    <span class=""> Harita <br>
                                                                                        <p
                                                                                            style="  font-weight: normal;font-size:13px;">
                                                                                            (iframe linki)
                                                                                        </p>
                                                                                    </span>
                                                                                </label>
                                                                                <div class="col-lg-8 fv-row">
                                                                                    <input type="number"
                                                                                        value="{{ $adres_en->map }}"
                                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                        name="address_map_en[]"
                                                                                        id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="row mb-6">
                                                                                <label
                                                                                    class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                                    <span class=""> Email</span>
                                                                                </label>
                                                                                <div class="col-lg-8 fv-row">
                                                                                    <input type="text"
                                                                                        value="{{ $adres_en->email }}"
                                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                        name="address_email_en[]"
                                                                                        id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row mb-6">
                                                                                <label
                                                                                    class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                                    <span class=""> Telefon </span>
                                                                                </label>
                                                                                <div class="col-lg-8 fv-row">
                                                                                    <input type="text"
                                                                                        value="{{ $adres_en->phone }}"
                                                                                        class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                        name="address_phone_en[]"
                                                                                        id="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="text-align: center" class="py-6">
                                                                        <button style="width:150px" type="button"
                                                                            class="btn btn-danger delete_item_buton2_en">SİL</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                    </div>
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
    <script>
        function create_slug_tr() {
            var Text = $("#title_tr").val();
            Text2 = (slug(Text));
            $("#link_tr").val(Text2);
            $("#seo_title_tr").val(Text);
        }

        function create_slug_en() {
            var Text = $("#title_en").val();
            Text2 = (slug(Text));
            $("#link_en").val(Text2);
            $("#seo_title_en").val(Text);
        }

        function create_ozet() {
            var Text = $("#add_activity_text_tr").val();
            $("#add_activity_category_seo_description_tr").val(Text);
        }

        function create_ozet_en() {
            var Text = $("#add_activity_text_en").val();
            $("#add_activity_category_seo_description_en").val(Text);
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
    </script>
    <script>
        var input1 = document.querySelector("#seo_key_tr");
        new Tagify(input1,{ maxTags:5});

        var input2 = document.querySelector("#seo_key_en");
        new Tagify(input2,{ maxTags:5});
    </script>

    <script>
        $(document).ready(function() {
            $(".add_item_buton").click(function(e) {
                e.preventDefault();
                $("#show_item").append('<div class="row pt-10"  style="margin-left:0" id="show_item">\
                                                                                                                <div class="col-md-3">\
                                                                                                                    <div class="col-lg-11 fv-row" >\
                                                                                                                        <input type="text" placeholder="İkon"\
                                                                                                                            class="form-control w-full form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                            name="company_icon[]" id="">\
                                                                                                                            <span style="color:gray">Fontawesome sitesinden alınmaldır.</span>\
                                                                                                                    </div>\
                                                                                                                </div>\
                                                                                                                <div class="col-md-4">\
                                                                                                                    <div class="col-lg-11 fv-row">\
                                                                                                                        <input type="text" placeholder="Başlık"\
                                                                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                            name="company_title[]" id="">\
                                                                                                                    </div>\
                                                                                                                </div>\
                                                                                                                <div class="col-md-4">\
                                                                                                                    <div class="col-lg-11 fv-row">\
                                                                                                                        <input type="text" placeholder="Açıklama"\
                                                                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                            name="company_description[]" id="">\
                                                                                                                    </div>\
                                                                                                                </div>\
                                                                                                                <div class="col-md-1" style="text-align:right;padding-right:0">\
                                                                                                                    <button style="width:100px" class="btn btn-danger delete_item_buton ">SİL</button>\
                                                                                                                </div>\
                                                                                                            </div>');
            });

            $(document).on('click', '.delete_item_buton', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $(".add_item_buton_en").click(function(e) {
                e.preventDefault();
                $("#show_item_en").append('<div class="row pt-10"  style="margin-left:0" id="show_item">\
                                                                                                                <div class="col-md-3">\
                                                                                                                    <div class="col-lg-11 fv-row" >\
                                                                                                                        <input type="text" placeholder="İkon"\
                                                                                                                            class="form-control w-full form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                            name="company_icon_en[]" id="">\
                                                                                                                            <span style="color:gray">Fontawesome sitesinden alınmaldır.</span>\
                                                                                                                    </div>\
                                                                                                                </div>\
                                                                                                                <div class="col-md-4">\
                                                                                                                    <div class="col-lg-11 fv-row">\
                                                                                                                        <input type="text" placeholder="Başlık"\
                                                                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                            name="company_title_en[]" id="">\
                                                                                                                    </div>\
                                                                                                                </div>\
                                                                                                                <div class="col-md-4">\
                                                                                                                    <div class="col-lg-11 fv-row">\
                                                                                                                        <input type="text" placeholder="Açıklama"\
                                                                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                            name="company_description_en[]" id="">\
                                                                                                                    </div>\
                                                                                                                </div>\
                                                                                                                <div class="col-md-1" style="text-align:right;padding-right:0">\
                                                                                                                    <button style="width:100px" class="btn btn-danger delete_item_buton_en ">SİL</button>\
                                                                                                                </div>\
                                                                                                            </div>');
            });

            $(document).on('click', '.delete_item_buton_en', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $(".add_item_buton2").click(function(e) {
                e.preventDefault();
                $("#show_item2").append('<hr><div id="show_item2">\
                                                                                                                <div style="padding:2%" >\
                                                                                                                    <div class="row mb-6">\
                                                                                                                        <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">\
                                                                                                                            <span class=""> Başlık</span>\
                                                                                                                        </label>\
                                                                                                                        <div class="col-lg-10 fv-row">\
                                                                                                                            <input type="text"\
                                                                                                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                name="address_title[]" id="">\
                                                                                                                        </div>\
                                                                                                                    </div>\
                                                                                                                    <div class="row mb-6">\
                                                                                                                        <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">\
                                                                                                                            <span class=""> Adres</span>\
                                                                                                                        </label>\
                                                                                                                        <div class="col-lg-10 fv-row">\
                                                                                                                            <input type="text"\
                                                                                                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                name="address_address[]" id="">\
                                                                                                                        </div>\
                                                                                                                    </div>\
                                                                                                                    <div class="row">\
                                                                                                                        <div class="col-md-6">\
                                                                                                                            <div class="row mb-6">\
                                                                                                                                <label class="col-lg-4 col-form-label ps-5 fw-bold fs-6">\
                                                                                                                                    <span class=""> Website</span>\
                                                                                                                                </label>\
                                                                                                                                <div class="col-lg-8 fv-row">\
                                                                                                                                    <input type="text"\
                                                                                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                        name="address_website[]" id="">\
                                                                                                                                </div>\
                                                                                                                            </div>\
                                                                                                                        </div>\
                                                                                                                        <div class="col-md-6">\
                                                                                                                            <div class="row mb-6">\
                                                                                                                                <label class="col-lg-4 col-form-label text-end ps-5 fw-bold fs-6">\
                                                                                                                                    <span class=""> Harita <br><p style="  font-weight: normal;font-size:13px;">(iframe linki)</p> </span>\
                                                                                                                                </label>\
                                                                                                                                <div class="col-lg-8 fv-row">\
                                                                                                                                    <input type="number"\
                                                                                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                        name="address_map[]" id="">\
                                                                                                                                </div>\
                                                                                                                            </div>\
                                                                                                                        </div>\
                                                                                                                    </div>\
                                                                                                                    <div class="row">\
                                                                                                                        <div class="col-md-6">\
                                                                                                                            <div class="row mb-6">\
                                                                                                                                <label class="col-lg-4 col-form-label ps-5 fw-bold fs-6">\
                                                                                                                                    <span class=""> Email</span>\
                                                                                                                                </label>\
                                                                                                                                <div class="col-lg-8 fv-row">\
                                                                                                                                    <input type="text"\
                                                                                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                        name="address_email[]" id="">\
                                                                                                                                </div>\
                                                                                                                            </div>\
                                                                                                                        </div>\
                                                                                                                        <div class="col-md-6">\
                                                                                                                            <div class="row mb-6">\
                                                                                                                                <label class="col-lg-4 col-form-label text-end ps-5 fw-bold fs-6">\
                                                                                                                                    <span class=""> Telefon </span>\
                                                                                                                                </label>\
                                                                                                                                <div class="col-lg-8 fv-row">\
                                                                                                                                    <input type="text"\
                                                                                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                        name="address_phone[]" id="">\
                                                                                                                                </div>\
                                                                                                                            </div>\
                                                                                                                        </div>\
                                                                                                                    </div>\
                                                                                                                    <div style="text-align: center" class="py-6">\
                                                                                                                        <button style="width:150px" type="button" class="btn btn-danger delete_item_buton2">SİL</button>\
                                                                                                                    </div>\
                                                                                                                </div>\
                                                                                                            </div>');
            });

            $(document).on('click', '.delete_item_buton2', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $(".add_item_buton2_en").click(function(e) {
                e.preventDefault();
                $("#show_item2_en").append('<hr><div id="show_item2">\
                                                                                                                <div style="padding:2%" >\
                                                                                                                    <div class="row mb-6">\
                                                                                                                        <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">\
                                                                                                                            <span class=""> Başlık</span>\
                                                                                                                        </label>\
                                                                                                                        <div class="col-lg-10 fv-row">\
                                                                                                                            <input type="text"\
                                                                                                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                name="address_title_en[]" id="">\
                                                                                                                        </div>\
                                                                                                                    </div>\
                                                                                                                    <div class="row mb-6">\
                                                                                                                        <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">\
                                                                                                                            <span class=""> Adres</span>\
                                                                                                                        </label>\
                                                                                                                        <div class="col-lg-10 fv-row">\
                                                                                                                            <input type="text"\
                                                                                                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                name="address_address_en[]" id="">\
                                                                                                                        </div>\
                                                                                                                    </div>\
                                                                                                                    <div class="row">\
                                                                                                                        <div class="col-md-6">\
                                                                                                                            <div class="row mb-6">\
                                                                                                                                <label class="col-lg-4 col-form-label ps-5 fw-bold fs-6">\
                                                                                                                                    <span class=""> Website</span>\
                                                                                                                                </label>\
                                                                                                                                <div class="col-lg-8 fv-row">\
                                                                                                                                    <input type="text"\
                                                                                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                        name="address_website_en[]" id="">\
                                                                                                                                </div>\
                                                                                                                            </div>\
                                                                                                                        </div>\
                                                                                                                        <div class="col-md-6">\
                                                                                                                            <div class="row mb-6">\
                                                                                                                                <label class="col-lg-4 col-form-label text-end ps-5 fw-bold fs-6">\
                                                                                                                                    <span class=""> Harita <br><p style="  font-weight: normal;font-size:13px;">(iframe linki)</p> </span>\
                                                                                                                                </label>\
                                                                                                                                <div class="col-lg-8 fv-row">\
                                                                                                                                    <input type="number"\
                                                                                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                        name="address_map_en[]" id="">\
                                                                                                                                </div>\
                                                                                                                            </div>\
                                                                                                                        </div>\
                                                                                                                    </div>\
                                                                                                                    <div class="row">\
                                                                                                                        <div class="col-md-6">\
                                                                                                                            <div class="row mb-6">\
                                                                                                                                <label class="col-lg-4 col-form-label ps-5 fw-bold fs-6">\
                                                                                                                                    <span class=""> Email</span>\
                                                                                                                                </label>\
                                                                                                                                <div class="col-lg-8 fv-row">\
                                                                                                                                    <input type="text"\
                                                                                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                        name="address_email_en[]" id="">\
                                                                                                                                </div>\
                                                                                                                            </div>\
                                                                                                                        </div>\
                                                                                                                        <div class="col-md-6">\
                                                                                                                            <div class="row mb-6">\
                                                                                                                                <label class="col-lg-4 col-form-label text-end ps-5 fw-bold fs-6">\
                                                                                                                                    <span class=""> Telefon </span>\
                                                                                                                                </label>\
                                                                                                                                <div class="col-lg-8 fv-row">\
                                                                                                                                    <input type="text"\
                                                                                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                                                                                                                        name="address_phone_en[]" id="">\
                                                                                                                                </div>\
                                                                                                                            </div>\
                                                                                                                        </div>\
                                                                                                                    </div>\
                                                                                                                    <div style="text-align: center" class="py-6">\
                                                                                                                        <button style="width:150px" type="button" class="btn btn-danger delete_item_buton2_en">SİL</button>\
                                                                                                                    </div>\
                                                                                                                </div>\
                                                                                                            </div>');
            });

            $(document).on('click', '.delete_item_buton2_en', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $(".add_item_buton3").click(function(e) {
                e.preventDefault();
                $("#gorseller").append(
                    '<div class="row pt-10" style="margin-left:0">\
                        <div class="col-md-5">\
                            <div class="col-lg-11 fv-row">\
                                <input type="file"\
                                    class="form-control w-full form-control-lg  mb-3 mb-lg-0"\
                                    name="gorseller_image[]" id="">\
                            </div>\
                        </div>\
                        <div class="col-md-5">\
                            <div class="col-lg-11 fv-row">\
                                <input type="number" placeholder="Sıralama"\
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                    name="gorseller_queue[]" id="">\
                            </div>\
                        </div>\
                        <div class="col-md-2" style="padding-right:0">\
                            <button style="width:100px" class="btn btn-danger delete_item_buton3">SİL</button>\
                        </div>\
                    </div>');
            });

            $(document).on('click', '.delete_item_buton3', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });

        });
    </script>
@endsection
