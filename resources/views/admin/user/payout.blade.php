@extends('admin.layout.master')
@section('page_title')
  Users
@endsection
@section('main_content')
                     
					<section class="col-xl-9 account-wrapper bg-light">
						<div class="account-card">
							<div class="table-responsive table-style-1">
								
								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>Payout ID</th>
											<th>User Name</th>
											<th>Payout Amount</th>
											<th>Status</th>
											<th>Image</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									  <tbody>
    @foreach ($payoutRequests as $request)
        <tr>
            <td>{{ $request->id }}</td>
            <td>{{ $request->user->name }}</td>
            <td>{{ $request->amount }}</td>
            <td>
                <form action="{{ route('admin.user.payout.status', $request->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if($request->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @else
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>pending</option>
                            <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }}>approved</option>
                        </select>
                    @endif
            </td>
            <td>
                @if($request->image) 
                    <!-- Display the uploaded image -->
                    <img src="{{ asset('storage/uploads/payout/' . $request->image) }}" alt="Proof Image" style="width: 100px; height: auto; border: 1px solid #ccc;">
                @else
                    <!-- Display the upload option -->
                    <input type="file" name="image" class="form-control">
                @endif
            </td>

            <td>{{ $request->created_at }}</td>
            <td>
                <button type="submit" class="btn badge mt-2">Update Status</button>
            </td>
                </form>
        </tr>
    @endforeach
</tbody>

								</table>
							</div>
							
							<!-- Pagination-->
							<div class="d-flex justify-content-center">
								<nav aria-label="Table Pagination">
									<ul class="pagination style-1">
										<li class="page-item"></li> 
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
