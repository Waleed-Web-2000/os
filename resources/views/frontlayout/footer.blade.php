@section('footer')
	@php
		$data = DB::table('settings')->first();     
	 @endphp
	<footer class="site-footer  footer-dark">
<div class="footer-top">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="widget widget_about me-2">
					<ul class="widget-address nav-inline">
						<li>
							<p><span>E-mail</span> : {{ $data->email ?? 'N/A' }}</p>
						</li>
						<li>
							<p><span>Phone</span> : {{ $data->phone ?? 'N/A' }}</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<div class="widget widget_services text-lg-end">
					<ul class="nav-inline mb-3">
						<li><a href="{{ route('home') }}">Home</a></li>
						<li><a href="{{ route('shop') }}">Shop</a></li>
						<li><a href="{{ route('about') }}">About</a></li>
						<li><a href="{{ route('contact') }}">Contact</a></li>
					</ul>
					<ul class="nav-inline">
						<li><a href="javascript:void();" target="_blank" class="site-button-link facebook hover"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="javascript:void();" target="_blank" class="site-button-link google-plus hover"><i class="fab fa-youtube"></i></a></li>
						<li><a href="javascript:void();" target="_blank" class="site-button-link instagram hover"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="footer-bottom">
	<div class="container">
		<div class="row fb-inner">
			<div class="col-lg-6 col-md-12 text-start"> 
				<p class="copyright-text"> <a href="/">{{ $data->copy_right ?? 'N/A' }}</a></p>
			</div>
			<div class="col-lg-6 col-md-12 text-end"> 
				<div class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-lg-end">
					<span class="me-3">We Accept: </span>
					<img src="/assets/images/footer-img.png" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
</footer>						
		
		<!-- Floating Cog Button -->
		
		<button id="menuButton" type="button" class="floating-cog-btn me-1 bg-primary">
    <i class="fa fa-cog rotating-icon"></i>
</button>


		<div id="menu" class="floating-menu">
		    <!-- Login/Username -->
		    @if (Route::has('login'))
		        @guest
		            <a href="{{ route('login') }}" class="menu-item bg-primary">
		                <i class="fa fa-sign-in"></i>
		            </a>
		        @else
		            <a href="{{ Auth::user()->utype === 'ADM' ? route('dashboard') : route('user.index') }}" class="menu-item bg-green">
		                <i class="fa fa-user"></i>
		            </a>
		        @endguest
		    @endif

		    <!-- Search -->
		    <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" class="menu-item bg-primary">
		        <i class="fa fa-search"></i>
		    </a>

		    <!-- Cart -->
		    <a href="{{ route('cart') }}" class="menu-item bg-primary">
			    <i class="fa fa-shopping-cart"></i>
			    <span class="cart-count-badge">
			        @if (Cart::instance('cart')->count() > 0) 
			            {{ Cart::instance('cart')->count() }}
			        @else
			            0
			        @endif
			    </span>
			</a>


		    <!-- Logout -->
		    <form method="POST" action="{{ route('logout') }}" x-data>
		        @csrf
		        <button type="submit" class="menu-item bg-primary">
		            <i class="fa fa-sign-out"></i>
		        </button>
		    </form>
		</div>		

@endsection
