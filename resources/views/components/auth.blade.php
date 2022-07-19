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

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body class="account-page">

<!-- Main Wrapper -->
<div class="main-wrapper">
    <div class="account-content">
        <div class="container">

            <!-- Account Logo -->
            <div class="account-logo">
                <a href="/"><img src="{{ asset('img/its-banner-logo.png') }}" alt="ITS Payroll System"></a>
            </div>
            <!-- /Account Logo -->

            {{ $slot }}

        </div>
    </div>
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('js/global.js') }}"></script>
<script src="{{ $js ?? '' }}"></script>

</body>
</html>
