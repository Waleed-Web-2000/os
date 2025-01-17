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
	<!-- STYLESHEETS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swiper/6.4.5/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">

    <link rel="stylesheet" href="/assets/css/skin/skin-1.css">

    <link rel="stylesheet" href="/assets/css/style.css">



	
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swiper/6.4.5/swiper-bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" defer></script>
   
    <script src="/assets/js/custom.js" defer></script>
    <script src="/assets/js/dz.ajax.js" defer></script>
    <script src="/assets/js/dz.carousel.min.js" defer></script>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuButton = document.getElementById('menuButton');
            const menu = document.getElementById('menu');

            menuButton.addEventListener('click', (event) => {
                event.stopPropagation();
                menu.classList.toggle('show');
            });

            document.addEventListener('click', (event) => {
                if (!menu.contains(event.target) && !menuButton.contains(event.target)) {
                    menu.classList.remove('show');
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
