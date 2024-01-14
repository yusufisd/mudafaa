@extends('backend.master')
@section('content')
    <style>
        #blog_status_1:hover {
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
                        Abone {{ __('message.listesi') }} </h1>
                    <!--end::Title-->
                </div>

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
                            <!--end::Card header-->
                            <!--begin::Body-->
                            <div class="card-body pb-5 pt-0">
                                <!--begin::Table container-->
                                <div class="table-responsive with_search_table">
                                    <table id="blog_categories_table" class="gy-7 gx-7 table">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">

                                                <th style="text-align: center"> E-mail <i class="fa fa-sort ms-3"></i></th>
                                                <th style="text-align: center"> Kayıt Tarihi <i class="fa fa-sort ms-3"></i>
                                                </th>
                                                <th style="text-align: center"> Durum <i class="fa fa-sort ms-3"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subscribers as $item)
                                                <tr>
                                                    <td style="text-align: center">{{ $item->email }}</td>
                                                    <td style="text-align: center">
                                                        {{ $item->created_at->translatedFormat('d M y') }}</td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox"
                                                                id="blog_status_1" onclick="change_status({{ $item->id }})"
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
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection
@section('script')
    
    <script>
        function change_status(d) {
            window.location.href = "{{ route('admin.subscriber.change_status') }}/" + d;
        }
        // begin: DataTable Scripts
        $("#blog_categories_table").DataTable({
            "ordering": true,
            "order": [
                [0, "asc"]
            ],
            "language": {
                "sEmptyTable": "{{ __('message.Tabloda herhangi bir veri mevcut değil') }}",
                "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                "sInfoEmpty": "Kayıt yok",
                "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "Sayfada _MENU_ kayıt göster",
                "sLoadingRecords": "Yükleniyor...",
                "sProcessing": "İşleniyor...",
                "sSearch": "{{ __('message.Ara') }}:",
                "sZeroRecords": "Eşleşen kayıt bulunamadı",
                "oPaginate": {
                    "sFirst": "İlk",
                    "sLast": "Son",
                    "sNext": "{{ __('message.Sonraki') }}",
                    "sPrevious": "{{ __('message.Önceki') }}"
                },
                "oAria": {
                    "sSortAscending": ": artan sütun sıralamasını aktifleştir",
                    "sSortDescending": ": azalan sütun sıralamasını aktifleştir"
                },
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                    "searchable": false,
                    "className": "no-sort"
                }],
            },
            dom: 'Qfrtip'
        });
    </script>
@endsection
