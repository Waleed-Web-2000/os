@extends('admin.layout.master')
@section('page_title')
  Add Product
@endsection
@section('main_content')
	<section class="col-xl-9 account-wrapper">
						<div class="account-card">
							<form class="row" name="formCreate" id="formCreate" method="POST" action="{{ Route('product.store') }}" enctype="multipart/form-data">
								@csrf  
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Name</label>
										<input type="text" name="name" required="" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Slug</label>
										<input type="text" name="slug" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
								    <div class="form-group m-b25">
								        <label class="label-title">Category</label>						
								        <select class="form-control" name="category_id" id="category_id">
								            <option value="">Select Category</option>
								            @foreach ($categories as $category)
								                <option value="{{ $category->id }}">{{ $category->name }}</option>
								            @endforeach
								        </select>
								    </div>
								</div>

								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Price</label>
										<input type="text" name="price" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Sale Price</label>
										<input type="text" name="sale_price" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Quantity</label>
										<input type="text" name="quantity" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Tags</label>
										<input type="text" name="tags" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Meta Description</label>
										<input type="text" name="meta_description" class="form-control">
									</div>
								</div>			
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Description</label>
										<textarea type="text" id="description" name="description" class="form-control"></textarea>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Image</label>										
										<input type='file' class="form-control" name="image">
									</div>
								</div>	
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Gallery Images</label>										
										 <input type="file" class="form-control" name="gallery_images[]" 
                    						accept="image/*" multiple>
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