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
                        {{ __('message.güncel') }} {{ __('message.haber') }} {{ __('message.yönetimi') }}</h1>
                    <!--end::Title-->
                </div>
                <div class="gap-5" style="display: flex" style="text-align: right!important">
                    <div id="goster" class="col-md-8" style="display:none">
                        <form action="{{ route('admin.currentNews.ice_aktar') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="ice_aktar" id="">
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn-sm btn btn-primary" id="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="gizle">
                        <button class="btn-sm btn btn-primary" onclick="iceri_aktar()" type="button"> Aktar</button>
                    </div>
                    <div>
                        <a href="{{ route('admin.currentNews.disa_aktar') }}">
                            <button style="position:initial;background-color:#1e1e3f;color:white" class="btn-sm btn"
                                type="button"> Örnek Excel</button>
                        </a>
                    </div>
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
                                <div class="card-toolbar">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                        <a type="button" class="btn btn-outline btn-outline-success"
                                            href="{{ route('admin.currentNews.add') }}">
                                            <i class="fa-solid fa-plus"></i> {{ __('message.haber') }}
                                            {{ __('message.ekle') }}
                                        </a>

                                        <a type="button" class="btn btn-outline btn-outline-success ms-5"
                                            href="{{ route('admin.currentNewsCategory.list') }}">
                                            <i class="fa fa-newspaper" aria-hidden="true"></i> {{ __('message.haber') }}
                                            {{ __('message.kategorisi') }}
                                        </a>


                                        <!-- FİLTRELEME SEÇENEKLERİ:BAŞLANGIÇ-->
                                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                                            <!--begin::Menu toggle-->
                                            <a href="#"
                                                class="btn btn-sm btn-flex bg-body btn-outline btn-outline-success fw-bold ms-5"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                                <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->Filtrele</a>
                                            <!--end::Menu toggle-->

                                            <!--begin::Menu 1-->
                                            <div class="menu menu-sub menu-sub-dropdown w-350px w-md-400px"
                                                data-kt-menu="true" id="kt_menu_63de8b3bde02f">
                                                <!--begin::Header-->
                                                <div class="px-7 py-5">
                                                    <div class="fs-5 text-dark fw-bold">Filtre Seçenekleri</div>
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Menu separator-->
                                                <div class="separator border-gray-200"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Form-->



                                                <form action="{{ route('admin.currentNews.filterPost') }}" method="POST">
                                                    @csrf
                                                    <div class="px-7 py-5">
                                                        <!--begin::Input group-->
                                                        <div class="mb-10">
                                                            <!--begin::Label-->
                                                            <label class="form-label fw-semibold">Kategori:</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <div>
                                                                <select required name="category" class="form-select form-select-solid"
                                                                    data-kt-select2="true" data-placeholder="Seçiniz.."
                                                                    data-dropdown-parent="#kt_menu_63de8b3bde02f"
                                                                    data-allow-clear="true">
                                                                    <option></option>
                                                                    @foreach ($categories as $cat)
                                                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="mb-10">
                                                            <!--begin::Label-->
                                                            <label class="form-label fw-semibold">İşlem:</label>
                                                            <!--end::Label-->
                                                            <!--begin::Options-->
                                                            <div class="d-flex">
                                                                <!--begin::Options-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                                    <input class="form-check-input" name="process"
                                                                        type="radio" required value="1" />
                                                                    <span class="form-check-label">Toplu Sil</span>
                                                                </label>
                                                                <!--end::Options-->
                                                                <!--begin::Options-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                                    <input class="form-check-input" name="process"
                                                                        type="radio" required value="2"  />
                                                                    <span class="form-check-label">Pasif Yap</span>
                                                                </label>
                                                                <!--end::Options-->
                                                                <!--begin::Options-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input" name="process"
                                                                        type="radio" required value="3" />
                                                                    <span class="form-check-label">Aktif Yap</span>
                                                                </label>
                                                                <!--end::Options-->
                                                            </div>
                                                            <!--end::Options-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Actions-->
                                                        <div class="d-flex justify-content-end">
                                                            <button type="reset"
                                                                class="btn btn-sm btn-outline btn-outline-success me-2"
                                                                data-kt-menu-dismiss="true">Sıfırla</button>
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                data-kt-menu-dismiss="true">Uygula</button>
                                                        </div>
                                                        <!--end::Actions-->
                                                    </div>
                                                </form>
                                                <!--end::Form-->


                                            </div>
                                            <!--end::Menu 1-->

                                        </div>
                                        <!-- FİLTRELEME SEÇENEKLERİ:BİTİŞ-->



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
                                    <table id="blog_management_table" class="gy-7 gx-7 table">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800">
                                                <th class="w-10px">
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            data-kt-check="true"
                                                            data-kt-check-target="#blog_management_table .my-input "
                                                            value="1" />
                                                    </div>
                                                </th>
                                                <th>{{ __('message.görsel') }}<i class="fa fa-sort ms-3"></i></th>
                                                <th>{{ __('message.başlık') }}<i class="fa fa-sort ms-3"></i></th>
                                                <th style="width: 300px">{{ __('message.kategori') }}<i
                                                        class="fa fa-sort ms-3"></i></th>
                                                <th class="text-center">{{ __('message.manşet') }}<i
                                                        class="fa fa-sort ms-3"></i></th>
                                                <th class="pe-7 text-center">{{ __('message.durum') }}<i
                                                        class="fa fa-sort ms-3"></i></th>
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
                                                    <td> {{ substr($item->title, 0, 30) }}... </td>
                                                    <td style="width: 300px"> {{ implode('-', $item->Category2()) }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px"
                                                                onchange="change_headline({{ $item->id }})"
                                                                {{ $item->headline == 1 ? 'checked' : '' }}
                                                                type="checkbox" id="headline">
                                                            <label class="form-check-label" for="headline"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox"
                                                                id="status"
                                                                onchange="change_status({{ $item->id }})"
                                                                {{ $item->status == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="blog_status_1"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.currentNews.commentList', $item->id) }}"
                                                            style="border:solid; border-radius:5px;padding:3%; border-color:lightgray;margin:3%">
                                                            <i class="fa-solid fa-comment fa-xl"></i>
                                                            <span style="color: gray">
                                                                {{ $item->AdminCommentCount() }}
                                                            </span>
                                                        </a>
                                                        <a href="{{ route('admin.currentNews.edit', $item->id) }}"
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
                    window.location.href = "{{ route('admin.currentNews.destroy') }}/" + d;
                }
            })
        }

        function change_headline(d) {
            window.location.href = "{{ route('admin.currentNews.change_headline') }}/" + d;
        }

        function change_status(d) {
            window.location.href = "{{ route('admin.currentNews.change_status') }}/" + d;
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
