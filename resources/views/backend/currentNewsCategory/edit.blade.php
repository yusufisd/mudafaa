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
                        {{ __('message.güncel') }} {{ __('message.haber') }} {{ __('message.kategori') }}
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
        <form action="{{ route('admin.currentNewsCategory.update', $data_tr->id) }}" method="POST"
            enctype="multipart/form-data">
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
                                                        style="border-radius: 15px; width:300px" alt="">

                                                </div>

                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                        {{ __('message.görsel') }} </label>
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
                                                        {{ __('message.sıralama') }} </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">
                                                        <!--begin::Row-->
                                                        <div class="row">
                                                            <!--begin::Col-->
                                                            <div class="col-lg-12 fv-row">
                                                                <input type="number" name="queue"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                    value="{{ $data_tr->queue }}" />
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Row-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>

                                                <div class="row mb-6">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                        {{ __('message.renk kodu') }} </label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-10">
                                                        <!--begin::Row-->
                                                        <div class="row">
                                                            <!--begin::Col-->
                                                            <div class="col-lg-12 fv-row">
                                                                <input type="string" value="{{ $data_tr->color_code }}"
                                                                    name="color_code" placeholder="#236500"
                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3" />
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Row-->
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
                                                                                    id="title_tr"
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
                                                                        class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Url</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <input type="text"
                                                                                            name="link_tr" id="link_tr"
                                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                            value="{{ $data_tr->link }}" />
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
                                                                class="card-footer d-flex justify-content-between px-0 py-6">

                                                                <!--begin::Input group-->
                                                                <div class="row mb-0">
                                                                    <label
                                                                        class="col-lg-8 col-form-label fw-bold fs-6 ps-5">{{ __('message.status') }}</label>
                                                                    <div class="col-lg-4 d-flex align-items-center">
                                                                        <div
                                                                            class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                            <input class="form-check-input w-50px h-25px"
                                                                                type="checkbox" name="status_tr"
                                                                                id="allowblog_category_detail_tr"
                                                                                {{ $data_tr->status == 1 ? 'checked' : '' }} />
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
                                                                        class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Başlık</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
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
                                                                        class="col-lg-2 col-form-label required fw-bold fs-6 ps-5">Url</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <input type="text"
                                                                                            id="link_en" name="link_en"
                                                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                            value="{{ $data_en->link }}" />
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
                                                                class="card-footer d-flex justify-content-between px-0 py-6">

                                                                <!--begin::Input group-->
                                                                <div class="row mb-0">
                                                                    <label
                                                                        class="col-lg-8 col-form-label fw-bold fs-6 ps-5">{{ __('message.status') }}</label>
                                                                    <div class="col-lg-4 d-flex align-items-center">
                                                                        <div
                                                                            class="form-check form-check-solid form-switch form-check-custom fv-row">
                                                                            <input name="status_en"
                                                                                class="form-check-input w-50px h-25px"
                                                                                type="checkbox"
                                                                                id="allowblog_category_detail_en"
                                                                                {{ $data_en->status == 1 ? 'checked' : '' }} />
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
                                                                <textarea name="seo_description_tr" required id="seo_description_tr"
                                                                    class="form-control form-control-lg form-control-solid" value="">{{ $data_tr->seo_description }}</textarea>
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
                                                                <textarea name="seo_descriptipn_en" required id="seo_description_en"
                                                                    class="form-control form-control-lg form-control-solid" value="">{{ $data_en->seo_description }}</textarea>
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
@section('script')
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
        var input1 = document.querySelector("#seo_key_tr");
        new Tagify(input1, {
            maxTags: 5
        });

        var input2 = document.querySelector("#seo_key_en");
        new Tagify(input2, {
            maxTags: 5
        });
    </script>
@endsection
