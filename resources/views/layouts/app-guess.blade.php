<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">  
        <title> ICT Online Enrollment System </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="{{ asset('modular/css/vendor.css') }}">
        <link rel="stylesheet" href="{{ asset('modular/css/app-green.css') }}">
        <style> 
            ::selection {
              background: #00ff00; /* WebKit/Blink Browsers */
            }
            ::-moz-selection {
              background: #00ff00; /* Gecko Browsers */
            }
        </style>
    </head>
    <body>
        @yield('content')
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