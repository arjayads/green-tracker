<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div style="text-align: center">
    <div class="col-md-offset-4 col-md-3">
        <h3 class="text-primary text-center">Green Tracker</h3>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul style="list-style-type: none; padding-left: 5px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/auth/login">
            <fieldset>
                {!! csrf_field() !!}

                <div class="row">
                    <div class="col-md-12">
                        <input placeholder="Email" class="form-control" type="email" id="email" name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="hoz-space"></div>
                <div class="row">
                    <div class="col-md-12">
                        <input placeholder="Password" type="password" class="form-control" id="password" name="password">
                    </div>
                </div>

                <div class="hoz-space"></div>
                <div class="row">
                    <div class="col-md-12">
                        <label><input type="checkbox" name="remember"> Remember Me</label>
                    </div>
                </div>

                <div class="hoz-space"></div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<script type="text/javascript" src="/js/vendor/jquery.min.js"></script>
<script type="text/javascript" src="/js/vendor/bootstrap.min.js"></script>

</body>
</html>

