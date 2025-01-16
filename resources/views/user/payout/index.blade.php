@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	User Payouts 
@endsection 
@section('meta')
@endsection

@section('main-content')
	
	
					@include('user.aside')
                     
					<section class="col-xl-9 account-wrapper bg-light">
						<div class="account-card">
							<div class="table-responsive table-style-1">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Send Request</th> 
											<th></th> 
										</tr>
									</thead>
									<tbody>
										<td><a href="{{Route('user.payout.create')}}" class="badge bg-success">Add Request</a></td>
										<td></td>
									</tbody>
								</table>

								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>Payout ID</th>
											<th>Payout Amount</th>
											<th>Payout Image</th>
											<th>Payout Status</th>
											<th>Payout Date</th>
										</tr>
									</thead>
									@foreach ($payoutRequests as $request)
									<tbody>
										
										<td>{{ $request->id }}</td>
										<td>{{ $request->amount }}</td>
										<td><img src="{{ asset( 'storage/uploads/payout/' . $request->image) }}" alt="image" class="img-fluid img-thumbnail" width="100" height="100"></td>
										<td>
										    @if($request->status == 'approved')
										        <span class="badge bg-success">Approved</span>
										    @elseif($request->status == 'rejected')
										        <span class="badge bg-danger">Rejected</span>
										    @else
										        <span class="badge bg-warning">Pending</span>
										    @endif
										</td>
										<td>{{ $request->created_at }}</td>	
									</tbody>
									@endforeach
								</table>
							</div>
							
							<!-- Pagination-->
							<div class="d-flex justify-content-center">
								<nav aria-label="Table Pagination">
									<ul class="pagination style-1">
										<li class="page-item">{{ $payoutRequests->links('pagination::bootstrap-5') }}</li> 
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
