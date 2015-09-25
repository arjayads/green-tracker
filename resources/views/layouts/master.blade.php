<!-- resources/views/layouts/master.blade.php -->

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
        <link rel="apple-touch-icon" href="/images/ico/60.png">
        <link rel="apple-touch-icon" sizes="76x76" href="images/ico/76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="images/ico/120.png">
        <link rel="apple-touch-icon" sizes="152x152" href="images/ico/152.png">
        <link rel="icon" type="image/x-icon" href="/images/ico/favicon.png"/>

        <!-- Google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

        <!-- Assets -->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

        <link href="css/toastr/toastr.min.css" rel="stylesheet" type="text/css">
        <link href="css/datapicker/datepicker3.css" rel="stylesheet">
        <link href="css/datapicker/angular-datapicker.css" rel="stylesheet">

        @yield('css')
        <script type="text/javascript" src="/js/angular/angular.min.js"></script>
    </head>
<body>
@include('includes.nav')
@yield('content')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
<script src="js/vendor/modernizr.min.js"></script>
<script src="js/vendor/pace.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>

<script src="/js/vendor/jquery-ui-1.10.4.min.js"></script>
<script src="/js/angular/ui-bootstrap-0.11.0.min.js"></script>
<script src="/js/angular/angular-touch.min.js"></script>
<script src="/js/angular/angular-animate.min.js"></script>

<script src="/js/datepicker/datepicker.js"></script>
<script src="/js/toastr/toastr.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>

@yield('javascript')

</body>
</html>

