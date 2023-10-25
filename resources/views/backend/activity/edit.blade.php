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
                        {{ __('message.etkinlik') }}
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

        <form action="{{ route('admin.activity.update',$data_tr->id) }}" method="POST" enctype="multipart/form-data">
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
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tab_blog_detay">Detay</a>
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

                                                <div style="text-align: center; margin-bottom:5%">
                                                    <img src="/{{ $data_tr->image }}"
                                                        style="width: 20%; border-radius:15px;" alt="">
                                                </div>
                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                        {{ __('message.görsel') }} (1920px -
                                                        2880px) </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">

                                                        <input type="file" class="form-control" name="image"
                                                            accept=".png, .jpg, .jpeg" />

                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
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
                                                                    value="{{ $item->id }}"> {{ $item->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>




                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                        <span class="required"> {{ __('message.yazar') }} </span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10 fv-row">
                                                        <select name="author" aria-label="Seçiniz" data-control="select2"
                                                            data-placeholder="Seçiniz..."
                                                            class="form-select form-select-solid form-select-lg fw-semibold">
                                                            <option value="">Seçiniz...</option>

                                                            @foreach ($users as $item)
                                                                <option
                                                                    {{ $data_tr->Author->id == $item->id ? 'selected' : '' }}
                                                                    value="{{ $item->id }}"> {{ $item->name }}
                                                                    {{ $item->surname }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>

                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                        <span class="required"> Website</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10 fv-row">
                                                        <input type="text" value="{{ $data_tr->website }}"
                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                            name="website" id="">
                                                    </div>
                                                    <!--end::Col-->
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                <span class=""> Online Bilet</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <input type="text" value="{{ $data_tr->ticket_link }}"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="ticket" id="">
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                <span class=""> Katılımcı Formu</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <input type="text"
                                                                    value="{{ $data_tr->subscribe_form }}"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="user_form" id="">
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-4 col-form-label ps-5 fw-bold fs-6">
                                                                <span class="required"> Başlangıç</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-5 fv-row">
                                                                <input required type="date"
                                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                    name="start_date" value="{{ $data_tr->start_time }}" id="">
                                                            </div>
                                                            <div class="col-lg-3 fv-row">
                                                                <input required type="time"
                                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                    name="start_clock" value="{{ $data_tr->start_clock }}" id="">
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-4 col-form-label text-end ps-5 fw-bold fs-6">
                                                                <span class="required"> Bitiş</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-5 fv-row">
                                                                <input required type="date"
                                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                    name="finish_date" value="{{ $data_tr->finish_time }}" id="">
                                                            </div>
                                                            <div class="col-lg-3 fv-row">
                                                                <input required type="time"
                                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                    name="finish_clock" value="{{ $data_tr->finish_clock }}" id="">
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                <span class="required"> Ülke</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <select name="country" aria-label="Seçiniz"
                                                                    data-control="select2" data-placeholder="Seçiniz..."
                                                                    class="form-select form-select-solid form-select-lg fw-semibold">
                                                                    <option value="">Seçiniz...</option>

                                                                    @foreach ($countrylist as $item)
                                                                        <option
                                                                            {{ $data_tr->Country->id == $item->id ? 'selected' : '' }}
                                                                            value="{{ $item->id }}">
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                <span class="required"> Şehir</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <input type="text" value="{{ $data_tr->city }}"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="city" id="">
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                <span class=""> Adres</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <input type="text" value="{{ $data_tr->address }}"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="adres" id="">
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-4 col-form-label fw-bold fs-6 ps-5 text-end">
                                                                <span class=""> Harita </span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <input type="text" value="{{ $data_tr->map }}"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="map" id="">
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row mb-6">
                                                            <!--begin::Label-->
                                                            <label class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                <span class=""> Email</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <input type="text" value="{{ $data_tr->email }}"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="email" id="">
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
                                                                <input type="text" value="{{ $data_tr->phone }}"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="phone" id="">
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <!--end::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Tab-->
                                                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-5">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-bs-toggle="tab"
                                                            href="#tab_blog_tr">
                                                            <span>
                                                                <img src="{{ asset('/assets/tr.png') }}" width="28"
                                                                    height="20" alt="TR" title="TR">
                                                            </span>

                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#tab_blog_en">
                                                            <span>
                                                                <img src="{{ asset('/assets/en.png') }}" width="28"
                                                                    height="20" alt="EN" title="EN">
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
                                                                    class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Başlık</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10">
                                                                    <!--begin::Row-->
                                                                    <div class="row">
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-12 fv-row">
                                                                            <input type="text" name="name_tr"
                                                                                id="name_tr" onchange="create_slug_tr()"
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
                                                                    class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Özet</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10 fv-row">
                                                                    <textarea name="short_description_tr" id="short_description_tr" onchange="create_ozet_tr()"
                                                                        class="form-control form-control-lg form-control-solid" >{{ $data_tr->short_description }}</textarea>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-12 col-form-label fw-bold fs-6 mb-5 ps-5">
                                                                    <span>İçerik</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-12 fv-row mb-5 ps-5">

                                                                    <textarea id="editor" name="description_tr" class="tox-target ckeditor">{{ $data_tr->description }}</textarea>


                                                                </div>
                                                                <!--end::Col-->
                                                            </div>

                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Link</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10">
                                                                    <!--begin::Row-->
                                                                    <div class="row">
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-12 fv-row">
                                                                            <input type="text" name="link_tr"
                                                                                id="link_tr" onchange="create_slug_tr()"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                value="{{ $data_tr->link }}" />
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                    <!--end::Row-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>

                                                        </div>
                                                        <!--end::Card body-->
                                                        <!--begin::Actions-->
                                                        <div class="card-footer d-flex justify-content-between px-0 py-6">
                                                            <!--begin::Input group-->
                                                            <div class="row mb-0">
                                                                <label
                                                                    class="col-lg-8 col-form-label fw-bold fs-6 ps-5">Durum</label>
                                                                <div class="col-lg-4 d-flex align-items-center">
                                                                    <div
                                                                        class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                        <input class="form-check-input w-50px h-25px"
                                                                            type="checkbox" name="status_tr"
                                                                            {{ $data_tr->status == 1 ? 'checked' : '' }} />
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
                                                                    class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Başlık</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10">
                                                                    <!--begin::Row-->
                                                                    <div class="row">
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-12 fv-row">
                                                                            <input type="text" name="name_en"
                                                                                id="name_en" onchange="create_slug_en()"
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
                                                                    class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Özet</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10 fv-row">
                                                                    <textarea name="short_description_en" id="short_description_en" onchange="create_ozet_en()"
                                                                        class="form-control form-control-lg form-control-solid" >{{ $data_en->short_description }}</textarea>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-12 col-form-label fw-bold fs-6 mb-5 ps-5">
                                                                    <span>İçerik</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-12 fv-row mb-5 ps-5">

                                                                    <textarea id="editor2" name="description_en" class="tox-target ckeditor">{{ $data_en->description }}</textarea>


                                                                </div>
                                                                <!--end::Col-->
                                                            </div>

                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Link</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-10">
                                                                    <!--begin::Row-->
                                                                    <div class="row">
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-12 fv-row">
                                                                            <input type="text" name="link_en"
                                                                                id="link_en" onchange="create_slug_en()"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                value="{{ $data_en->link }}" />
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                    <!--end::Row-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>


                                                        </div>
                                                        <!--end::Card body-->
                                                        <!--begin::Actions-->
                                                        <div class="card-footer d-flex justify-content-between px-0 py-6">
                                                            <!--begin::Input group-->
                                                            <div class="row mb-0">
                                                                <label
                                                                    class="col-lg-8 col-form-label fw-bold fs-6 ps-5">Durum</label>
                                                                <div class="col-lg-4 d-flex align-items-center">
                                                                    <div
                                                                        class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                        <input class="form-check-input w-50px h-25px"
                                                                            type="checkbox" id="allowblog_detail_en"
                                                                            name="status_en"
                                                                            {{ $data_en->status == 1 ? 'selected' : '' }} />
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
                                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-5">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tab_seo_tr">
                                                        <span>
                                                            <img src="{{ asset('/assets/tr.png') }}" width="28"
                                                                height="20" alt="TR" title="TR">
                                                        </span>

                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tab_seo_en">
                                                        <span>
                                                            <img src="{{ asset('/assets/en.png') }}" width="28"
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
                                                                        <input type="text" name="seo_title_tr"
                                                                            id="seo_title_tr"
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
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
                                                                Açıklaması</label>
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
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
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
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
                                                                Açıklaması</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10 fv-row">
                                                                <textarea name="seo_description_en" id="seo_description_en" class="form-control form-control-lg form-control-solid">{{ $data_en->seo_description }}</textarea>
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
                                                                        <input type="text" id="blog_seo_keywords_en"
                                                                            name="seo_key_en[]"
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
                                    </div>

                                </div>
                                <!--end::Tab-->
                            </div>
                            <!--begin::Body-->
                        </div>
                    </div>
                    <!--end::Col-->
                    <!--end::Row-->

                    <div class="right" style="text-align: right">
                        <button class="btn btn-primary"> {{ __('message.kaydet') }} </button>
                    </div>
                </div>

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
