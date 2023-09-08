@extends('backend.master')
@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-10">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-primary fw-bold fs-3 flex-column justify-content-center my-0">
                        Video {{ __('message.ekle') }} </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Back-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <a href="javascript:history.back()"
                        class="page-heading d-flex text-dark fw-bold fs-3 justify-content-center my-0 text-hover-success">
                        <i class="fa fa-arrow-left my-auto mx-2"></i>
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
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-5 mb-xl-8">
                            <div class="card card-flush h-xl-100 mb-5 mb-xl-8">
                                <!--begin::Header-->
                                <!--<div class="ps-12 pt-12"></div>-->
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Tab-->
                                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
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
                                            <!--begin::Form-->
                                            <!--begin::Card body-->
                                            <div class="card-body px-3 py-9">
                                                <!--begin::Input group-->
                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label required ps-5 fw-bold fs-6">Görsel <span style="font-weight:normal">( 960px - 520px)</span></label> 
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">
                                                        <input type="file" class="form-control" name="image"
                                                            id="">
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">
                                                        <span class="required">Kategori</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10 fv-row">
                                                        <select name="category[]" aria-label="Seçiniz"
                                                            data-control="select2" data-placeholder="Seçiniz..."
                                                            class="form-select form-select-solid form-select-lg fw-semibold"
                                                            multiple>
                                                            <option value="">Seçiniz...</option>
                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->id }}"> {{ $cat->title }}
                                                                </option>
                                                            @endforeach


                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>

                                                <!--begin::Input group-->
                                                <div class="row mb-6">

                                                    <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                        <div class="row">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-4 col-form-label fw-bold fs-6">Yazar</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <select name="author" aria-label="Seçiniz"
                                                                            data-control="select2"
                                                                            data-placeholder="Seçiniz..."
                                                                            class="form-select form-select-solid form-select-lg fw-semibold">
                                                                            <option value="">Seçiniz...</option>

                                                                            @foreach ($users as $user)
                                                                            @endforeach
                                                                            <option value="{{ $user->id }}">
                                                                                {{ $user->name ?? '' }} {{ $user->surname ?? ''}}
                                                                            </option>

                                                                        </select>
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>

                                                    </div>

                                                    <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                        <div class="row ms-10">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-4 col-form-label fw-bold fs-6">Yayın
                                                                Tarihi</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="date"
                                                                            name="activity_on_location_tr"
                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                            value="{{ substr($now,0,10) }}" />
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                                <!--end::Input group-->
                                                <div class="row mb-6">
                                                    <!--begin::Tab-->
                                                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab"
                                                                href="#tab_activity_tr">
                                                                <span>
                                                                    <img src="https://gaviapanel.gaviaworks.org/assets/images/svg/turkey.svg"
                                                                        width="28" height="28" alt="TR"
                                                                        title="TR">
                                                                </span>

                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab"
                                                                href="#tab_activity_en">
                                                                <span>
                                                                    <img src="https://gaviapanel.gaviaworks.org/assets/images/svg/england.svg"
                                                                        width="28" height="28" alt="EN"
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
                                                                        class="col-lg-2 col-form-label ps-5 required fw-bold fs-6">Başlık</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text"
                                                                                    name="activity_name_tr"
                                                                                    onchange="create_slug_tr()"
                                                                                    id="activity_name_tr"
                                                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                    value="" />
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
                                                                        class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Açıklama</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10 fv-row">
                                                                        <textarea name="activity_summary_tr" id="ozet_tr" onchange="create_ozet_tr()"
                                                                            class="form-control form-control-lg form-control-solid" value=""></textarea>
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Youtube</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text"
                                                                                    id="youtube"
                                                                                    name="youtube_tr"
                                                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                    value="" />
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
                                                                        class="col-lg-2 col-form-label ps-5 required fw-bold fs-6">Url</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <div class="row">
                                                                                    <div class="col-lg-10">
                                                                                        <input type="text"
                                                                                            name="activity_url_tr"
                                                                                            id="activity_url_tr"
                                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                            value="" />
                                                                                    </div>
                                                                                    <div class="col-lg-2">
                                                                                        <button type="submit"
                                                                                            class="btn btn-outline btn-outline-success w-100"
                                                                                            id="activity_detail_url_btn_tr">URL
                                                                                            ÜRET</button>
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
                                                            

                                                            
                                                            <!--end::Actions-->
                                                            <!--end::Form-->
                                                        </div>
                                                        <div class="tab-pane fade" id="tab_activity_en" role="tabpanel">
                                                            <!--begin::Form-->
                                                            <!--begin::Card body-->
                                                            <div class="card-body px-0 py-9">
                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-2 col-form-label ps-5 required fw-bold fs-6">Başlık</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text"
                                                                                    name="activity_name_en"
                                                                                    id="activity_name_en"
                                                                                    onchange="create_slug_en()"
                                                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                    value="" />
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
                                                                        class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Açıklama</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10 fv-row">
                                                                        <textarea name="activity_summary_en" id="ozet_en" onchange="create_ozet_en()"
                                                                            class="form-control form-control-lg form-control-solid" value=""></textarea>
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                            
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Youtube</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text"
                                                                                    id="etiket_en"
                                                                                    name="etiket_en[]"
                                                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                    value="" />
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
                                                                        class="col-lg-2 col-form-label ps-5 required fw-bold fs-6">Url</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <div class="row">
                                                                                    <div class="col-lg-10">
                                                                                        <input type="text"
                                                                                            name="activity_url_en"
                                                                                            id="activity_url_en"
                                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                            value="" />
                                                                                    </div>
                                                                                    <div class="col-lg-2">
                                                                                        <button type="submit"
                                                                                            class="btn btn-outline btn-outline-success w-100"
                                                                                            id="activity_detail_url_btn_tr">URL
                                                                                            ÜRET</button>
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
                                                            

                                                           
                                                            <!--end::Actions-->
                                                            <!--end::Form-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Card body-->
                                            <!--end::Form-->
                                        </div>
                                        <div class="tab-pane fade" id="tab_activity_seo" role="tabpanel">
                                            <!--begin::Tab-->
                                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tab_seo_tr">
                                                        <span>
                                                            <img src="https://gaviapanel.gaviaworks.org/assets/images/svg/turkey.svg"
                                                                width="28" height="28" alt="TR"
                                                                title="TR">
                                                        </span>

                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tab_seo_en">
                                                        <span>
                                                            <img src="https://gaviapanel.gaviaworks.org/assets/images/svg/england.svg"
                                                                width="28" height="28" alt="EN"
                                                                title="EN">
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
                                                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Site
                                                                Başlığı</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text" name="activity_seo_title_tr"
                                                                            id="activity_seo_title_tr"
                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                            value="" />
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
                                                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Site
                                                                Açıklaması</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10 fv-row">
                                                                <textarea name="activity_seo_description_tr" id="seo_description_tr"
                                                                    class="form-control form-control-lg form-control-solid" value=""></textarea>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Site
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
                                                                            name="activity_seo_keywords_tr"
                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                            value="" />
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
                                                    <div class="card-footer d-flex justify-content-between py-6 px-0">
                                                        <!--begin::Input group-->
                                                        <div class="row mb-0">
                                                            <label
                                                                class="col-lg-8 col-form-label fw-bold fs-6 ">Durum</label>
                                                            <div class="col-lg-4 d-flex align-items-center">
                                                                <div
                                                                    class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                    <input class="form-check-input w-50px h-25px"
                                                                        type="checkbox" id="allowactivity_seo_tr"
                                                                        checked="checked" name="seo_statu_tr" />
                                                                    <label class="form-check-label"
                                                                        for="allowactivity_seo_tr"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Input group-->

                                                    </div>
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
                                                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Site
                                                                Başlığı</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input type="text" name="activity_seo_title_en"
                                                                            id="activity_seo_title_en"
                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                            value="" />
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
                                                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Site
                                                                Açıklaması</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10 fv-row">
                                                                <textarea name="activity_seo_description_en" id="seo_description_en"
                                                                    class="form-control form-control-lg form-control-solid" value=""></textarea>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Site
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
                                                                            name="activity_seo_keywords_en"
                                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                            value="" />
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
                                                    <div class="card-footer d-flex justify-content-between py-6 px-0">

                                                        <!--begin::Input group-->
                                                        <div class="row mb-0">
                                                            <label
                                                                class="col-lg-8 col-form-label fw-bold fs-6 ">Durum</label>
                                                            <div class="col-lg-4 d-flex align-items-center">
                                                                <div
                                                                    class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                    <input class="form-check-input w-50px h-25px"
                                                                        type="checkbox" id="allowactivity_seo_en"
                                                                        checked="checked" name="seo_statu_en" />
                                                                    <label class="form-check-label"
                                                                        for="allowactivity_seo_en"></label>
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
                                    <!--end::Tab-->
                                </div>
                                <!--begin::Body-->
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <div class="right " style="text-align: right">
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
    <!--begin:: extra js-->
    <script src="../assets/plugins/global/plugins.bundle.js"></script>
    <script src="../assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    <script src="../assets/plugins/custom/tinymce/langs/tr.js"></script>

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
        new Tagify(input1);

        var input2 = document.querySelector("#activity_seo_keywords_en");
        new Tagify(input2);

        var input3 = document.querySelector("#etiket_tr");
        new Tagify(input3);

        var input4 = document.querySelector("#etiket_en");
        new Tagify(input4);

        $(document).ready(function() {
            tinymce.init({
                selector: "#tinymce_activity_detail_tr",
                height: "480",
                language: 'tr',
                menubar: false,
                toolbar: ["styleselect fontselect fontsizeselect",
                    "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                    "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
                ],
                plugins: "advlist autolink link image lists charmap print preview code"
            });

            tinymce.init({
                selector: "#tinymce_activity_detail_en",
                height: "480",
                language: 'tr',
                menubar: false,
                toolbar: ["styleselect fontselect fontsizeselect",
                    "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                    "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
                ],
                plugins: "advlist autolink link image lists charmap print preview code"
            });

        });
    </script>
    <!--end:: extra js-->
@endsection
