@extends('layouts.app')
@section('title', Lang::get('lang.adminpanel') . ' | '. Lang::get('lang.login'))
@push('attr-body')
class="vertical-layout vertical-menu 1-column blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column"
@endpush
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 m-0">
                        <div class="card-header border-0">
                            <div class="card-title text-center">
                                <div class="p-1 font-large-2">@lang('lang.adminpanel')</div>
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-center font-medium-3 pt-2"><span>@lang('lang.login')</span></h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <fieldset class="form-group position-relative has-icon-left mb-1">
                                        <input type="email" class="form-control form-control-lg @error('email') is-invalid text-danger @enderror"
                                                placeholder="@lang('validation.attributes.email')" name="email" value="{{ old('email') }}" required>
                                        <div class="form-control-position font-large-1 @error('email') text-danger @enderror">
                                            <i class="feather icon-user"></i>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control form-control-lg @error('password') is-invalid text-danger @enderror"
                                                name="password" placeholder="@lang('validation.attributes.password')" required>
                                        <div class="form-control-position font-large-1 @error('password') text-danger @enderror">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-12 text-center text-sm-left">
                                            <fieldset>
                                                <input type="checkbox" id="remember-me" class="chk-remember">
                                                <label for="remember-me"> @lang('lang.rememberme')</label>
                                            </fieldset>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right">
                                                <a href="{{ route('password.request') }}" class="card-link">@lang('lang.forgotpassword')</a>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="feather icon-unlock"></i> @lang('lang.login')</button>
                                </form>
                            </div>
                            @if (App\User::all()->count()==0)
                                <p class="text-center">@lang('lang.donthaveAccount') <a href="{{ route('register') }}" class="card-link">@lang('lang.register')</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</div>
<!-- END: Content-->
@endsection

{{-- CSS --}}
@push('VendorCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
@endpush
@push('PageCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/login-register.min.css') }}">
@endpush

{{-- JS --}}
@push('PageVendorJS')
<script src="{{asset('app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
@endpush
@push('PageJS')
<script src="{{asset('app-assets/js/scripts/forms/form-login-register.min.js')}}"></script>
@endpush
