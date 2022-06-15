<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="..." />
    <meta name="author" content="..." />

    <title>@hasSection('title')
        @yield('title') - {{ config('app.name') }}
        @else {{ config('app.name') }} @endif</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/style.css') }}">
    {{--
    <link id="color" rel="stylesheet" href=" {{ asset('assets/css/color-1.css" media="screen') }}"> --}}
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/responsive.css') }}">
</head>
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <!-- feather icon js-->
        <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="{{ asset('assets/js/config.js') }}"></script>
        <!-- Plugins JS start-->
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <!-- login js-->
        <!-- Plugin used-->
    </div>
</body>

</html>
