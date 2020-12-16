@extends('layouts.app')
@section('title' ,  Lang::get('lang.adminpanel') . ' | '. Lang::get('lang.editScore'))
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
                    <h3 class="content-header-title mb-0">@lang('lang.editScore')</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('adminpanel')}}">@lang('lang.home')</a></li>
                                <li class="breadcrumb-item"><a href="{{route('category.index')}}">@lang('lang.categories')</a></li>
                                <li class="breadcrumb-item"><a href="{{route('score.index', $category->id)}}">{{$category->name}}</a></li>
                                <li class="breadcrumb-item active"><span>@lang('lang.editScore')</span></li>
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
                                        <form action="{{route('score.update', [$category->id, $score->id])}}" method="POST" enctype="multipart/form-data">
                                            <h4 class="form-section"><i class="fas fa-list"></i> @lang('lang.editScore')</h4>
                                            @csrf
                                            <input name="_method" type="hidden" value="PUT">
                                            <div class="row">
                                                <fieldset class="form-group col-12 mb-2">
                                                    <label for="name">@lang('validation.attributes.name')</label>
                                                    <input type="text" class="form-control @error('name') is-invalid text-danger @enderror" id="name"
                                                           placeholder="@lang('validation.attributes.name')" name="name" value="{{$score->name}}">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="row">
                                                <fieldset class="form-group col-12 mb-2">
                                                    <label for="score">@lang('lang.score')</label>
                                                    <input type="number" class="form-control @error('score') is-invalid text-danger @enderror" id="score"
                                                           placeholder="@lang('lang.score')" name="score" value="{{$score->score}}">
                                                    @error('score')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="form-actions clearfix">
                                                <div class="buttons-group float-right">
                                                    <button type="submit" class="btn btn-success">
                                                        @lang('lang.save')
                                                        <i class="fas fa-check"></i>
                                                    </button>
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
@push('ThemeCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/custom-rtl.css') }}">
@endpush
@push('PageCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
@endpush

{{-- JS --}}
@push('PageJS')
    <script src="{{ asset('app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
@endpush
