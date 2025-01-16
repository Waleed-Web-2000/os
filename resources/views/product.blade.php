@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	{{$product->name}} 
@endsection 
@section('meta')
@endsection

@section('main-content')
	<div class="page-content bg-light pt-5">
		
		<div class="d-sm-flex justify-content-between container-fluid py-3 pt-5">
			<nav aria-label="breadcrumb" class="breadcrumb-row">
				<ul class="breadcrumb mb-0">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
					<li class="breadcrumb-item">{{$product->name}}</li>
				</ul>
			</nav>
		</div>
		
		<section class="content-inner py-0">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-4 col-md-4">
						<div class="dz-product-detail sticky-top">
							<div class="swiper-btn-center-lr">
								<div class="swiper product-gallery-swiper2 rounded" >
									<div class="swiper-wrapper" id="lightgallery2">
										@if($product->gallery_images)
								        @php
								            $imagesArray = json_decode($product->gallery_images);
								        @endphp
								        @if ($imagesArray)
								            @foreach($imagesArray as $image)
										<div class="swiper-slide">
											<div class="dz-media DZoomImage">
												<a class="mfp-link lg-item" href="{{ asset( 'storage/uploads/product/' . $image) }}" data-src="{{ asset( 'storage/uploads/product/' . $image) }}">
													<i class="feather icon-maximize dz-maximize top-left"></i>
												</a>
												<img src="{{ asset( 'storage/uploads/product/' . $image) }}" alt="{{$product->name}}">
											</div>
										</div>
											@endforeach
										@endif
										@else
											<div class="swiper-slide">
											<div class="dz-media DZoomImage">
												<a class="mfp-link lg-item" href="/storage/uploads/no-img.jpg" data-src="/storage/uploads/no-img.jpg">
													<i class="feather icon-maximize dz-maximize top-left"></i>
												</a>
												<img src="/storage/uploads/no-img.jpg" alt="image">
											</div>
										</div>
										@endif	
									</div>
								</div>
								<div class="swiper product-gallery-swiper thumb-swiper-lg">
									<div class="swiper-wrapper">
									@if($product->gallery_images)
								        @php
								            $imagesArray = json_decode($product->gallery_images);
								        @endphp
								        @if ($imagesArray)
								            @foreach($imagesArray as $image)
												<div class="swiper-slide">
													<img src="{{ asset( 'storage/uploads/product/' . $image) }}" alt="{{$product->name}}">
												</div>
											@endforeach
										@endif
										@else
										<div class="swiper-slide">
											<img src="/storage/uploads/no-img.jpg" alt="image">
										</div>
									@endif											
									</div>
								</div>
							</div>							
						</div>	
					</div>
					<div class="col-xl-8 col-md-8">
						<div class="row">
							<div class="col-xl-7">
								<div class="dz-product-detail style-2 p-t20 ps-0">
									<div class="dz-content">
										<div class="dz-content-footer">
											<div class="dz-content-start">
												<span class="badge bg-secondary mb-2">Trending Item</span>
												<h4 class="title mb-1">{{$product->name}}</h4>
											</div>
										</div>
										<div class="dz-info">
											<ul>
												<li><strong>Category:</strong></li>
												<li><a href="{{ route('category-detail', $product->category->slug) }}">{{$product->category->name}}</a></li>				
											</ul>
											<ul>
												<li><strong>Tags:</strong></li>
												@php
													$tags = json_decode($product->tags)
												@endphp
												@if($tags)
													@foreach ($tags as $tag)
														<li>{{$tag}}</li>
													@endforeach
												@endif													
											</ul>
										</div>
									</div>
									<div class="banner-social-media">
										<ul>
											<li>
												<a href="https://www.instagram.com/dexignzone/">Instagram</a>
											</li>
											<li>
												<a href="https://www.facebook.com/dexignzone">Facebook</a>
											</li>
											<li>
												<a href="https://twitter.com/dexignzones">twitter</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xl-5">
								<div class="cart-detail">
									@if(Cart::instance("cart")->content()->where('id', $product->id)->count() > 0)
				                            <a href="{{ route('cart') }}" class="btn btn-secondary w-100 m-b20 ">
											<i class="flaticon flaticon-basket ms-2"></i>
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
                                                    
											<button type="submit" class="btn btn-secondary w-100 m-b20"> Add to Cart
											<i class="flaticon flaticon-basket ms-2"></i>
											<i class="flaticon flaticon-basket-on dz-heart-fill"></i>
										</button>
										</form>
                                	@endif
									<table>
										<tbody>
											<tr class="total">
												<td>
													<h6 class="mb-0">Total</h6>
												</td>
												<td class="price">
													@if($product->sale_price)
													RS/{{$product->sale_price}} <del class="text-primary">RS/{{$product->price}}</del>
													@else
													RS/{{$product->price}}
													@endif
												</td>
											</tr>
										</tbody>
									</table>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="content-inner-3 pb-0"> 
			<div class="container">
				<div class="product-description">
					<div class="dz-tabs">					
						<ul class="nav nav-tabs center" id="myTab1" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Description</button>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
								<div class="detail-bx text-center">
									<h5 class="title">{{$product->name}}</h5>
										{!! $product->description !!}
										@php
											$images = json_decode($product->gallery_images)
										@endphp
										@if($images)
											@foreach ($images as $image)
												<img src="{{asset('storage/uploads/product/' . $image)}}" width="200" height="200" class="img-thumbnail img-fluid" alt="{{$product->name}}">
											@endforeach
										@else
											<img src="/storage/uploads/no-img.jpg" alt="image">
										@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="content-inner-1  overflow-hidden">
			<div class="container">
				<div class="section-head style-2 d-md-flex justify-content-between align-items-center">
					<div class="left-content">
						<h2 class="title mb-0">Related products</h2>
					</div>
					<a href="{{ route('shop') }}" class="text-secondary font-14 d-flex align-items-center gap-1">See all products
						<i class="icon feather icon-chevron-right font-18"></i>
					</a>			
				</div>
				<div class="swiper-btn-center-lr">
					<div class="swiper swiper-four">
						<div class="swiper-wrapper">
							@forelse ($pros as $product)
							<div class="swiper-slide">
								<div class="shop-card style-1">
									<div class="dz-media">
										<img src="{{ asset('storage/uploads/product/' . $product->image) }}" alt="{{ $product->name }}">
										<div class="shop-meta">  
														<a href="{{ route('product-detail', $product->slug) }}" class="btn btn-secondary btn-md btn-rounded">
															<i class="fa-solid fa-eye d-md-none d-block"></i>
															<span class="d-md-block d-none">View Detail</span>
														</a>
													</div>								
									</div>
									<div class="dz-content">
										<h5 class="title"><a href="shop-list.html">{{ $product->name }}</a></h5>
										<h5 class="price">@if($product->sale_price)
													RS/{{$product->sale_price}} <del class="text-primary">RS/{{$product->price}}</del>
													@else
													RS/{{$product->price}}
													@endif</h5>
									</div>
									<div class="product-tag">
										<span class="badge ">Related items</span>
									</div>
								</div>
							</div>
							@empty
							@endforelse
						</div>
					</div>
					<div class="pagination-align">
						<div class="tranding-button-prev btn-prev">
							<i class="flaticon flaticon-left-chevron"></i>
						</div>
						<div class="tranding-button-next btn-next">
							<i class="flaticon flaticon-chevron"></i>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	</div>
@endsection
@section('scripts')
@endsection
