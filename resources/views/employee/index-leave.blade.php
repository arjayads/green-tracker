@extends('layouts.master')

@section('title', 'Leave')

@section('css')
    <link href="{{asset('css/ui-grid/ui-grid.min.css')}}" rel="stylesheet" type="text/css">
@stop

@section('content')
    <div  ng-app="leaveIndex">
        <div ng-controller="mainCtrl">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <h2 ng-cloak=""><% title %></h2>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <a href="/my/leaveApplication" class="btn btn-success">Apply</a>
                                </div>
                                <div class="col-md-8 col-lg-8">
                                    <label class="pull-right input-label">Filter</label>
                                </div>
                                <div class="col-md-2 col-lg-2 pull-right">
                                    <select style="padding: 0" required="" ng-change="setSelectedStatus(selectedStatus)" class="form-control" id="status" ng-model="selectedStatus"
                                            ng-options="st.status for st in stats track by st.id">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div ui-grid="gridOptions1" ui-grid-pagination ui-grid-resize-columns id="list"></div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@stop


@section('javascript')
    <script src="{{asset('js/app/modules/leave-index.js')}}"></script>
    <script src="{{asset('js/ui-grid/ui-grid.min.js')}}"></script>
    <script>
        $( document ).ready(function() {
            $('.ui-grid-icon-angle-down').remove();
        });
    </script>
@stop