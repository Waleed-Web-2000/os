@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	User Profile 
@endsection 
@section('meta')
@endsection 

@section('main-content')
	
	
					@include('user.aside')
                     
					<section class="col-xl-9 account-wrapper">
						<div class="account-card">
							<div class="profile-edit">
								
								<div class="clearfix">
									<h2 class="title mb-0">{{ $user->name }}</h2><span class="text text-primary">{{ $user->email }}</span>
									
								</div>
							</div>
							<form action="#" class="row">
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Name</label>
										<input name="name" required="" value="{{ $user->name }}" class="form-control dzName">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Email address</label>
										<input type="email" name="email" required="" value="{{ $user->email }}" class="form-control dzEmail" readonly="">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Phone</label>
										<input type="text" name="mobile" value="{{ $user->mobile }}" required="" class="form-control dzPhone" readonly="">
									</div>
								</div> 
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Current password</label>
										<input type="password" name="password" required="" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">New password (leave blank to leave unchanged)</label>
										<input type="password" name="password" required="" class="form-control">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Confirm new password</label>
										<input type="password" name="password" required="" class="form-control">
									</div>
								</div>
							</form>
							<div class="d-flex flex-wrap justify-content-between align-items-center">			
								<button class="btn btn-primary mt-3 mt-sm-0" type="button">Update profile</button>
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
