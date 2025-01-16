@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	Order Detail
@endsection 
@section('meta')
@endsection

@section('main-content')
	
	
					@include('user.aside')
                     
					<section class="col-xl-9 account-wrapper">
						<div class="account-card order-details">
							<div class="order-head">
								<div class="clearfix m-l20">
									<h4 class="mb-0">Order Number : {{$order->id}}</h4>
								</div>
							</div>
							<div class="row mb-sm-4 mb-2">
								<div class="col-sm-6">
									<div class="shiping-tracker-detail">
										<span>Address</span>
										<h6 class="title">{{$order->address}}</h6>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="shiping-tracker-detail">
										<span>City</span>
										<h6 class="title">{{$order->city}}</h6>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="shiping-tracker-detail">
										<span>Phone</span>
										<h6 class="title">{{$order->phone}}</h6>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="shiping-tracker-detail">
										<span>Order Date</span>
										<h6 class="title">{{$order->created_at}}</h6>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="shiping-tracker-detail">
										<span>Order Status :</span>
										@if ($order->status == 'delivered')
											<span class="badge bg-success text-white">Delivered</span>
											@elseif ($order->status == 'returened') 
											<span class="badge bg-danger text-white">Reutrned</span>
											@else ($order->status == 'ordered')
											<span class="badge bg-warning text-white">Pending</span>
											@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="shiping-tracker-detail">
										<span>Payment Mode :</span>
										<span class="badge bg-warning">{{$transaction->mode}}</span>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="shiping-tracker-detail">
										<span>Deliver Date</span>
										<h6 class="title">{{$order->delivered_date}}</h6>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="shiping-tracker-detail">
										<span>Paid Order :</span>
											@if ($order->payment_status == 'paid')
											<span class="badge bg-success text-white">Paid</span>
											@else ($order->status == 'pending') 
											<span class="badge bg-warning text-white">Pending</span>
											@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="shiping-tracker-detail">
										<span>Paid Date</span>
										<h6 class="title">{{$order->paid_date}}</h6>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="shiping-tracker-detail">
										<span>Canceled Date</span>
										<h6 class="title">{{$order->canceled_data}}</h6>
									</div>
								</div>
							</div>
							<div class="content-btn m-b15">
								<a href="account-cancellation-requests.html" class="btn btn-outline-danger m-b15 btnhover20">Cancel Order</a>
							</div>
							<div class="clearfix">
								<div class="dz-tabs style-3">
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										
										<button class="nav-link active" id="nav-Item-tab" data-bs-toggle="tab" data-bs-target="#nav-Item" role="tab" aria-controls="nav-Item" aria-selected="false">Item Details</button>
										<button class="nav-link" id="nav-receiver-tab" data-bs-toggle="tab" data-bs-target="#nav-receiver" role="tab" aria-controls="nav-receiver" aria-selected="false">Receiver</button>
									</div>
								</div>
								<div class="tab-content" id="nav-tabContent">
									
									<div class="tab-pane fade show active" id="nav-Item" role="tabpanel" aria-labelledby="nav-Item-tab" tabindex="0">
										<h5>Item Details</h5>
										@foreach ($orderitems as $item)
										<div class="tracking-item">
											<div class="tracking-product">
												<img src="{{ asset('storage/uploads/product/' . $item->product->image) }}" alt=""></div>
											<div class="tracking-product-content">
												<h6 class="title">{{ $item->product->name }}</h6>
												<small class="d-block">@if($item->product->sale_price)
													{{ $item->product->sale_price }} <del>{{ $item->product->price }}</del>
													@else
													{{ $item->product->price }}
													@endif
												</small>
											</div>
										</div>
										@endforeach
										<div class="tracking-item-content">
											<span>Subtotal</span>
											<h6>RS/{{$order->subtotal}}</h6>
										</div>
										  <div class="tracking-item-content border-bottom border-light mb-2">
											<span class="text-success">Shipping</span>
											<h6>199.00</h6>
										</div>
										  <div class="tracking-item-content">
											<span>Order Total</span>
											<h6>RS/{{$order->total}}</h6>
										</div>
									</div>
									<div class="tab-pane fade" id="nav-receiver" role="tabpanel" aria-labelledby="nav-receiver-tab" tabindex="0">
										<h5 class="text-success mb-4">Thank you Your order has been received</h5>
										<ul class="tracking-receiver">
											<li>Order Number : <strong>{{$order->id}}</strong></li>
											<li>Date : <strong>{{$order->created_at}}</strong></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</section>

                </div>
      		</div>
		</div>
	</div>

@endsection
@section('scripts')
@endsection
