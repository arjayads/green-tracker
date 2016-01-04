@extends('layouts.master')

@section('title', 'Leave details')

@section('content')
    <div  ng-app="leaveShow">
        <div ng-controller="showCtrl">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <h2  ng-cloak=""><% title %></h2>
                        <a href="/my/leave" class="btn btn-primary">Back</a>
                        @if($leave->status == 'Pending')

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-9 col-lg-9">
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <button ng-show="!approved" ng-init="leaveId = {{$leave->id}}" ng-click="process('Approved')" class="btn btn-success-outline">Approve</button>
                                        <button ng-show="!disapproved" ng-init="leaveId = {{$leave->id}}" ng-click="process('Disapproved')" class="btn btn-danger-outline">Disapprove</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <p class="badge" style="padding: 10px;">{{$leave->status}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label bold">Date Filed</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <p class="form-control">{{date("F d, Y", strtotime($leave->date_filed))}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label bold">Reason</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <p class="form-control">{{$leave->leave_type}}</p>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;"></div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label bold">Purpose</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <p class="form-control">{{$leave->purpose}}</p>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;"></div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label bold">No of Days</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <p class="form-control">{{$leave->no_of_days}}</p>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;"></div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-2 col-lg-2">
                                    <label class="input-label bold">Inclusive Dates</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                <ul style="list-style: none;" class="form-control">
                                    @foreach($leave->dates as $d)
                                        @if($d->date_from == $d->date_to)
                                            <li>{{date("F d, Y", strtotime($d->date_from))}}</li>
                                        @else
                                            <li>{{date("F d, Y", strtotime($d->date_from))}} - {{date("F d, Y", strtotime($d->date_to))}}</li>
                                        @endif
                                    @endforeach
                                </ul>
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
    <script src="{{asset('js/app/modules/admin-leave-show.js')}}"></script>
@stop