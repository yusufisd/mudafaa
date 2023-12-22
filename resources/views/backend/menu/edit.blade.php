@extends('backend.master')
@section('content')
<style>
    #headline,
    #status {
        cursor: pointer;
    }
</style>
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
                        Menü Yönetimi
                    </h1>
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

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">

                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <!--begin::Col-->
                    <div class="col-xl-12 mb-xl-8 mb-5">
                        <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-6">
                                <!--begin::Card toolbar-->
                             


                            </div>
                            <!--end::Card header-->
                            <!--begin::Body-->
                            <div class="card-body pt-0">
                                <!--begin::Table container-->
                                <div class="table-responsive with_search_table pt-12 px-12">
                                    <table id="blog_categories_table" class="gy-7 gx-7 table">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                
                                                <th style="width:100px"> Sıra <i class="fa fa-sort ms-3"></i></th>
                                                <th> {{ __('message.başlık') }} <i class="fa fa-sort ms-3"></i></th>
                                                <th class="pe-7">{{ __('message.durum') }}<i class="fa fa-sort ms-3"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)
                                            <tr style="font-size:15px">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->menu_id == 1 ? 'Güncel Haberler' : ($item->menu_id == 2 ? 'Savunma Sanayi' : ($item->menu_id == 3 ? 'Etkinlikler' : ($item->menu_id == 4 ? 'Röportajlar' : ($item->menu_id == 5 ? 'Firmalar' : ($item->menu_id == 6 ? 'SS Sözlüğü' : ($item->menu_id == 7 ? 'Videolar' : '-')))))) }}</td>
                                                <td>
                                                    <div
                                                        class="form-check form-check-solid form-switch form-check-custom fv-row ">
                                                        <input class="form-check-input w-50px h-25px" type="checkbox"
                                                            id="status"
                                                            onchange="change_status({{ $item->menu_id }})"
                                                            {{ $item->status == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="blog_status_1"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

            </div>
            <!--end::Content container-->
        </div>
    </div>
    <!--end::Content-->
    </form>

    </div>
    <!--end::Content wrapper-->
@endsection
@section('script')
    <!--begin:: extra js-->
    <script src="../assets/plugins/global/plugins.bundle.js"></script>
    <script src="../assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    <script src="../assets/plugins/custom/tinymce/langs/tr.js"></script>

    <script>
        function change_status(d) {
            window.location.href = "{{ route('admin.menu.change_status') }}/" + d;
        }
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
