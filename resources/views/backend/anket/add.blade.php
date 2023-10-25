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
                        {{ __('message.anket') }}
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
        <form action="{{ route('admin.anket.store') }}" method="POST" enctype="multipart/form-data">
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

                                                <div class="container">
                                                    <div class="row mb-10">
                                                        <div class="col-md-1">
                                                            <label
                                                            class="col-form-label required fw-bold fs-6 ps-5">
                                                            Görsel </label>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <input type="file" class="form-control" name="image" id="">
                                                        </div>
                                                    </div>
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
                                                                        {{ __('message.soru') }} </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <textarea required name="question_tr" class="form-control form-control-lg form-control-solid mb-lg-0 mb-3" id=""
                                                                                    cols="30" rows="2"></textarea>
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>


                                                                <div class="row mb-6">
                                                                    <div class="col-md-1" style="text-align: end">
                                                                        <div class="row" style="margin-top:15%">
                                                                            <div class="col-md-6">
                                                                                <input type="radio" id="answer_tr_a"
                                                                                    name="is_true" value="a"
                                                                                    style="height:20px; width:20px; vertical-align: middle;">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>A )</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <input type="text" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="answer_tr_a" for="answer_tr_a" id="">
                                                                    </div>
                                                                </div>


                                                                <div class="row mb-6">
                                                                    <div class="col-md-1" style="text-align: end">
                                                                        <div class="row" style="margin-top:15%">
                                                                            <div class="col-md-6">
                                                                                <input type="radio" id="answer_tr_b"
                                                                                    name="is_true"  value="b"
                                                                                    style="height:20px; width:20px; vertical-align: middle;">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>B )</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <input type="text" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="answer_tr_b" for="answer_tr_b" id="">
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <div class="col-md-1" style="text-align: end">
                                                                        <div class="row" style="margin-top:15%">
                                                                            <div class="col-md-6">
                                                                                <input type="radio" id="answer_tr_c"
                                                                                    name="is_true" value="c"
                                                                                    style="height:20px; width:20px; vertical-align: middle;">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>C )</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <input type="text" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="answer_tr_c" for="answer_tr_c" id="">
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <div class="col-md-1" style="text-align: end">
                                                                        <div class="row" style="margin-top:15%">
                                                                            <div class="col-md-6">
                                                                                <input type="radio" id="answer_tr_d"
                                                                                    name="is_true" value="d"
                                                                                    style="height:20px; width:20px; vertical-align: middle;">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>D )</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <input type="text" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="answer_tr_d" for="answer_tr_d" id="">
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <div class="col-md-1" style="text-align: end">
                                                                        <div class="row" style="margin-top:15%">
                                                                            <div class="col-md-6">
                                                                                <input type="radio" id="answer_tr_e"
                                                                                    name="is_true" value="e"
                                                                                    style="height:20px; width:20px; vertical-align: middle;">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>E )</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <input type="text" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="answer_tr_e" for="answer_tr_e" id="">
                                                                    </div>
                                                                </div>


                                                            </div>

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
                                                                        class="col-lg-1 col-form-label required fw-bold fs-6 ps-5">
                                                                        {{ __('message.soru') }} </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-11">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <textarea required name="question_en" class="form-control form-control-lg form-control-solid mb-lg-0 mb-3" id=""
                                                                                    cols="30" rows="2"></textarea>
                                                                            </div>
                                                                            <!--end::Col-->
                                                                        </div>
                                                                        <!--end::Row-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>


                                                                <div class="row mb-6">
                                                                    <div class="col-md-1" style="text-align: end">
                                                                        <div class="row" style="margin-top:15%">
                                                                            <div class="col-md-6">
                                                                                <input type="radio" id="is_true"
                                                                                    name="is_true_en" value="a"
                                                                                    style="height:20px; width:20px; vertical-align: middle;">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>A )</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <input type="text" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="answer_en_a" id="">
                                                                    </div>
                                                                </div>


                                                                <div class="row mb-6">
                                                                    <div class="col-md-1" style="text-align: end">
                                                                        <div class="row" style="margin-top:15%">
                                                                            <div class="col-md-6">
                                                                                <input type="radio" id="is_true"
                                                                                    name="is_true_en" value="b"
                                                                                    style="height:20px; width:20px; vertical-align: middle;">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>B )</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <input type="text" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="answer_en_b" id="">
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <div class="col-md-1" style="text-align: end">
                                                                        <div class="row" style="margin-top:15%">
                                                                            <div class="col-md-6">
                                                                                <input type="radio" id="is_true"
                                                                                    name="is_true_en" value="c"
                                                                                    style="height:20px; width:20px; vertical-align: middle;">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>C )</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <input type="text" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="answer_en_c" id="">
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <div class="col-md-1" style="text-align: end">
                                                                        <div class="row" style="margin-top:15%">
                                                                            <div class="col-md-6">
                                                                                <input type="radio" id="is_true"
                                                                                    name="is_true_en" value="d"
                                                                                    style="height:20px; width:20px; vertical-align: middle;">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>D )</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <input type="text" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="answer_en_d" id="">
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-6">
                                                                    <div class="col-md-1" style="text-align: end">
                                                                        <div class="row" style="margin-top:15%">
                                                                            <div class="col-md-6">
                                                                                <input type="radio" id="is_true"
                                                                                    name="is_true_en" value="e"
                                                                                    style="height:20px; width:20px; vertical-align: middle;">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h4>E )</h4>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <input type="text" required
                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                            name="answer_en_e" id="">
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
