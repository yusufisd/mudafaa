@extends('backend.master')
@section('content')

<style>
    #headline,#status{
        cursor: pointer;
    }
</style>
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
                        Firma {{ __('message.yönetimi') }}</h1>
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
                    <div class="col-xl-12 mb-5 mb-xl-8">
                        <div class="card card-flush h-xl-100 mb-5 mb-xl-8">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-6">

                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                        <a type="button" class="btn btn-outline btn-outline-success"
                                            href="{{ route('admin.companyModel.add') }}">
                                            <i class="fa-solid fa-plus"></i> Firma
                                            {{ __('message.ekle') }}
                                        </a>

                                        <a type="button" class="btn btn-outline btn-outline-success ms-5"
                                            href="{{ route('admin.companyCategory.list') }}">
                                            <i class="fa fa-newspaper" aria-hidden="true"></i> Firma
                                            {{ __('message.kategorisi') }} 
                                        </a>



                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Card toolbar-->

                            </div>
                            <!--end::Card header-->
                            <!--begin::Body-->
                            <div class="card-body pt-0 pb-5">
                                <!--begin::Table container-->
                                <div class="table-responsive with_search_table">
                                    <table id="blog_management_table" class="table gy-7 gx-7">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                <th class="w-10px">
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                            data-kt-check-target="#blog_management_table .my-input "
                                                            value="1" />
                                                    </div>
                                                </th>
                                                <th>{{ __('message.görsel') }}<i class="fa fa-sort ms-3"></i></th>
                                                <th>{{ __('message.başlık') }}<i class="fa fa-sort ms-3"></i></th>
                                                <th>{{ __('message.kategori') }}<i class="fa fa-sort ms-3"></i></th>
                                                <th>{{ __('message.durum') }}<i class="fa fa-sort ms-3"></i></th>
                                                <th class="text-center">{{ __('message.işlem') }}<i
                                                        class="fa fa-sort ms-3"></i></th>
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
                                                        <img src="/{{ $item->image }}" class="w-75px ms-n1"
                                                            alt="">
                                                    </td>
                                                    <td> {{ $item->title }} </td>
                                                    <td>
                                                        @foreach ($item->Category() as $cat)
                                                            {{ $cat->title }},
                                                        @endforeach
                                                    </td>
                                                    <td style="text-align: center">
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox"
                                                                id="blog_status_1"
                                                                onchange="change_status({{ $item->id }})"
                                                                {{ $item->status == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="blog_status_1"></label>
                                                        </div>
                                                    </td>
                                                    
                                                    <td class="text-center">


                                                        <a href="{{ route('admin.video.edit', $item->id) }}"
                                                            class="px-2 btn btn-icon btn-bg-light btn-active-color-secondary btn-sm me-1"
                                                            title="Düzenle">
                                                            <i class="fa-regular fa-pen-to-square fs-3"></i>
                                                        </a>
                                                        <a onclick="destroy({{$item->id}})"
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
                    window.location.href = "{{ route('admin.video.destroy') }}/" + d;
                }
            })
        }

    </script>
    <!--begin:: extra js-->
    <script>
        // begin: DataTable Scripts
        $("#blog_management_table").DataTable({
            "ordering": true,
            "order": [
                [0, "asc"]
            ],
            "language": {
                "sEmptyTable": "Tabloda herhangi bir veri mevcut değil",
                "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                "sInfoEmpty": "Kayıt yok",
                "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "Sayfada _MENU_ kayıt göster",
                "sLoadingRecords": "Yükleniyor...",
                "sProcessing": "İşleniyor...",
                "sSearch": "Ara:",
                "sZeroRecords": "Eşleşen kayıt bulunamadı",
                "oPaginate": {
                    "sFirst": "İlk",
                    "sLast": "Son",
                    "sNext": "Sonraki",
                    "sPrevious": "Önceki"
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
