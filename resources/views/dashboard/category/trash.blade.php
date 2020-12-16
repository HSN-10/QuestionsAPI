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
                    <h3 class="content-header-title mb-0">@lang('lang.trash')</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('adminpanel')}}">@lang('lang.home')</a></li>
                                <li class="breadcrumb-item"><a href="{{route('category.index')}}">@lang('lang.categories')</a></li>
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
                                            <h4 class="form-section"><i class="fas fa-list"></i> @lang('lang.trash')</h4>
                                        </form>
                                        <table class="table table-striped table-bordered datatables">
                                            <thead>
                                            <tr>
                                                <th>@lang('lang.id')</th>
                                                <th>@lang('lang.imageCategory')</th>
                                                <th>@lang('lang.nameCategory')</th>
                                                <th>@lang('lang.options')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($categories as $category)
                                                <tr>
                                                    <td>{{$category->id}}</td>
                                                    <td><img class="rounded img-thumbnail" src="{{ asset('storage/'.$category->image) }}"></td>
                                                    <td>{{$category->name}}</td>
                                                    <td>
                                                        <div class="d-none d-md-block">
                                                            <div class="btn-group">
                                                                <a href="{{route('category.undo', $category->id)}}" class="btn btn-group btn-info square">
                                                                    <i class="fas fa-undo mr-1"></i> @lang('lang.undo')
                                                                </a>
                                                                <a href="{{route('category.destroy', $category->id)}}" class="btn btn-group btn-danger square confirm-text"
                                                                   onclick="event.preventDefault();" data-category="{{$category->id}}">
                                                                    <i class="fas fa-trash mr-1"></i> @lang('lang.delete')
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="d-sm-block d-xs-block d-lg-none d-md-none">
                                                            <div class="btn-group mr-1 mb-1">
                                                                <button type="button" class="btn btn-secondary dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                                                                <div class="dropdown-menu" style="right: -150% !important;">
                                                                    <a class="dropdown-item"
                                                                       href="{{route('category.undo', $category->id)}}">
                                                                        <i class="fas fa-undo mr-1"></i> @lang('lang.undo')
                                                                    </a>
                                                                    <a class="dropdown-item" data-category="{{$category->id}}"
                                                                       href="{{route('category.forceDelete', $category->id)}}" id="confirm-text" onclick="event.preventDefault();"
                                                                    ><i class="fas fa-trash mr-1"></i> @lang('lang.delete')</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form id="forceDelete-form-{{$category->id}}" action="{{ route('category.forceDelete', $category->id) }}" method="POST" style="display: none;">
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
                                                <th>@lang('lang.imageCategory')</th>
                                                <th>@lang('lang.nameCategory')</th>
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
                { "width": "2%" },
                { "width": "15%" },
                { "width": "20%" },
                {"width":"30%"}
            ]
        });
        $(".confirm-text").on("click", function() {
            let category = this.dataset.category;
            Swal.fire({
                title: "@lang('lang.areyousure')",
                text: "@lang('lang.forceDeleteNoteCategory')",
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
                        document.getElementById('forceDelete-form-' + category).submit();
                    },1500)

                }
            });
        });
    </script>
@endpush
