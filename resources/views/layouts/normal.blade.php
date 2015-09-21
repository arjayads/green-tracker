<!-- resources/views/layouts/normal.blade.php -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Green Tracker - @yield('title')</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta content="" name="description"/>
        <meta content="" name="author"/>

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="images/ico/60.png">
        <link rel="apple-touch-icon" sizes="76x76" href="images/ico/76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="images/ico/120.png">
        <link rel="apple-touch-icon" sizes="152x152" href="images/ico/152.png">
        <link rel="icon" type="image/x-icon" href="images/ico/favicon.png"/>

        <!-- Google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

        <!-- Assets -->
        <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-awesome/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/toastr/toastr.min.css')}}">

        @yield('css')
        <script src="{{asset('js/angular/angular.min.js')}}"></script>
    </head>
<body>
@yield('content')

<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
<script src="{{asset('js/vendor/modernizr.min.js')}}"></script>
<script src="{{asset('js/vendor/pace.min.js')}}"></script>
<script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>


<script src="{{asset('js/vendor/jquery-ui-1.10.4.min.js')}}"></script>
<script src="{{asset('js/angular/ui-bootstrap-0.11.0.min.js')}}"></script>
<script src="{{asset('js/angular/angular-touch.min.js')}}"></script>
<script src="{{asset('js/angular/angular-animate.min.js')}}"></script>

<script src="{{asset('js/toastr/toastr.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

@yield('javascript')

</body>
</html>

