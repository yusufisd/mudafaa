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
                        {{ __('message.ülke') }} {{ __('message.düzenle') }}</h1>
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
        <form action="{{ route('admin.country.update',$data->id) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-xl-12 mb-5 mb-xl-8">
                            <div class="card card-flush h-xl-100 mb-5 mb-xl-8">
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


                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 required col-form-label ps-5 fw-bold fs-6">
                                                        {{ __('message.isim') }} </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">
                                                        <!--begin::Row-->
                                                        <div class="row">
                                                            <!--begin::Col-->
                                                            <div class="col-lg-12 fv-row">
                                                                <input type="text" name="name"
                                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                    value="{{$data->name}}" />
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Row-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>

                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label required ps-5 fw-bold fs-6">
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
                                                                    class="form-control form-control-lg  mb-3 mb-lg-0"
                                                                    value="" />
                                                            </div>
                                                            <!--end::Col-->
                                                        </div><br>

                                                        <div class="row">
                                                            <img src="/{{$data->image}}" style="width: 25%; border-radius:8%" alt="">
                                                        </div>
                                                        <!--end::Row-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--begin::Input group-->
                                                

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