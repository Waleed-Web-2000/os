@extends('admin.layout.master')
@section('page_title')
  Products
@endsection
@section('main_content')
	<section class="col-xl-9 account-wrapper">
						<div class="account-card">
							<div class="table-responsive table-style-1">
								<table class="table table-hover mb-3">
									<thead>
										<tr> 
											<th>Import Products</th>
											<th>Export Products</th>
											<th>Add Products</th>
										</tr>
									</thead>
									<tbody>									
										<tr>
											<td><button type="button" class="badge bg-successe" data-bs-toggle="modal" data-bs-target="#importModal">Import</button></td>
											<td><a href="{{ route('products.export') }}" class="badge bg-successe">Export</a></td>
											<td><a href="{{Route('product.create')}}" class="badge bg-success">Add</a></td>
										</tr>									
									</tbody>
								</table>

								<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
							        <div class="modal-dialog modal-dialog-centered modal-lg">
							            <div class="modal-content">
							                <div class="modal-header">
							                    <h5 class="modal-title" id="importModalLabel">Import Products</h5>
							                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							                </div>
							                <div class="modal-body">
							                	 <!-- Error Alert -->
							                <div id="error-alert" class="alert alert-danger" style="display: none;">
							                    <ul>
							                        <li>Please Upload Only CSV File.</li>
							                    </ul>
							                </div>
							                    <form id="importForm" action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
							                    	@csrf
							                        <div class="mb-3 mt-3">
							                            <input type="file" name="file" id="file" class="form-control" required>
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

								@if($products)
								<table class="table table-hover mb-3">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Category</th>
											<th>Image</th>
											<th>Status</th>
											<th>Edit Action</th>
											<th>Delete Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($products as $product)
										<tr>
											<td><a href="javascript:void;" class="fw-medium">{{$product->id}}</a></td>
											<td>{{$product->name}}</td>
											<td>{{ $product->category->name ?? 'N/A' }}</td>
											<td>
												<div class="user-thumb">								
													@if($product->image == 'No image found')
								                      <img src="/uploads/no-img.jpg" class="rounded-circle" width="50" height="50" alt="No Image Found">
									                  @elseif(file_exists(public_path('storage/uploads/product/' . $product->image)))
									                      <img src="{{ asset('storage/uploads/product/' . $product->image) }}" class="rounded-circle" width="50" height="50" alt="{{ $product->name }}">
									                  @else
									                      <img src="{{ asset('storage/' . $product->image) }}" width="50" height="50" class="rounded-circle" alt="{{ $product->name }}">
									                  @endif
												</div>
											</td>
											<td>
											  @if($product->status == "DEACTIVE")
							                    <a href="{{Route('product.status', $product->id)}}" class="badge bg-info  m-0"><i class="fa fa-thumbs-down"></i></a>
							                  @else  
							                    <a href="{{Route('product.status', $product->id)}}" class="badge bg-info  m-0"><i class="fa fa-thumbs-up"></i></a>
							                  @endif  
						                  </td>
											<td><a href="{{Route('product.edit', $product->id)}}" class="btn-link text-underline p-0">Edit</a></td>
											<td><a href="{{Route('product.destroy', $product->id)}}" class="btn-link text-underline p-0">Delete</a></td>
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
										{{$products->links()}}
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