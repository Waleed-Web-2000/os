@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	Home 
@endsection 
@section('meta')
@endsection

@section('main-content')
	<div class="page-content bg-light">
		
		<!--Swiper Banner Start -->
		<div class="main-slider style-3"> 
			<div class="container">
				<div class="banner-content">
					<div class="row gx-0">
						@if ($product)
						<div class="col-md-12 col-lg-8 align-self-center">
							<div class="inner-content">
								<div class="content-info">
									<h1 class="title mb-4 wow flipInX animated" data-wow-delay="0.5s">{{$product->name}}</h1>
									<p class="text" data-swiper-parallax="-40">{!! $product->description !!}</p>
									<div class="content-btn m-b30 wow fadeInUp" data-wow-delay="0.8s" data-swiper-parallax="-60">
										
										<a class="btn btn-secondary btn-lg btnhover20" href="{{route('product-detail', $product->slug)}}">VIEW DETAILS</a>
									</div>
								</div>
							</div>
							<div class="row">
								@forelse ($banner as $product)
								<div class="col-sm-12 col-md-6 col-lg-5 mb-3 wow fadeInUp" data-wow-delay="0.1s">
									<div class="product-card">
										<div class="dz-media">
											<img src="{{ asset('storage/uploads/product/' . $product->image) }}" alt="/">									
										</div>
										<div class="dz-content">
											<h5 class="dz-title"><a href="{{route('product-detail', $product->slug)}}">{{ $product->name }}</a></h5>
											<span class="price">
												@if($product->sale_price)
												    RS/{{ $product->sale_price }} <del>Rs/{{ $product->price }}</del>
												@else
												    RS/{{ $product->price }}
												@endif 
											</span>
										</div>
									</div>
								</div>
								@empty
								@endforelse
							</div>
						</div>
						<div class="col-md-12 col-lg-4">
							<div class="banner-media">
								<div class="img-preview wow slideInRight" data-wow-delay="0.1s" data-wow-duration="1.5s">
									<img src="{{ asset('storage/uploads/product/' . $product->image) }}" alt="banner-media">
								</div>
								<a class="icon-button popup-youtube" href="https://www.youtube.com/watch?v=YwYoyQ1JdpQ">
									<div class="text-row word-rotate-box c-black blur">
										<span class="word-rotate">More Collection Explore </span>
										<i class="fa-solid fa-play text-dark badge__emoji" ></i>
									</div>
								</a>
								<div class="star">
									<svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 68 68" fill="none">
									<path d="M34 0L43.6167 24.3833L68 34L43.6167 43.6167L34 68L24.3833 43.6167L0 34L24.3833 24.3833L34 0Z" fill="black"/>
								  </svg>
								</div>
							</div>
						</div>
						@else
						<div class="inner-content">
								<div class="content-info">
									<h1 class="title mb-4 wow flipInX animated" data-wow-delay="0.5s">OOPS NO BANNER AVAILABLE</h1>
									<p class="text" data-swiper-parallax="-40"></p>
									<div class="content-btn m-b30 wow fadeInUp" data-wow-delay="0.8s" data-swiper-parallax="-60">
										<a class="btn btn-secondary btn-lg btnhover20" href="">SORRY NO BANNER FOUND</a>
									</div>
								</div>
							</div>
							
						@endif
					</div>
				</div>
			</div>
		</div>
		<!--Swiper Banner End-->
	
		<!-- abouts-Secthion Start -->
		<section class="content-inner overflow-hidden bg-light-dark">
			<div class="container">
				<div class="row align-items-center">
					
					<div class="col-lg-12 col-md-12 m-b30">
						<div class="about-wraper   position-relative">
							<div class="section-head style-1 wow fadeInUp d-lg-flex justify-content-between align-items-center" data-wow-delay="0.4s">
								<h3 class="title ">Discover latest collection</h3>
								<a class="service-btn-2 wow fadeInUp position-relative light  d-md-flex  d-none" data-wow-delay="0.6s" href="about-us.html">
									<span class="icon-wrapper">
										<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12.832 31.1663L31.1654 12.833" stroke="var(--title)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12.832 12.833H31.1654V31.1663" stroke="var(--title)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										</svg>
									</span>
								</a>
							</div>
							
							<div class="swiper testimonial-swiper about-swiper m-b30">
								<div class="swiper-wrapper">
									@forelse ( $categories as $category )
									<div class="swiper-slide">
										<div class="about-box">	
											<div class="about-img">
												<img src="{{ asset('storage/uploads/category/' . $category->image) }}" alt="image">
											</div>
											<div class="about-btn"><a class="btn btn-white btn-md" href="{{route('category-detail', $category->slug)}}">{{ $category->name }}</a></div>
										</div>
									</div>
									@empty
									<div class="swiper-slide">
										<div class="about-box">	
											<div class="about-img">
												<img src="/assets/images/shop/product-2/1.png" alt="image">
											</div>
											<div class="about-btn"><a class="btn btn-white btn-md" href="/">OOPS NO CATEGORY AVAILABLE</a></div>
										</div>
									</div>
									@endforelse								
								</div>
							</div>
							<div class="d-flex justify-content-between align-items-center">
								<div class="d-flex gap-3">
									<div class="testimonial-button-prev">
										<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
											<path d="M36.8751 19.372H4.6659L12.288 11.9623C12.8705 11.3965 12.0066 10.4958 11.4164 11.0663C11.4164 11.0663 2.68932 19.5502 2.68932 19.5502C2.43467 19.7821 2.45495 20.2007 2.68935 20.4462C2.68932 20.4462 11.4164 28.9337 11.4164 28.9337C12.0038 29.4974 12.8725 28.6135 12.288 28.0377C12.288 28.0377 4.66308 20.622 4.66308 20.622H36.8751C37.6738 20.6144 37.7149 19.3872 36.8751 19.372Z" fill="black"/>
										</svg>
									</div>
									<div class="testimonial-button-next">
										<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
										<path d="M3.12489 19.372H35.3341L27.712 11.9623C27.1295 11.3965 27.9934 10.4958 28.5836 11.0663L37.3107 19.5502C37.5653 19.7821 37.5451 20.2007 37.3107 20.4462L28.5836 28.9337C27.9962 29.4973 27.1275 28.6135 27.712 28.0377L35.3369 20.622H3.12489C2.32618 20.6144 2.28506 19.3872 3.12489 19.372Z" fill="black"/>
										</svg>
									</div>
								</div>	
								<div class="swiper-pagination style-1 text-end swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
									<span class="swiper-pagination-bullet" tabindex="0">01</span>
									<span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" aria-current="true">02</span>
									<span class="swiper-pagination-bullet" tabindex="0">03</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- abouts-Secthion End -->

		<!-- Products  Section Start-->
		<section class="content-inner">
			<div class="container">
				<div class=" row justify-content-md-between align-items-start">
					<div class="col-lg-12 col-md-12">
						<div class="section-head style-1 m-b30  wow fadeInUp" data-wow-delay="0.2s">
							<div class="left-content">
								<h2 class="title">Most popular products</h2>
							</div>
						</div>	
					</div>
				</div>
				<div class="clearfix">
					<ul id="masonry" class="row g-xl-4 g-3">
						@forelse ( $products as $product )
						<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.6s">
							<div class="shop-card">
								<div class="dz-media">
									<img src="{{ asset('storage/uploads/product/' . $product->image) }}" alt="{{$product->name}}">
									<div class="shop-meta">
										<a href="{{route('product-detail', $product->slug)}}" class="btn btn-secondary btn-md btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
											<i class="fa-solid fa-eye d-md-none d-block"></i>
											<span class="d-md-block d-none">View Detail</span>
										</a>
										@if(Cart::instance("cart")->content()->where('id', $product->id)->count() > 0)
				                            <a href="{{ route('cart') }}" class="btn meta-icon dz-carticon bg-primary">
											<i class="flaticon flaticon-basket"></i>
											<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
										</a>
				                        @else
				                        <form class="add-to-cart-form" method="POST" action="{{ route('cart.add') }}">
                            						{{ csrf_field() }}
                                                    <!-- Add hidden fields -->
                                                    <input type="hidden" name="id" value="{{ $product->id }}"/>
                                                    <input type="hidden" name="name" value="{{ $product->name }}"/>
                                                    <input type="hidden" name="price" value="{{ $product->sale_price == '' ? $product->price : $product->sale_price }}"/>
                                                    <input type="hidden" name="image" value="{{ $product->image }}"/> 
                                                    <input type="hidden" name="quantity" value="1"/> 
                                                    
											<button type="submit" class="btn btn-primary meta-icon dz-carticon">
											<i class="flaticon flaticon-basket"></i>
											<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
										</button>
										</form>
                                	@endif
									</div>							
								</div>
								<div class="dz-content">
									<h5 class="title"><a href="{{route('product-detail', $product->slug)}}">{{$product->name}}</a></h5>
									<h5 class="price">@if($product->sale_price)
												    RS/{{ $product->sale_price }} <del>Rs/{{ $product->price }}</del>
												@else
												    RS/{{ $product->price }}
												@endif </h5>
								</div>
								<div class="product-tag">
									<span class="badge">Trending Items</span>
								</div>
							</div>
						</li>
						@empty
						<li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.6s">
							<div class="shop-card">
								<div class="dz-media">
									<img src="/assets/images/shop/product/1.png" alt="image">	
								</div>
								<div class="dz-content">
									<h5 class="title"><a href="/">OOPS NO PRODUCT AVAILABLE</a></h5>	
								</div>
							</div>
						</li>
						@endforelse
					</ul>
				</div>
			</div>
		</section>
		<!-- Products Section Start-->
		
		<!-- company-box Start-->
		<section class="content-inner-2 pb-5">
			<div class="container">	
				<div class="section-head style-1 wow fadeInUp d-flex  justify-content-between" data-wow-delay="0.2s">
					<div class="left-content">
						<h2 class="title">Courier Partners</h2>
					</div>			
				</div>
				<div class="swiper swiper-company">
					<div class="swiper-wrapper ">
						<div class="swiper-slide">
							<div class="company-box style-1 wow fadeInUp" data-wow-delay="0.4s">
								<div class="dz-media p-5 bg-secondary">
									<h2 class="title text-center font-weight-bold" style="color: white !important;">TCS</h2>
								</div>
										
							</div>
						</div>
						<div class="swiper-slide">
							<div class="company-box style-1 wow fadeInUp" data-wow-delay="0.6s">
								<div class="dz-media p-5 bg-secondary">
									<h2 class="title text-center font-weight-bold" style="color: white !important;">TRAX</h2>	
								</div>
										
							</div>
						</div>
						<div class="swiper-slide">
							<div class="company-box style-1 wow fadeInUp" data-wow-delay="0.8s">
								<div class="dz-media p-5 bg-secondary">
									<h2 class="title text-center font-weight-bold" style="color: white !important;">LEOPARDS</h2>	
								</div>
										
							</div>
						</div>
						<div class="swiper-slide">
							<div class="company-box style-1 wow fadeInUp" data-wow-delay="1.0s">
								<div class="dz-media p-5 bg-secondary">
									<h2 class="title text-center font-weight-bold" style="color: white !important;">BLUE EX</h2>	
								</div>
										
							</div>
						</div>
						<div class="swiper-slide">
							<div class="company-box style-1 wow fadeInUp" data-wow-delay="1.2s">
								<div class="dz-media p-5 bg-secondary">
									<h2 class="title text-center font-weight-bold" style="color: white !important;">POST EX</h2>	
								</div>		
							</div>
						</div>	
					</div>
				</div>
			</div>
		</section>
		<!-- company-box End-->
	</div>
@endsection
@section('scripts')
@endsection
