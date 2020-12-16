@extends('layouts.app')
@section('title' ,  Lang::get('lang.adminpanel') . ' | '. Lang::get('lang.createQuestion'))
@push('attr-body')
    class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"
@endpush
@section('content')
@include('dashboard.components.header')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">@lang('lang.createQuestion')</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('adminpanel')}}">@lang('lang.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{route('question.index')}}">@lang('lang.questions')</a></li>
                            <li class="breadcrumb-item active"><span>@lang('lang.createQuestion')</span></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Elements start -->
            <section class="basic-elements">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{route('user.store')}}" method="POST">
                                        <h4 class="form-section"><i class="fas fa-users"></i> @lang('lang.createUser')</h4>
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">@lang('validation.attributes.name')</label>
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid text-danger @enderror"
                                                           placeholder="@lang('validation.attributes.name')" name="name" value="{{old('name')}}">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="username">@lang('validation.attributes.username')</label>
                                                    <input type="text" id="username" class="form-control @error('username') is-invalid text-danger @enderror"
                                                           placeholder="@lang('validation.attributes.username')" name="username" value="{{old('username')}}">
                                                    @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">@lang('validation.attributes.email')</label>
                                                    <input type="text" id="email" class="form-control @error('email') is-invalid text-danger @enderror"
                                                           placeholder="@lang('validation.attributes.email')" name="email" value="{{old('email')}}">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group @error('is_admin') has-error @enderror">
                                                    <label for="is_admin">@lang('lang.isAdmin')</label>
                                                    <select name="is_admin" class="form-control select2 @error('is_admin') is-invalid text-danger @enderror" id="is_admin">
                                                        <option value="1" @if(old('is_admin')) selected @endif>@lang('lang.yes')</option>
                                                        <option value="0" @if(!old('is_admin')) selected @endif>@lang('lang.no')</option>
                                                    </select>
                                                    @error('is_admin')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">@lang('validation.attributes.password')</label>
                                                    <input type="password" id="password" class="form-control @error('password') is-invalid text-danger @enderror"
                                                           placeholder="@lang('validation.attributes.password')" name="password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password_confirmation">@lang('validation.attributes.password_confirmation')</label>
                                                    <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid text-danger @enderror"
                                                           placeholder="@lang('validation.attributes.password_confirmation')"
                                                           name="password_confirmation">
                                                    @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions clearfix">
                                            <div class="buttons-group float-right">
                                                <button type="submit" class="btn btn-success">
                                                    @lang('lang.save')
                                                    <i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Inputs end -->
        </div>
    </div>
</div>


@endsection

{{-- CSS --}}
@push('VendorCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
@endpush
@push('ThemeCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/custom-rtl.css') }}">
@endpush
@push('PageCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <style>
        .custom-file-label::after{
            content: '@lang('lang.browse')';
        }
        .has-error .select2-selection {
            border-color: #FF7588 !important;
        }
    </style>
@endpush

{{-- JS --}}
@push('PageJS')
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
    <script>
        $('select').select2({
            minimumResultsForSearch: -1
        });
    </script>
@endpush
