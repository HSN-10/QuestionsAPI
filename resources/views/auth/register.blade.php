@if (App\User::all()->count()!=0)
<script type="text/javascript">
    window.location = "{{ route('login') }}";
</script>
@endif
@extends('layouts.app')
@section('title', Lang::get('lang.adminpanel') . ' | '. Lang::get('lang.register'))
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
                    <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                        <div class="card-header border-0">
                            <div class="card-title text-center">
                                <div class="p-1 font-large-2">@lang('lang.adminpanel')</div>
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-center font-medium-3 pt-2"><span>@lang('lang.createAccount')</span></h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form method="POST" class="form-horizontal form-simple" action="{{ route('register') }}">
                                    @csrf
                                    <fieldset class="form-group position-relative has-icon-left mb-1">
                                        <input type="text" class="form-control form-control-lg @error('name') is-invalid text-danger @enderror" name="name"
                                                value="{{ old('name') }}" placeholder="@lang('validation.attributes.name')" required autofocus>
                                        <div class="form-control-position font-large-1 @error('name') is-invalid text-danger @enderror">
                                            <i class="feather icon-user"></i>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left mb-1">
                                        <input type="text" class="form-control form-control-lg @error('username') is-invalid text-danger @enderror" name="username"
                                                value="{{ old('username') }}" placeholder="@lang('validation.attributes.username')" required>
                                        <div class="form-control-position font-large-1 @error('username') is-invalid text-danger @enderror">
                                            <i class="feather icon-user"></i>
                                        </div>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left mb-1">
                                        <input type="email" class="form-control form-control-lg @error('email') is-invalid text-danger @enderror" name="email"
                                            value="{{ old('email') }}" placeholder="@lang('validation.attributes.email')" required>
                                        <div class="form-control-position font-large-1 @error('email') is-invalid text-danger @enderror">
                                            <i class="feather icon-mail"></i>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control form-control-lg @error('password') is-invalid text-danger @enderror" name="password"
                                            placeholder="@lang('validation.attributes.password')" required>
                                        <div class="form-control-position font-large-1 @error('password') is-invalid text-danger @enderror">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control form-control-lg" name="password_confirmation"
                                            placeholder="@lang('validation.attributes.password_confirmation')" required>
                                        <div class="form-control-position font-large-1">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                    </fieldset>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="feather icon-unlock"></i> @lang('lang.register')</button>
                                </form>
                            </div>
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

