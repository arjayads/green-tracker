@extends('layouts.normal')

@section('title', 'Detail')

@section('content')
    <div ng-app="sale">
        <div ng-controller="processCtrl">
            <input type="hidden" ng-cloak ng-model="patientId" ng-init="employeeId = 0">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <h2>Employee Detail</h2>
                    </div>
                </main>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script src="{{asset('js/app/modules/sale-process.js')}}"></script>
@stop
