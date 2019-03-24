<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Welcome - ICT Online Enrollment System </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="{{ asset('modular/css/vendor.css') }}">
        <link rel="stylesheet" href="{{ asset('modular/css/app-blue.css') }}">
    </head>
    <body>
        <div class="app blank sidebar-opened">
            <article class="content">
                <div class="error-card global">
                    <div class="error-title-block">
                        <h1 class="error-title"> <img src="{{ asset('uploads/imgs/logo.png') }}" height="110px" width="auto" style="margin-top: -22px; margin-right: -20px"> ICT </h1>
                        <h2 class="error-sub-title"> Online Registration System </h2>
                    </div>
                    <div class="error-container">
                        {{-- <a href="{{ route('student.registration') }}" class="btn btn-primary">
                            <i class="fa fa-user-plus"></i> Signup </a>
                        </a>
 --}}                        <a class="btn btn-primary" href="{{ route('student.login') }}">
                            <i class="fa fa-user"></i> Login </a>
                    </div>
                </div>
            </article>
        </div>
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="{{ asset('modular/js/vendor.js') }}"></script>
        <script src="{{ asset('modular/js/app.js') }}"></script>
    </body>
</html>