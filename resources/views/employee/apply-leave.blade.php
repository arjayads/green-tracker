@extends('layouts.master')

@section('title', 'Leave application')

@section('css')
    <link href="{{asset('css/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/datapicker/angular-datapicker.css')}}" rel="stylesheet">
@stop

@section('content')
    <div  ng-app="leaveApplication">
        <div ng-controller="mainCtrl">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <h2><% title %></h2>
                        <a href="/my/leave" class="btn btn-primary">Back</a>
                        <form ng-submit="processForm()" ng-show="showForm">
                            <hr/>


                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="reason">Reason</label>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-filter"></i></span>
                                            <select required="" ng-change="setSelectedReason(selectedReason)" class="form-control" id="reason" ng-model="selectedReason"
                                                    ng-options="leaveType.description for leaveType in leaveTypes track by leaveType.id">
                                                <option value="">Select Reason</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <form-error err_field="errors.reason"></form-error>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>


                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="purpose">Purpose</label>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <textarea required="" rows="5" placeholder="Enter purpose" ng-model="leave.purpose" class="form-control" id="purpose"></textarea>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <form-error err_field="errors.purpose"></form-error>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="no_of_days">Number of Days</label>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            <input min="1" step="1" required="" placeholder="Enter number of days" ng-model="leave.no_of_days" class="form-control" id="no_of_days" type="number"/>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <form-error err_field="errors.no_of_days"></form-error>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <input placeholder="mm/dd/yyyy" type="text" id="date" class="datepicker form-control">
                                            <span style="cursor: pointer" ng-click="addDate()" title="Select date and click to add date" class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="date">Dates</label>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <p ng-hide="dates.length > 0">Add leave dates</p>
                                        <table class="table table-bordered table-hover">
                                            <tbody>
                                                <tr ng-repeat="d in dates">
                                                    <td style="padding: 10px;"><%d%> <i style="cursor: pointer" ng-click="removeDate($index)" title="Click to remove date" class="glyphicon glyphicon-minus-sign pull-right"></i></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <form-error err_field="errors.date"></form-error>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <fieldset ng-disabled="submitting">
                                            <button ng-mousedown="submit = true" type="submit"
                                                    class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> <% save %></button>
                                            <button type="button" ng-click="resetForm()" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
@stop


@section('javascript')
    <script src="{{asset('js/datepicker/datepicker.js')}}"></script>
    <script src="{{asset('js/app/directives/form-error.js')}}"></script>
    <script src="{{asset('js/app/modules/leave-apply.js')}}"></script>

    <script>
        $(function () {
            $('.datepicker').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "mm/dd/yyyy"
            });
        })
    </script>
@stop