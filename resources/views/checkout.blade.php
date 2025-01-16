@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	Checkout 
@endsection 
@section('meta')
@endsection

@section('main-content')
	
	<div class="page-content bg-light">
		<!-- inner page banner End-->
		<div class="content-inner-1">
			<div class="container">
				<div class="section-head style-1 wow fadeInUp d-lg-flex justify-content-between align-items-center pt-5" data-wow-delay="0.4s">
								<h3 class="title ">Checkout</h3>
								<a class="service-btn-2 wow fadeInUp position-relative light  d-md-flex  d-none" data-wow-delay="0.6s" href="/">
									<span class="icon-wrapper">
										<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12.832 31.1663L31.1654 12.833" stroke="var(--title)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path d="M12.832 12.833H31.1654V31.1663" stroke="var(--title)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										</svg>
									</span>
								</a>
							</div>
				<div class="row shop-checkout">
					<div class="col-xl-8">
						<h4 class="title m-b15">Billing details</h4>
						
						<form class="row" action="{{route('place.order')}}"  method="POST">
							@csrf
							@if($address)
							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Name</label>
									<input name="name" required="" class="form-control dzName @error('name') is-invalid @enderror" value="{{$address->name}}" placeholder="Full name">
									@error('name')
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
						        @enderror
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Street address *</label>
									<input name="address" required="" class="form-control m-b15 dzName @error('address') is-invalid @enderror" placeholder="House number and street name" value="{{$address->address}}">
									@error('address')
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
						        @enderror
								</div>
							</div>

							<div class="col-md-6">
						    <div class="m-b25">
						        <label class="label-title">Town / City *</label>
						        <select class="default-select form-select w-100 @error('city') is-invalid @enderror" name="city">
						            <option value="">Select a City</option>
						            <option value="Kota" {{ old('city') == 'Kota' ? 'selected' : '' }}>Kota</option>
						            <option value="1" {{ old('city') == '1' ? 'selected' : '' }}>Another option</option>
						            <option value="Jaipur" {{ old('city') == 'Jaipur' ? 'selected' : '' }}>Jaipur</option>
						            <option value="Udaipur" {{ old('city') == 'Udaipur' ? 'selected' : '' }}>Udaipur</option>
						        </select>
						        @error('city')
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
						        @enderror
						    </div>
						</div>

							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Phone *</label>
									<input name="phone" required="" class="form-control dzName @error('phone') is-invalid @enderror" value="{{$address->phone}}" placeholder="Used Mobile Number">
									@error('phone')
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
						       		@enderror
								</div>
							</div>
							
							<div class="col-md-12 m-b25">
								<div class="form-group">
									<label class="label-title">Order notes (optional)</label>
									<textarea id="comments" placeholder="Notes about your order, e.g. special notes for delivery." class="form-control comment @error('note') is-invalid @enderror" name="note" cols="90" rows="5">{{$address->note}}</textarea>
									@error('note')
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
						       		@enderror
								</div>
							</div>
							@else
							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Name</label>
									<input name="name" required="" class="form-control dzName @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Full name">
									@error('name')
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
						        @enderror
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Street address *</label>
									<input name="address" required="" class="form-control m-b15 dzName @error('address') is-invalid @enderror" placeholder="House number and street name" value="{{old('address')}}">
									@error('address')
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
						        @enderror
								</div>
							</div>
							
							<div class="col-md-6">
						    <div class="m-b25">
						        <label class="label-title">Town / City *</label>
						        <select class="default-select form-select w-100 @error('city') is-invalid @enderror" name="city">
						            <option value="">Select a City</option>
						            <option value="Kota" {{ old('city') == 'Kota' ? 'selected' : '' }}>Kota</option>
						            <option value="1" {{ old('city') == '1' ? 'selected' : '' }}>Another option</option>
						            <option value="Jaipur" {{ old('city') == 'Jaipur' ? 'selected' : '' }}>Jaipur</option>
						            <option value="Udaipur" {{ old('city') == 'Udaipur' ? 'selected' : '' }}>Udaipur</option>
						        </select>
						        @error('city')
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
						        @enderror
						    </div>
						</div>


							<div class="col-md-6">
								<div class="form-group m-b25">
									<label class="label-title">Phone *</label>
									<input name="phone" required="" class="form-control dzName @error('phone') is-invalid @enderror" value="{{old('phone')}}" placeholder="Used Mobile Number">
									@error('phone')
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
						       		@enderror
								</div>
							</div>
							
							<div class="col-md-12 m-b25">
								<div class="form-group">
									<label class="label-title">Order notes (optional)</label>
									<textarea id="comments" placeholder="Notes about your order, e.g. special notes for delivery." class="form-control comment @error('note') is-invalid @enderror" name="note" cols="90" rows="5"></textarea>
									@error('note')
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
						       		@enderror
								</div>
							</div>
							@endif
						
					</div>
					<div class="col-xl-4 side-bar">
						<h4 class="title m-b15">Your Order</h4>
						<div class="order-detail sticky-top">
							@php
								$items = Cart::instance('cart')->content();     
							@endphp
							@forelse ($items as $item)
							<div class="cart-item style-1">
								<div class="dz-media">
									<img src="{{ asset('storage/uploads/product/' . $item->options->image) }}" alt="{{$item->name}}">
								</div>
								<div class="dz-content">
									<h6 class="title mb-0">{{$item->name}}</h6>
									<span class="price">RS/{{$item->price}} x ({{$item->qty}})</span>
								</div>
							</div>
							@empty
							<div class="cart-item style-1">
								<div class="dz-content">
									<span class="price">OOPS NO ITEMS IN CART</span>
								</div>
							</div>
							@endforelse
							<table>
								<tbody>
									<tr class="shipping">
										<td>
											<div class="custom-control custom-checkbox">		  
											  <label class="form-check-label" for="flexRadioDefault2">
												Flat Rate Shipping:
											  </label>
											</div>
										</td>
										<td class="price">RS/199</td>
									</tr> 

									<tr class="shipping">
										<td>
											<div class="custom-control custom-checkbox">		  
											  <label class="form-check-label" for="flexRadioDefault2">
												Selling Price
											  </label>
											</div>
										</td>
										<td class="price"><input type="text" name="selling_price" id="sellingPrice" class="form-control"></td>
									</tr>
									<tr class="profit">
    <td>
        <div class="custom-control custom-checkbox">		  
            <label class="form-check-label" for="profit">
                Profit
            </label>
        </div>
    </td>
    <td class="profit-amount">
        <span id="profitAmount">RS/0</span>
    </td>
