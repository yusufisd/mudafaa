@extends('backend.master')
@section('css')
    <style>
        .image-input-placeholder {
            background-image: url('svg/avatars/blank.svg');
        }

        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url('svg/avatars/blank-dark.svg');
        }
    </style>
@endsection
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
                        Kullanıcı Grubu Düzenle</h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Back-->
                <div class="page-title d-flex flex-column justify-content-center me-3 flex-wrap">
                    <!--begin::Title-->
                    <a href="javascript:history.back()"
                        class="page-heading d-flex text-dark fw-bold fs-3 justify-content-center text-hover-success my-0">
                        <i class="fa fa-arrow-left mx-2 my-auto"></i>
                        Geri Dön
                    </a>
                    <!--end::Title-->
                </div>
                <!--end::Back-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->

        <form action="{{ route('admin.role.update',$data->id) }}" method="POST">
            @csrf

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Header-->
                                <!--<div class="ps-12 pt-12"></div>-->
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Form-->
                                    <!--begin::Card body-->
                                    <div class="card-body px-0 py-9">
                                        <!--begin::Input group-->
                                        <div class="row">
                                            <!--begin::Label-->
                                            <label class="col-lg-2 col-form-label fw-bold fs-6 required">Kullanıcı Grup
                                                Adı</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-10">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-row">
                                                        <input id="user_name" name="role"
                                                            class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                                                            value="{{$data->name}}" />
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
                                    <!--end::Form-->
                                </div>
                                <!--begin::Body-->
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <table id="product_management_table"
                                            class="table-striped table-row-bordered gy-5 gs-7 table">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th class="w-60"> {{ __('message.haber') }}
                                                        {{ __('message.yönetimi') }}
                                                    </th>
                                                    <th class="w-10 text-center">Görüntüleme</th>
                                                    <th class="w-10 text-center">Ekleme</th>
                                                    <th class="w-10 text-center">Düzenleme</th>
                                                    <th class="w-10 text-center">Silme</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> {{ __('message.güncel') }} {{ __('message.haber') }}
                                                        {{ __('message.kategorisi') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('currentNewsCategory_list',$data->permissions) ? 'checked' : ''}}
                                                                id="currentNewsCategory_list"
                                                                name="currentNewsCategory_list" />
                                                            <label class="form-check-label"
                                                                for="currentNewsCategory_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('currentNewsCategory_add',$data->permissions) ? 'checked' : ''}}
                                                                id="currentNewsCategory_add"
                                                                name="currentNewsCategory_add" />
                                                            <label class="form-check-label"
                                                                for="currentNewsCategory_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('currentNewsCategory_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="currentNewsCategory_edit"
                                                                name="currentNewsCategory_edit" />
                                                            <label class="form-check-label"
                                                                for="currentNewsCategory_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('currentNewsCategory_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="currentNewsCategory_delete"
                                                                name="currentNewsCategory_delete" />
                                                            <label class="form-check-label"
                                                                for="currentNewsCategory_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> {{ __('message.güncel') }} {{ __('message.haber') }}
                                                        {{ __('message.içerik') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('currentNews_list',$data->permissions) ? 'checked' : ''}}
                                                                id="currentNews_list" name="currentNews_list" />
                                                            <label class="form-check-label" for="currentNews_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('currentNews_add',$data->permissions) ? 'checked' : ''}}
                                                                id="currentNews_add" name="currentNews_add" />
                                                            <label class="form-check-label" for="currentNews_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('currentNews_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="currentNews_edit" name="currentNews_edit" />
                                                            <label class="form-check-label" for="currentNews_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('currentNews_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="currentNews_delete" name="currentNews_delete" />
                                                            <label class="form-check-label"
                                                                for="currentNews_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>

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

                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <table id="order_management_table"
                                            class="table-striped table-row-bordered gy-5 gs-7 table">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th class="w-60"> {{ __('message.savunma') }}
                                                        {{ __('message.sanayi') }}
                                                        {{ __('message.yönetimi') }} </th>
                                                    <th class="w-10 text-center">Görüntüleme</th>
                                                    <th class="w-10 text-center">Ekleme</th>
                                                    <th class="w-10 text-center">Düzenleme</th>
                                                    <th class="w-10 text-center">Silme</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td> {{ __('message.savunma') }} {{ __('message.sanayi') }}
                                                        {{ __('message.kategori') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustry_list',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustry_list" name="defenseIndustry_list" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustry_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustry_add',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustry_add" name="defenseIndustry_add" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustry_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustry_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustry_edit" name="defenseIndustry_edit" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustry_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustry_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustry_delete"
                                                                name="defenseIndustry_delete" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustry_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> {{ __('message.savunma') }} {{ __('message.sanayi') }}
                                                        {{ __('message.alt') }} {{ __('message.kategori') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCategory_list',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCategory_list"
                                                                name="defenseIndustryCategory_list" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCategory_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCategory_add',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCategory_add"
                                                                name="defenseIndustryCategory_add" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCategory_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCategory_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCategory_edit"
                                                                name="defenseIndustryCategory_edit" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCategory_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCategory_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCategory_delete"
                                                                name="defenseIndustryCategory_delete" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCategory_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> {{ __('message.savunma') }} {{ __('message.sanayi') }}
                                                        {{ __('message.içerik') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryContent_list',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryContent_list"
                                                                name="defenseIndustryContent_list" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryContent_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryContent_add',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryContent_add"
                                                                name="defenseIndustryContent_add" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryContent_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryContent_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryContent_edit"
                                                                name="defenseIndustryContent_edit" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryContent_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryContent_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryContent_delete"
                                                                name="defenseIndustryContent_delete" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryContent_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> {{ __('message.savunma') }} {{ __('message.sanayi') }}
                                                        {{ __('message.ülke') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCountry_list',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCountry_list"
                                                                name="defenseIndustryCountry_list" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCountry_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCountry_add',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCountry_add"
                                                                name="defenseIndustryCountry_add" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCountry_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCountry_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCountry_edit"
                                                                name="defenseIndustryCountry_edit" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCountry_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCountry_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCountry_delete"
                                                                name="defenseIndustryCountry_delete" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCountry_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> {{ __('message.savunma') }} {{ __('message.sanayi') }}
                                                        {{ __('message.firma') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCompany_list',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCompany_list"
                                                                name="defenseIndustryCompany_list" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCompany_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCompany_add',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCompany_add"
                                                                name="defenseIndustryCompany_add" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCompany_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCompany_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCompany_edit"
                                                                name="defenseIndustryCompany_edit" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCompany_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('defenseIndustryCompany_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="defenseIndustryCompany_delete"
                                                                name="defenseIndustryCompany_delete" />
                                                            <label class="form-check-label"
                                                                for="defenseIndustryCompany_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
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

                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <table id="customer_management_table"
                                            class="table-striped table-row-bordered gy-5 gs-7 table">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th class="w-60"> {{ __('message.etkinlik') }}
                                                        {{ __('message.yönetimi') }} </th>
                                                    <th class="w-10 text-center">Görüntüleme</th>
                                                    <th class="w-10 text-center">Ekleme</th>
                                                    <th class="w-10 text-center">Düzenleme</th>
                                                    <th class="w-10 text-center">Silme</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td> {{ __('message.etkinlik') }} {{ __('message.kategorisi') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('activityCategory_list',$data->permissions) ? 'checked' : ''}}
                                                                id="activityCategory_list" name="activityCategory_list" />
                                                            <label class="form-check-label"
                                                                for="activityCategory_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('activityCategory_add',$data->permissions) ? 'checked' : ''}}
                                                                id="activityCategory_add" name="activityCategory_add" />
                                                            <label class="form-check-label"
                                                                for="activityCategory_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('activityCategory_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="activityCategory_edit" name="activityCategory_edit" />
                                                            <label class="form-check-label"
                                                                for="customers_allow_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('activityCategory_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="activityCategory_delete"
                                                                name="activityCategory_delete" />
                                                            <label class="form-check-label"
                                                                for="activityCategory_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> {{ __('message.etkinlik') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('activity_list',$data->permissions) ? 'checked' : ''}}
                                                                id="activity_list" name="activity_list" />
                                                            <label class="form-check-label" for="activity_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('activity_add',$data->permissions) ? 'checked' : ''}}
                                                                id="activity_add" name="activity_add" />
                                                            <label class="form-check-label" for="activity_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('activity_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="activity_edit" name="activity_edit" />
                                                            <label class="form-check-label" for="activity_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('activity_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="activity_delete" name="activity_delete" />
                                                            <label class="form-check-label" for="activity_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
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

                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <table id="customer_management_table"
                                            class="table-striped table-row-bordered gy-5 gs-7 table">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th class="w-60"> {{ __('message.röportaj') }}
                                                        {{ __('message.yönetimi') }} </th>
                                                    <th class="w-10 text-center">Görüntüleme</th>
                                                    <th class="w-10 text-center">Ekleme</th>
                                                    <th class="w-10 text-center">Düzenleme</th>
                                                    <th class="w-10 text-center">Silme</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td> {{ __('message.röportaj') }} </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('interview_list',$data->permissions) ? 'checked' : ''}}
                                                                id="interview_list" name="interview_list" />
                                                            <label class="form-check-label" for="interview_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('interview_add',$data->permissions) ? 'checked' : ''}}
                                                                id="interview_add" name="interview_add" />
                                                            <label class="form-check-label" for="interview_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('interview_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="interview_edit" name="interview_edit" />
                                                            <label class="form-check-label" for="interview_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('interview_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="interview_delete" name="interview_delete" />
                                                            <label class="form-check-label"
                                                                for="interview_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>

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

                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <table id="customer_management_table"
                                            class="table-striped table-row-bordered gy-5 gs-7 table">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th class="w-60"> {{ __('message.sözlük') }}
                                                        {{ __('message.yönetimi') }} </th>
                                                    <th class="w-10 text-center">Görüntüleme</th>
                                                    <th class="w-10 text-center">Ekleme</th>
                                                    <th class="w-10 text-center">Düzenleme</th>
                                                    <th class="w-10 text-center">Silme</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr>
                                                    <td> {{ __('message.sözlük') }} {{ __('message.içerik') }}</td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('dictionary_list',$data->permissions) ? 'checked' : ''}}
                                                                id="dictionary_list" name="dictionary_list" />
                                                            <label class="form-check-label" for="dictionary_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('dictionary_add',$data->permissions) ? 'checked' : ''}}
                                                                id="dictionary_add" name="dictionary_add" />
                                                            <label class="form-check-label" for="dictionary_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('dictionary_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="dictionary_edit" name="dictionary_edit" />
                                                            <label class="form-check-label" for="dictionary_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('dictionary_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="dictionary_delete" name="dictionary_delete" />
                                                            <label class="form-check-label"
                                                                for="dictionary_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
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
                    <!--end::Row-->

                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <table id="customer_management_table"
                                            class="table-striped table-row-bordered gy-5 gs-7 table">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th class="w-60"> Video {{ __('message.yönetimi') }} </th>
                                                    <th class="w-10 text-center">Görüntüleme</th>
                                                    <th class="w-10 text-center">Ekleme</th>
                                                    <th class="w-10 text-center">Düzenleme</th>
                                                    <th class="w-10 text-center">Silme</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td> Video {{ __('message.kategorisi') }}</td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('videoCategory_list',$data->permissions) ? 'checked' : ''}}
                                                                id="videoCategory_list" name="videoCategory_list" />
                                                            <label class="form-check-label"
                                                                for="videoCategory_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('videoCategory_add',$data->permissions) ? 'checked' : ''}}
                                                                id="videoCategory_add" name="videoCategory_add" />
                                                            <label class="form-check-label"
                                                                for="videoCategory_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('videoCategory_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="videoCategory_edit" name="videoCategory_edit" />
                                                            <label class="form-check-label"
                                                                for="videoCategory_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('videoCategory_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="videoCategory_delete" name="videoCategory_delete" />
                                                            <label class="form-check-label"
                                                                for="videoCategory_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> Video {{ __('message.içerik') }}</td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('video_list',$data->permissions) ? 'checked' : ''}}
                                                                id="video_list" name="video_list" />
                                                            <label class="form-check-label" for="video_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('video_add',$data->permissions) ? 'checked' : ''}}
                                                                id="video_add" name="video_add" />
                                                            <label class="form-check-label" for="video_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('video_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="video_edit" name="video_edit" />
                                                            <label class="form-check-label" for="video_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('video_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="video_delete" name="video_delete" />
                                                            <label class="form-check-label" for="video_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>

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

                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <table id="customer_management_table"
                                            class="table-striped table-row-bordered gy-5 gs-7 table">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th class="w-60"> {{ __('message.firma') }}
                                                        {{ __('message.yönetimi') }} </th>
                                                    <th class="w-10 text-center">Görüntüleme</th>
                                                    <th class="w-10 text-center">Ekleme</th>
                                                    <th class="w-10 text-center">Düzenleme</th>
                                                    <th class="w-10 text-center">Silme</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td> {{ __('message.firma') }} {{ __('message.kategorisi') }}</td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('companyCategory_list',$data->permissions) ? 'checked' : ''}}
                                                                id="companyCategory_list" name="companyCategory_list" />
                                                            <label class="form-check-label"
                                                                for="companyCategory_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('companyCategory_add',$data->permissions) ? 'checked' : ''}}
                                                                id="companyCategory_add" name="companyCategory_add" />
                                                            <label class="form-check-label"
                                                                for="companyCategory_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('companyCategory_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="companyCategory_edit" name="companyCategory_edit" />
                                                            <label class="form-check-label"
                                                                for="companyCategory_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('companyCategory_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="companyCategory_delete"
                                                                name="companyCategory_delete" />
                                                            <label class="form-check-label"
                                                                for="companyCategory_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> {{ __('message.firma') }} {{ __('message.içerik') }}</td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('company_list',$data->permissions) ? 'checked' : ''}}
                                                                id="company_list" name="company_list" />
                                                            <label class="form-check-label" for="company_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('company_add',$data->permissions) ? 'checked' : ''}}
                                                                id="company_add" name="company_add" />
                                                            <label class="form-check-label" for="company_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('company_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="company_edit" name="company_edit" />
                                                            <label class="form-check-label" for="company_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('company_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="company_delete" name="company_delete" />
                                                            <label class="form-check-label" for="company_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>
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
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-8 mb-5">
                            <div class="card card-flush h-xl-100 mb-xl-8 mb-5">
                                <!--begin::Body-->
                                <div class="card-body py-5">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <table id="payment_management_table"
                                            class="table-striped table-row-bordered gy-5 gs-7 table">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th class="w-60"> {{ __('message.sayfa') }}
                                                        {{ __('message.yönetimi') }} </th>
                                                    <th class="w-10 text-center">Görüntüleme</th>
                                                    <th class="w-10 text-center">Ekleme</th>
                                                    <th class="w-10 text-center">Düzenleme</th>
                                                    <th class="w-10 text-center">Silme</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>{{ __('message.sayfa') }}</td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('page_list',$data->permissions) ? 'checked' : ''}}
                                                                id="page_list" name="page_list" />
                                                            <label class="form-check-label" for="page_list"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('page_add',$data->permissions) ? 'checked' : ''}}
                                                                id="page_add" name="page_add" />
                                                            <label class="form-check-label" for="page_add"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('page_edit',$data->permissions) ? 'checked' : ''}}
                                                                id="page_edit" name="page_edit" />
                                                            <label class="form-check-label" for="page_edit"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-check-solid form-switch form-check-custom fv-row justify-content-center">
                                                            <input class="form-check-input w-50px h-25px" type="checkbox" {{in_array('page_delete',$data->permissions) ? 'checked' : ''}}
                                                                id="page_delete" name="page_delete" />
                                                            <label class="form-check-label" for="page_delete"></label>
                                                        </div>
                                                    </td>
                                                </tr>

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
                    <div class="right" style="text-align: right">
                        <button type="submit" class="btn btn-primary">EKLE</button>
                    </div>
                </div>

                
                <!--end::Content container-->
            </div>
        </form>

        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection
