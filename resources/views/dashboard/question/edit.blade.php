@extends('layouts.app')
@section('title' ,  Lang::get('lang.adminpanel') . ' | '. Lang::get('lang.editQuestion'))
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
                    <h3 class="content-header-title mb-0">@lang('lang.editQuestion')</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('adminpanel')}}">@lang('lang.home')</a></li>
                                <li class="breadcrumb-item"><a href="{{route('question.index')}}">@lang('lang.questions')</a></li>
                                <li class="breadcrumb-item active"><span>@lang('lang.editQuestion')</span></li>
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
                                        <form action="{{route('question.update', $question->id)}}" method="POST" enctype="multipart/form-data">
                                            <h4 class="form-section"><i class="fas fa-question-circle"></i> @lang('lang.editQuestion')</h4>
                                            @csrf

                                            <input type="hidden" name="_method" value="PUT">
                                            <div class="row">
                                                <fieldset class="form-group col-12 mb-2">
                                                    <label for="thequestion">@lang('lang.thequestion')</label>
                                                    <input type="text" class="form-control @error('question') is-invalid text-danger @enderror" id="thequestion"
                                                           placeholder="@lang('lang.thequestion')" name="question" value="{{$question->question}}">
                                                    @error('question')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                            <div class="row">
                                                <fieldset class="form-group col-4 mb-2 @error('with_image') has-error @enderror">
                                                    <label for="with_image">@lang('lang.withImage')</label>
                                                    <select name="with_image" class="form-control select2 withoutSearch @error('with_image') is-invalid text-danger @enderror" id="with_image">
                                                        <option value="1" @if($question->with_image) selected @endif>@lang('lang.withImage')</option>
                                                        <option value="0" @if(!$question->with_image) selected @endif>@lang('lang.withoutImage')</option>
                                                    </select>
                                                    @error('with_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </fieldset>

                                                <fieldset class="form-group col-4 mb-2 @error('category_id') has-error @enderror">
                                                    <label for="category_id">@lang('validation.attributes.category_id')</label>
                                                    <select name="category_id" class="form-control select2 @error('category_id') is-invalid text-danger @enderror" id="category_id">
                                                        <option>@lang('lang.select')</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}" @if($question->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </fieldset>

                                                <fieldset class="form-group col-4 mb-2 @error('active') has-error @enderror">
                                                    <label for="active">@lang('lang.isActive')</label>
                                                    <select name="active" class="select2 form-control withoutSearch @error('active') is-invalid text-danger @enderror" id="active">
                                                        <option value="1" @if($question->active) selected @endif>@lang('lang.active')</option>
                                                        <option value="0" @if(!$question->active) selected @endif>@lang('lang.inActive')</option>
                                                    </select>
                                                    @error('active')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </fieldset>
                                            </div>

                                            <div id="withImage" style="display: none;">
                                                <div class="row">
                                                    <fieldset class="form-group col-6 mb-2">
                                                        <label for="image">@lang("lang.imageQuestion")</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input @error('image') is-invalid text-danger @enderror" id="image" name="image"
                                                                   accept="image/x-png,image/gif,image/jpeg,image/svg,image/webp">
                                                            <label class="custom-file-label" for="image">@lang("lang.chooseFile")</label>
                                                            @error('image')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        @if($question->with_image)
                                                            <img class="rounded img-thumbnail" style="max-width: 200px;" src="{{ asset('storage/'.$question->image) }}">
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group col-6 mb-2">
                                                        <label for="correct_answer">@lang("lang.correct_answer")</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input @error('correct_answer') is-invalid text-danger @enderror" id="correct_answer" name="correct_answer"
                                                                   accept="image/x-png,image/gif,image/jpeg,image/svg,image/webp">
                                                            <label class="custom-file-label" for="correct_answer">@lang("lang.chooseFile")</label>
                                                            @error('correct_answer')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        @if($question->with_image)
                                                            <img class="rounded img-thumbnail" style="max-width: 200px;" src="{{ asset('storage/'.$question->correct_answer) }}">
                                                        @endif
                                                    </fieldset>
                                                </div>
                                                <div class="row">
                                                    <fieldset class="form-group col-4 mb-2">
                                                        <label for="upload">@lang("validation.attributes.answer2")</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input @error('answer2') is-invalid text-danger @enderror" id="upload" name="answer2"
                                                                   accept="image/x-png,image/gif,image/jpeg,image/svg,image/webp">
                                                            <label class="custom-file-label" for="answer2">@lang("lang.chooseFile")</label>
                                                            @error('answer2')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        @if($question->with_image)
                                                            <img class="rounded img-thumbnail" style="max-width: 200px;" src="{{ asset('storage/'.$question->answer2) }}">
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group col-4 mb-2">
                                                        <label for="upload">@lang("validation.attributes.answer3")</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input @error('answer3') is-invalid text-danger @enderror" id="upload" name="answer3"
                                                                   accept="image/x-png,image/gif,image/jpeg,image/svg,image/webp">
                                                            <label class="custom-file-label" for="answer3">@lang("lang.chooseFile")</label>
                                                            @error('answer3')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        @if($question->with_image)
                                                            <img class="rounded img-thumbnail" style="max-width: 200px;" src="{{ asset('storage/'.$question->answer3) }}">
                                                        @endif
                                                    </fieldset>

                                                    <fieldset class="form-group col-4 mb-2">
                                                        <label for="upload">@lang("validation.attributes.answer4")</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input @error('answer4') is-invalid text-danger @enderror" id="upload" name="answer4"
                                                                   accept="image/x-png,image/gif,image/jpeg,image/svg,image/webp">
                                                            <label class="custom-file-label" for="answer4">@lang("lang.chooseFile")</label>
                                                            @error('answer4')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        @if($question->with_image)
                                                            <img class="rounded img-thumbnail" style="max-width: 200px;" src="{{ asset('storage/'.$question->answer4) }}">
                                                        @endif
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div id="withoutImage">
                                                <div class="row">
                                                    <fieldset class="form-group col-12 mb-2">
                                                        <label for="correct_answer">@lang("lang.correct_answer")</label>
                                                        <input type="text" class="form-control @error('correct_answer') is-invalid text-danger @enderror" id="correct_answer"
                                                               placeholder="@lang("lang.correct_answer")" name="correct_answer"
                                                               @if(!$question->with_image) value="{{$question->correct_answer}}" @endif>
                                                        @error('correct_answer')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </fieldset>
                                                </div>
                                                <div class="row">
                                                    <fieldset class="form-group col-4 mb-2">
                                                        <label for="answer2">@lang("validation.attributes.answer2")</label>
                                                        <input type="text" class="form-control @error('answer2') is-invalid text-danger @enderror" id="answer2"
                                                               placeholder="@lang("validation.attributes.answer2")" name="answer2"
                                                               @if(!$question->with_image) value="{{$question->answer2}}" @endif>
                                                        @error('answer2')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </fieldset>
                                                    <fieldset class="form-group col-4 mb-2">
                                                        <label for="answer2">@lang("validation.attributes.answer3")</label>
                                                        <input type="text" class="form-control @error('answer3') is-invalid text-danger @enderror" id="answer2"
                                                               placeholder="@lang("validation.attributes.answer3")" name="answer3"
                                                               @if(!$question->with_image) value="{{$question->answer3}}" @endif>
                                                        @error('answer3')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </fieldset>
                                                    <fieldset class="form-group col-4 mb-2">
                                                        <label for="answer2">@lang("validation.attributes.answer4")</label>
                                                        <input type="text" class="form-control @error('answer4') is-invalid text-danger @enderror" id="answer2"
                                                               placeholder="@lang("validation.attributes.answer4")" name="answer4"
                                                               @if(!$question->with_image) value="{{$question->answer4}}" @endif>
                                                        @error('answer4')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </fieldset>
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
        $(document).ready(()=>{
            if($('#with_image').val()==1){
                $('#withImage').show();
                $('#withoutImage').hide();
            }else{
                $('#withoutImage').show();
                $('#withImage').hide();
            }
            $('#with_image').change(()=>{
                if($('#with_image').val()==1){
                    $('#withImage').show();
                    $('#withoutImage').hide();
                }else{
                    $('#withoutImage').show();
                    $('#withImage').hide();
                }
            });
        });
        $('.withoutSearch').select2({
            minimumResultsForSearch: -1
        });
    </script>
@endpush
