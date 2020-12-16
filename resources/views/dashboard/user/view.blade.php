@extends('layouts.app')
@section('title' ,  Lang::get('lang.adminpanel') . ' | '. Lang::get('lang.users'))
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
                <h3 class="content-header-title mb-0">@lang('lang.users')</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('adminpanel')}}">@lang('lang.home')</a></li>
                            <li class="breadcrumb-item active"><span>@lang('lang.users')</span></li>
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
                                        <h4 class="form-section"><i class="fas fa-users"></i> @lang('lang.users')</h4>
                                    </form>
                                    <table class="table table-striped table-bordered datatables">
                                        <thead>
                                            <tr>
                                                <th>@lang('lang.id')</th>
                                                <th>@lang('validation.attributes.name')</th>
                                                <th>@lang('validation.attributes.username')</th>
                                                <th>@lang('validation.attributes.email')</th>
                                                <th>@lang('lang.isAdmin')</th>
                                                <th>@lang('lang.options')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->username}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>
                                                        <span class="badge @if($user->is_admin) badge-success @else badge-danger @endif">
                                                            @if($user->is_admin) @lang('lang.yes') @else @lang('lang.no') @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if(auth()->user()->is_admin)
                                                            <div class="btn-group mr-1 mb-1">
                                                                <button type="button" class="btn btn-secondary dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                                                                <div class="dropdown-menu" style="right: -150% !important;">
                                                                    <a class="dropdown-item"
                                                                       href="{{route('user.edit', $user->id)}}"><i class="fas fa-edit mr-1"></i> @lang('lang.edit')</a>
                                                                    @if(auth()->user()->id != $user->id)
                                                                        <a class="dropdown-item text-danger confirm-text" data-user="{{$user->id}}"
                                                                           href="{{route('user.destroy', $user->id)}}" onclick="event.preventDefault();">
                                                                            <i class="fas fa-trash mr-1"></i> @lang('lang.delete')
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(auth()->user()->id != $user->id && auth()->user()->is_admin)
                                                            <form id="delete-form-{{$user->id}}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: none;">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>@lang('lang.id')</th>
                                                <th>@lang('validation.attributes.name')</th>
                                                <th>@lang('validation.attributes.username')</th>
                                                <th>@lang('validation.attributes.email')</th>
                                                <th>@lang('lang.isAdmin')</th>
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
                    { "width": "9%" },
                    { "width": "10%" },
                    { "width": "5%" },
                    { "width": "5%" }
                ]
        });
        $(".confirm-text").on("click", function() {
            let user = this.dataset.user;
            Swal.fire({
                title: "@lang('lang.areyousure')",
                text: "@lang('lang.moveToTrash')",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "@lang('lang.yesMove')",
                cancelButtonText: "@lang('lang.close')",
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    Swal.fire({
                        type: "success",
                        title: "@lang('lang.success')",
                        text: "@lang('lang.moveSuccess')",
                        confirmButtonClass: "btn btn-success"
                    });
                    setTimeout(()=>{
                        document.getElementById('delete-form-' + user).submit();
                    },1500)

                }
            });
        });
    </script>
@endpush
