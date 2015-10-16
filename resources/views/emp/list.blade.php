@extends('layouts.master')

@section('title', 'Employees')

@section('css')
    <link href="{{asset('css/ui-grid/ui-grid.min.css')}}" rel="stylesheet" type="text/css">

    <style>
        .list {
            width: 100%;
            height: 530px;
        }
    </style>
@stop

@section('content')

<div  ng-app="user">
    <div ng-controller="listCtrl">
        <div id="primary" class="content-area mg-t-10 mg-b-10">
            <main id="main" class="site-main" role="main">
                <div class="container">
                    <h2>Employee list</h2>
                    <div class="row">
                        <div class="col-md-10 col-lg-10">
                            <div class="input-group" style="width: 300px">
                                <input class="form-control" placeholder="Filter" ng-model="query" />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2" style="text-align: right !important;">
                            <a class="btn btn-primary" href="/emp/create">Create</a>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div ui-grid="gridOptions1" ui-grid-pagination class="list"></div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

@stop
@section('javascript')
    <script src="{{asset('js/ui-grid/ui-grid.min.js')}}"></script>
    <script src="{{asset('js/app/modules/emp-list.js')}}"></script>
@stop