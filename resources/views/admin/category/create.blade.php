@extends('admin.layout.master')
@section('page_title')
  Add Category
@endsection
@section('main_content')
	<section class="col-xl-9 account-wrapper">
						<div class="account-card">
							<form class="row" name="formCreate" id="formCreate" method="POST" action="{{Route('category.store')}}" enctype="multipart/form-data">
								@csrf  
								<div class="profile-edit">
								<div class="avatar-upload d-flex align-items-center">
									<div class=" position-relative ">
										<div class="avatar-preview thumb">
											<div id="imagePreview" style="background-image: url('/assets/images/profile3.jpg');"></div>
										</div>
										<div class="change-btn  thumb-edit d-flex align-items-center flex-wrap">
											<input type='file' class="form-control d-none" name="image"  id="imageUpload" accept=".png, .jpg, .jpeg">
											<label for="imageUpload" class="btn btn-light ms-0"><i class="fa-solid fa-camera"></i></label>
										</div>	
									</div>
								</div>
								<div class="clearfix">
									<h2 class="title mb-0">Upload Image</h2>
								</div>
							</div>
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
								
								
									<button class="btn btn-primary mt-3 mt-sm-0" type="submit">Add Category</button>
									<a class="btn btn-primary mt-3" href="{{Route('category.all')}}">Back</a>					
								
							</form>			
						</div>
	</section>
@endsection
@section('scripts')
    <script>
    const editorConfig = {
        ckfinder: {
            uploadUrl: '/upload-image/category',
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