@extends('layouts.normal')

@section('title', 'Detail')

@section('content')
    <div ng-app="sale">
        <div ng-controller="processCtrl">
            <input type="hidden" ng-cloak ng-model="patientId" ng-init="employeeId = 0">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <h2>Employee detail</h2>
                            </div>
                            <div class="col-md-4">
                                <a href="/user/{{$employee->id}}/edit" class="btn btn-primary  pull-right" style="margin-top: 20px;">Edit</a>
                            </div>
                        </div>

                        <hr/>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label" for="id_number">ID Number</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-arrow-left"></i></span>
                                        <label class="input-label form-control">{{$employee->id_number}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 10px;"></div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label" for="email">Email</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <label class="input-label form-control">{{$employee->user->email}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 10px;"></div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label" for="first_name">First name</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                                        <label class="input-label form-control" >{{$employee->first_name}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;"></div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label" for="middle_name">Middle name</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                                        <label class="input-label form-control">{{$employee->middle_name}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;"></div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label" for="last_name">Last name</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                                        <label class="input-label form-control">{{$employee->last_name}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;"></div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label" for="sex">Sex</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                                        <label class="input-label form-control">{{$employee->sex}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;"></div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label" for="birthday">Birthday</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <label class="input-label form-control">{{date('F d, Y', strtotime($employee->birthday))}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;"></div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label" for="shift">Shift</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                        <label class="input-label form-control">{{$employee->shift->description}}</label>
                                    </div>
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
    <script src="{{asset('js/app/modules/sale-process.js')}}"></script>
@stop
