<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Title -->
	@php
      $data=DB::table('settings')->first();                          
    @endphp
    
	<title>@yield('page_title') | {{ $data->name ?? 'N/A' }}</title> 
	
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" type="image/x-icon" href="{{ asset('storage/uploads/setting/fev/' . ($data->fev ?? 'N/A')) }}">
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- STYLESHEETS -->
	
	<link rel="stylesheet" type="text/css" href="/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/vendor/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/vendor/nouislider/nouislider.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="/assets/vendor/lightgallery/dist/css/lightgallery.css" >
    <link rel="stylesheet" type="text/css" href="/assets/vendor/lightgallery/dist/css/lg-thumbnail.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/lightgallery/dist/css/lg-zoom.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
	
	
	<!-- GOOGLE FONTS-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

</head>
<body>
<div class="page-wraper">

	<!-- <div id="loading-area" class="preloader-wrapper-4">
		<img src="/assets/images/loading.gif" alt="">
	</div> -->

	<x-app-layout>
	<div class="page-content bg-light">
		
		<!--Banner Start-->
		<div class="dz-bnr-inr bg-secondary overlay-black-light" style="background-color: 000;">
			<div class="container">
				<div class="dz-bnr-inr-entry">
					<h1>@yield('page_title')</h1>
				</div>
			</div>	
		</div>
		<!--Banner End-->
		
		<div class="content-inner-1">
			<div class="container">
                <div class="row">
					<aside class="col-xl-3">
						<div class="toggle-info">
							<h5 class="title mb-0">{{ $data->name ?? 'N/A' }}</h5>
							<a class="toggle-btn" href="#accountSidebar">Account Menu</a>
						</div>
						<div class="sticky-top account-sidebar-wrapper">
							<div class="account-sidebar" id="accountSidebar">
								<div class="profile-head">
									<div class="user-thumb">
										<img class="rounded-circle" src="/assets/images/profile4.jpg" alt="Susan Gardner">
									</div>
									<h5 class="title mb-0">{{Auth()->user()->name}}</h5>
									<span class="text text-primary">{{Auth()->user()->email}}</span>
								</div>
								<div class="account-nav">
									<div class="nav-title bg-secondary text-white">DASHBOARD</div>
									<ul>
										<li><a class="text-underline btn-link Text" href="{{Route('dashboard')}}">DASHBOARD</a></li>
									</ul>
									<div class="nav-title bg-secondary text-white">USERS</div>
									<ul>
										<li><a class="text-underline btn-link Text" href="{{Route('user.all')}}">VIEW USERS</a></li>
									</ul>
									<div class="nav-title bg-secondary text-white">CATEGORIES</div>
									<ul class="account-info-list">
										<li><a class="text-underline btn-link Text" href="{{Route('category.all')}}">VIEW CATEGORIES</a></li>
									</ul>
		 							<div class="nav-title bg-secondary text-white">PRODUCTS</div>
									<ul class="account-info-list"> 
										<li><a class="text-underline btn-link Text" href="{{Route('product.all')}}">VIEW PRODUCTS</a></li>
									</ul>
									<div class="nav-title bg-secondary text-white">USER PAYOUTS</div>
									<ul class="account-info-list">
										<li><a class="text-underline btn-link Text" href="{{Route('admin.user.payout')}}">VIEW PAYOUT</a></li>
									</ul>
									<div class="nav-title bg-secondary text-white">ORDERS</div>
									<ul class="account-info-list">
										<li><a class="text-underline btn-link Text" href="{{Route('addtocartorders')}}">VIEW ORDERS</a></li>
									</ul> 
									<div class="nav-title bg-secondary text-white">WEB SETTING</div>
									<ul class="account-info-list">
										<li><a class="text-underline btn-link Text" href="{{Route('settings')}}">VIEW & EDIT SETTING</a></li>
									</ul>
								</div>
							</div>
						</div>
                    </aside>
                    
                    @yield('main_content')

                </div>
      		</div>
		</div>
	</div>
</x-app-layout>

	
	
	<button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>

</div>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="/assets/js/jquery.min.js"></script><!-- JQUERY MIN JS -->
<script src="/assets/vendor/wow/wow.min.js"></script><!-- WOW JS -->
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP MIN JS -->
<script src="/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT MIN JS -->
<script src="/assets/vendor/bootstrap-touchspin/bootstrap-touchspin.js"></script><!-- BOOTSTRAP TOUCHSPIN JS -->
<script src="/assets/vendor/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="/assets/vendor/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script><!-- SWIPER JS -->
<script src="/assets/vendor/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED-->
<script src="/assets/vendor/masonry/masonry-4.2.2.js"></script><!-- MASONRY -->
<script src="/assets/vendor/masonry/isotope.pkgd.min.js"></script><!-- ISOTOPE -->
<script src="/assets/vendor/countdown/jquery.countdown.js"></script><!-- COUNTDOWN FUCTIONS  -->
<script src="/assets/vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="/assets/vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="/assets/js/dz.carousel.js"></script><!-- DZ CAROUSEL JS -->
<script src="/assets/js/dz.ajax.js"></script><!-- AJAX -->
<script src="/assets/js/custom.js"></script><!-- CUSTOM JS -->
 @yield('scripts')
</body>
</html>