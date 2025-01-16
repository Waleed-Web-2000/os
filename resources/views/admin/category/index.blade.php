@extends('admin.layout.master')
@section('page_title')
  Categories
@endsection
@section('main_content')
	<section class="col-xl-9 account-wrapper">
						<div class="account-card">
							<div class="table-responsive table-style-1">
								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>Import Categories</th>
											<th>Export Categories</th> 
											<th>Add Categories</th> 
										</tr>
									</thead>
									<tbody>									
										<tr>
											<td><button type="button" class="badge bg-successe" data-bs-toggle="modal" data-bs-target="#importModal">Import</button></td>
											<td><a href="{{ route('category.export') }}" class="badge bg-successe">Export</a></td>
											<td><a href="{{Route('category.create')}}" class="badge bg-success">Add</a></td>
										</tr>									
									</tbody>
								</table>

								<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
							        <div class="modal-dialog modal-dialog-centered modal-lg">
							            <div class="modal-content">
							                <div class="modal-header">
							                    <h5 class="modal-title" id="importModalLabel">Import Categories</h5>
							                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							                </div>
							                <div class="modal-body">
							                	<!-- Error Alert -->
								                <div id="error-alert" class="alert alert-danger" style="display: none;">
								                    <ul>
								                        <li>Please Upload Only CSV File.</li>
								                    </ul>
								                </div>
							                    <form id="importForm" action="{{ route('category.import') }}" method="POST" enctype="multipart/form-data">
							                    	@csrf
							                        <div class="mb-3 mt-3">
							                            <input type="file" class="form-control" id="file" name="file" required>
							                            <small class="text-muted">Supported formats: CSV</small>
							                        </div>
							                        <div class="text-end">
							                            <button type="button" class="btn btn-secondary mt-3 mt-sm-0" data-bs-dismiss="modal">Cancel</button>
							                            <button type="submit" class="btn btn-primary mt-3 mt-sm-0" id="submitBtn">Upload</button>
							                        </div>
							                    </form>
							                </div>
							            </div>
							        </div>
							    </div>

								@if($categories)
								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Image</th>
											<th>Status</th>
											<th>Edit Action</th>
											<th>Delete Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($categories as $category)
										<tr>
											<td><a href="javascript:void;" class="fw-medium">{{$category->id}}</a></td>
											<td>{{$category->name}}</td>
											<td>
												<div class="user-thumb">
													
													@if($category->image == 'No image found')
								                      <img src="asset('storage/uploads/no-img.jpg)" class="rounded-circle" width="50" height="50" alt="No Image Found">
								                  @elseif(file_exists(public_path('storage/uploads/category/' . $category->image)))
								                      <img src="{{ asset('storage/uploads/category/' . $category->image) }}" class="rounded-circle" width="50" height="50" alt="{{ $category->name }}">
								                  @elseif(file_exists(public_path('storage/' . $category->image)))
								                      <img src="{{ asset('storage/' . $category->image) }}" width="50" height="50" class="rounded-circle" alt="{{ $category->name }}">
								                  @else
								                      <img src="{{ Storage::disk('s3')->url('uploads/category/' . $category->image) }}" class="rounded-circle" width="50" height="50" alt="No Image Found">
								                  @endif
												</div>
											</td>
											<td>
											  @if($category->status == "DEACTIVE")
							                    <a href="{{Route('category.status', $category->id)}}" class="badge bg-info  m-0"><i class="fa fa-thumbs-down"></i></a>
							                  @else  
							                    <a href="{{Route('category.status', $category->id)}}" class="badge bg-info  m-0"><i class="fa fa-thumbs-up"></i></a>
							                  @endif  
						                  </td>
											<td><a href="{{Route('category.edit', $category->id)}}" class="btn-link text-underline p-0">Edit</a></td>
											<td><a href="{{Route('category.destroy', $category->id)}}" class="btn-link text-underline p-0">Delete</a></td>
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
										{{$categories->links()}}
									</ul>
								</nav>
							</div>
                        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Function to check file extension
    document.getElementById('file').addEventListener('change', function() {
        var file = this.files[0];
        var errorAlert = document.getElementById('error-alert');
        var submitBtn = document.getElementById('submitBtn');
        
        // Check if a file is selected and if it's a CSV
        if (file) {
            var fileName = file.name;
            var fileExtension = fileName.split('.').pop().toLowerCase();
            
            // Check if the file is CSV
            if (fileExtension !== 'csv') {
                // Show error and prevent form submission
                errorAlert.style.display = 'block';
                submitBtn.disabled = true;  // Disable the submit button
            } else {
                // Hide error and allow form submission
                errorAlert.style.display = 'none';
                submitBtn.disabled = false;  // Enable the submit button
            }
        }
    });
</script>
@endsection