@extends('frontlayout.master')
@section('page-title')
     Login 
@endsection 
@section('main-content')
    <div class="page-content bg-light">
        <section class="p-5">
            <div class="row">
                 @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif                
                <div class="col-xxl-12 col-xl-12 col-lg-12 end-side-content justify-content-center">
                     <div class="login-area">
                        <h2 class="text-secondary text-center">PLDS LOGIN</h2>
                        <p class="text-center m-b25">welcome please login to your account</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="m-b30">
                                <label class="label-title" value="{{ __('Email') }}" >Email Address</label>
                                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                            </div>
                            <div class="m-b15">
                                <label class="label-title" value="{{ __('Password') }}">Password</label>
                                <div class="secure-input ">
                                    <input id="password" class="form-control dz-password" type="password" name="password" required autocomplete="current-password">
                                    <div class="show-pass">
                                        <i class="eye-open fa-regular fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row d-flex justify-content-between m-b30">
                                <div class="form-group">
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                        <label class="form-check-label" for="basic_checkbox_1">{{ __('Remember me') }}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if (Route::has('password.request'))
                                    <a class="text-primary" href="{{ route('password.request') }}">Forgot Password</a>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center"> 
                                <button type="submit" class="btn btn-secondary btnhover text-uppercase me-2 sign-btn">
                                    {{ __('Log in') }}
                                </button>
                                <a href="{{ route('register') }}" class="btn btn-secondary btnhover text-uppercase me-2 sign-btn">Register</a>
                            </div>
                        </form>
                        <div class="text-center mt-2"> 
                                <span class="text-uppercase text-primary mt-5"><x-validation-errors/></span>
                        </div>
                    </div> 
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
@endsection





