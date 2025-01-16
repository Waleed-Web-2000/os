@extends('admin.layout.master')
@section('page_title')
  Orders
@endsection
@section('main_content') 
	<section class="col-xl-9 account-wrapper">
						<div class="account-card">
								@if($atcOrders)
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Paid Order</th>
											<th>Name</th>
											<th>Items</th>
											<th>Date</th>
											<th>Status</th>
											<th>Action</th>
											<!-- <th>Delete Action</th> -->
										</tr>
									</thead>
									<tbody>
										@foreach($atcOrders as $orders)
										<tr>
											<td>@if ($orders->payment_status == 'paid')
											<span class="badge bg-success text-white">Paid</span>
											@else ($orders->status == 'pending') 
											<span class="badge bg-warning text-white">Pending</span>
											@endif</td>
											<td>{{$orders->name}}</td>
											<td class="fw-medium">{{$orders->orderItems->count()}}</td>
											<td>{{$orders->created_at}}</td>
											<td>
												@if ($orders->status == 'delivered')
												<span class="badge bg-success">Delivered</span>
												@elseif ($orders->status == 'canceled')
												<span class="badge bg-primary">Canceled</span>
												@elseif ($orders->status == 'returned')
												<span class="badge bg-danger">Returned</span>
												@else ($orders->status == 'ordered')
													<form action="{{route('order.status.update')}}" method="POST">
														@csrf
														@method('PUT')
														<input type="hidden" name="order_id" value="{{$orders->id}}">
														<select name="order_status" id="order_status" class="form-control mb-3">
															<option value="ordered" {{ $orders->status == 'ordered' ? "selected" : "" }}>Ordered</option>
															<option value="booked" {{ $orders->status == 'booked' ? "selected" : "" }}>Booked</option>
															<option value="delivered" {{ $orders->status == 'delivered' ? "selected" : "" }}>Delivered</option>
															<option value="returned" {{ $orders->status == 'returned' ? "selected" : "" }}>Returned</option>
															<option value="canceled" {{ $orders->status == 'canceled' ? "selected" : "" }}>Canceled</option>
														</select>
														<button type="sumbit" class="badge">Update Status</button>
													</form>
												@endif
											</td>
											<td><a href="{{ route('singleaddtocartorders', ['order_id'=>$orders->id]) }}" class="btn-link text-underline p-0"><i class="fa fa-eye"></i></a></td> 
											<!-- <td>
											<form action="{{ route('singleaddtocartordersdelete', $orders->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order and its items?');">
											    @csrf
											    @method('DELETE')
											    <button type="submit" class="btn-link text-underline p-0">Delete</button>
											</form></td> -->
										</tr>
										@endforeach
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
										{{$atcOrders->links()}}
									</ul>
								</nav>
							</div>
                        </div>
    </section>
@endsection