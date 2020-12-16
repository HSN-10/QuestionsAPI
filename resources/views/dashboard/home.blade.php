@extends('layouts.app')
@section('title' ,  Lang::get('lang.adminpanel') . ' | '. Lang::get('lang.home'))
@push('attr-body')
class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"
@endpush
@section('content')
@include('dashboard.components.header') {{-- Header with menu --}}
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="row grouped-multiple-statistics-card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                        <span class="card-icon primary d-flex justify-content-center mr-3">
                                            <i class="fas fa-list p-1 customize-icon font-large-2 p-1"></i>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600" id="categoriesCount"
                                                data-toggle="tooltip" data-placement="top" data-original-title="{{$categoriesCount}}"></h3>
                                            <p class="sub-heading">@lang('lang.category')</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                        <span class="card-icon primary d-flex justify-content-center mr-3">
                                            <i class="fas fa-question-circle p-1 customize-icon font-large-2 p-1"></i>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600" id="questionsCount"
                                                data-toggle="tooltip" data-placement="top" data-original-title="{{$questionsCount}}"></h3>
                                            <p class="sub-heading">@lang('lang.question')</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                        <span class="card-icon primary d-flex justify-content-center mr-3">
                                            <i class="feather icon-bar-chart-2 p-1 customize-icon font-large-2 p-1"></i>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600" id="scoresCount"
                                                data-toggle="tooltip" data-placement="top" data-original-title="{{$scoresCount}}"></h3>
                                            <p class="sub-heading">@lang('lang.scoreRegister')</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                    <div class="d-flex align-items-start">
                                        <span class="card-icon primary d-flex justify-content-center mr-3">
                                            <i class="feather icon-users p-1 customize-icon font-large-2 p-1"></i>
                                        </span>
                                        <div class="stats-amount mr-3">
                                            <h3 class="heading-text text-bold-600" id="usersCount"
                                                data-toggle="tooltip" data-placement="top" data-original-title="{{$usersCount}}"></h3>
                                            <p class="sub-heading">@lang('lang.user')</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <!-- Column Basic Chart Start -->
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><h4><i class="fas fa-chart-bar"></i> @lang('lang.charScore')</h4></div>

                            <div id="chart"></div>
                        </div>
                    </div>
                    <!-- column basic chart end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

@endsection

{{-- CSS --}}
@push('VendorCSS')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/apexcharts.css')}}">
@endpush
@push('ThemeCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/custom-rtl.css') }}">
@endpush
@push('PageCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/card-statistics.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/colors/palette-tooltip.css') }}">
@endpush

{{-- JS --}}
@push('PageVendorJS')
<script src="{{ asset('app-assets/vendors/js/charts/apexcharts/apexcharts.min.js') }}"></script>
@endpush
@push('PageJS')
<script src="{{ asset('app-assets/vendors/js/extensions/numeral/numeral.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/tooltip/tooltip.js') }}"></script>
    <script>
        let categoriesCount = numeral({{$categoriesCount}}).format('0a');
        let questionsCount = numeral({{$questionsCount}}).format('0a');
        let scoresCount = numeral({{$scoresCount}}).format('0a');
        let usersCount = numeral({{$usersCount}}).format('0a');

        document.getElementById('categoriesCount').innerText = categoriesCount;
        document.getElementById('questionsCount').innerText = questionsCount;
        document.getElementById('scoresCount').innerText = scoresCount;
        document.getElementById('usersCount').innerText = usersCount;

        let date = [ @foreach($data['date'] as $date) '{{$date}}', @endforeach ];
        let number = [ @foreach($data['number'] as $number) {{$number}}, @endforeach ];
        var options = {
            chart: {
                height: 350,
                type: 'bar',
            },
            series: [{
                name: '@lang("lang.person")',
                data: number
            }],
            xaxis: {
                categories: date
            },
            fill:{
                colors:'#00b5b8'
            }
        }
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush
