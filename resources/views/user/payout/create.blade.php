@extends('frontlayout.master')
@extends('frontlayout.header-main')
@extends('frontlayout.footer')
@section('page-title')
	User Payouts Create
@endsection 
@section('meta')
@endsection

@section('main-content')
	
	
					@include('user.aside')
                     
					<section class="col-xl-9 account-wrapper ">
						<div class="account-card">
							<form class="row" name="formCreate" id="formCreate" method="POST" action="{{ Route('user.payout.store') }}">
								@csrf  
								<div class="col-lg-6">
									<div class="form-group m-b25">
										<label class="label-title">Amount</label>
										<input type="number" name="amount" id="amount" class="form-control">
									</div>
								</div>			
									<button class="btn btn-primary mt-3 mt-sm-0" type="submit">Submit</button>	
									<a class="btn btn-primary mt-3" href="{{Route('user.payout')}}">Back</a>
							</form>			
						</div>
                    </section>

                </div>
      		</div>
		</div>
	</div>

@endsection
@section('scripts')
@endsection