</tr>
									<tr class="shipping">
										<td>
											<div class="custom-control custom-checkbox">		  
											  <label class="form-check-label" for="flexRadioDefault2">
												Subtotal:
											  </label>
											</div>
										</td>
										<td class="price">RS/{{Cart::instance('cart')->subtotal()}}</td>
									</tr>
									<tr class="total">
										<td>Total</td>
										@php
										    // Get subtotal and ensure it's a numeric value
										    $subtotal = Cart::instance('cart')->subtotal();
										    
										    // Remove any non-numeric characters (commas, currency symbols, etc.)
										    $subtotal = preg_replace('/[^\d.]/', '', $subtotal);
										    
										    // Cast to float
										    $subtotal = (float) $subtotal;
										    
										    // Shipping fee
										    $shipping = 199.00;
										    
										    // Calculate the total
										    $total = $subtotal + $shipping;
										@endphp
										<td class="price">RS/{{$total}}</td>	
									</tr>
								</tbody>
							</table>

							<div class="accordion dz-accordion accordion-sm" id="accordionFaq1">
								<div class="accordion-item">
									<div class="accordion-header" id="heading1">
										<div class="accordion-button collapsed custom-control custom-checkbox border-0" data-bs-toggle="collapse" data-bs-target="#collapse1" role="navigation"  aria-expanded="true" aria-controls="collapse1">
											<input class="form-check-input radio" type="radio" name="mode" id="flexRadioDefault3" value="cod">
											<label class="form-check-label" for="flexRadioDefault3">
												Cod / Only Accept Cod Method
											</label>
										</div>
									</div>
									
								</div>
								<div class="accordion-item">
									<div class="accordion-header" id="heading2">
										<div class="accordion-button collapsed custom-control custom-checkbox border-0" data-bs-toggle="collapse" data-bs-target="#collapse2" role="navigation" aria-expanded="true" aria-controls="collapse2">
											<input class="form-check-input radio" type="radio" name="mode" id="flexRadioDefault5" value="card">
											<label class="form-check-label" for="flexRadioDefault5">
												Bank Payment
											</label>
										</div>
									</div>
									<div id="collapse2" class="accordion-collapse collapse" aria-labelledby="collapse2" data-bs-parent="#accordionFaq1">
										<div class="accordion-body">
											<p class="m-b0">Bank Payment Method Soon</p>
										</div>
									</div>
								</div>
								<div class="accordion-item">
									<div class="accordion-header" id="heading3">
										<div class="accordion-button collapsed custom-control custom-checkbox border-0" data-bs-toggle="collapse" data-bs-target="#collapse3" role="navigation" aria-expanded="true" aria-controls="collapse3">
											<input class="form-check-input radio" type="radio" name="mode" id="flexRadioDefault4" value="another">
											<label class="form-check-label" for="flexRadioDefault4">
												Another
											</label>
										</div>
									</div>
									<div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionFaq1">
										<div class="accordion-body">
											<p class="m-b0">Another Payment Method Soon</p>
										</div>
									</div>
								</div>
							</div>

							<button type="sumbit" class="btn btn-secondary w-100">PLACE ORDER</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
@section('scripts')
<script>
    // Get the selling price input field and profit amount element
    const sellingPriceInput = document.getElementById('sellingPrice');
    const profitAmount = document.getElementById('profitAmount');
    const totalAmount = @json($total);  // Pass the PHP total to JS

    // Event listener to calculate profit when the selling price changes
    sellingPriceInput.addEventListener('input', function() {
        const sellingPrice = parseFloat(sellingPriceInput.value) || 0;
        const profit = sellingPrice - totalAmount; // Calculate the profit (selling price - total)
        profitAmount.textContent = profit.toFixed(2); // Display profit with 2 decimal places
    });
</script>
@endsection
