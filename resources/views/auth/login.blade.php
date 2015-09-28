
<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Green Tracker | Login</title>
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
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>

<div class="register-cotainer full-height">
    <div class="container-xs-height full-height">
        <div class="row-xs-height">
            <div class="col-xs-height col-middle pad-15">
                <div class="col-sm-4 col-center">
                    <img src="/images/logo-brandmark.png" alt="logo" class="mg-b-20" />
                    <img src="/images/logo-wordmark.png" alt="logo" class="mg-b-20" />
                    <p>Sign-in to access your account</p>

                    <form method="POST" action="/auth/login">
                        <fieldset>
                            {!! csrf_field() !!}

                            <div class="row">
                                <div class="col-sm-12 no-padding">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul style="list-style-type: none; padding-left: 5px;">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group form-group-default">
                                <label>Email</label>
                                <div class="controls">
                                    <input placeholder="Email" class="form-control" type="email" id="email" name="email" value="{{ old('email') }}"  aria-required="true">
                                </div>
                            </div>

                            <div class="form-group form-group-default">
                                <label>Password</label>
                                <div class="controls">
                                    <input placeholder="Password" type="password" class="form-control" id="password" name="password" aria-required="true">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 no-padding">
                                    <div class="checkbox checkbox-primary">
                                        <input type="checkbox" name="remember" id="checkbox1">
                                        <label for="checkbox1">Keep Me Signed in</label>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-cons mg-t-10" type="submit">Sign in</button>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<script src="/js/vendor/modernizr.min.js"></script>
<script src="/js/vendor/pace.min.js"></script>
<script src="/js/vendor/bootstrap.min.js"></script>
<script src="/js/plugins.js"></script>

</body>
</html>
