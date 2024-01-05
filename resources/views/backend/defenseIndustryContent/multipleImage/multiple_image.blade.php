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
                        {{ __('message.içerik') }} {{ __('message.görsel') }} </h1>
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


                        <form action="{{ route('admin.defenseIndustryContent.multipleImage_store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $id }}" name="id" id="">

                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                @if ($data)
                                    @foreach ($data as $key => $item)
                                        <div class="image row" style="text-align: center;margin-top:3%;">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <img src="/{{ $item }}" style="width:250px; border-radius:5%"
                                                alt="">
                                                <input type="hidden" name="previousData[]" value="{{ $item }}" id="">
                                            </div>
                                            <div class="buton col-md-3" style="padding:3%">
                                                <button type="button" class="btn btn-danger btn-sm delete_item_buton"
                                                    style="width: 150px">SİL</button>
                                            </div>
                                            <hr style="margin-top:3%; color:gray">
                                        </div>
                                    @endforeach
                                @endif





                                <div class="card-body mt-10 pb-5 pt-0" id="show_item">

                                    <div class="image row" style="text-align: center;margin-top:2%;margin-bottom:2%">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" name="image[]" id="">
                                        </div>
                                        <div class="buton col-md-3">
                                            <button type="button" class="btn btn-success btn-sm add_item_buton"
                                                style="width: 150px">EKLE</button>
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <div class="right" style="text-align: right">
                                <button type="submit" class="btn btn-primary"> {{ __('message.kaydet') }} </button>
                            </div>
                        </form>


                        {{-- <div class="card card-flush h-xl-100 mb-xl-8 mb-5">

                            <div class="card-header border-0 pt-6">
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                        <!--begin::Add user-->
                                        <a type="button" class="btn btn-outline btn-outline-success"
                                            href="{{ route('admin.defenseIndustryContent.multipleImage_add', $id) }}">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                        rx="1" transform="rotate(-90 11.364 20.364)"
                                                        fill="currentColor" />
                                                    <rect x="4.36396" y="11.364" width="16" height="2"
                                                        rx="1" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon--> {{ __('message.görsel') }} {{ __('message.ekle') }} </a>
                                        <!--end::Add user-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Body-->
                            <div class="card-body pb-5 pt-0">
                                <!--begin::Table container-
                                <div class="table-responsive with_search_table">
                                    <table id="blog_categories_table" class="gy-7 gx-7 table">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                <th class="w-10px">
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                            data-kt-check-target="#blog_categories_table .my-input "
                                                            value="1" />
                                                    </div>
                                                </th>
                                                <th style="text-align: center"> {{ __('message.görsel') }} <i
                                                        class="fa fa-sort ms-3"></i></th>
                                                <th> {{ __('message.işlem') }} <i class="fa fa-sort ms-3"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($data)
                                                @foreach ($data as $item)
                                                    <tr class="align-middle">
                                                        <td>
                                                            <div
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input my-input" type="checkbox"
                                                                    value="1" />
                                                            </div>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <img src="/{{ $item }}"
                                                                style="width:150px; border-radius:5%" alt="">
                                                        </td>

                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 px-2"
                                                                title="Görüntüle">
                                                                <i class="fa-solid fa-eye fs-3"></i>
                                                            </a>

                                                            <a onclick="destroy('{{ $item }}')"
                                                                class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 px-2"
                                                                data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                                title="Sil">
                                                                <i class="fa-regular fa-trash-can fs-4"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                end::Table container-->
                            </div>
                            <!--begin::Body-->
                        </div> --}}
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



        $(document).ready(function() {
            $(document).on('click', '.add_item_buton', function(e) {
                e.preventDefault();
                $("#show_item").prepend(
                    '<div class="image row" style="text-align: center;margin-top:0%; margin-bottom:0%">' +
                    '<div class="col-md-3">' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<input type="file" class="form-control" name="image[]" id="">' +
                    '</div>' +
                    '<div class="buton col-md-3">' +
                    '<button type="button" id="delete_item_buton" class="btn btn-danger btn-sm delete_item_buton"' +
                    'style="width: 150px">SİL</button>' +
                    '</div>' +
                    '<hr style="color:gray; margin-top:3%">' +
                    '</div>'
                );
            })
        });

        $(document).on('click', '.delete_item_buton', function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
    </script>
@endsection
