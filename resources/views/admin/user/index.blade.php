@extends('admin.layout.master')
@section('page_title')
  Users
@endsection
@section('main_content')
	<section class="col-xl-9 account-wrapper">
						<div class="account-card">
							<div class="table-responsive table-style-1">

								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Wallet</th>
											<th>Email</th>
											<th>User Type</th>
											<th>Moblie</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										@foreach($users as $user)
										<tr>
											<td><a href="javascript:void;" class="fw-medium">{{$user->id}}</a></td>
											<td>{{$user->name}}</td>
											<td>{{ $user->wallet ? $user->wallet->balance : '0.00' }}
</td>
											<td>{{$user->email}}</td>
											<td><span class="badge">{{$user->utype}}</span></td>
											<td>{{$user->mobile}}</td>
											<td>
											  @if($user->status == "DEACTIVE") 
							                    <a href="{{Route('user.status', $user->id)}}" class="badge bg-danger  m-0"><i class="fa fa-thumbs-down"></i></a>
							                  @else  
							                    <a href="{{Route('user.status', $user->id)}}" class="badge bg-info  m-0"><i class="fa fa-thumbs-up"></i></a>
							                  @endif  
						                  </td>	
										</tr>
										@endforeach
									</tbody>
								</table>
								
							</div>
							
							<!-- Pagination-->
							<div class="d-flex justify-content-center">
								<nav aria-label="Table Pagination">
									<ul class="pagination style-1">
										{{$users->links()}}
									</ul>
								</nav>
							</div>
                        </div>
    </section>
@endsection

@section('scripts')

@endsection