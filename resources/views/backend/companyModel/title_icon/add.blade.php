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
                        Firma Başlık İkon
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
        <form action="{{ route('admin.titleIcon.store') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-xl-12 mb-xl-8 ">
                            <div class="card card-flush h-xl-100 mb-xl-8 ">

                                <div class="card-body py-5">


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
                                                        class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">
                                                        İkon </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">
                                                        <!--begin::Row-->
                                                        <div class="row">
                                                            <!--begin::Col-->
                                                            <div class="col-lg-12 fv-row">
                                                                <input type="text" name="icon_tr"
                                                                    id="name_tr"
                                                                    required class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
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
                                                        class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">
                                                        {{ __('message.başlık') }} </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">
                                                        <!--begin::Row-->
                                                        <div class="row">
                                                            <!--begin::Col-->
                                                            <div class="col-lg-12 fv-row">
                                                                <input type="text" name="title_tr"
                                                                    id="name_tr"
                                                                    required class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    value="" />
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
                                                        class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">İkon</label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">
                                                        <!--begin::Row-->
                                                        <div class="row">
                                                            <!--begin::Col-->
                                                            <div class="col-lg-12 fv-row">
                                                                <input type="text" name="icon_en"
                                                                    id="name_en" 
                                                                    required class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
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
                                                        class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Başlık</label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">
                                                        <!--begin::Row-->
                                                        <div class="row">
                                                            <!--begin::Col-->
                                                            <div class="col-lg-12 fv-row">
                                                                <input type="text" name="title_en"
                                                                    id="name_en" 
                                                                    required class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
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

