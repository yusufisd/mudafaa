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



        <div id="kt_app_content" class="app-content flex-column-fluid">


            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->

				@if($errors->any())
					@foreach ($errors->all() as $e)
						<div class="alert alert-danger">
							{{ $e }}
						</div>
					@endforeach
				@endif
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
                                                        <select name="ad_type_select" aria-label="Seçiniz" data-placeholder="Seçiniz..." class="form-select form-select-solid form-select-lg fw-semibold">
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
                                <!--end::Form-->


								<div class="header">
									<h5>Anasayfa</h5>
								</div>
								<div class="container" style="border: solid; padding:15px; border-radius:5px;border-color:lightgray">
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="1" name="reklam[]" id="1">&nbsp;&nbsp;
											<label for="1">Anasayfa Üst Sol Yarım (468x60)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="2" name="reklam[]" id="2">&nbsp;&nbsp;
											<label for="2">Anasayfa Üst Sağ Yarım (468x60)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="3" name="reklam[]" id="3">&nbsp;&nbsp;
											<label for="3">Anasayfa Üst Tekli (970x90)</label>
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="4" name="reklam[]" id="4">&nbsp;&nbsp;
											<label for="4">Anasayfa Orta Sol Yarım (468x60)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="5" name="reklam[]" id="5">&nbsp;&nbsp;
											<label for="5">Anasayfa Orta Sağ Yarım (468x60)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="6" name="reklam[]" id="6">&nbsp;&nbsp;
											<label for="6">Anasayfa Orta Tekli (970x90)</label>
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="7" name="reklam[]" id="7">&nbsp;&nbsp;
											<label for="7">Anasayfa Alt Tekli (970x90)</label>
										</div>

									</div><br>
								</div><br>

								<div class="header">
									<h5>Güncel Haber</h5>
								</div>
								<div class="container" style="border: solid; padding:15px; border-radius:5px;border-color:lightgray">
									<p><b> Kategori Liste Sayfası</b></p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="8" name="reklam[]" id="8">&nbsp;&nbsp;
											<label for="8">Üst Ara Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="9" name="reklam[]" id="9">&nbsp;&nbsp;
											<label for="9">Alt Ara Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="10" name="reklam[]" id="10">&nbsp;&nbsp;
											<label for="10">Sağ Kısım (250x250)</label>
										</div>
									</div><br>

									<p><b> İçerik Detay Sayfası </b></p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="11" name="reklam[]" id="11">&nbsp;&nbsp;
											<label for="11">Orta Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="12" name="reklam[]" id="12">&nbsp;&nbsp;
											<label for="12">Sağ Kısım (300x250)</label>
										</div>
									</div><br>
								</div><br>

								<div class="header">
									<h5>Savunma Sanayi</h5>
								</div>
								<div class="container" style="border: solid; padding:15px; border-radius:5px;border-color:lightgray">
									<p><b> Kategori Liste Sayfası </b></p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="13" name="reklam[]" id="13">&nbsp;&nbsp;
											<label for="13">Orta Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="14" name="reklam[]" id="14">&nbsp;&nbsp;
											<label for="14">Sağ Kısım (300x250)</label>
										</div>
									</div><br>

									<p><b> İçerik Detay Sayfası </b></p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="15" name="reklam[]" id="15">&nbsp;&nbsp;
											<label for="15">Üst Kısım (970x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="16" name="reklam[]" id="16">&nbsp;&nbsp;
											<label for="16">Alt Kısım (970x90)</label>
										</div>
									</div><br>
								</div><br>

								<div class="header">
									<h5>Etkinlik</h5>
								</div>
								<div class="container" style="border: solid; padding:15px; border-radius:5px;border-color:lightgray">
									<p><b> Kategori Liste Sayfası</b> </p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="17" name="reklam[]" id="17">&nbsp;&nbsp;
											<label for="17">Üst Kısım (970x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" name="reklam[]" id="175" value="175">&nbsp; &nbsp;
											<label for="175">Üst Sol Yarım (468x60)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="18" name="reklam[]" id="18">&nbsp;&nbsp;
											<label for="18">Üst Sağ Yarım (468x60)</label>
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="19" name="reklam[]" id="19">&nbsp;&nbsp;
											<label for="19">Ara Kısım 1 (970x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="20" name="reklam[]" id="20">&nbsp;&nbsp;
											<label for="20">Ara Kısım 2 (970x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="21" name="reklam[]" id="21">&nbsp;&nbsp;
											<label for="21">Ara Kısım 3 (970x90)</label>
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="22" name="reklam[]" id="22">&nbsp;&nbsp;
											<label for="22">Ara Kısım 4 (970x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="23" name="reklam[]" id="23">&nbsp;&nbsp;
											<label for="23">Ara Kısım 5 (970x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="24" name="reklam[]" id="24">&nbsp;&nbsp;
											<label for="24">Ara Kısım 6 (970x90)</label>
										</div>
									</div><br>

									<p><b> İçerik Detay Sayfası</b> </p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="25" name="reklam[]" id="25">&nbsp;&nbsp;
											<label for="25">Orta Kısım (970x90)</label>
										</div>
									</div><br>

									<p><b> Takvim Sayfası</b> </p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="26" name="reklam[]" id="26">&nbsp;&nbsp;
											<label for="26">Sol Kısım (300x600)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="27" name="reklam[]" id="27">&nbsp;&nbsp;
											<label for="27">Alt Kısım (468x60)</label>
										</div>
									</div><br>
								</div><br>

								<div class="header">
									<h5>Röportaj</h5>
								</div>
								<div class="container" style="border: solid; padding:15px; border-radius:5px;border-color:lightgray">
									<p><b> Kategori Liste Sayfası</b> </p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="28" name="reklam[]" id="28">&nbsp;&nbsp;
											<label for="28">Üst Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="29" name="reklam[]" id="29">&nbsp;&nbsp;
											<label for="29">Alt Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="30" name="reklam[]" id="30">&nbsp;&nbsp;
											<label for="30">Sağ Kısım (250x250)</label>
										</div>
									</div><br>

									<p><b> İçerik Detay Sayfası</b> </p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="31" name="reklam[]" id="31">&nbsp;&nbsp;
											<label for="31">Üst Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="32" name="reklam[]" id="32">&nbsp;&nbsp;
											<label for="32">Alt Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="33" name="reklam[]" id="33">&nbsp;&nbsp;
											<label for="33">Sağ Kısım (300x250)</label>
										</div>
									</div><br>
								</div><br>

								<div class="header">
									<h5>Firma</h5>
								</div>
								<div class="container" style="border: solid; padding:15px; border-radius:5px;border-color:lightgray">
									<p><b> Kategori Liste Sayfası</b> </p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="34" name="reklam[]" id="34">&nbsp;&nbsp;
											<label for="34">Üst Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="35" name="reklam[]" id="35">&nbsp;&nbsp;
											<label for="35">Alt Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="36" name="reklam[]" id="36">&nbsp;&nbsp;
											<label for="36">Sağ Kısım (300x600)</label>
										</div>
									</div><br>

									<p><b> İçerik Detay Sayfası</b> </p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="37" name="reklam[]" id="37">&nbsp;&nbsp;
											<label for="37">Alt Kısım (728x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="38" name="reklam[]" id="38">&nbsp;&nbsp;
											<label for="38">Sağ Kısım (300x250)</label>
										</div>
									</div><br>
								</div><br>

								<div class="header">
									<h5>Sözlük</h5>
								</div>
								<div class="container" style="border: solid; padding:15px; border-radius:5px;border-color:lightgray">
									<p><b> Liste Sayfası</b> </p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="39" name="reklam[]" id="39">&nbsp;&nbsp;
											<label for="39">Üst Kısım (970x90)</label>
										</div>
										<div class="col-md-4">
											<input type="checkbox" value="40" name="reklam[]" id="40">&nbsp;&nbsp;
											<label for="40">Alt Kısım (970x90)</label>
										</div>
									</div><br>

									<p><b> İçerik Detay Sayfası</b> </p><hr>
									<div class="row">
										<div class="col-md-4">
											<input type="checkbox" value="41" name="reklam[]" id="41">&nbsp;&nbsp;
											<label for="41">Alt Kısım (970x90)</label>
										</div>
									</div><br>
								</div><br>
								<div style="text-align: right">
									<button type="submit" class="btn btn-outline btn-outline-success" id="btn_submit_add_ad"><i class="fa-solid fa-check ps-1"></i> KAYDET</button>
								</div>
							</form>

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
							'<div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">'+
								'<div class="row">'+
									'<label class="col-lg-4 col-form-label fw-bold fs-6">'+
										'Yayın Başlangıç <br>Tarihi'+
									'</label>'+
									'<div class="col-lg-8">'+
										'<div class="row">'+
											'<div class="col-md-12">'+
												'<input type="date" name="start_date" class="form-control">'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+

							'<div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">'+
								'<div class="row ms-10">'+
									'<label class="col-lg-4 col-form-label fw-bold fs-6" style="padding-top: 0px;">Yayın Bitiş <br> Tarihi </label>'+
									'<div class="col-lg-8">'+
										'<div class="row">'+
											'<div class="col-md-12">'+
												'<input type="date" name="finish_date" class="form-control">'+
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
								'<input type="file" name="image" class="form-control">'+
							'</div>'+
						'</div>'+
						'<div class="separator my-10"></div>'+
						'<div class="row mb-6">'+
							'<div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">'+
								'<div class="row">'+
									'<label class="col-lg-4 col-form-label fw-bold fs-6">'+
										'Yayın Başlangıç <br>Tarihi'+
									'</label>'+
									'<div class="col-lg-8">'+
										'<div class="row">'+
											'<div class="col-md-12">'+
												'<input type="date" name="start_date" class="form-control">'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+

							'<div class="col-lg-6 fv-row fv-plugins-icon-container ps-5">'+
								'<div class="row ms-10">'+
									'<label class="col-lg-4 col-form-label fw-bold fs-6" style="padding-top: 0px;">Yayın Bitiş <br> Tarihi</label>'+
									'<div class="col-lg-8">'+
										'<div class="row">'+
											'<div class="col-md-12">'+
												'<input type="date" name="finish_date" class="form-control">'+
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
                        '</div>'
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
