<?php
@include_once("controller/_Configuration.php");
@include_once("controller/_ValidSession_Login.php");
?>
<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->

<head>
	<meta charset="utf-8" />

	<title>Deza | Admin</title>
	<meta name="description" content="Latest updates and statistic charts">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!--begin::Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
	<!--end::Fonts -->

	<!--begin::Page Vendors Styles(used by this page) -->
	<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles -->


	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles -->

	<!--begin::Layout Skins(used by all pages) -->

	<link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/brand/navy.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/aside/navy.css" rel="stylesheet" type="text/css" />
	<!--end::Layout Skins -->

	<link rel="shortcut icon" href="assets/media/logos/logo_deza_ico.png" />

	<!-- Hotjar Tracking Code for keenthemes.com -->
	<!-- <script>
		(function (h, o, t, j, a, r) {
			h.hj = h.hj || function () { (h.hj.q = h.hj.q || []).push(arguments) };
			h._hjSettings = { hjid: 1070954, hjsv: 6 };
			a = o.getElementsByTagName('head')[0];
			r = o.createElement('script'); r.async = 1;
			r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
			a.appendChild(r);
		})(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
	</script> -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', 'UA-37564768-1');
	</script> -->
</head>
<!-- end::Head -->

<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

	<!-- begin:: Header Mobile -->
	<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
		<div class="kt-header-mobile__logo">
			<a href="index.html">
				<img alt="Logo" src="assets/media/logos/logo_deza_blanco_2.png" />
			</a>
		</div>
		<div class="kt-header-mobile__toolbar">

			<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>

			<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>

			<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
		</div>
	</div>
	<!-- end:: Header Mobile -->
	<!-- begin:: Root -->
	<div class="kt-grid kt-grid--hor kt-grid--root">
		<!-- begin:: Page -->
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
			<!-- begin:: Aside -->
			<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>

			<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
				<!-- begin::Aside Brand -->
				<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
					<div class="kt-aside__brand-logo">
						<a href="index.html">
							<img alt="Logo" src="assets/media/logos/logo_deza_blanco_2.png" />
						</a>
					</div>

					<div class="kt-aside__brand-tools">
						<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
					</div>
				</div>
				<!-- end:: Aside Brand -->
				<!-- begin:: Aside Menu -->
				<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
					<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
						<ul class="kt-menu__nav ">
							<!-- kt-menu__item--open kt-menu__item--here -->
							<li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
								<a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-graphic"></i><span class="kt-menu__link-text">Dashboards</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
								<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
										<li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Dashboards</span></span></li>
										<li class="kt-menu__item" id="menu-kardex"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Kardex</span></a></li>
										<li class="kt-menu__item" id="menu-proyecto"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Proyectos</span></a></li>
										<li class="kt-menu__item" id="menu-ordenCompra"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Ordenes de Compra</span></a></li>
										<li class="kt-menu__item" id="menu-persona"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Personas</span></a></li>
									</ul>
								</div>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
								<a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-database"></i><span class="kt-menu__link-text">Maestros</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
								<div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
										<li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Maestros</span></span></li>
										<li class="kt-menu__item" id="menu-producto"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Productos</span></a></li>
										<li class="kt-menu__item" id="menu-almacen"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Almacen</span></a></li>
										<li class="kt-menu__item" id="menu-unidadMedida"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Unidades de Medida</span></a></li>
										<li class="kt-menu__item" id="menu-emailTipo"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tipos de Email</span></a></li>
										<li class="kt-menu__item" id="menu-telefonoTipo"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tipos de Teléfono</span></a></li>
										<li class="kt-menu__item" id="menu-estadoCivil"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Estados Civiles</span></a></li>
										<li class="kt-menu__item" id="menu-comprobantePagoTipo"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tipos de Comprobantes de Pago</span></a></li>
									</ul>
								</div>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
								<a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-cogs"></i><span class="kt-menu__link-text">Sistema</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
								<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
										<li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Sistema</span></span></li>
										<li class="kt-menu__item" id="menu-formaPago"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Formas de Pago</span></a></li>
										<li class="kt-menu__item" id="menu-rol"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Roles</span></a></li>
										<li class="kt-menu__item" id="menu-personaTipo"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tipos de Persona</span></a></li>
										<li class="kt-menu__item" id="menu-documentoIdentidad"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Documentos de Identidad</span></a></li>
										<li class="kt-menu__item" id="menu-genero"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Géneros</span></a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- end:: Aside Menu -->
				<!-- begin:: Aside Footer -->
				<div class="kt-aside__footer kt-grid__item" id="kt_aside_footer">
					<div class="kt-aside__footer-nav">
						<div class="kt-aside__footer-item">
							<a href="#" class="btn btn-icon"><i class="flaticon2-gear"></i></a>
						</div>
						<div class="kt-aside__footer-item">
							<a href="#" class="btn btn-icon"><i class="flaticon2-cube"></i></a>
						</div>
						<div class="kt-aside__footer-item">
							<a href="#" class="btn btn-icon"><i class="flaticon2-bell-alarm-symbol"></i></a>
						</div>
						<div class="kt-aside__footer-item">
							<button type="button" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="flaticon2-add"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-left">
								<ul class="kt-nav">
									<li class="kt-nav__section kt-nav__section--first">
										<span class="kt-nav__section-text">Export Tools</span>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-print"></i>
											<span class="kt-nav__link-text">Print</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-copy"></i>
											<span class="kt-nav__link-text">Copy</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-excel-o"></i>
											<span class="kt-nav__link-text">Excel</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-text-o"></i>
											<span class="kt-nav__link-text">CSV</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon la la-file-pdf-o"></i>
											<span class="kt-nav__link-text">PDF</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="kt-aside__footer-item">
							<a href="#" class="btn btn-icon"><i class="flaticon2-calendar-2"></i></a>
						</div>
					</div>
				</div>
				<!-- end:: Aside Footer-->
			</div>
			<!-- end:: Aside -->
			<!-- begin:: Wrapper -->
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
				<!-- begin:: Header -->
				<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

					<!-- begin:: Header Menu -->
					<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
					<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">

						<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout- ">
							<ul class="kt-menu__nav ">
								<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel kt-menu__item--active" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Pages</span><i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
										<ul class="kt-menu__subnav">
											<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Create New Post</span></a></li>
											<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Generate Reports</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--success">2</span></span></a></li>
											<li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Manage Orders</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
												<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
													<ul class="kt-menu__subnav">
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Latest
																	Orders</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Pending
																	Orders</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Processed
																	Orders</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Delivery
																	Reports</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Payments</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Customers</span></a></li>
													</ul>
												</div>
											</li>
											<li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Customer Feedbacks</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
												<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
													<ul class="kt-menu__subnav">
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Customer
																	Feedbacks</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Supplier
																	Feedbacks</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Reviewed
																	Feedbacks</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Resolved
																	Feedbacks</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Feedback
																	Reports</span></a></li>
													</ul>
												</div>
											</li>
											<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Register Member</span></a></li>
										</ul>
									</div>
								</li>
								<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Reports</span><i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu  kt-menu__submenu--fixed kt-menu__submenu--left" style="width:1000px">
										<div class="kt-menu__subnav">
											<ul class="kt-menu__content">
												<li class="kt-menu__item ">
													<h3 class="kt-menu__heading kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Finance
															Reports</span><i class="kt-menu__ver-arrow la la-angle-right"></i></h3>
													<ul class="kt-menu__inner">
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-map"></i><span class="kt-menu__link-text">Annual
																	Reports</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-user"></i><span class="kt-menu__link-text">HR
																	Reports</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-clipboard"></i><span class="kt-menu__link-text">IPO
																	Reports</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-graphic-1"></i><span class="kt-menu__link-text">Finance
																	Margins</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-graphic-2"></i><span class="kt-menu__link-text">Revenue
																	Reports</span></a></li>
													</ul>
												</li>
												<li class="kt-menu__item ">
													<h3 class="kt-menu__heading kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Project
															Reports</span><i class="kt-menu__ver-arrow la la-angle-right"></i></h3>
													<ul class="kt-menu__inner">
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Coca Cola CRM</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Delta Airlines Booking
																	Site</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Malibu
																	Accounting</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Vineseed Website
																	Rewamp</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Zircon Mobile
																	App</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Mercury CMS</span></a>
														</li>
													</ul>
												</li>
												<li class="kt-menu__item ">
													<h3 class="kt-menu__heading kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">HR
															Reports</span><i class="kt-menu__ver-arrow la la-angle-right"></i></h3>
													<ul class="kt-menu__inner">
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Staff
																	Directory</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Client
																	Directory</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Salary Reports</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Staff Payslips</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Corporate
																	Expenses</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Project
																	Expenses</span></a></li>
													</ul>
												</li>
												<li class="kt-menu__item ">
													<h3 class="kt-menu__heading kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Reporting
															Apps</span><i class="kt-menu__ver-arrow la la-angle-right"></i></h3>
													<ul class="kt-menu__inner">
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Report
																	Adjusments</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Sources &
																	Mediums</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Reporting
																	Settings</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Conversions</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Report
																	Flows</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><span class="kt-menu__link-text">Audit &
																	Logs</span></a>
														</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Apps</span><i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
									<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
										<ul class="kt-menu__subnav">
											<li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">eCommerce</span></a></li>
											<li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Audience</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
												<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
													<ul class="kt-menu__subnav">
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-users"></i><span class="kt-menu__link-text">Active
																	Users</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-interface-1"></i><span class="kt-menu__link-text">User
																	Explorer</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-lifebuoy"></i><span class="kt-menu__link-text">Users
																	Flows</span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-graphic-1"></i><span class="kt-menu__link-text">Market
																	Segments</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-graphic"></i><span class="kt-menu__link-text">User
																	Reports</span></a>
														</li>
													</ul>
												</div>
											</li>
											<li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Marketing</span></a></li>
											<li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Campaigns</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--success">3</span></span></a></li>
											<li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Cloud Manager</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
												<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
													<ul class="kt-menu__subnav">
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-add"></i><span class="kt-menu__link-text">File
																	Upload</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--danger">3</span></span></a>
														</li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-signs-1"></i><span class="kt-menu__link-text">File
																	Attributes</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-folder"></i><span class="kt-menu__link-text">Folders</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="index-2.html#.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-cogwheel-2"></i><span class="kt-menu__link-text">System
																	Settings</span></a></li>
													</ul>
												</div>
											</li>
										</ul>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- end:: Header Menu -->
					<!-- begin:: Header Topbar -->
					<div class="kt-header__topbar">
						<!--begin: Search -->
						<div class="kt-header__topbar-item kt-header__topbar-item--search dropdown">
							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
								<span class="kt-header__topbar-icon"><i class="flaticon2-search-1"></i></span>
							</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-top-unround dropdown-menu-anim dropdown-menu-lg">
								<div class="kt-quick-search kt-quick-search--dropdown kt-quick-search--result-compact" id="kt_quick_search_dropdown">
									<form method="get" class="kt-quick-search__form">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
											<input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
											<div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>
										</div>
									</form>
									<div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325" data-mobile-height="200">

									</div>
								</div>
							</div>
						</div>
						<!--end: Search -->
						<!--begin: Notifications -->
						<div class="kt-header__topbar-item dropdown">
							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px">
								<span class="kt-header__topbar-icon">
									<i class="flaticon2-bell-alarm-symbol"></i>
									<span class="kt-badge kt-badge--dot kt-badge--notify kt-badge--sm kt-badge--brand"></span>
								</span>
							</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
								<form>
									<div class="kt-head" style="background-image: url(assets/media/misc/head_bg_sm.jpg)">
										<h3 class="kt-head__title">User Notifications</h3>
										<div class="kt-head__sub"><span class="kt-head__desc">23 new
												notifications</span></div>
									</div>
									<div class="kt-notification kt-margin-t-30 kt-margin-b-20 kt-scroll" data-scroll="true" data-height="270" data-mobile-height="220">
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-line-chart kt-font-success"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													New order has been received
												</div>
												<div class="kt-notification__item-time">
													2 hrs ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-box-1 kt-font-brand"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													New customer is registered
												</div>
												<div class="kt-notification__item-time">
													3 hrs ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-chart2 kt-font-danger"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													Application has been approved
												</div>
												<div class="kt-notification__item-time">
													3 hrs ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-image-file kt-font-warning"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													New file has been uploaded
												</div>
												<div class="kt-notification__item-time">
													5 hrs ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-user kt-font-info"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													New user feedback received
												</div>
												<div class="kt-notification__item-time">
													8 hrs ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-pie-chart-2 kt-font-success"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													System reboot has been successfully completed
												</div>
												<div class="kt-notification__item-time">
													12 hrs ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-favourite kt-font-focus"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													New order has been placed
												</div>
												<div class="kt-notification__item-time">
													15 hrs ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item kt-notification__item--read">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-safe kt-font-primary"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													Company meeting canceled
												</div>
												<div class="kt-notification__item-time">
													19 hrs ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-psd kt-font-success"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													New report has been received
												</div>
												<div class="kt-notification__item-time">
													23 hrs ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon-download-1 kt-font-danger"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													Finance report has been generated
												</div>
												<div class="kt-notification__item-time">
													25 hrs ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon-security kt-font-warning"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													New customer comment recieved
												</div>
												<div class="kt-notification__item-time">
													2 days ago
												</div>
											</div>
										</a>
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-pie-chart kt-font-focus"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title">
													New customer is registered
												</div>
												<div class="kt-notification__item-time">
													3 days ago
												</div>
											</div>
										</a>
									</div>
								</form>
							</div>
						</div>
						<!--end: Notifications -->
						<!--begin: Quick Actions -->
						<div class="kt-header__topbar-item">
							<div class="kt-header__topbar-wrapper" id="kt_offcanvas_toolbar_quick_actions_toggler_btn">
								<span class="kt-header__topbar-icon"><i class="flaticon2-gear"></i></span>
							</div>
						</div>
						<!--end: Quick Actions -->
						<!--begin:: Languages -->
						<div class="kt-header__topbar-item kt-header__topbar-item--langs">
							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
								<span class="kt-header__topbar-icon">
									<img class="" src="assets/media/logos/226-united-states.svg" alt="" />
								</span>
							</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
								<ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
									<li class="kt-nav__item kt-nav__item--active">
										<a href="#" class="kt-nav__link">
											<span class="kt-nav__link-icon"><img src="assets/media/logos/226-united-states.svg" alt="" /></span>
											<span class="kt-nav__link-text">English</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<span class="kt-nav__link-icon"><img src="assets/media/logos/128-spain.svg" alt="" /></span>
											<span class="kt-nav__link-text">Spanish</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<span class="kt-nav__link-icon"><img src="assets/media/logos/162-germany.svg" alt="" /></span>
											<span class="kt-nav__link-text">German</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<!--end:: Languages -->
						<!--begin: User Bar -->
						<div class="kt-header__topbar-item kt-header__topbar-item--user">

							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
								<!--use "kt-rounded" class for rounded avatar style-->
								<div class="kt-header__topbar-user kt-rounded-">
									<span class="kt-header__topbar-welcome kt-hidden-mobile">Hola,</span>
									<span class="kt-header__topbar-username kt-hidden-mobile"><?php echo ($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["nombre_1"]) ?></span>
									<img alt="Pic" src="<?php echo ($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["profile_image"]) ?>" class="kt-rounded-" />
									<!-- <img alt="Pic" src="/uploads/<?php echo ($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["profile_image"]) ?>" class="kt-rounded-" /> -->
									<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
									<span class="kt-badge kt-badge--username kt-badge--lg kt-badge--brand kt-hidden kt-badge--bold">S</span>
								</div>
							</div>

							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-sm">
								<div class="kt-user-card kt-margin-b-40 kt-margin-b-30-tablet-and-mobile" style="background-image: url(assets/media/misc/head_bg_sm.jpg)">
									<div class="kt-user-card__wrapper">
										<div class="kt-user-card__pic">
											<!--use "kt-rounded" class for rounded avatar style-->
											<img alt="Pic" src="<?php echo ($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["profile_image"]) ?>" class="kt-rounded-" />
											<!-- <img alt="Pic" src="/uploads/<?php echo ($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["profile_image"]) ?>" class="kt-rounded-" /> -->
										</div>
										<div class="kt-user-card__details">
											<div class="kt-user-card__name"><?php echo ($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["nombre_1"] . " " . $_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["apellido_paterno"]) ?></div>
											<div class="kt-user-card__position">CTO, Loop Inc.</div>
										</div>
									</div>
								</div>

								<ul class="kt-nav kt-margin-b-10">
									<li class="kt-nav__item">
										<a href="custom/profile/personal-information.html" class="kt-nav__link">
											<span class="kt-nav__link-icon"><i class="flaticon2-calendar-3"></i></span>
											<span class="kt-nav__link-text">My Profile</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="custom/profile/overview-1.html" class="kt-nav__link">
											<span class="kt-nav__link-icon"><i class="flaticon2-browser-2"></i></span>
											<span class="kt-nav__link-text">My Tasks</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="custom/profile/overview-2.html" class="kt-nav__link">
											<span class="kt-nav__link-icon"><i class="flaticon2-mail"></i></span>
											<span class="kt-nav__link-text">Messages</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="custom/profile/account-settings.html" class="kt-nav__link">
											<span class="kt-nav__link-icon"><i class="flaticon2-gear"></i></span>
											<span class="kt-nav__link-text">Settings</span>
										</a>
									</li>
									<li class="kt-nav__separator kt-nav__separator--fit"></li>

									<li class="kt-nav__custom kt-space-between">
										<a href="controller/_Logout_C.php" class="btn btn-label-brand btn-upper btn-sm btn-bold">Salir</a>
										<i class="flaticon2-information kt-label-font-color-2" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
									</li>
								</ul>
							</div>
						</div>
						<!--end: User Bar -->
						<!--begin:: Quick Panel Toggler -->
						<div class="kt-header__topbar-item kt-header__topbar-item--quick-panel" data-toggle="kt-tooltip" title="Quick panel" data-placement="right">
							<span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn">
								<i class="flaticon2-grids"></i>
							</span>
						</div>
						<!--end:: Quick Panel Toggler -->

					</div>
					<!-- end:: Header Topbar -->
				</div>
				<!-- end:: Header -->

				<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

					<!-- begin:: Subheader -->

					<!-- end:: Subheader -->

					<!-- begin:: Content -->
					<div id="container"></div>
					<!-- end:: Content -->
				</div>

				<!-- begin:: Footer -->
				<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
					<div class="kt-container  kt-container--fluid ">
						<div class="kt-footer__copyright">
							2020&nbsp;&copy;&nbsp;<a href="https://www.facebook.com/sky.technologies.pe" target="_blank" class="kt-link">Sky Technologies</a>
						</div>
						<div class="kt-footer__menu">
							<a href="https://www.facebook.com/sky.technologies.pe" target="_blank" class="kt-footer__menu-link kt-link">About</a>
							<a href="https://www.facebook.com/sky.technologies.pe" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
							<a href="https://www.facebook.com/sky.technologies.pe" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
						</div>
					</div>
				</div>
				<!-- end:: Footer -->
			</div>
			<!-- end:: Wrapper -->

		</div>
		<!-- end:: Page -->
	</div>
	<!-- end:: Root -->

	<!-- begin:: Topbar Offcanvas Panels -->


	<!-- begin::Offcanvas Toolbar Quick Actions -->
	<div id="kt_offcanvas_toolbar_quick_actions" class="kt-offcanvas-panel">
		<div class="kt-offcanvas-panel__head">
			<h3 class="kt-offcanvas-panel__title">
				Quick Actions
			</h3>
			<a href="#" class="kt-offcanvas-panel__close" id="kt_offcanvas_toolbar_quick_actions_close"><i class="flaticon2-delete"></i></a>
		</div>
		<div class="kt-offcanvas-panel__body">
			<div class="kt-grid-nav-v2">
				<a href="#" class="kt-grid-nav-v2__item">
					<div class="kt-grid-nav-v2__item-icon"><i class="flaticon2-box"></i></div>
					<div class="kt-grid-nav-v2__item-title">Orders</div>
				</a>
				<a href="#" class="kt-grid-nav-v2__item">
					<div class="kt-grid-nav-v2__item-icon"><i class="flaticon-download-1"></i></div>
					<div class="kt-grid-nav-v2__item-title">Uploades</div>
				</a>
				<a href="#" class="kt-grid-nav-v2__item">
					<div class="kt-grid-nav-v2__item-icon"><i class="flaticon2-supermarket"></i></div>
					<div class="kt-grid-nav-v2__item-title">Products</div>
				</a>
				<a href="#" class="kt-grid-nav-v2__item">
					<div class="kt-grid-nav-v2__item-icon"><i class="flaticon2-avatar"></i></div>
					<div class="kt-grid-nav-v2__item-title">Customers</div>
				</a>
				<a href="#" class="kt-grid-nav-v2__item">
					<div class="kt-grid-nav-v2__item-icon"><i class="flaticon2-list"></i></div>
					<div class="kt-grid-nav-v2__item-title">Blog Posts</div>
				</a>
				<a href="#" class="kt-grid-nav-v2__item">
					<div class="kt-grid-nav-v2__item-icon"><i class="flaticon2-settings"></i></div>
					<div class="kt-grid-nav-v2__item-title">Settings</div>
				</a>
			</div>
		</div>
	</div>
	<!-- end::Offcanvas Toolbar Quick Actions -->
	<!-- end:: Topbar Offcanvas Panels -->

	<!-- begin:: Quick Panel -->
	<div id="kt_quick_panel" class="kt-offcanvas-panel">
		<div class="kt-offcanvas-panel__nav">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item active">
					<a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_notifications" role="tab">Notifications</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_actions" role="tab">Actions</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_settings" role="tab">Settings</a>
				</li>
			</ul>

			<button class="kt-offcanvas-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></button>
		</div>

		<div class="kt-offcanvas-panel__body">
			<div class="tab-content">
				<div class="tab-pane fade show kt-offcanvas-panel__content kt-scroll active" id="kt_quick_panel_tab_notifications" role="tabpanel">
					<!--Begin::Timeline -->
					<div class="kt-timeline">
						<!--Begin::Item -->
						<div class="kt-timeline__item kt-timeline__item--success">
							<div class="kt-timeline__item-section">
								<div class="kt-timeline__item-section-border">
									<div class="kt-timeline__item-section-icon">
										<i class="flaticon-feed kt-font-success"></i>
									</div>
								</div>
								<span class="kt-timeline__item-datetime">02:30 PM</span>
							</div>

							<a href="#" class="kt-timeline__item-text">
								KeenThemes created new layout whith tens of new options for Keen Admin panel
							</a>
							<div class="kt-timeline__item-info">
								HTML,CSS,VueJS
							</div>
						</div>
						<!--End::Item -->

						<!--Begin::Item -->
						<div class="kt-timeline__item kt-timeline__item--danger">
							<div class="kt-timeline__item-section">
								<div class="kt-timeline__item-section-border">
									<div class="kt-timeline__item-section-icon">
										<i class="flaticon-safe-shield-protection kt-font-danger"></i>
									</div>
								</div>
								<span class="kt-timeline__item-datetime">01:20 AM</span>
							</div>

							<a href="#" class="kt-timeline__item-text">
								New secyrity alert by Firewall & order to take aktion on User Preferences
							</a>
							<div class="kt-timeline__item-info">
								Security, Fieewall
							</div>
						</div>
						<!--End::Item -->

						<!--Begin::Item -->
						<div class="kt-timeline__item kt-timeline__item--brand">
							<div class="kt-timeline__item-section">
								<div class="kt-timeline__item-section-border">
									<div class="kt-timeline__item-section-icon">
										<i class="flaticon2-box kt-font-brand"></i>
									</div>
								</div>
								<span class="kt-timeline__item-datetime">Yestardey</span>
							</div>

							<a href="#" class="kt-timeline__item-text">
								FlyMore design mock-ups been uploadet by designers Bob, Naomi, Richard
							</a>
							<div class="kt-timeline__item-info">
								PSD, Sketch, AJ
							</div>
						</div>
						<!--End::Item -->

						<!--Begin::Item -->
						<div class="kt-timeline__item kt-timeline__item--warning">
							<div class="kt-timeline__item-section">
								<div class="kt-timeline__item-section-border">
									<div class="kt-timeline__item-section-icon">
										<i class="flaticon-pie-chart-1 kt-font-warning"></i>
									</div>
								</div>
								<span class="kt-timeline__item-datetime">Aug 13,2018</span>
							</div>

							<a href="#" class="kt-timeline__item-text">
								Meeting with Ken Digital Corp ot Unit14, 3 Edigor Buildings, George Street, Loondon<br>
								England, BA12FJ
							</a>
							<div class="kt-timeline__item-info">
								Meeting, Customer
							</div>
						</div>
						<!--End::Item -->

						<!--Begin::Item -->
						<div class="kt-timeline__item kt-timeline__item--info">
							<div class="kt-timeline__item-section">
								<div class="kt-timeline__item-section-border">
									<div class="kt-timeline__item-section-icon">
										<i class="flaticon-notepad kt-font-info"></i>
									</div>
								</div>
								<span class="kt-timeline__item-datetime">May 09, 2018</span>
							</div>

							<a href="#" class="kt-timeline__item-text">
								KeenThemes created new layout whith tens of new options for Keen Admin panel
							</a>
							<div class="kt-timeline__item-info">
								HTML,CSS,VueJS
							</div>
						</div>
						<!--End::Item -->

						<!--Begin::Item -->
						<div class="kt-timeline__item kt-timeline__item--accent">
							<div class="kt-timeline__item-section">
								<div class="kt-timeline__item-section-border">
									<div class="kt-timeline__item-section-icon">
										<i class="flaticon-bell kt-font-success"></i>
									</div>
								</div>
								<span class="kt-timeline__item-datetime">01:20 AM</span>
							</div>

							<a href="#" class="kt-timeline__item-text">
								New secyrity alert by Firewall & order to take aktion on User Preferences
							</a>
							<div class="kt-timeline__item-info">
								Security, Fieewall
							</div>
						</div>
						<!--End::Item -->

					</div>
					<!--End::Timeline -->
				</div>
				<div class="tab-pane fade kt-offcanvas-panel__content kt-scroll" id="kt_quick_panel_tab_actions" role="tabpanel">
					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--solid-success">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon kt-hide"><i class="flaticon-stopwatch"></i></span>
								<h3 class="kt-portlet__head-title">Recent Bills</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-group">
									<div class="dropdown dropdown-inline">
										<button type="button" class="btn btn-sm btn-font-light btn-outline-hover-light btn-circle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											<i class="flaticon-more"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="#">Action</a>
											<a class="dropdown-item" href="#">Another action</a>
											<a class="dropdown-item" href="#">Something else here</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="#">Separated link</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-portlet__content">
								Lorem Ipsum is simply dummy text of the printing and typesetting simply dummy text of
								the printing industry.
							</div>
						</div>
						<div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
							<a href="#" class="btn btn-bold btn-upper btn-sm btn-font-light btn-outline-hover-light">Dismiss</a>
							<a href="#" class="btn btn-bold btn-upper btn-sm btn-font-light btn-outline-hover-light">View</a>
						</div>
					</div>
					<!--end::Portlet-->

					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--solid-focus">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon kt-hide"><i class="flaticon-stopwatch"></i></span>
								<h3 class="kt-portlet__head-title">Latest Orders</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-group">
									<div class="dropdown dropdown-inline">
										<button type="button" class="btn btn-sm btn-font-light btn-outline-hover-light btn-circle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											<i class="flaticon-more"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="#">Action</a>
											<a class="dropdown-item" href="#">Another action</a>
											<a class="dropdown-item" href="#">Something else here</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="#">Separated link</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-portlet__content">
								Lorem Ipsum is simply dummy text of the printing and typesetting simply dummy text of
								the printing industry.
							</div>
						</div>
						<div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
							<a href="#" class="btn btn-bold btn-upper btn-sm btn-font-light btn-outline-hover-light">Dismiss</a>
							<a href="#" class="btn btn-bold btn-upper btn-sm btn-font-light btn-outline-hover-light">View</a>
						</div>
					</div>
					<!--end::Portlet-->

					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--solid-info">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">Latest Invoices</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-group">
									<div class="dropdown dropdown-inline">
										<button type="button" class="btn btn-sm btn-font-light btn-outline-hover-light btn-circle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											<i class="flaticon-more"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="#">Action</a>
											<a class="dropdown-item" href="#">Another action</a>
											<a class="dropdown-item" href="#">Something else here</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="#">Separated link</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-portlet__content">
								Lorem Ipsum is simply dummy text of the printing and typesetting simply dummy text of
								the printing industry.
							</div>
						</div>
						<div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
							<a href="#" class="btn btn-bold btn-upper btn-sm btn-font-light btn-outline-hover-light">Dismiss</a>
							<a href="#" class="btn btn-bold btn-upper btn-sm btn-font-light btn-outline-hover-light">View</a>
						</div>
					</div>
					<!--end::Portlet-->

					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--solid-warning">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">New Comments</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-group">
									<div class="dropdown dropdown-inline">
										<button type="button" class="btn btn-sm btn-font-light btn-outline-hover-light btn-circle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											<i class="flaticon-more"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="#">Action</a>
											<a class="dropdown-item" href="#">Another action</a>
											<a class="dropdown-item" href="#">Something else here</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="#">Separated link</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-portlet__content">
								Lorem Ipsum is simply dummy text of the printing and typesetting simply dummy text of
								the printing industry.
							</div>
						</div>
						<div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
							<a href="#" class="btn btn-bold btn-upper btn-sm btn-font-light btn-outline-hover-light">Dismiss</a>
							<a href="#" class="btn btn-bold btn-upper btn-sm btn-font-light btn-outline-hover-light">View</a>
						</div>
					</div>
					<!--end::Portlet-->

					<!--begin::Portlet-->
					<div class="kt-portlet kt-portlet--solid-brand">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">Recent Posts</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-group">
									<div class="dropdown dropdown-inline">
										<button type="button" class="btn btn-sm btn-font-light btn-outline-hover-light btn-circle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											<i class="flaticon-more"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="#">Action</a>
											<a class="dropdown-item" href="#">Another action</a>
											<a class="dropdown-item" href="#">Something else here</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="#">Separated link</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-portlet__content">
								Lorem Ipsum is simply dummy text of the printing and typesetting simply dummy text of
								the printing industry.
							</div>
						</div>
						<div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
							<a href="#" class="btn btn-bold btn-upper btn-sm btn-font-light btn-outline-hover-light">Dismiss</a>
							<a href="#" class="btn btn-bold btn-upper btn-sm btn-font-light btn-outline-hover-light">View</a>
						</div>
					</div>
					<!--end::Portlet-->
				</div>
				<div class="tab-pane fade kt-offcanvas-panel__content kt-scroll" id="kt_quick_panel_tab_settings" role="tabpanel">
					<form class="kt-form">
						<div class="kt-heading kt-heading--space-sm">Notifications</div>

						<div class="form-group form-group-xs row">
							<label class="col-8 col-form-label">Enable notifications:</label>
							<div class="col-4 kt-align-right">
								<span class="kt-switch kt-switch--sm">
									<label>
										<input type="checkbox" checked="checked" name="quick_panel_notifications_1">
										<span></span>
									</label>
								</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-8 col-form-label">Enable audit log:</label>
							<div class="col-4 kt-align-right">
								<span class="kt-switch kt-switch--sm">
									<label>
										<input type="checkbox" name="quick_panel_notifications_2">
										<span></span>
									</label>
								</span>
							</div>
						</div>
						<div class="form-group form-group-last form-group-xs row">
							<label class="col-8 col-form-label">Notify on new orders:</label>
							<div class="col-4 kt-align-right">
								<span class="kt-switch kt-switch--sm">
									<label>
										<input type="checkbox" checked="checked" name="quick_panel_notifications_2">
										<span></span>
									</label>
								</span>
							</div>
						</div>

						<div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>

						<div class="kt-heading kt-heading--space-sm">Orders</div>

						<div class="form-group form-group-xs row">
							<label class="col-8 col-form-label">Enable order tracking:</label>
							<div class="col-4 kt-align-right">
								<span class="kt-switch kt-switch--sm kt-switch--danger">
									<label>
										<input type="checkbox" checked="checked" name="quick_panel_notifications_3">
										<span></span>
									</label>
								</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-8 col-form-label">Enable orders reports:</label>
							<div class="col-4 kt-align-right">
								<span class="kt-switch kt-switch--sm kt-switch--danger">
									<label>
										<input type="checkbox" name="quick_panel_notifications_3">
										<span></span>
									</label>
								</span>
							</div>
						</div>
						<div class="form-group form-group-last form-group-xs row">
							<label class="col-8 col-form-label">Allow order status auto update:</label>
							<div class="col-4 kt-align-right">
								<span class="kt-switch kt-switch--sm kt-switch--danger">
									<label>
										<input type="checkbox" checked="checked" name="quick_panel_notifications_4">
										<span></span>
									</label>
								</span>
							</div>
						</div>

						<div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>

						<div class="kt-heading kt-heading--space-sm">Customers</div>

						<div class="form-group form-group-xs row">
							<label class="col-8 col-form-label">Enable customer singup:</label>
							<div class="col-4 kt-align-right">
								<span class="kt-switch kt-switch--sm kt-switch--success">
									<label>
										<input type="checkbox" checked="checked" name="quick_panel_notifications_5">
										<span></span>
									</label>
								</span>
							</div>
						</div>
						<div class="form-group form-group-xs row">
							<label class="col-8 col-form-label">Enable customers reporting:</label>
							<div class="col-4 kt-align-right">
								<span class="kt-switch kt-switch--sm kt-switch--success">
									<label>
										<input type="checkbox" name="quick_panel_notifications_5">
										<span></span>
									</label>
								</span>
							</div>
						</div>
						<div class="form-group form-group-last form-group-xs row">
							<label class="col-8 col-form-label">Notifiy on new customer registration:</label>
							<div class="col-4 kt-align-right">
								<span class="kt-switch kt-switch--sm kt-switch--success">
									<label>
										<input type="checkbox" checked="checked" name="quick_panel_notifications_6">
										<span></span>
									</label>
								</span>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end:: Quick Panel -->


	<!-- begin::Scrolltop -->
	<div id="kt_scrolltop" class="kt-scrolltop">
		<i class="fa fa-arrow-up"></i>
	</div>
	<!-- end::Scrolltop -->

	<!-- begin::Global Config(global config for global JS sciprts) -->
	<script>
		var KTAppOptions = {
			"colors": {
				"state": {
					"brand": "#5d78ff",
					"metal": "#c4c5d6",
					"light": "#ffffff",
					"accent": "#00c5dc",
					"primary": "#5867dd",
					"success": "#34bfa3",
					"info": "#36a3f7",
					"warning": "#ffb822",
					"danger": "#fd3995",
					"focus": "#9816f4"
				},
				"base": {
					"label": [
						"#c5cbe3",
						"#a1a8c3",
						"#3d4465",
						"#3e4466"
					],
					"shape": [
						"#f0f3ff",
						"#d9dffa",
						"#afb4d4",
						"#646c9a"
					]
				}
			}
		};
	</script>
	<!-- end::Global Config -->

	<!--begin::Global Theme Bundle(used by all pages) -->
	<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>
	<!--end::Global Theme Bundle -->

	<!--begin::Page Vendors(used by this page) -->
	<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
	<script src="assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
	<script src="assets/js/pages/components/bootbox/bootbox.all.min.js" type="text/javascript"></script>
	<script src="assets/js/pages/components/notify/bootstrap-notify.min.js" type="text/javascript"></script>
	<script src="assets/js/pages/components/extended/blockui.js" type=""></script>

	<!--end::Page Vendors -->

	<!--begin::Page Scripts(used by this page) -->
	<script src="assets/js/pages/dashboard.js" type="text/javascript"></script>
	<script src="assets/js/custom.js" type="text/javascript"></script>
	<!--end::Page Scripts -->
</body>
<!-- end::Body -->

<!-- Mirrored from keenthemes.com/keen/preview/demo1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Feb 2020 21:26:52 GMT -->

</html>