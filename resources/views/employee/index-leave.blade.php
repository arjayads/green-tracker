@extends('layouts.master')

@section('title', 'Leave')

@section('content')
    <div  ng-app="leaveIndex">
        <div ng-controller="mainCtrl">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <h2><% title %></h2>
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th>Date Filed</th>
                                <th>Leave Type</th>
                                <th>Purpose</th>
                                <th>No of days</th>
                                <th>Inclusive dates</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="leave in leaves">
                                <td><%leave.date_filed | date: 'MMM d, yyyy'%></td>
                                <td><%leave.leave_type%></td>
                                <td><%leave.purpose%></td>
                                <td><%leave.no_of_days%></td>
                                <td ng-bind-html="parseDates(leave.dates)"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </div>
@stop


@section('javascript')
    <script src="{{asset('js/app/modules/leave-index.js')}}"></script>
@stop