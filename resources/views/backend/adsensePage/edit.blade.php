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
                        Reklam Sayfası Düzenle </h1>
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


        <form action="{{ route('admin.adsensePageEdit.update') }}" method="POST" enctype="multipart/form-data">
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
                                        <div class="tab-pane fade show active" id="tab_activity_detay" role="tabpanel">
                                            <div class="card-body px-3 py-9">

                                                <div class="row mb-6">
                                                    <label
                                                        class="col-lg-2 col-form-label  fw-bold fs-6 ps-5">Görsel
                                                        <span style="font-weight:normal">( 1320px -
                                                            320px)</span></label>
                                                    <div class="col-lg-10">
                                                        <input type="file" class="form-control"
                                                            name="image" id="">
                                                    </div>
                                                </div>
                                               

                                                <div class="row mb-6">
                                                    <!--begin::Tab-->
                                                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 mb-5">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab"
                                                                href="#tab_activity_tr">
                                                                <span>
                                                                    <img src="{{ asset('/assets/tr.webp') }}" width="28"
                                                                        height="20" alt="TR" title="TR">
                                                                </span>

                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab"
                                                                href="#tab_activity_en">
                                                                <span>
                                                                    <img src="{{ asset('/assets/en.webp') }}" width="28"
                                                                        height="20" alt="EN" title="EN">
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
                                                                        class="col-lg-2 col-form-label  fw-bold fs-6 ps-5">Başlık</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text" name="name_tr"
                                                                                    id="name_tr"
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="{{ $data->title ?? '' }}" />
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
                                                                        class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                        {{ __('message.içerik') }} </label><br>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10 fv-row">
                                                                        <textarea id="tinymce_activity_detail_tr" name="description_tr" class="tox-target">{{ $data->description ?? '' }}</textarea>
                                                                    </div>
                                                                    <!--end::Col-->
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
                                                                        class="col-lg-2 col-form-label  fw-bold fs-6 ps-5">Başlık</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10">
                                                                        <!--begin::Row-->
                                                                        <div class="row">
                                                                            <!--begin::Col-->
                                                                            <div class="col-lg-12 fv-row">
                                                                                <input type="text" name="name_en"
                                                                                    id="name_en"
                                                                                    class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                                                    value="{{ $data_en->title ?? '' }}" />
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
                                                                        class="col-lg-2 col-form-label fw-bold fs-6 ps-5">
                                                                        {{ __('message.içerik') }} </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Col-->
                                                                    <div class="col-lg-10 fv-row">
                                                                        <textarea id="tinymce_activity_detail_en" name="description_en" class="tox-target">{{ $data_en->description ?? '' }}</textarea>
                                                                    </div>
                                                                    <!--end::Col-->
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
                plugins: "advlist autolink link image lists charmap print preview code",
                images_upload_handler: function(blobInfo, success, failure) {
                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.adsensePageEdit.content_image') }}',
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
                    "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
                ],
                plugins: "advlist autolink link image lists charmap print preview code",
                images_upload_handler: function(blobInfo, success, failure) {
                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.adsensePageEdit.content_image') }}',
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
