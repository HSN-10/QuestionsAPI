@extends('layouts.app')
@section('title' ,  Lang::get('lang.adminpanel') . ' | '. Lang::get('lang.trash'))
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
                    <h3 class="content-header-title mb-0">@lang('lang.questions')</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('adminpanel')}}">@lang('lang.home')</a></li>
                                <li class="breadcrumb-item"><a href="{{route('question.index')}}">@lang('lang.questions')</a></li>
                                <li class="breadcrumb-item active"><span>@lang('lang.trash')</span></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <form>
                                            <h4 class="form-section"><i class="fas fa-question-circle"></i> @lang('lang.trash')</h4>
                                        </form>
                                        <table class="table table-striped table-bordered datatables">
                                            <thead>
                                            <tr>
                                                <th>@lang('lang.id')</th>
                                                <th>@lang('lang.category')</th>
                                                <th>@lang('lang.question')</th>
                                                <th>@lang('lang.correct_answer')</th>
                                                <th>@lang('lang.wrongAnswer')</th>
                                                <th>@lang('lang.wrongAnswer')</th>
                                                <th>@lang('lang.wrongAnswer')</th>
                                                <th>@lang('lang.isActive')</th>
                                                <th>@lang('lang.options')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($questions as $question)
                                                <tr>
                                                    <td>{{$question->id}}</td>
                                                    <td>{{App\Category::withTrashed()->find($question->category_id)->name}}</td>
                                                    <td>{{$question->question}}
                                                        @if($question->with_image)
                                                            <br><img class="rounded img-thumbnail" style="max-width: 200px;" src="{{ asset('storage/'.$question->image) }}">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($question->with_image)
                                                            <img class="rounded img-thumbnail" style="max-width: 200px;" src="{{ asset('storage/'.$question->correct_answer) }}">
                                                        @else
                                                            {{$question->correct_answer}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($question->with_image)
                                                            <img class="rounded img-thumbnail" style="max-width: 200px;" src="{{ asset('storage/'.$question->answer2) }}">
                                                        @else
                                                            {{$question->answer2}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($question->with_image)
                                                            <img class="rounded img-thumbnail" style="max-width: 200px;" src="{{ asset('storage/'.$question->answer3) }}">
                                                        @else
                                                            {{$question->answer3}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($question->with_image)
                                                            <img class="rounded img-thumbnail" style="max-width: 200px;" src="{{ asset('storage/'.$question->answer4) }}">
                                                        @else
                                                            {{$question->answer4}}
                                                        @endif
                                                    </td>
                                                    <td><span class="badge @if($question->active) badge-success @else badge-danger @endif">
                                                            @if($question->active) @lang('lang.active') @else @lang('lang.inActive') @endif
                                                        </span></td>
                                                    <td>
                                                        <div class="btn-group mr-1 mb-1">
                                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                                                            <div class="dropdown-menu" style="right: -150% !important;">
                                                                <a class="dropdown-item"
                                                                   href="{{route('question.undo', $question->id)}}"><i class="fas fa-undo mr-1"></i> @lang('lang.undo')</a>
                                                                <a class="dropdown-item text-danger confirm-text" data-category="{{$question->id}}"
                                                                   href="{{route('question.forceDelete', $question->id)}}" onclick="event.preventDefault();"
                                                                ><i class="fas fa-trash mr-1"></i> @lang('lang.delete')</a>
                                                            </div>
                                                        </div>
                                                        <form id="delete-form-{{$question->id}}" action="{{ route('question.forceDelete', $question->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>@lang('lang.id')</th>
                                                <th>@lang('lang.category')</th>
                                                <th>@lang('lang.question')</th>
                                                <th>@lang('lang.correct_answer')</th>
                                                <th>@lang('lang.wrongAnswer')</th>
                                                <th>@lang('lang.wrongAnswer')</th>
                                                <th>@lang('lang.wrongAnswer')</th>
                                                <th>@lang('lang.isActive')</th>
                                                <th>@lang('lang.options')</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->
            </div>
        </div>
    </div>
@endsection

{{-- CSS --}}
@push('VendorCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endpush
@push('ThemeCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/custom-rtl.css') }}">
@endpush
@push('PageCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
@endpush

{{-- JS --}}
@push('PageVendorJS')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
@endpush

@push('PageJS')
    <script src="{{ asset('app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
    <script>
        $('.datatables').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Arabic.json"
            },
            "columns": [
                { "width": "1%" },
                { "width": "10%" },
                { "width": "20%" },
                { "width": "15%" },
                { "width": "15%" },
                { "width": "15%" },
                { "width": "15%" },
                { "width": "4%" },
                {"width":"5%"}
            ]
        });
        $(".confirm-text").on("click", function() {
            let category = this.dataset.category;
            Swal.fire({
                title: "@lang('lang.areyousure')",
                text: "@lang('lang.forceDeleteNote')",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "@lang('lang.yesDelete')",
                cancelButtonText: "@lang('lang.close')",
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    Swal.fire({
                        type: "success",
                        title: "@lang('lang.success')",
                        text: "@lang('lang.deleteSuccess')",
                        confirmButtonClass: "btn btn-success"
                    });
                    setTimeout(()=>{
                        document.getElementById('delete-form-' + category).submit();
                    },1500)

                }
            });
        });
    </script>
@endpush
