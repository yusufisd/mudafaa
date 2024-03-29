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
                        {{ __('message.ekle') }}</h1>
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

        <form action="{{ route('admin.activity.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="required col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                        {{ __('message.görsel') }} <br>
                                                        <span style="font-weight: normal">(1920px - 2880px)</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">

                                                        <input type="file" class="form-control" name="image"
                                                            accept=".png, .jpg, .jpeg, .webp" />

                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row mb-6">
                                                    <!--begin::Label-->

                                                    <!--end::Col-->
                                                </div>




                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">
                                                        <div class="row">
                                                            <label class="col-lg-4 col-form-label fw-bold fs-6 ps-5">
                                                                <span class="required"> {{ __('message.kategori') }} </span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <select name="category" aria-label="Seçiniz"
                                                                    data-control="select2" data-placeholder="Seçiniz..."
                                                                    class="form-select form-select-solid form-select-lg fw-semibold">
                                                                    <option value="">Seçiniz...</option>

                                                                    @foreach ($categories as $item)
                                                                        <option @selected(old('category') == $item->id)
                                                                            value="{{ $item->id }}"> {{ $item->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">

                                                        <div class="row">
                                                            <!--begin::Label-->
                                                            <label
                                                                class="col-lg-2 col-form-label fw-bold fs-6">Yazar</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
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
                                                                                aria-label="Seçiniz" data-control="select2"
                                                                                data-placeholder="Seçiniz..."
                                                                                class="form-select form-select-solid form-select-lg fw-semibold">
                                                                                <option selected
                                                                                    value="{{ AuthorUser()->id }}">
                                                                                    {{ AuthorUser()->name }}
                                                                                    {{ AuthorUser()->surname }} </option>
                                                                            </select>
                                                                        @endif

                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>

                                                    </div>
                                                    <!--end::Col-->
                                                </div>

                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                        <span class=""> Website</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10 fv-row">
                                                        <input type="text" value="{{ old('website') }}"
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
                                                                <input type="text"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="ticket" value="{{ old('ticket') }}"
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
                                                                <span class=""> Katılımcı Formu</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <input type="text"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="user_form" value="{{ old('user_form') }}"
                                                                    id="">
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
                                                                <span class=""> Başlangıç</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-5 fv-row">
                                                                <input type="date"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="start_date" value="{{ old('start_date') }}"
                                                                    id="">
                                                            </div>
                                                            <div class="col-lg-3 fv-row">
                                                                <input type="time"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="start_clock" value="{{ old('start_clock') }}"
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
                                                                <span class=""> Bitiş</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-5 fv-row">
                                                                <input type="date"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="finish_date" value="{{ old('finish_date') }}"
                                                                    id="">
                                                            </div>
                                                            <div class="col-lg-3 fv-row">
                                                                <input type="time"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="finish_clock" value="{{ old('finish_clock') }}"
                                                                    id="">
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
                                                                <span class=""> Ülke</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <select name="country" aria-label="Seçiniz"
                                                                    data-control="select2" data-placeholder="Seçiniz..."
                                                                    class="form-select form-select-solid form-select-lg fw-semibold">
                                                                    <option value="">Seçiniz...</option>

                                                                    @foreach ($countrylist as $item)
                                                                        <option @selected(old('country') == $item->id)
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
                                                                <span class=""> Şehir</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <input type="text"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="city" value="{{ old('city') }}"
                                                                    id="">
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
                                                                <input type="text"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="adres" value="{{ old('adres') }}"
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
                                                                <span class=""> Harita </span><br>
                                                                <span style="font-size: 14px; font-weight:normal">(iFrame
                                                                    ekleyiniz)</span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <input type="text"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="map" {{ old('map') }} id="">
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
                                                                <input type="text"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="email" value="{{ old('email') }}"
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
                                                                <span class=""> Telefon </span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-8 fv-row">
                                                                <input type="text"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    name="phone" value="{{ old('phone') }}"
                                                                    id="">
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
                                                                <img src="{{ asset('/assets/tr.webp') }}" width="28"
                                                                    height="20" alt="TR" title="TR">
                                                            </span>

                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#tab_blog_en">
                                                            <span>
                                                                <img src="{{ asset('/assets/en.webp') }}" width="28"
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
                                                                    class="col-lg-1 col-form-label required fw-bold fs-6 ps-5">Başlık</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-11">
                                                                    <!--begin::Row-->
                                                                    <div class="row">
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-12 fv-row">
                                                                            <input required type="text" name="name_tr"
                                                                                id="name_tr" onchange="create_slug_tr()"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                value="{{ old('name_tr') }}" />
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
                                                                    class="col-lg-1 col-form-label fw-bold fs-6 required ps-5">Özet</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-11 fv-row">
                                                                    <textarea name="short_description_tr" id="short_description_tr" onchange="create_ozet_tr()"
                                                                        class="form-control form-control-lg form-control-solid" value="">{{ old('short_description_tr') }}</textarea>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-1 col-form-label fw-bold fs-6 required mb-5 ps-5">
                                                                    <span>İçerik</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-11 fv-row mb-5 ps-5">

                                                                    <textarea id="tinymce_activity_detail_tr" name="description_tr" class="tox-target">{{ old('description_tr') }}</textarea>

                                                                </div>
                                                                <!--end::Col-->
                                                            </div>

                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-1 col-form-label required fw-bold fs-6 ps-5">Link</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-11">
                                                                    <!--begin::Row-->
                                                                    <div class="row">
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-12 fv-row">
                                                                            <input required type="text" name="link_tr"
                                                                                id="link_tr" onchange="create_slug_tr()"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                value="{{ old('link_tr') }}" />
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
                                                                    class="col-lg-1 col-form-label required fw-bold fs-6 ps-5">Başlık</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-11">
                                                                    <!--begin::Row-->
                                                                    <div class="row">
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-12 fv-row">
                                                                            <input required type="text" name="name_en"
                                                                                id="name_en" onchange="create_slug_en()"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                value="{{ old('name_en') }}" />
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
                                                                    class="col-lg-1 col-form-label fw-bold fs-6 required ps-5">Özet</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-11 fv-row">
                                                                    <textarea name="short_description_en" id="short_description_en" onchange="create_ozet_en()"
                                                                        class="form-control form-control-lg form-control-solid" value="">{{ old('short_description_en') }}</textarea>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-1 col-form-label fw-bold fs-6 required mb-5 ps-5">
                                                                    <span>İçerik</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-11 fv-row mb-5 ps-5">

                                                                    <textarea id="tinymce_activity_detail_en" name="description_en" class="tox-target">{{ old('description_en') }}</textarea>

                                                                </div>
                                                                <!--end::Col-->
                                                            </div>

                                                            <div class="row mb-6">
                                                                <!--begin::Label-->
                                                                <label
                                                                    class="col-lg-1 col-form-label required fw-bold fs-6 ps-5">Link</label>
                                                                <!--end::Label-->
                                                                <!--begin::Col-->
                                                                <div class="col-lg-11">
                                                                    <!--begin::Row-->
                                                                    <div class="row">
                                                                        <!--begin::Col-->
                                                                        <div class="col-lg-12 fv-row">
                                                                            <input required type="text" name="link_en"
                                                                                id="link_en" onchange="create_slug_en()"
                                                                                class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                value="{{ old('link_en') }}" />
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
                                                                        <input required type="text" name="seo_title_tr"
                                                                            id="seo_title_tr"
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            value="{{ old('seo_title_tr') }}" />
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
                                                                <textarea name="seo_description_tr" id="seo_description_tr" class="form-control form-control-lg form-control-solid"
                                                                    value=""></textarea>
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
                                                                        <input required type="text"
                                                                            id="blog_seo_keywords_tr" name="seo_key_tr[]"
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
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
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
                                                                Başlığı</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input required type="text" name="seo_title_en"
                                                                            id="seo_title_en"
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
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
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
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
                                                            <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">Site
                                                                Anahtar Kelimeleri</label>
                                                            <!--end::Label-->
                                                            <!--begin::Col-->
                                                            <div class="col-lg-10">
                                                                <!--begin::Row-->
                                                                <div class="row">
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-12 fv-row">
                                                                        <input required type="text"
                                                                            id="blog_seo_keywords_en" name="seo_key_en[]"
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
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

    <script src="{{ asset('assets/backend/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/custom/tinymce/langs/tr.js') }}"></script>

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
        new Tagify(input1, {
            maxTags: 5
        });

        var input2 = document.querySelector("#blog_seo_keywords_en");
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
                        url: '{{ route('admin.activity.content_image') }}',
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
                        url: '{{ route('admin.activity.content_image') }}',
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
