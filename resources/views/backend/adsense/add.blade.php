@extends('backend.master')
@section('content')
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-10">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-primary fw-bold fs-3 flex-column justify-content-center my-0">Reklam Ekle</h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
                <!--begin::Back-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <a href="javascript:history.back()" class="page-heading d-flex text-dark fw-bold fs-3 justify-content-center my-0 text-hover-success">
                        <i class="fa fa-arrow-left my-auto mx-2"></i>
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
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <!--begin::Col-->
                    <div class="col-xl-12 mb-5 mb-xl-8">
                        <div class="card card-flush h-xl-100 mb-5 mb-xl-8">
                            <!--begin::Header-->
                                <!--<div class="ps-12 pt-12"></div>-->
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-5">
                                <!--begin::Form-->
                                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.adsense.store') }}" id="add_ad_form" class="form">
									@csrf
                                    <!--begin::Card body-->
                                    <div class="card-body px-0 py-9">
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-2 col-form-label ps-5 fw-bold fs-6 required">Reklam Tipi</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-12 ps-5">
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <!--begin::Col-->
                                                    <div class="col-lg-12 fv-row">
                                                        <select name="ad_type_select" aria-label="Seçiniz" data-control="select2" data-placeholder="Seçiniz..." class="form-select form-select-solid form-select-lg fw-semibold">
                                                            <option value="">Seçiniz...</option>
                                                            <option value="google_ads">Google Reklamları</option>
                                                            <option value="sponsored_ads">Sponsorlu Reklamlar</option>
                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->

                                        <div id="google_ads_content"></div>
                                        <div id="sponsered_ads_content"></div>

                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Actions-->
                                    <div id="card_action" class="card-footer d-flex justify-content-between py-6 px-0"></div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                                
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
    
