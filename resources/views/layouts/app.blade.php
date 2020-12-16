<!DOCTYPE html>
<!--
Author: Hassan
Website: https://www.7assan.dev/
Contact: h-@outlook.in
twitter: www.twitter.com/7assanDev
instagram: www.instagram.com/7assanDev
-->
<html class="loading" lang="ar" data-textdirection="rtl">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors-rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.css') }}">
    @stack('VendorCSS')
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/components.min.css') }}">
    @stack('ThemeCSS')
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/toastr.css') }}">
    @stack('PageCSS')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-rtl.css') }}">
    @stack('CustomCSS')
    <!-- END: Custom CSS-->
  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body @stack('attr-body')>

    @yield('content')

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @stack('PageVendorJS')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    @stack('ThemeJS')
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <script>
        @if(session()->has('success'))
            toastr.success("{{ session()->get('success') }}", '@lang('lang.success')', {positionClass: 'toast-top-left', containerId: 'toast-top-left' });
        @endif
        @if(session()->has('error'))
            toastr.error("{{ session()->get('error') }}", '@lang('lang.error')', {positionClass: 'toast-top-left', containerId: 'toast-top-left' });
        @endif
    </script>
    @stack('PageJS')
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->
</html>
