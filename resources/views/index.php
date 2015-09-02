<!DOCTYPE html>
<html lang="en" ng-app="social">
    <head>
        <title ng-cloak>GW Social {{pageTitle ? ('| ' + pageTitle) : ''}}</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <link href="css/toastr/toastr.min.css" rel="stylesheet" type="text/css">

        <link href="css/datapicker/datepicker3.css" rel="stylesheet">
        <link href="css/datapicker/angular-datapicker.css" rel="stylesheet">
    </head>
    <body><input type="hidden" name="_token" id="csrf-token" value="<?= Session::token() ?>">

        <div class="container">
            <div class="content">
                <div class="title">Be social at Greenwire!</div>
            </div>

            <a ui-sref="main">Home</a>
            <a ui-sref="sales">Sales</a>
            <a ui-sref="user">User</a>
            <a ui-sref="myProfile">My Profile</a>
            <div ui-view>

            </div>
        </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
    <script src="js/angular/angular-ui-router.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.3/ui-bootstrap-tpls.min.js"></script>

    <script src="js/ocLazyLoad/ocLazyLoad.js"></script>
    <script src="js/toastr/toastr.min.js"></script>
    <script src="js/datepicker/datepicker.js"></script>

    <script src="js/app.js"></script>
    <script src="js/routes.js"></script>

</html>
