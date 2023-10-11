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
                        Sözlük {{ __('message.yönetimi') }} </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <div class="" style="display: flex">
                    <div id="goster" class="col-md-8" style="display:none">
                        <form action="{{ route('admin.dictionary.ice_aktar') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="ice_aktar" id="">
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" class="btn btn-primary" id="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="gizle">
                        <button class="btn btn-primary" onclick="iceri_aktar()" type="button"> Aktar</button>
                    </div>
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
                            <div class="card-header border-0 pt-6">
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                        <!--begin::Add user-->
                                        <a type="button" class="btn btn-outline btn-outline-success"
                                            href="{{ route('admin.dictionary.add') }}">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="11.364" y="20.364" width="16"
                                                        height="2" rx="1" transform="rotate(-90 11.364 20.364)"
                                                        fill="currentColor" />
                                                    <rect x="4.36396" y="11.364" width="16" height="2"
                                                        rx="1" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon--> Yeni {{ __('message.ekle') }} </a>
                                        <!--end::Add user-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Card toolbar-->


                            </div>
                            <!--end::Card header-->
                            <!--begin::Body-->
                            <div class="card-body pb-5 pt-0">
                                <!--begin::Table container-->
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
                                                <th> {{ __('message.görsel') }} <i class="fa fa-sort ms-3"></i></th>
                                                <th> {{ __('message.başlık') }} <i class="fa fa-sort ms-3"></i></th>
                                                <th> {{ __('message.yazar') }} <i class="fa fa-sort ms-3"></i></th>
                                                <th> Yayın Tarihi <i class="fa fa-sort ms-3"></i></th>
                                                <th class="pe-7 text-center">{{ __('message.durum') }}<i
                                                    class="fa fa-sort ms-3"></i></th>
                                                <th> {{ __('message.işlem') }} <i class="fa fa-sort ms-3"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($data as $item)
                                                <tr class="align-middle">
                                                    <td>
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input my-input" type="checkbox"
                                                                value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <img src="/{{ $item->image }}"
                                                            style="width:150px; border-radius:5%" alt="">
                                                    </td>
                                                    <td> {{ $item->title }} </td>
                                                    <td> <p style="text-transform: capitalize">{{ $item->Author->name }} {{ $item->Author->surname }} </p>  </td>
                                                    <td> {{ $item->live_date->translatedFormat('d M Y') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox"
                                                                id="blog_status_1"
                                                                onchange="change_status({{ $item->id }})"
                                                                {{ $item->status == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="blog_status_1"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#"
                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 px-2"
                                                            title="Görüntüle">
                                                            <i class="fa-solid fa-eye fs-3"></i>
                                                        </a>
                                                        <a href="{{ route('admin.dictionary.edit', $item->id) }}"
                                                            class="btn btn-icon btn-bg-light btn-active-color-secondary btn-sm me-1 px-2"
                                                            title="Düzenle">
                                                            <i class="fa-regular fa-pen-to-square fs-3"></i>
                                                        </a>
                                                        <a onclick="destroy({{ $item->id }})"
                                                            class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 px-2"
                                                            data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                            title="Sil">
                                                            <i class="fa-regular fa-trash-can fs-4"></i>
                                                        </a>
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
        function iceri_aktar() {
            $('#goster').toggle('fast');
        }
    </script>
    <script>
        function change_status(d) {
            window.location.href = "{{ route('admin.dictionary.change_status') }}/" + d
        }

        function destroy(d) {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Seçtiğiniz içerik silinecek!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.dictionary.destroy') }}/" + d;
                }
            })
        }
    </script>
    <!--begin:: extra js-->
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
        // end: DataTable Scripts
    </script>
    <!--end:: extra js-->
@endsection
