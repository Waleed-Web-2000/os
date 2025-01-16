@extends('admin.layout.master')
@section('page_title')
  Edit Product
@endsection
@section('main_content')
	<section class="col-xl-9 account-wrapper">
						<div class="account-card">
							<form class="row" name="formEdit" id="formEdit" method="POST" action="{{Route('product.update', $product->id)}}" enctype="multipart/form-data">
								@csrf
								@method('put')  
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Name</label>
										<input type="text" name="name" required="" value="{{$product->name}}" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Slug</label>
										<input type="text" name="slug" value="{{$product->slug}}" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
    <div class="form-group m-b25">
        <label class="label-title">Category</label>
        <select class="form-control" name="category_id" id="category_id">
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
            @endforeach
        </select>
    </div>
</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Price</label>
										<input type="text" name="price" value="{{$product->price}}" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Sale Price</label>
										<input type="text" name="sale_price" value="{{$product->sale_price}}" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Quantity</label>
										<input type="text" name="quantity" value="{{$product->quantity}}" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Tags</label>
										<input type="text" name="tags" value="{{ is_array($product->tags) ? implode(', ', $product->tags) : (json_decode($product->tags, true) ? implode(', ', json_decode($product->tags, true)) : '') }}" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Meta Description</label>
										<input type="text" name="meta_description" value="{{$product->meta_description}}" class="form-control">
									</div>
								</div>			
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Description</label>
										<textarea type="text" id="description" name="description" class="form-control">{{$product->description}}</textarea>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Image</label>										
										<input type='file' class="form-control" name="image">
										 @if($product->image == 'No image found')
							                      <img src="/uploads/no-img.jpg" width="100" height="100" class="img-thumbnail" alt="No Image Found">
							                  @elseif(file_exists(public_path('storage/uploads/product/' . $product->image)))
							                      <img src="{{ asset('storage/uploads/product/' . $product->image) }}" width="100" height="100" class="img-thumbnail" alt="{{ $product->name }}">
							                  @elseif(file_exists(public_path('storage/' . $product->image)))
							                      <img src="{{ asset('storage/' . $product->image) }}" width="100" height="100" class="img-thumbnail" alt="{{ $product->name }}">
							                  @else
							                      <img src="{{ Storage::disk('s3')->url($product->image) }}" width="100" height="100" class="img-thumbnail" alt="{{ $product->name }}">
							                  @endif 
							            @error('image')
							              <span class="invalid-feedback">{{ $message }}</span>
							            @enderror
									</div>
								</div>	
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Gallery Images</label>										
										 <input type="file" class="form-control" name="gallery_images[]" 
                    						accept="image/*" multiple>
                    						
                    						@foreach (json_decode($product->gallery_images, true) as $gallery_image)
					                        @if ($product->gallery_images)    
					                            <img src="{{ asset('storage/uploads/product/' . $gallery_image) }}" alt="{{ $product->name }}" class="img-fluid img-thumbnail" width="50" height="50">
        									@else 
        										<img src="{{ asset('storage/uploads/product/' . $gallery_image) }}" alt="{{ $product->name }}" class="img-fluid img-thumbnail" width="50" height="50">
        									@endif
					                        @endforeach
					                        
									</div>
								</div>
								
								
									<button class="btn btn-primary mt-3 mt-sm-0" type="submit">Add Product</button>	
									<a class="btn btn-primary mt-3" href="{{Route('product.all')}}">Back</a>				
								
							</form>			
						</div>
	</section>
@endsection
@section('scripts')
	
    <script>
    const editorConfig = {
        ckfinder: {
            uploadUrl: '/upload-image/product',
        },
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                'imageUpload', '|',
                'undo', 'redo'
            ]
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
            ]
        },
        allowedContent: true,
        extraAllowedContent: 'h1 h2 h3 h4 p blockquote strong em; a[!href]; img[!src,width,height];',
        removePlugins: ['MediaEmbed'],
    };

    // Initialize CKEditor for the required text areas
    ClassicEditor.create(document.querySelector('#description'), editorConfig);
</script>


@endsection