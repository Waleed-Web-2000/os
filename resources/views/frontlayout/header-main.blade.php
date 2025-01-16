@section('header')
	@php
		$data = DB::table('settings')->first();     
	 @endphp

	<header class="site-header mo-left header header-transparent">			
		<div class="main-bar-wraper navbar-expand-lg">
			<div class="main-bar clearfix">
				<div class="container-fluid clearfix d-lg-flex d-block">
					<!-- Website Logo -->
					<div class="logo-header logo-dark me-md-5">
						<a href="{{ route('home') }}"><img src="{{ asset('storage/uploads/setting/' . ($data->logo ?? 'N/A')) }}" alt="logo"></a>
					</div>
					
					<!-- Nav Toggle Button -->
				
					<button class="navbar-toggler collapsed navicon justify-content-end" type="button"
					data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
					aria-expanded="false" aria-label="Toggle navigation">
					<span></span>
					<span></span>
					<span></span>
				</button>
					
				<!-- Main Nav -->
				<div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
					<div class="logo-header logo-dark">
						<a href="{{ route('home') }}"><img src="{{ asset('storage/uploads/setting/' . ($data->logo ?? 'N/A')) }}" alt=""></a>
					</div>
					<ul class="nav navbar-nav">
						<li class="has-mega-menu sub-menu-down">
							<a href="{{ route('home') }}">Home</a>
							<a href="{{ route('shop') }}">Shop</a>
							<a href="{{ route('about') }}">About</a>
							<a href="{{ route('contact') }}">Contact</a>
						</li>	
					</ul>
					<div class="dz-social-icon">
						<ul>
							<li><a class="fab fa-facebook-f" target="_blank" href="https://www.facebook.com/dexignzone"></a></li>
							<li><a class="fab fa-twitter" target="_blank" href="https://twitter.com/dexignzones"></a></li>
							<li><a class="fab fa-linkedin-in" target="_blank" href="https://www.linkedin.com/showcase/3686700/admin/"></a></li>
							<li><a class="fab fa-instagram" target="_blank" href="https://www.instagram.com/dexignzone/"></a></li>
						</ul>
					</div>
				</div>
				
				</div>
			</div>
		</div>
		<!-- Main Header End -->
	<!-- SearchBar -->
		<div class="dz-search-area dz-offcanvas offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop">
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
				×
			</button>
			<div class="container">
				<form class="header-item-search">
					<div class="input-group search-input">
						<select class="default-select">
							@php
								$categories = DB::table('categories')->limit(6)->get();     
							@endphp
							<option>All Categories</option>
							@forelse ($categories as $category)
							<option>{{$category->name}}</option>
							@empty
							<option>...</option>
							@endforelse
						</select>
						<input type="search" class="form-control" placeholder="Search Product">
						<button class="btn" type="button">
							<i class="iconly-Light-Search"></i>
						</button>
					</div>
					<ul class="recent-tag">
						<li class="pe-0"><span>Quick Search :</span></li>
						@forelse ($categories as $category)
						<li><a href="{{route('category-detail', $category->slug)}}">{{$category->name}}</a></li>
						@empty
						<li>...</li>
						@endforelse
					</ul>
				</form>
				<div class="row">
					<div class="col-xl-12">
						<h5 class="mb-3">You May Also Like</h5>
						<div class="swiper category-swiper2">
							@php
								$products = DB::table('products')->limit(8)->get();     
							@endphp
							<div class="swiper-wrapper">
								@forelse ($products as $product)
								<div class="swiper-slide">
									<div class="shop-card">
										<div class="dz-media ">
											<img src="{{ asset('storage/uploads/product/' . $product->image ) }}" alt="{{$product->name}}">
										</div>
										<div class="dz-content">
											<h6 class="title"><a href="{{route('product-detail', $product->slug)}}">{{$product->name}}</a></h6>
											<h6 class="price">RS/{{$product->price}}</h6>
										</div>
									</div>
								</div>
								@empty
								<li>...</li>
								@endforelse			
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- SearchBar -->
		
		<!-- Sidebar cart -->
		<div class="offcanvas dz-offcanvas offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight">
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
				×
			</button>
			<div class="offcanvas-body">
				<div class="product-description">
					<div class="dz-tabs">
						<ul class="nav nav-tabs center" id="myTab" role="tablist">

							@php
								$items = Cart::instance('cart')->content();     
							@endphp

							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="shopping-cart" data-bs-toggle="tab" data-bs-target="#shopping-cart-pane" type="button" role="tab" aria-controls="shopping-cart-pane" aria-selected="true">Shopping Cart
									<span class="badge badge-light">@if (Cart::instance('cart')->count() > 0) 
											    {{ Cart::instance('cart')->count() }}
											 @else
											    0
											@endif</span>
								</button>
							</li>
						</ul>
						<div class="tab-content pt-4" id="dz-shopcart-sidebar">
							<div class="tab-pane fade show active" id="shopping-cart-pane" role="tabpanel" aria-labelledby="shopping-cart" tabindex="0">
								<div class="shop-sidebar-cart">
									@if ($items->count()>0)
									<ul class="sidebar-cart-list">
										@forelse ($items as $item)
										<li>
											<div class="cart-widget">
												<div class="dz-media me-3">
													<img src="{{ asset('storage/uploads/product/' . $item->options->image) }}" alt="{{$item->name}}">
												</div>
												<div class="cart-content">
													<h6 class="title"><a href="/">{{$item->name}}</a></h6>
													<div class="d-flex align-items-center">
														<h6 class="dz-price mb-0">RS/{{$item->price}} </h6>
														<h6 class="dz-price mb-0 mx-2">x</h6>
														<h6 class="dz-price mb-0">({{$item->qty}})</h6>
													</div>
												</div>
												<form method="POST" action="{{ route('cart.item.remove', ['rowId' => $item->rowId]) }}">
			                                    @csrf
			                                    @method('DELETE')
												<button type="submit" class="dz-close btn"><i class="ti-close"></i></button>
												</form>
											</div>
										</li>
										@empty
										<li>...</li>
										@endforelse
									</ul>
									@endif
									<div class="cart-total">
										<h5 class="mb-0">Subtotal:</h5>
										<h5 class="mb-0">RS/{{Cart::instance('cart')->subtotal()}}</h5>
									</div>
									<div class="">
										
										<a href="{{ route('checkout') }}" class="btn btn-outline-secondary btn-block m-b20">Checkout</a>	
										<a href="{{ route('cart') }}" class="btn btn-secondary btn-block">View Cart</a>	
									</div>	
								</div>	
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	

				
					
@endsection
