@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
 	Dashboard 
@endsection 
@section('meta') 
@endsection

@section('main-content')

					@include('user.aside')
                    <section class="col-xl-9 account-wrapper">
						<div class="confirmation-card account-card">
							<div class="thumb">
								<img src="/assets/images/confirmation.png" alt="">
							</div>
							<div class="text-center mt-4">
								<h4 class="mb-3 text-capitalize">Your Order Is Completed !</h4>
								<p class="mb-2">You will receive an order confirmation email with details of your order.</p>
								<p class="mb-0">Order ID: {{$order->id}}</p>
								<p class="mb-0">Date: {{$order->created_at}}</p>
								<div class="mt-4 d-sm-flex gap-3 justify-content-center">
									<a href="{{route('user.order.detail', ['order_id' => $order->id ] )}}" class="btn my-1 btn-secondary">View Order </a> 
									<a href="{{ route('home') }}" class="btn btn-outline-secondary my-1 btnhover20">Back To Home </a> 
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
