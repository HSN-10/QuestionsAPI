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
                            <h6 class="card-subtitle line-on-side text-muted text-center font-medium-3 pt-2"><span>@lang('lang.resetpassword')</span></h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="email" class="form-control form-control-lg @error('email') is-invalid text-danger @enderror"
                                                name="email" value="{{ old('email') }}" placeholder="@lang('validation.attributes.email')" required>
                                        <div class="form-control-position font-large-1 @error('email') text-danger @enderror">
                                            <i class="feather icon-mail"></i>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block"><i class="feather icon-unlock"></i> @lang('lang.sendPasswordResetLink')</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <p class="float-sm-left text-center"><a href="{{ route('login') }}" class="card-link">@lang('lang.login')</a></p>
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
