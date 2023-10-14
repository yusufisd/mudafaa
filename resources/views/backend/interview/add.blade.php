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
                        Röportaj
                        {{ __('message.ekle') }}</h1>
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

        <form action="{{ route('admin.interview.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Row-->

                    @if ($errors->any)
                        @foreach ($errors->all() as $e)
                            <div class="alert alert-danger">
                                {{ $e }}
                            </div>
                        @endforeach
                    @endif

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
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tab_blog_detay">Detay</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-bs-toggle="tab" href="#rop">Röportaj</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab_blog_seo">Seo Bilgileri</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="TabContent_1">
                                        <div class="tab-pane fade show active" id="tab_blog_detay" role="tabpanel">
                                            <!--begin::Form-->
                                            <!--begin::Card body-->
                                            <div class="card-body px-3 py-9">
                                                <div id="form_alert_blog_detail_tr" tabindex="0">
                                                </div>
                                                <div id="form_alert_blog_detail_en" tabindex="0">
                                                </div>
                                                <!--begin::Input group-->
                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">
                                                        {{ __('message.görsel') }} (1920px -
                                                        2880px) </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">

                                                        <input required type="file" class="form-control" name="image"
                                                            accept=".png, .jpg, .jpeg" />

                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->





                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">
                                                        <span class="required"> {{ __('message.yazar') }} </span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10 fv-row">
                                                        <select required name="author" aria-label="Seçiniz" data-control="select2"
                                                            data-placeholder="Seçiniz..."
                                                            class="form-select form-select-solid form-select-lg fw-semibold">
                                                            <option value="">Seçiniz...</option>

                                                            @foreach ($users as $item)
                                                                <option value="{{ $item->id }}"> {{ $item->name }} {{ $item->surname }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>

                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">
                                                        <span class="required"> Yayın Tarihi</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10 fv-row">
                                                        <input required type="date"
                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                            name="live_time" value="{{ substr($now,0,10) }}" id="">
                                                    </div>
                                                    <!--end::Col-->
                                                </div>


                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">
                                                        <span class=""> Youtube</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10 fv-row">
                                                        <input  type="text"
                                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                            name="youtube" id="">
                                                    </div>
                                                    <!--end::Col-->
                                                </div>






                                            </div>
                                            <!--end::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Tab-->
                                                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-bs-toggle="tab" href="#tab_blog_tr">
                                                            <span>
                                                                <img src="{{asset('/assets/tr.png')}}"
                                                                    width="28" height="20" alt="TR"
                                                                    title="TR">
                                                            </span>

                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#tab_blog_en">
                                                            <span>
                                                                <img src="{{asset('/assets/en.png')}}"
                                                                    width="28" height="20" alt="EN"
                                                                    title="EN">
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="TabContent_2">
                                                    <div class="tab-pane fade show active" id="tab_blog_tr"
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
                                                                            <input required type="text" name="name_tr"
                                                                                id="name_tr" onchange="create_slug_tr()"
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
                                                                    class="col-lg-2 col-form-label ps-5 fw-bold fs-6 required">Özet</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10 fv-row">
                                                                    <textarea required name="short_description_tr" id="short_description_tr" onchange="create_ozet_tr()"
                                                                        class="form-control form-control-lg form-control-solid" value=""></textarea>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-12 col-form-label fw-bold fs-6 mb-5 ps-5 required">
                                                                    <span>İçerik</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-12 fv-row mb-5 ps-5">

                                                                    <textarea id="editor" name="description_tr" class="tox-target ckeditor"></textarea>


                                                                </div>

                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-2 col-form-label ps-5 required fw-bold fs-6">Link</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input required type="text" name="link_tr"
                                                                                       id="link_tr" onchange="create_slug_tr()"
                                                                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                       value="" />
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>



                                                        </div>
                                                        <!--end::Card body-->
                                                        <!--begin::Actions-->
                                                        <div class="card-footer d-flex justify-content-between py-6 px-0">
                                                            <!--begin::Input group-->
                                                            <div class="row mb-0">
                                                                <label
                                                                    class="col-lg-8 col-form-label fw-bold fs-6 ps-5">Durum</label>
                                                                <div class="col-lg-4 d-flex align-items-center">
                                                                    <div
                                                                        class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                        <input class="form-check-input w-50px h-25px"
                                                                            type="checkbox" name="status_tr"
                                                                            checked="checked" />
                                                                        <label class="form-check-label"
                                                                            for="allowblog_detail_tr"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Input group-->


                                                        </div>
                                                        <!--end::Actions-->
                                                        <!--end::Form-->
                                                    </div>
                                                    <div class="tab-pane fade" id="tab_blog_en" role="tabpanel">
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
                                                                            <input required type="text" name="name_en"
                                                                                id="name_en" onchange="create_slug_en()"
                                                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
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
                                                                    class="col-lg-2 col-form-label required ps-5 fw-bold fs-6">Özet</label>

                                                                <div class="col-lg-10 fv-row">
                                                                    <textarea required name="short_description_en" id="short_description_en" onchange="create_ozet_en()"
                                                                        class="form-control form-control-lg form-control-solid" value=""></textarea>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>

                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-12 col-form-label required fw-bold fs-6 mb-5 ps-5">
                                                                    <span>İçerik</span>
                                                                </label>

                                                                <div class="col-lg-12 fv-row mb-5 ps-5">

                                                                    <textarea id="editor2" name="description_en" class="tox-target ckeditor"></textarea>


                                                                </div>

                                                                <div class="row mb-6">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="col-lg-2 col-form-label ps-5 required required fw-bold fs-6">Link</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input required type="text" name="link_en"
                                                                                       id="link_en" onchange="create_slug_en()"
                                                                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                       value="" />
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>


                                                        </div>

                                                        <div class="card-footer d-flex justify-content-between py-6 px-0">
                                                            <!--begin::Input group-->
                                                            <div class="row mb-0">
                                                                <label
                                                                    class="col-lg-8 col-form-label fw-bold fs-6 ps-5">Durum</label>
                                                                <div class="col-lg-4 d-flex align-items-center">
                                                                    <div
                                                                        class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                        <input class="form-check-input w-50px h-25px"
                                                                            type="checkbox" id="allowblog_detail_en"
                                                                            name="status_en" checked="checked" />
                                                                        <label class="form-check-label"
                                                                            for="allowblog_detail_en"></label>
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
                                        <div class="tab-pane fade" id="tab_blog_seo" role="tabpanel">
                                            <!--begin::Tab-->
                                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tab_seo_tr">
                                                        <span>
                                                            <img src="{{asset('/assets/tr.png')}}"
                                                                width="28" height="20" alt="TR"
                                                                title="TR">
                                                        </span>

                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tab_seo_en">
                                                        <span>
                                                            <img src="{{asset('/assets/en.png')}}"
                                                                width="28" height="20" alt="EN"
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
                                                                        <input type="text" name="seo_title_tr"
                                                                            id="seo_title_tr"
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
                                                                <textarea name="seo_description_tr" id="seo_description_tr" class="form-control form-control-lg form-control-solid"
                                                                    value=""></textarea>
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
                                                                        <input type="text" id="blog_seo_keywords_tr"
                                                                            name="seo_key_tr[]"
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
                                                                        <input type="text" name="seo_title_en"
                                                                            id="seo_title_en"
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
                                                                <textarea name="seo_description_en" id="seo_description_en" class="form-control form-control-lg form-control-solid"
                                                                    value=""></textarea>
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
                                                                        <input type="text" id="blog_seo_keywords_en"
                                                                            name="seo_key_en[]"
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

                                                    <!--end::Actions-->
                                                    <!--end::Form-->
                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="rop">
                                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#asd">
                                                        <span>
                                                            <img src="{{asset('/assets/tr.png')}}"
                                                                width="28" height="20" alt="TR"
                                                                title="TR">
                                                        </span>

                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#dsa">
                                                        <span>
                                                            <img src="{{asset('/assets/en.png')}}"
                                                                width="28" height="20" alt="EN"
                                                                title="EN">
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div id="asd" class="tab-pane fade show active">
                                                    <div id="show_item" >
                                                        <div class=" container"
                                                            style=" padding:2%;"
                                                             role="tabpanel">
                                                            <div class="row mb-6">
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <label
                                                                            class="col-lg-4 col-form-label ps-5 fw-bold fs-6">
                                                                            <span class="required"> Soran Kişi</span>
                                                                        </label>
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="text"
                                                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                name="soran_tr[]" id="questioner">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <label
                                                                            class="col-lg-4 col-form-label text-end ps-5 fw-bold fs-6">
                                                                            <span class="required"> Cevaplayan Kişi</span>
                                                                        </label>
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="text"
                                                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                name="cevaplayan_tr[]" id="answered">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-6">
                                                                <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">
                                                                    <span class="required"> Soru</span>
                                                                </label>
                                                                <div class="col-lg-10 fv-row">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                        name="soru_tr[]" id="">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-6">
                                                                <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">
                                                                    <span class="required"> Cevap</span>
                                                                </label>
                                                                <div class="col-lg-10 fv-row">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                        name="cevap_tr[]" id="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button"
                                                                class="btn btn-primary add_item_buton" style="margin: auto; display: flex">EKLE</button>
                                                    </div><br>

                                                    <div class="ekle" style="text-align:center">

                                                    </div>
                                                </div>
                                                <div id="dsa" class="tab-pane fade">
                                                    <div id="show_item2">
                                                        <div class=" container" role="tabpanel"
                                                            style=" padding:2%; ">
                                                            <div class="row mb-6">
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <label
                                                                            class="col-lg-4 col-form-label ps-5 fw-bold fs-6">
                                                                            <span class="required"> Soran Kişi</span>
                                                                        </label>
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="text"
                                                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                name="soran_en[]" id="questioner_en">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row mb-6">
                                                                        <label
                                                                            class="col-lg-4 col-form-label text-end ps-5 fw-bold fs-6">
                                                                            <span class="required"> Cevaplayan Kişi</span>
                                                                        </label>
                                                                        <div class="col-lg-8 fv-row">
                                                                            <input type="text"
                                                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                                name="cevaplayan_en[]" id="answered_en">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-6">
                                                                <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">
                                                                    <span class="required"> Soru</span>
                                                                </label>
                                                                <div class="col-lg-10 fv-row">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                        name="soru_en[]" id="">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-6">
                                                                <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">
                                                                    <span class="required"> Cevap</span>
                                                                </label>
                                                                <div class="col-lg-10 fv-row">
                                                                    <input type="text"
                                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                        name="cevap_en[]" id="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" style="display: flex; margin: auto"
                                                                class="btn btn-primary add_item_buton2">EKLE</button>
                                                    </div><br>

                                                    <div class="ekle" style="text-align:center">

                                                    </div>
                                                </div>
                                            </div><br>

                                        </div>
                                    </div>

                                </div>
                                <!--end::Tab-->
                            </div>
                            <!--begin::Body-->
                        </div>
                    </div>
                    <!--end::Col-->
                    <div class="right" style="text-align: right">
                        <button class="btn btn-primary"> {{ __('message.kaydet') }} </button>
                    </div>
                </div>
                <!--end::Row-->



            </div>
            <!--end::Content container-->
    </div>
    <!--end::Content-->
    </form>

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
        function create_slug_tr() {
            var Text = $("#name_tr").val();
            Text2 = (slug(Text));
            $("#link_tr").val(Text2);
            $("#seo_title_tr").val(Text);
        }

        function create_slug_en() {
            var Text = $("#name_en").val();
            Text2 = (slug(Text));
            $("#link_en").val(Text2);
            $("#seo_title_en").val(Text);
        }

        function create_ozet_tr() {
            var Text = $("#short_description_tr").val();
            $("#seo_description_tr").val(Text);
        }

        function create_ozet_en() {
            var Text = $("#short_description_en").val();
            $("#seo_description_en").val(Text);
        }



        var input1 = document.querySelector("#blog_seo_keywords_tr");
        new Tagify(input1);

        var input2 = document.querySelector("#blog_seo_keywords_en");
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
    <script>
        $(document).ready(function() {
            $(".add_item_buton").click(function(e) {
                let questioner = $("#questioner").val();
                let answered = $("#answered").val();
                e.preventDefault();
                $("#show_item").append(' <div id="show_item" class="py-12">\
                    <div class=" container" style=" padding-top:10%; padding-bottom:10%; border-top: 1px solid black; "\
                        role="tabpanel">\
                        <div class="row mb-6">\
                            <div class="col-md-6">\
                                <div class="row mb-6">\
                                    <label class="col-lg-4 col-form-label ps-5 fw-bold fs-6">\
                                        <span class="required"> Soran Kişi</span>\
                                    </label>\
                                    <div class="col-lg-8 fv-row">\
                                        <input type="text"\
                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                            name="soran_tr[]" id="" value="' + questioner + '">\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="col-md-6">\
                                <div class="row mb-6">\
                                    <label\
                                        class="col-lg-4 col-form-label text-end ps-5 fw-bold fs-6">\
                                        <span class="required"> Cevaplayan Kişi</span>\
                                    </label>\
                                    <div class="col-lg-8 fv-row">\
                                        <input type="text"\
                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                            name="cevaplayan_tr[]" id="" value="' + answered + '">\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="row mb-6">\
                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">\
                                <span class="required"> Soru</span>\
                            </label>\
                            <div class="col-lg-10 fv-row">\
                                <input type="text"\
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                    name="soru_tr[]" id="">\
                            </div>\
                        </div>\
                        <div class="row mb-6">\
                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">\
                                <span class="required"> Cevap</span>\
                            </label>\
                            <div class="col-lg-10 fv-row">\
                                <input type="text"\
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                    name="cevap_tr[]" id="">\
                            </div>\
                        </div>\
                        <div class="ekle" style="text-align:center">\
                    <button type="button"\
                        class="btn btn-danger delete_item_buton">SİL</button>\
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
            $(".add_item_buton2").click(function(e) {
                let questioner = $("#questioner_en").val();
                let answered = $("#answered_en").val();
                e.preventDefault();
                $("#show_item2").append('<div id="show_item2" class="py-12">\
                    <div  role="tabpanel" style=" padding-top:10%; padding-bottom:10%; border-top: 1px solid black;">\
                        <div class="row mb-6">\
                            <div class="col-md-6">\
                                <div class="row mb-6">\
                                    <label class="col-lg-4 col-form-label ps-5 fw-bold fs-6">\
                                        <span class="required"> Soran Kişi</span>\
                                    </label>\
                                    <div class="col-lg-8 fv-row">\
                                        <input type="text"\
                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                            name="soran_en[]" id="" value="' + questioner + '">\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="col-md-6">\
                                <div class="row mb-6">\
                                    <label\
                                        class="col-lg-4 col-form-label text-end ps-5 fw-bold fs-6">\
                                        <span class="required"> Cevaplayan Kişi</span>\
                                    </label>\
                                    <div class="col-lg-8 fv-row">\
                                        <input type="text"\
                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                            name="cevaplayan_en[]" id="" value="' + answered + '">\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="row mb-6">\
                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">\
                                <span class="required"> Soru</span>\
                            </label>\
                            <div class="col-lg-10 fv-row">\
                                <input type="text"\
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                    name="soru_en[]" id="">\
                            </div>\
                        </div>\
                        <div class="row mb-6">\
                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">\
                                <span class="required"> Cevap</span>\
                            </label>\
                            <div class="col-lg-10 fv-row">\
                                <input type="text"\
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"\
                                    name="cevap_en[]" id="">\
                            </div>\
                        </div>\
                    <div class="ekle" style="text-align:center">\
                    <button type="button"\
                        class="btn btn-danger delete_item_buton2">SİL</button>\
                    </div>\
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
    <!--end:: extra js-->
@endsection
