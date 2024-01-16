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
                                                <th> İsim <i class="fa fa-sort ms-3"></i></th>
                                                <th> Email <i class="fa fa-sort ms-3"></i></th>
                                                <th> Telefon <i class="fa fa-sort ms-3"></i></th>
                                                <th> Oluşturma Tarihi <i class="fa fa-sort ms-3"></i></th>
                                                <th class="pe-7 text-center">Mesaj<i
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
                                                <td>{{ $item->fullname }}</td>
                                                <td> {{ $item->email }} </td>
                                                <td> {{ $item->phone }} </td>
                                                <td> {{ $item->created_at->translatedFormat('d M y') }} </td>
                                                <td> {{ $item->message }} </td>
                                                
                                                <td class="text-center">
                                                    
                                                    <a style="text-align: center" onclick="destroy({{$item->id}})"
                                                        class="px-2 btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1"
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
                    window.location.href = "{{ route('admin.contactForm.delete') }}/" + d;
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
