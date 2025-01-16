@extends('admin.layout.master')
@section('page_title')
  Add to Cart Orders
@endsection
@section('main_content') 
	<section class="col-xl-9 account-wrapper">
						<div class="account-card">
								@if($orderitems)
								@if(Session::has('status'))
									<p class="alert alert-success">{{Session::get('status')}}</p>
								@endif	
								<table class="table table-hover mb-3">
									<thead> 
										<tr>
											<th>ID</th>
											<th>Product Name</th>
											<th>Product Image</th>
											<th>Product Price</th>
											<th>Items Qunatity</th>
											<th>Return Status</th>
										</tr>
									</thead> 
									<tbody> 
										@foreach($orderitems as $orderitem)
										<tr>
											<td><a href="javascript:void;" class="fw-medium">{{$orderitem->id}}</a></td>
											<td>{{ Str::limit($orderitem->product->name, 25)}}</td>
											<td><img src="{{ asset('storage/uploads/product/' . $orderitem->product->image) }}" width="50" height="50" alt=""></td>
												@if($orderitem->product->sale_price)
												<td>{{$orderitem->product->sale_price}} <del>{{$orderitem->product->price}}</del></td>
												@else
												<td>{{$orderitem->product->price}}</td>
												@endif
											<td>{{$orderitem->quantity}}</td>
											<td>{{$orderitem->rstatus == 0 ? "No":"Yes"}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								<table class="table table-hover mb-3">
									<thead> 
										<tr>
											<th>Order Date</th>
											<th>Payment Mode</th>
											<th>Order Status</th>
											<th>Status</th>
										</tr>
									</thead> 
									<tbody> 					
										<tr>
											<td>{{$order->created_at}}</td>
											<td>{{$transaction->mode}}</td>
											<td>
												@if($order->status == 'delivered')
												<span class="badge bg-success">Delivered</span>
												@elseif($order->status == 'canceled')
												<span class="badge bg-danger">Canceled</span>
												@elseif($order->status == 'returned')
												<span class="badge bg-danger">Returned</span>
												@elseif($order->status == 'booked')
												<span class="badge bg-danger">Booked</span>
												@else
												<span class="badge bg-danger">Ordered</span>
												@endif
											</td>
											<td>
												@if($transaction->status == 'approved')
												<span class="badge bg-success">Approved</span>
												@elseif($transaction->status == 'declined')
												<span class="badge bg-danger">Declined</span>
												@elseif($transaction->status == 'refunded')
												<span class="badge bg-secondary text-white">Refunded</span>
												@else
												<span class="badge bg-secondary text-warning">Pending</span>
												@endif
											</td> 
										</tr>
									</tbody>
								</table>
								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>Customer Name</th>
											<th>Customer Address</th>
											<th>Customer Phone</th>
											<th>Customer City</th>
											<th>Customer Note</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><a href="javascript:void;">{{$order->name}}</a></td>
											<td>{{$order->address}}</td>
											<td>{{$order->phone}}</td>
											<td>{{$order->city}}</td>
											<td>{{ $order->note ?? 'No Notes From Customer' }}</td>
										</tr>
									</tbody>
								</table>
								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>Order Total</th>
											<th>Selling Price</th>
											<th>Profit</th>
											<th>Paid Order</th>
											<th>Paid Date</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="fw-medium">{{$order->total}}</td>
											<td class="fw-medium">{{$order->selling_price}}</td>
											<td class="fw-medium">@php $profit = $order->selling_price - $order->total @endphp {{$profit}}</td>
											<td>@if ($order->payment_status == 'paid')
											<span class="badge bg-success text-white">Paid</span>
											@else ($order->status == 'pending') 
											<span class="badge bg-warning text-white">Pending</span>
											@endif</td>
											<td>{{$order->paid_date}}</td>
										</tr>
									</tbody>
								</table>
								<table class="table table-hover mb-3">
									<thead> 
										<tr>
											<th>Delivery Date</th>
											<th>Canceled Date</th>
										</tr>
									</thead> 
									<tbody> 					
										<tr>
											<td>{{ $order->delivered_date ?? 'N/A' }}</td>
											<td>{{ $order->canceled_date ?? 'N/A' }}</td>
										</tr>
									</tbody>
								</table>
								@else
				                  <div class="alert alert-danger">No Record Found</div>    
				                @endif
							</div>
							
							<!-- Pagination-->
							<div class="d-flex justify-content-center">
								<nav aria-label="Table Pagination">
									<ul class="pagination style-1">
										{{$orderitems->links()}}
									</ul> 
								</nav>
							</div>
                        </div>
    </section>
@endsection