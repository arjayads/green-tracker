@extends('layouts.master')

@section('title', 'Sales')

@section('css')
    <link href="{{asset('css/ui-grid/ui-grid.min.css')}}" rel="stylesheet" type="text/css">

    <style>
        .list {
            width: 100%;
            height: 530px;
        }

        #sav i.fa-2x {
            font-size: 1.9em !important;
        }
    </style>
@stop
@section('content')


    <div  ng-app="sale">
        <div ng-controller="listCtrl">
            @include ('includes.menu')
            <input type="hidden" ng-model="campaign" ng-init="campaign = {{ session('campaign') ? session('campaign') : '0'}} ">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container mg-t-20">
                        <div class="panel pd-20">
                        <h3>Sales list</h3>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-1 col-lg-1">
                                    <label class="input-label" for="campaign">Campaign</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group w50">
                                        <select ng-change="setSelectedCampaign()" class="form-control" id="campaign" ng-model="selectedCampaign"
                                                ng-options="campaign.name for campaign in campaigns track by campaign.id">
                                            <option value="">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6" style="padding-top: 10px">
                                    <div class="pull-right dropdown">

                                             <div class="col-md-5 col-lg-5">
                                                <label class="input-label" for="status">Status</label>
                                            </div>

                                            <div class="col-md-7 col-lg-7" style="padding: 0 0">
                                                <select ng-change="setSelectedStatus()" class="form-control" id="status" ng-model="selectedStatus"
                                                    ng-options="status.stat for status in statuses track by status.id">
                                                </select>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div ui-grid="gridOptions1" ui-grid-pagination ui-grid-resize-columns class="list"></div>
                            </div>
                        </div>
                    </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@stop


@section('javascript')
    <script src="{{asset('js/app/modules/sale-list.js')}}"></script>
    <script src="{{asset('js/ui-grid/ui-grid.min.js')}}"></script>

    <script>
        $( document ).ready(function() {
            $('.ui-grid-icon-angle-down').remove();
        });
    </script>
@stop