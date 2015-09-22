@extends('layouts.normal')

@section('title', 'Sales')

@section('content')

<div  ng-app="user">
    <div ng-controller="listCtrl">
        <div id="primary" class="content-area mg-t-10 mg-b-10">
            <main id="main" class="site-main" role="main">
                <div class="container">
                    <h2>User list</h2>
                    <div class="row">
                        <div class="col-md-10 col-lg-10">
                            <div class="input-group" style="width: 300px">
                                <input class="form-control" placeholder="Filter" ng-model="query" />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2" style="text-align: right !important;">
                            <a class="btn btn-primary" href="#">Create</a>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>Shift</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="user in s = (users | filter:query)">
                                    <td><% user.id_number %></td>
                                    <td><% user.email %></td>
                                    <td><% user.last_name %>, <% user.first_name %> <% user.middle_name %></td>
                                    <td><% user.sex %></td>
                                    <td><% user.shift %></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

@stop
@section('javascript')
    <script src="{{asset('js/app/modules/user-list.js')}}"></script>
@stop