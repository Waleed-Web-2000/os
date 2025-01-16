@extends('admin.layout.master')
@section('page_title')
  Setting
@endsection
@section('main_content')
	<section class="col-xl-9 account-wrapper">
						<div class="account-card">
							@isset($data)
							<form class="row" name="formEdit" id="formEdit" method="POST" action="{{route('settings.update', $data->id)}}" enctype="multipart/form-data">
								@csrf 
       							@method('put')
       							{{-- {{dd($data)}} --}}
								
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Website Name</label>
										<input type="text" value="{{$data->name}}" name="name" required="" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Address</label>
										<input type="text" value="{{$data->address}}" name="address" required="" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Email</label>
										<input type="email" value="{{$data->email}}" name="email" required="" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Phone</label>
										<input type="phone" value="{{$data->phone}}" name="phone" required="" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Copy Right</label>
										<input type="text" value="{{$data->copy_right}}" name="copy_right" required="" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Meta Description</label>
										<input type="text" value="{{$data->meta_description}}" name="meta_description" required="" class="form-control">
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Logo</label>
										<input type="file" name="logo" class="form-control">
										<span><img src="{{ asset('storage/uploads/setting/' . $data->logo) }}" width="150" height="150" alt=""></span>
									</div>
								</div>
								
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Fevicon</label>
										<input type="file" name="fev" class="form-control">
										<span><img src="{{ asset('storage/uploads/setting/fev/' . $data->fev) }}" width="150" height="150" alt=""></span>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Home Description</label>
										<textarea type="text" id="description" name="description" required="" class="form-control">{{$data->description}}</textarea>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">About Page</label>
										<textarea type="text" id="about" name="about" required="" class="form-control">{{$data->about}}</textarea>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Privacy Policy Page</label>
										<textarea type="text" id="privacy_policy" name="privacy_policy" required="" class="form-control">{{$data->privacy_policy}}</textarea>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Shipping Policy Page</label>
										<textarea type="text" id="shipping_policy" name="shipping_policy" required="" class="form-control">{{$data->shipping_policy}}</textarea>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group m-b25">
										<label class="label-title">Terms Policy Page</label>
										<textarea type="text" id="terms_policy" name="terms_policy" required="" class="form-control">{{$data->terms_policy}}</textarea>
									</div>
								</div>
								
									<button class="btn btn-primary mt-3 mt-sm-0" type="submit">Update profile</button>
								
								
							</form>
							@else
								    <p>Data not found!</p>
								@endisset
						</div>
					</section>
@endsection
@section('scripts')
    <script>
    const editorConfig = {
        ckfinder: {
            uploadUrl: '/upload-image/setting',
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
    ClassicEditor.create(document.querySelector('#about'), editorConfig);
    ClassicEditor.create(document.querySelector('#shipping_policy'), editorConfig);
    ClassicEditor.create(document.querySelector('#terms_policy'), editorConfig);
    ClassicEditor.create(document.querySelector('#privacy_policy'), editorConfig);
</script>

@endsection