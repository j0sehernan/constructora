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
							<li class="kt-menu__item kt-menu__item--submenu -modulo-" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" id="modulo-reportes">
								<a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-print"></i><span class="kt-menu__link-text">Reportes</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
								<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
										<li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Reportes</span></span></li>
										<li class="kt-menu__item -menu-" id="menu-avanceProyecto"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Avance de Proyecto</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-ventas"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Ventas</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-pagoProveedores"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pago a Proveedores</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-reportOrdenesCompra"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Ordenes de Compra</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-reportMovimientosAlmacen"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Movimientos de Almacen</span></a></li>
									</ul>
								</div>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu -modulo-" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" id="modulo-menu">
								<a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-graphic"></i><span class="kt-menu__link-text">Menú</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
								<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
										<li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Menú</span></span></li>
										<li class="kt-menu__item -menu-" id="menu-proyectoVenta"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Ventas</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-proyectoRequerimiento"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Requerimientos</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-kardex"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Kardex</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-pagoContratista"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pagos a Contratistas</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-pagoProveedor"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pagos a Proveedores</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-proyecto"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Proyectos</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-ordenCompra"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Ordenes de Compra</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-persona"><a class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Personas</span></a></li>
									</ul>
								</div>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu -modulo-" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" id="modulo-maestros">
								<a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-database"></i><span class="kt-menu__link-text">Maestros</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
								<div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
										<li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Maestros</span></span></li>
										<li class="kt-menu__item -menu-" id="menu-producto"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Productos</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-productoMarca"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Marcas</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-almacen"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Almacen</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-unidadMedida"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Unidades de Medida</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-emailTipo"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tipos de Email</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-telefonoTipo"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tipos de Teléfono</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-estadoCivil"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Estados Civiles</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-comprobantePagoTipo"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tipos de Comprobantes de Pago</span></a></li>
									</ul>
								</div>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu -modulo-" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" id="modulo-sistema">
								<a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-cogs"></i><span class="kt-menu__link-text">Sistema</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
								<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
										<li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Sistema</span></span></li>
										<li class="kt-menu__item -menu-" id="menu-formaPago"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Formas de Pago</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-rol"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Roles</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-rolPermiso"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Permisos por Rol</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-personaTipo"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tipos de Persona</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-documentoIdentidad"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Documentos de Identidad</span></a></li>
										<li class="kt-menu__item -menu-" id="menu-genero"><a class="kt-menu__link"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Géneros</span></a></li>
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
							<div class="kt-footer__copyright">
								2020&nbsp;©&nbsp;<a href="https://www.facebook.com/sky.technologies.pe" target="_blank" class="kt-link">Sky Technologies</a>
							</div>
						</div>
					</div>
				</div>
				<!-- end:: Aside Footer-->
			</div>
			<!-- end:: Aside -->
			<!-- begin:: Wrapper -->
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
				<!-- begin:: Header -->
				<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " style="justify-content: flex-end;">
					<!-- begin:: Header Topbar -->
					<div class="kt-header__topbar">
						<!--begin: Notifications -->
						<div class="kt-header__topbar-item dropdown">
							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px">
								<span class="kt-header__topbar-icon" id="flagNotification">
									<i class="flaticon2-bell-alarm-symbol"></i>
								</span>
							</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
								<form>
									<div class="kt-head" style="background-image: url(assets/media/misc/head_bg_sm.jpg)">
										<h3 class="kt-head__title">Notificaciones</h3>
										<div class="kt-head__sub"><span id="notificationsCount" class="kt-head__desc">0 Notificaciones</span></div>
									</div>
									<div id="notificationsList" class="kt-notification kt-margin-t-30 kt-margin-b-20 kt-scroll" data-scroll="true" data-height="270" data-mobile-height="220">

									</div>
								</form>
							</div>
						</div>
						<!--end: Notifications -->
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
											<!-- <div class="kt-user-card__position">CTO, Loop Inc.</div> -->
										</div>
									</div>
								</div>

								<ul class="kt-nav kt-margin-b-10">
									<!-- <li class="kt-nav__item">
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
									</li> -->
									<li class="kt-nav__separator kt-nav__separator--fit"></li>

									<li class="kt-nav__custom kt-space-between">
										<a href="controller/_Logout_C.php" class="btn btn-label-brand btn-upper btn-sm btn-bold">Salir</a>
										<!-- <i class="flaticon2-information kt-label-font-color-2" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i> -->
									</li>
								</ul>
							</div>
						</div>
						<!--end: User Bar -->
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
	<script src="assets/js/admin.js" type="text/javascript"></script>
	<!--end::Page Scripts -->
</body>
<!-- end::Body -->

<!-- Mirrored from keenthemes.com/keen/preview/demo1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Feb 2020 21:26:52 GMT -->

</html>