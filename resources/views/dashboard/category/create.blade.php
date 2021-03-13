@extends('layouts.app')
@section('title' ,  Lang::get('lang.adminpanel') . ' | '. Lang::get('lang.createCategory'))
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
                <h3 class="content-header-title mb-0">@lang('lang.createCategory')</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('adminpanel')}}">@lang('lang.home')</a></li>
                            <li class="breadcrumb-item"><a href="{{route('category.index')}}">@lang('lang.categories')</a></li>
                            <li class="breadcrumb-item active"><span>@lang('lang.createCategory')</span></li>
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
                                    <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                                        <h4 class="form-section"><i class="fas fa-list"></i> @lang('lang.createCategory')</h4>
                                        @csrf
                                        <div class="row">
                                            <fieldset class="form-group col-6 mb-2">
                                                <label for="name">@lang('lang.nameCategory')</label>
                                                <input type="text" class="form-control @error('name') is-invalid text-danger @enderror" id="name"
                                                        placeholder="@lang('lang.nameCategory')" name="name" value="{{old('name')}}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group col-6 mb-2 @error('main_category_id') has-error @enderror">
                                                <label for="main_category_id">@lang('lang.mainCategory')</label>
                                                <select name="main_category_id" class="form-control select2 @error('main_category_id') is-invalid text-danger @enderror" id="main_category_id">
                                                    <option value="0">@lang('lang.withoutCategory')</option>
                                                    @foreach($categories as $mainCategory)
                                                        <option value="{{$mainCategory->id}}">{{$mainCategory->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('main_category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group col-12 mb-2">
                                                <label for="image">@lang('lang.imageCategory')</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input  @error('image') is-invalid text-danger @enderror" id="image" name="image"
                                                           accept="image/x-png,image/gif,image/jpeg,image/svg,image/webp" value="{{old('image')}}">
                                                    <label class="custom-file-label" for="image">@lang('lang.chooseFile')</label>
                                                    @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                            </fieldset>
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
    </style>
@endpush

{{-- JS --}}
@push('PageJS')
<script src="{{ asset('app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
@endpush
