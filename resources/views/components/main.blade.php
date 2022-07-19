<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Web-Based Payroll System for Independent Telemarketing Services">
        <meta name="author" content="PUP Bansud Branch Batch 2022">
        <meta name="robots" content="noindex, nofollow">
        <title>{{ $title ?? env('APP_NAME') }}</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">

        <!-- Chart CSS -->
        <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="{{ asset('js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->
    </head>
    <body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        @include('partials._header')
        <!-- /Header -->

        <!-- Sidebar -->
        @include('partials._sidebar')
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <!-- Page Content -->
            <div class="content container-fluid">
                {{ $slot }}
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    <script src="{{ $js ?? '' }}"></script>
    </body>
</html>
