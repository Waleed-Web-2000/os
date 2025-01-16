@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	Cart 
@endsection 
@section('meta')
@endsection

@section('main-content')
	
	<div class="page-content bg-light pt-5">
		<!-- contact area -->
		<section class="content-inner shop-account">
			<!-- Product -->
			<div class="container">
				<div class="section-head style-1 wow fadeInUp d-lg-flex justify-content-between align-items-center" data-wow-delay="0.4s">
								<h3 class="title ">All Cart Items</h3>
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
					<div class="col-lg-8">
						<div class="table-responsive">
							<table class="table check-tbl">
							
								<thead>
									<tr>
										<th>Product</th>
										<th></th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Remove</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@php
										$items = Cart::instance('cart')->content();     
									@endphp
									@forelse ($items as $item)
									<tr>
										<td class="product-item-img"><img src="{{ asset('storage/uploads/product/' . $item->options->image) }}" alt="{{$item->name}}"></td>
										<td class="product-item-name">{{$item->name}}</td>
										<td class="product-item-price">RS/{{$item->price}}</td>
										<td class="product-item-quantity">
                                <div class="position-relative qty-control">
                                 <!-- Decrease Quantity Form -->
								<form method="POST" class="quantity-form decrease-quantity-form" data-row-id="{{ $item->rowId }}" action="{{ route('cart.quantity.decrease', ['rowId' => $item->rowId]) }}">
								    @csrf
								    @method('PUT')
								    <button type="submit" class="btn qty-control__decrease">
								        <i class="fa-solid fa-minus"></i>
								    </button>
								</form>

								<!-- Quantity Display -->
								<div class="quantity btn-quantity style-1 ms-3" data-row-id="{{ $item->rowId }}">
								    <input type="text" class="qty" name="quantity" min="1" value="{{ $item->qty }}" readonly>
								</div>

								<!-- Increase Quantity Form -->
								<form method="POST" class="quantity-form increase-quantity-form" data-row-id="{{ $item->rowId }}" action="{{ route('cart.quantity.increase', ['rowId' => $item->rowId]) }}">
								    @csrf
								    @method('PUT')
								    <button type="submit" class="btn qty-control__increase">
								        <i class="fa-solid fa-plus"></i>
								    </button>
								</form>   
                                </div> 
                            </td>
										<form method="POST" action="{{ route('cart.item.remove', ['rowId' => $item->rowId]) }}">
	                                    @csrf
	                                    @method('DELETE')
										<td class="product-item-close"><button type="submit" class="btn"><i class="ti-close"></i></button>
										</form>
										</td>
									</tr>
									@empty
									<tr>
										<td class="product-item-name">OOPS NO ITEMS IN CART</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>
						<div class="row shop-form m-t30">
							<div class="col-md-12 text-end">
								<form action="{{ route('cart.clear') }}" method="POST">
		                        @csrf
		                        @method('DELETE')
								<button type="submit" class="btn btn-secondary">CLEAR CART</button>
                    			</form>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<h4 class="title mb15">Cart Total</h4>
						<div class="cart-detail">
							<a href="javascript:void(0);" class="btn btn-outline-secondary w-100 m-b20">Cash On Delivery</a>
							<div class="save-text">
								<i class="icon feather icon-check-circle"></i>
								<span class="m-l10">You will save ₹504 on this order</span>
							</div>
							<table>
								<tbody>
									<tr class="total">
										<td>
											<h6 class="mb-0">Total</h6>
										</td>
										<td class="price">
											RS/{{Cart::instance('cart')->subtotal()}}
										</td>
									</tr>
								</tbody>
							</table>
							<a href="{{ route('checkout') }}" class="btn btn-secondary w-100">Checkout</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Product END -->
		</section>
		<!-- contact area End--> 

	</div>

@endsection
@section('scripts')
@endsection
