@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	About Us
@endsection 
@section('meta')
@endsection

@section('main-content')
	
	<div class="page-content bg-light">
	
		<section class="dz-bnr-inr dz-bnr-inr-sm bg-light">
			<div class="container">
				<div class="dz-bnr-inr-entry ">
					<div class="row align-items-center">
						<div class="col-lg-7 col-md-7">
							<div class="text-start mb-xl-0 mb-4">
								
								<nav aria-label="breadcrumb" class="breadcrumb-row">
									<ul class="breadcrumb">
										<li class="breadcrumb-item"><a href="{{ route('home') }}"> Home</a></li>
										<li class="breadcrumb-item">About us</li>
									</ul>
								</nav>
							</div>							
						</div>
						<div class="col-lg-5 col-md-5">
							<div class="about-sale text-start">
								<div class="row">
									<div class="col-lg-5 col-md-6 col-6">
										<div class="about-content">
											<h2 class="title"><span class="counter">5000</span>+</h2>
											<p class="text">Items Sale</p>
										</div>
									</div>
									<div class="col-lg-5 col-md-6 col-6 ps-5">
										<div class="about-content">
											<h2 class="title">90%</h2>
											<p class="text">Delivery Ratio</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="about-banner overflow-visible pb-5">
			<video autoplay loop muted id="video-background">
				<source src="/assets/images/background/bg-video.mp4" type="video/mp4">
			</video>
			<div class="about-info">
				<h3 class="dz-title">
					<a href="about-me.html">why {{ $abouts->name ?? 'N/A' }} ?</a>
				</h3>
				<p class="text mb-0">{!! $abouts->about ?? 'N/A' !!}</p>
			</div>
		</section>		

		<section class="content-inner pt-5">
			<div class="container">
				<div class="row about-style2 align-items-xl-center align-items-start pt-5">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="about-content">
							<div class="section-head style-2 d-block">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


		<!-- Get In Touch -->
		<section class="get-in-touch">
			<div class="m-r100 m-md-r0 m-sm-r0">
				<h3 class="dz-title mb-lg-0 mb-3">Questions ?
					<span>Our experts will help find the grar that’s right for you</span>
				</h3>
			</div>
			<a href="{{ route('contact') }}" class="btn btn-light">Get In Touch</a>
		</section>
		<!-- Get In Touch End -->
		
	</div>

@endsection
@section('scripts')
@endsection
