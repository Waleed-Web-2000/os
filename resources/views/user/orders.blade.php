@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	User Order 
@endsection 
@section('meta')
@endsection

@section('main-content')
	
	
					@include('user.aside')
                     
					<section class="col-xl-9 account-wrapper bg-light">
						<div class="account-card">
							<div class="table-responsive table-style-1">
								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>Order ID</th>
											<th>Paid Order</th>
											<th>Name</th>
											<th>Phone</th>
											<th>Status</th>
											<th>Order Date</th>
											<th>Delivered On</th>
											<th>Items</th>
											<th>Subtotal</th>
											<th>Total</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@forelse ($orders as $order)  
										<tr>
											<td><a href="" class="fw-medium">({{ $order->id }})</a></td>
											<td>@if ($order->payment_status == 'paid')
											<span class="badge bg-success text-white">Paid</span>
											@else ($order->status == 'pending') 
											<span class="badge bg-warning text-white">Pending</span>
											@endif</td>
											<td>{{ $order->name }}</td>
											<td>{{ $order->phone }}</td>
											<td>@if ($order->status == 'delivered')
											<span class="badge bg-success text-white">Delivered</span>
											@elseif ($order->status == 'returned') 
											<span class="badge bg-danger text-white">Returned</span>
											@elseif ($order->status == 'canceled') 
											<span class="badge bg-primary text-white">Canceled</span>
											@else ($order->status == 'ordered')
											<span class="badge bg-warning text-white">Pending</span>
											@endif
											</td>
											<td>{{ $order->created_at }}</td>
											<td>{{ $order->delivered_date ?? 'N/A' }}</td> 
											<td>{{ $order->orderItems->count()}}</td>
											<td>{{ $order->subtotal }}</td>
											<td>{{ $order->total }}</td>
											<td><a href="{{route('user.order.detail', ['order_id' => $order->id ] )}}" class="btn-link text-underline p-0"><i class="fa fa-eye"></i></a></td> 
										</tr>
										@empty
										<tr>
											<td class="fw-medium">OOP NO ORDERS</a></td>
										</tr>
										@endforelse
									</tbody>
								</table>
							</div>
							
							<!-- Pagination-->
							<div class="d-flex justify-content-center">
								<nav aria-label="Table Pagination">
									<ul class="pagination style-1">
										<li class="page-item">{{ $orders->links('pagination::bootstrap-5') }}</li>
									</ul>
								</nav>
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
