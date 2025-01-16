<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Title -->
	@php
		$data = DB::table('settings')->first();     
	 @endphp
	<title> @yield('page-title') | {{ $data->name ?? 'N/A' }} </title>
	
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Sehatdar">
	<script src="https://unpkg.com/feather-icons"></script>

	<meta name="robots" content="index, follow">
	<meta name="format-detection" content="telephone=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="google-site-verification" content="xmEW2UcTN53HrCsyFCFrvXLc-lVDAeNsHShfLfgr5cA" />
	@yield('meta')
	<!-- FAVICONS ICON -->
	<link rel="icon" type="image/x-icon" href="{{ asset('storage/uploads/setting/fev/' . ($data->fev ?? 'N/A')) }}
">
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="/assets/icons/iconly/index.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/vendor/magnific-popup/magnific-popup.min.css">	
	<link rel="stylesheet" type="text/css" href="/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/vendor/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/vendor/nouislider/nouislider.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="/assets/vendor/lightgallery/dist/css/lightgallery.css" >
    <link rel="stylesheet" type="text/css" href="/assets/vendor/lightgallery/dist/css/lg-thumbnail.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/lightgallery/dist/css/lg-zoom.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/slick/slick.css">

	<!-- Custom Stylesheet -->
	<link class="main-css" rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link class="skin" type="text/css" rel="stylesheet" href="/assets/css/skin/skin-1.css">
	
	<!-- GOOGLE FONTS-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">



</head>	
	<body>
	<div class="page-wraper">

		@yield('header')

		@yield('main-content')

		@yield('footer')


	

	</div>

<!-- JAVASCRIPT FILES ========================================= -->
<script src="/assets/js/jquery.min.js"></script><!-- JQUERY MIN JS -->
<script src="/assets/vendor/wow/wow.min.js"></script><!-- WOW JS -->
<script src="/assets/vendor/bootstrap/dist//js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP MIN JS -->
<script src="/assets/vendor/bootstrap-select/dist//js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT MIN JS -->
<script src="/assets/vendor/bootstrap-touchspin/bootstrap-touchspin.js"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
<script src="/assets/vendor/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="/assets/vendor/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script><!-- SWIPER JS -->
<script src="/assets/vendor/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="/assets/vendor/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED-->
<script src="/assets/vendor/masonry/masonry-4.2.2.js"></script><!-- MASONRY -->
<script src="/assets/vendor/masonry/isotope.pkgd.min.js"></script><!-- ISOTOPE -->
<script src="/assets/vendor/countdown/jquery.countdown.js"></script><!-- COUNTDOWN FUCTIONS  -->
<script src="/assets/vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="/assets/vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="/assets/vendor/slick/slick.min.js"></script><!-- CAROUSEL MIN JS -->
<script src="/assets/vendor/lightgallery/dist/lightgallery.min.js"></script>
<script src="/assets/vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="/assets/vendor/lightgallery/dist/plugins/zoom/lg-zoom.min.js"></script>
<script src="/assets/js/dz.carousel.js"></script><!-- DZ CAROUSEL JS -->
<script src="/assets/js/dz.ajax.js"></script><!-- AJAX -->
<script src="/assets/js/custom.js"></script><!-- CUSTOM JS -->
<script>
	document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.getElementById('menuButton');
    const menu = document.getElementById('menu');

    // Toggle the menu visibility
    menuButton.addEventListener('click', (event) => {
        event.stopPropagation();
        menu.classList.toggle('show');
    });

    // Close the menu when clicking outside
    document.addEventListener('click', (event) => {
        if (!menu.contains(event.target) && !menuButton.contains(event.target)) {
            menu.classList.remove('show');
        }
    });
});
</script>
@yield ('scripts')
</body>
</html>