</div>
<!--end:::Main-->
@endsection
@section('script')
    <!--begin:: extra js-->
		<script>
            $(document).ready(function() {
				
				var selectedOption;

				$('select').on('change', function(e) {
					e.preventDefault();
                    $( "#google_ads_content" ).html("");
                    $( "#sponsered_ads_content" ).html("");
                    $( "#card_action" ).html("");

					selectedOption = $(this).val();
				
					if (selectedOption === 'google_ads') {
						$( "#google_ads_content" ).append(
                            '<div class="row mb-6">'+
                                '<label class="col-lg-2 col-form-label ps-5 required fw-bold fs-6">Reklam Adı</label>'+
                                '<div class="col-lg-10">'+
                                    '<div class="row">'+
                                        '<div class="col-lg-12 fv-row">'+
                                            '<input type="text" name="ad_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="" />'+
                                            '<input type="hidden" name="type" value="0" />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row mb-6">'+
                                '<label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Reklam Açıklaması</label>'+
                                '<div class="col-lg-10">'+
                                    '<div class="row">'+
                                        '<div class="col-lg-12 fv-row">'+
                                            '<textarea name="ad_explanation" class="form-control form-control-lg form-control-solid" value=""></textarea>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row mb-6">'+
                                '<label class="col-lg-2 col-form-label ps-5 required fw-bold fs-6">Google Adsense Kodu</label>'+
                                '<div class="col-lg-10">'+
                                    '<div class="row">'+
                                        '<div class="col-lg-12 fv-row">'+
                                            '<textarea name="ad_google_adsense_code" class="form-control form-control-lg form-control-solid" value=""></textarea>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                          
							'<div class="separator my-10"></div>'+
							'<div class="row mb-6">'+
								'<div class="col-lg-5 fv-row fv-plugins-icon-container ps-5">'+
									'<div class="row">'+
										'<label class="col-lg-5 col-form-label fw-bold fs-6">'+
											'Yayın Başlangıç Tarihi'+
										'</label>'+
										'<div class="col-lg-7">'+
											'<div class="row">'+
												'<div class="col-lg-12 fv-row">'+
													'<input type="date" class="form-control" name="start_time" id="">'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+

								'<div class="col-lg-7 fv-row fv-plugins-icon-container ps-5">'+
									'<div class="row ms-10">'+
										'<label style="text-align:right" class="col-lg-6 col-form-label fw-bold fs-6">'+
											'Yayın Bitiş Tarihi'+
										'</label>'+
										'<div class="col-lg-6">'+
											'<div class="row">'+
												'<div class="col-lg-12 fv-row">'+
													'<input type="date" class="form-control" name="finish_time" id="">'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+

								
							'</div>'

						);
					
                    }else {
                        $( "#sponsered_ads_content" ).append(
							'<div class="row mb-6">'+
                                '<label class="col-lg-2 col-form-label ps-5 required fw-bold fs-6">Reklam Adı</label>'+
                                '<div class="col-lg-10">'+
                                    '<div class="row">'+
                                        '<div class="col-lg-12 fv-row">'+
                                            '<input type="text" name="ad_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="" />'+
                                            '<input type="hidden" name="type"  value="1" />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row mb-6">'+
                                '<label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Reklam Açıklaması</label>'+
                                '<div class="col-lg-10">'+
                                    '<div class="row">'+
                                        '<div class="col-lg-12 fv-row">'+
                                            '<textarea name="ad_explanation" class="form-control form-control-lg form-control-solid" value=""></textarea>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
							'<div class="row mb-6">'+
                                '<label class="col-lg-2 col-form-label ps-5 required fw-bold fs-6">Url</label>'+
                                '<div class="col-lg-10">'+
                                    '<div class="row">'+
                                        '<div class="col-lg-12 fv-row">'+
                                            '<input type="text" name="ad_url" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="" />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
							'<div class="row mb-6">'+
							'<label class="col-lg-2 col-form-label ps-5 fw-bold fs-6"></label>'+
							'<div class="col-lg-10 fv-row">'+
								'<div class="d-flex align-items-center mt-3">'+
									'<label class="form-check form-check-custom form-check-inline form-check-solid me-5">'+
										'<input class="form-check-input" name="ad_view_status[]" type="radio" value="1" />'+
										'<span class="fw-semibold ps-2 fs-6">Aynı Sekmede Göster</span>'+
									'</label>'+
									'<label class="form-check form-check-custom form-check-inline form-check-solid">'+
										'<input class="form-check-input" name="ad_view_status[]" type="radio" value="2" checked />'+
										'<span class="fw-semibold ps-2 fs-6">Yeni Sekmede Göster </span>'+
									'</label>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row mb-6">'+
							'<label class="col-lg-2 col-form-label ps-5 fw-bold fs-6">Reklam Görseli</label>'+
							'<div class="col-lg-10">'+
								'<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url("assets/media/svg/avatars/blank.svg")">'+
									'<div class="image-input-wrapper w-125px h-125px" style="background-image: url(../assets/media/avatars/300-1.jpg)"></div>'+
									'<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Resmi Değiştir">'+
										'<i class="bi bi-pencil-fill fs-7"></i>'+
										'<input type="file" name="add_ad_image" accept=".png, .jpg, .jpeg" />'+
										'<input type="hidden" name="add_ad_image_remove" />'+
									'</label>'+
									'<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Resmi Sil">'+
										'<i class="bi bi-x fs-2"></i>'+
									'</span>'+
									'<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Resmi Kaldır">'+
										'<i class="bi bi-x fs-2"></i>'+
									'</span>'+
								'</div>'+
								'<div class="form-text">png, jpg, jpeg - (20x20)</div>'+
							'</div>'+
						'</div>'+
						'<div class="separator my-10"></div>'+
						'<div class="row mb-6">'+
							'<div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">'+
								'<div class="row">'+
									'<label class="col-lg-4 col-form-label fw-bold fs-6">'+
										'Yayın Başlangıç <br>Tarihi - Saati'+
									'</label>'+
									'<div class="col-lg-8">'+
										'<div class="row">'+
											'<div class="col-lg-12 fv-row">'+
												'<div class="input-group" id="add_ad_sponsered_start_calendar" data-td-target-input="nearest" data-td-target-toggle="nearest">'+
													'<input id="add_ad_date" type="text" class="form-control" data-td-target="#add_ad_sponsered_start_calendar"/>'+
													'<span class="input-group-text" data-td-target="#add_ad_sponsered_start_calendar" data-td-toggle="datetimepicker">'+
														'<i class="bi bi-calendar2-week fs-2"><span class="path1"></span><span class="path2"></span></i>'+
													'</span>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+

							'<div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">'+
								'<div class="row ms-10">'+
									'<label class="col-lg-4 col-form-label fw-bold fs-6" style="padding-top: 0px;">Yayın Bitiş <br> Tarihi - Saati</label>'+
									'<div class="col-lg-8">'+
										'<div class="row">'+
											'<div class="col-lg-12 fv-row">'+
												'<div class="input-group" id="add_ad_sponsered_end_calendar" data-td-target-input="nearest" data-td-target-toggle="nearest">'+
													'<input id="add_ad_date" type="text" class="form-control" data-td-target="#add_ad_sponsered_end_calendar"/>'+
													'<span class="input-group-text" data-td-target="#add_ad_sponsered_end_calendar" data-td-toggle="datetimepicker">'+
														'<i class="bi bi-calendar2-week fs-2"><span class="path1"></span><span class="path2"></span></i>'+
													'</span>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'

						);
					
                        
                    }

                    $( "#card_action" ).append(
                        '<div class="row mb-0">'+
                            '<label class="col-lg-8 col-form-label fw-bold fs-6 ps-5">Durum</label>'+
                            '<div class="col-lg-4 d-flex align-items-center">'+
                                '<div class="form-check form-check-solid form-switch form-check-custom fv-row">'+
                                    '<input class="form-check-input w-50px h-25px" type="checkbox" id="allowactivity_add_ad" checked="checked" />'+
                                    '<label class="form-check-label" for="allow_add_ad"></label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<button type="submit" class="btn btn-outline btn-outline-success" id="btn_submit_add_ad"><i class="fa-solid fa-check ps-1"></i> KAYDET</button>'
                    );
                    
					if(document.getElementById("add_ad_google_start_calendar")) {
						new tempusDominus.TempusDominus(document.getElementById("add_ad_google_start_calendar"), {
							display: {
								icons: {
									time: "bi bi-clock-fill fs-1",
									date: "bi bi-calendar2-week-fill fs-1",
									up: "bi bi-chevron-up fs-1",
									down: "bi bi-chevron-down fs-1",
									previous: "bi bi-chevron-left fs-1",
									next: "bi bi-chevron-right fs-1",
									today: "bi bi-calendar-check-fill fs-1",
									clear: "bi bi-trash-fill fs-1",
									close: "bi bi-x-circle-fill fs-1",
								},
								buttons: {
									today: true,
									clear: true,
									close: true,
								},
							}
						});

						new tempusDominus.TempusDominus(document.getElementById("add_ad_google_end_calendar"), {
							display: {
								icons: {
									time: "bi bi-clock-fill fs-1",
									date: "bi bi-calendar2-week-fill fs-1",
									up: "bi bi-chevron-up fs-1",
									down: "bi bi-chevron-down fs-1",
									previous: "bi bi-chevron-left fs-1",
									next: "bi bi-chevron-right fs-1",
									today: "bi bi-calendar-check-fill fs-1",
									clear: "bi bi-trash-fill fs-1",
									close: "bi bi-x-circle-fill fs-1",
								},
								buttons: {
									today: true,
									clear: true,
									close: true,
								},
							}
						});

					}
					else{
						new tempusDominus.TempusDominus(document.getElementById("add_ad_sponsered_start_calendar"), {
							display: {
								icons: {
									time: "bi bi-clock-fill fs-1",
									date: "bi bi-calendar2-week-fill fs-1",
									up: "bi bi-chevron-up fs-1",
									down: "bi bi-chevron-down fs-1",
									previous: "bi bi-chevron-left fs-1",
									next: "bi bi-chevron-right fs-1",
									today: "bi bi-calendar-check-fill fs-1",
									clear: "bi bi-trash-fill fs-1",
									close: "bi bi-x-circle-fill fs-1",
								},
								buttons: {
									today: true,
									clear: true,
									close: true,
								},
							}
						});

						new tempusDominus.TempusDominus(document.getElementById("add_ad_sponsered_end_calendar"), {
							display: {
								icons: {
									time: "bi bi-clock-fill fs-1",
									date: "bi bi-calendar2-week-fill fs-1",
									up: "bi bi-chevron-up fs-1",
									down: "bi bi-chevron-down fs-1",
									previous: "bi bi-chevron-left fs-1",
									next: "bi bi-chevron-right fs-1",
									today: "bi bi-calendar-check-fill fs-1",
									clear: "bi bi-trash-fill fs-1",
									close: "bi bi-x-circle-fill fs-1",
								},
								buttons: {
									today: true,
									clear: true,
									close: true,
								},
							}
						});

					}
					
					
				});

			});
		</script>
		<!--end:: extra js-->
@endsection