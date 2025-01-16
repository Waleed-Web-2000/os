@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	Category Detail 
@endsection 
@section('meta')
@endsection

@section('main-content')
	<div class="page-content bg-light pt-5">
		<section class="content-inner-3 pt-5">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<div class="section-head style-1 wow fadeInUp d-lg-flex justify-content-between align-items-center" data-wow-delay="0.4s">
								<h3 class="title ">Shop All Category Items</h3>
								<a class="service-btn-2 wow fadeInUp position-relative light  d-md-flex  d-none" data-wow-delay="0.6s" href="/">
									<span class="icon-wrapper">
										<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12.832 31.1663L31.1654 12.833" stroke="var(--title)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12.832 12.833H31.1654V31.1663" stroke="var(--title)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										</svg>
									</span>
								</a>
							</div>
						<div class="row">
							<div class="col-12 tab-content shop-" id="pills-tabContent">
								<div class="tab-pane fade show active" id="tab-list-column" role="tabpanel" aria-labelledby="tab-list-column-btn">
									<div class="row gx-xl-4 g-3 mb-xl-0 mb-md-0 mb-3">
										@forelse ($products as $product)
										<div class="col-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 m-md-b15 m-sm-b0 m-b30">
											<div class="shop-card style-1">
												<div class="dz-media">
													<img src="{{ asset('storage/uploads/product/' . $product->image) }}" alt="{{ $product->name }}">
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
													<h5 class="title"><a href="{{route('product-detail', $product->slug)}}">{{ $product->name }}</a></h5>
													<h5 class="price">@if($product->sale_price)
												    RS/{{ $product->sale_price }} <del>Rs/{{ $product->price }}</del>
												@else
												    RS/{{ $product->price }}
												@endif</h5>
												</div>
												<div class="product-tag">
													<span class="badge">Latest Item</span>
												</div>
											</div>
										</div>
										@empty
											<div class="cart-item style-1">
												<div class="dz-content">
													<span class="price">OOPS NO ITEMS AVIALABLE</span>
												</div>
											</div>
										@endforelse
									</div>
								</div>
								
							</div>
						</div>
						<div class="row page pt-3">
							<div class="col-md-6">
								<p class="page-text">
									Showing {{($products->currentpage()-1)*$products->perpage()+1}} to {{$products->currentpage()*$products->perpage()}}
                                        of  {{$products->total()}} entries
								</p>
							</div>
							<div class="col-md-6">
								<nav aria-label="Blog Pagination">
								<ul class="pagination style-1 p-t20">
									<li class="page-item">{{$products->links('pagination::bootstrap-5')}}</li>
								</ul>
							</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection
@section('scripts')
@endsection
