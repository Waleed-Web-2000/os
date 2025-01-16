@extends('frontlayout.master')
@section('page-title')
    Register 
@endsection 
@section('main-content')
    <div class="page-content bg-light">
        <section class="px-3">
                <div class="row align-center-center">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 end-side-content">
                        <div class="login-area">
                            <h2 class="text-secondary text-center">PLDS REGISTRATION</h2>
                            <p class="text-center m-b30">Welcome please registration to your account </p>
                            <form method="POST" action="{{ route('register') }}">
                            @csrf
                                <div class="m-b25">
                                    <label class="label-title" value="{{ __('Name') }}">Name</label>
                                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                                </div>
                                <div class="m-b25">
                                    <label class="label-title" value="{{ __('Email') }}">Email Address</label>
                                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username">
                                </div>
                                <div class="m-b25">
                                    <label class="label-title" value="{{ __('mobile') }}">Phone Number</label>
                                    <input id="mobile" class="form-control" type="text" name="mobile" :value="old('mobile')" required autocomplete="mobile">
                                </div>
                                <div class="m-b40">
                                    <label class="label-title" value="{{ __('Password') }}">Password</label>
                                    <div class="secure-input ">
                                        <input id="password" class="form-control dz-password" type="password" name="password" required autocomplete="new-password">
                                        <div class="show-pass">
                                            <i class="eye-open fa-regular fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-b40">
                                    <label class="label-title" value="{{ __('Confirm Password') }}">Confirm Password</label>
                                    <div class="secure-input ">
                                        <input id="password_confirmation" class="form-control dz-password" type="password" name="password_confirmation" required autocomplete="new-password">
                                        <div class="show-pass">
                                            <i class="eye-open fa-regular fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-secondary btnhover text-uppercase me-2">Register</button>
                                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btnhover text-uppercase">Sign In</a>
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





