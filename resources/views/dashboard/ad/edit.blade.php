@extends('layouts.app')
@section('title' ,  Lang::get('lang.adminpanel') . ' | '. Lang::get('lang.editAd'))
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
                    <h3 class="content-header-title mb-0">@lang('lang.editAd')</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('adminpanel')}}">@lang('lang.home')</a></li>
                                <li class="breadcrumb-item"><a href="{{route('ad.index')}}">@lang('lang.ads')</a></li>
                                <li class="breadcrumb-item active"><span>@lang('lang.editAd')</span></li>
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
                                        <form action="{{route('ad.update', $ad->id)}}" method="POST" enctype="multipart/form-data">
                                            <h4 class="form-section"><i class="fas fa-ad"></i> @lang('lang.editAd')</h4>
                                            @csrf
                                            <input type="hidden" name="_method" value="PUT">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <fieldset class="form-group">
                                                        <label for="name">@lang('validation.attributes.name')</label>
                                                        <input type="text" id="name" class="form-control @error('name') is-invalid text-danger @enderror"
                                                               placeholder="@lang('validation.attributes.name')" name="name"
                                                               value="{{$ad->name}}">
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6">
                                                    <fieldset class="form-group @error('active') has-error @enderror">
                                                        <label for="active">@lang('lang.isActive')</label>
                                                        <select name="active" class="form-control select2 @error('active') is-invalid text-danger @enderror" id="active">
                                                            <option value="1" @if($ad->active) selected @endif>@lang('lang.active')</option>
                                                            <option value="0" @if(!$ad->active) selected @endif>@lang('lang.inActive')</option>
                                                        </select>
                                                        @error('active')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <fieldset class="form-group">
                                                        <label for="url">@lang('lang.url')</label>
                                                        <input type="text" id="url" class="form-control @error('url') is-invalid text-danger @enderror"
                                                               placeholder="@lang('lang.url')" name="url" value="{{$ad->url}}">
                                                        @error('url')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6">
                                                    <fieldset class="form-group">
                                                        <label for="image">@lang('lang.image')</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input @error('image') is-invalid text-danger @enderror" id="image" name="image"
                                                                   accept="image/x-png,image/gif,image/jpeg,image/svg,image/webp">
                                                            <label class="custom-file-label" for="upload">@lang('lang.chooseFile')</label>
                                                            @error('image')
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                                    </fieldset>
                                                    <img class="rounded img-thumbnail" src="{{ asset('storage/'.$ad->image) }}">
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
