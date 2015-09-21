@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div  ng-app="profile">
        <div ng-controller="mainCtrl">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <div class="row sm-gutter">
                            <div class="col-sm-12 col-md-3 col-md-push-9 mg-b-10">
                                <div class="panel panel-default mg-b-10 bg-danger">
                                    <div class="panel-heading">
                                        <div class="panel-title text-white">Sales</div>
                                    </div>
                                    <div class="panel-body">
                                        <img src="images/sales-chart.png" class="center-block">
                                    </div>
                                    <div class="panel-footer bg-transparent bd-none">
                                        <ul class="list-inline mg-b-0">
                                            <li class="block clearfix"><span>Total sales to date</span> <span class="pull-right">1,243</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--/ .panel -->

                                <div class="panel panel-default mg-b-10 bg-info">
                                    <div class="panel-heading">
                                        <div class="panel-title text-white">Sales Weekly Chart</div>
                                    </div>
                                    <div class="panel-body">
                                        <img src="images/sales-weekly-chart.png" class="center-block">
                                    </div>
                                </div>
                                <!--/ .panel -->

                                <div class="panel panel-default mg-b-10 bg-success">
                                    <div class="panel-heading">
                                        <div class="panel-title text-white">Top Sellers</div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-unstyled mg-b-0">
                                            <li class="block mg-b-10 pd-b-10"><span class="inline text-white font-heading">Agent</span> <span class="pull-right text-white font-heading">Rank</span></li>
                                            <li class="block mg-b-10 pd-b-10 bd-b bd-transparent-white"><a href=""><img src="images/avatar-2.png" class="inline img-circle mg-r-5"> <span class="inline text-white">Rommel Belicario</span> <span class="pull-right text-white">1st</span></a></li>
                                            <li class="block mg-b-10 pd-b-10 bd-b bd-transparent-white"><a href=""><img src="images/avatar-3.png" class="inline img-circle mg-r-5"> <span class="inline text-white">Arjay Adong</span> <span class="pull-right text-white">2nd</span></a></li>
                                            <li class="block mg-b-10 pd-b-10 bd-b bd-transparent-white"><a href=""><img src="images/avatar-4.png" class="inline img-circle mg-r-5"> <span class="inline text-white">Larry Parangan</span> <span class="pull-right text-white">3rd</span></a></li>
                                            <li class="block"><a href=""><img src="images/avatar-5.png" class="inline img-circle mg-r-5"> <span class="inline text-white">Gabriel Ceniza</span> <span class="pull-right text-white">4th</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--/ .panel -->

                                <div class="panel panel-default mg-b-10 bg-warning">
                                    <div class="panel-heading">
                                        <div class="panel-title text-white">In Your Team</div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-inline">
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-6.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-7.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-8.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-empty.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-empty.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-empty.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-empty.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-empty.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-empty.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-empty.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-empty.png"></a></li>
                                            <li class="mg-b-10"><a href=""><img src="images/avatar-empty.png"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--/ .panel -->
                            </div>

                            <div class="col-md-9 col-md-pull-3 mg-b-10">
                                <div class="row sm-gutter">
                                    <div class="col-sm-5 mg-b-10">

                                        <div class="panel panel-default mg-b-10">

                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <textarea cols="8" rows="5" class="form-control" style="resize: vertical;" placeholder="Write something ..."></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary pd-y-5 btn-rounded pull-right" value="Send" />
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ .panel -->

                                        <div class="panel panel-default mg-b-10">
                                            <div class="panel-heading">
                                                <div class="panel-title text-primary">Time Log</div>
                                            </div>
                                            <div class="panel-body">
                                                <ul class="list-unstyled text-primary">
                                                    <li class="mg-b-5"><i class="fa fa-phone mg-r-5"></i> <span>Calls</span> <span class="pull-right inline">300</span> </li>
                                                    <li class="mg-b-5"><i class="fa fa-clock-o mg-r-5"></i> <span>Call Time</span> <span class="pull-right inline">04:30:00</span> </li>
                                                    <li class="mg-b-5"><i class="fa fa-clock-o mg-r-5"></i> <span>Drop Calls</span> <span class="pull-right inline">00:15:00</span> </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ .panel -->

                                        <div class="panel panel-default mg-b-10">
                                            <div class="panel-heading">
                                                <div class="panel-title text-primary">Employee Record</div>
                                            </div>
                                            <div class="panel-body">
                                                <ul class="list-unstyled text-primary">
                                                    <li class="mg-b-5"><i class="fa fa-calendar-minus-o mg-r-5"></i> <span>Absents</span> <span class="pull-right inline">10</span> </li>
                                                    <li class="mg-b-5"><i class="fa fa-clock-o mg-r-5"></i> <span>Tardiness</span> <span class="pull-right inline">00:15:00</span> </li>
                                                    <li class="mg-b-5"><i class="fa fa-calendar-minus-o mg-r-5"></i> <span>Leave</span> <span class="pull-right inline">2</span> </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ .panel -->

                                        <div class="panel panel-default mg-b-10">
                                            <div class="panel-heading">
                                                <div class="panel-title text-primary">Employee Status</div>
                                            </div>
                                            <div class="panel-body">
                                                <ul class="list-unstyled text-primary">
                                                    <li class="mg-b-5"><i class="fa fa-calendar-o mg-r-5"></i> <span>Date Hired</span> <span class="pull-right inline">Aug. 20, 2015</span> </li>
                                                    <li class="mg-b-5"><i class="fa fa-info-circle mg-r-5"></i> <span>Status</span> <span class="pull-right inline">Probationary</span> </li>
                                                    <li class="mg-b-5"><i class="fa fa-calendar-plus-o mg-r-5"></i> <span>Regularization</span> <span class="pull-right inline">Feb. 20, 2015</span> </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ .panel -->

                                        <button class="btn btn-info btn-block">How can we help?</button>

                                    </div>
                                    <div class="col-sm-7 mg-b-10">

                                        <div class="panel panel-default mg-b-10">
                                            <div class="panel-heading">
                                                <div class="panel-title block">
                                                    <div class="vcard">
                                                        <a href="" class="vcard-heading">
                                                            <img src="images/avatar-1.png" class="img-circle" width="35" height="35" />
                                                        </a>
                                                        <div class="vcard-content pd-l-45">
                                                            <a href="" class="inline vcard-title text-primary">Greenwire Admin</a>
                                                            <span class="vcard-meta timestamp fs-12 font-base hint">Yesterday at 10:40 pm</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <p>Congratulations to Richard Ybias for his new business. Tangkit’s Bakeshop!</p>
                                                <img src="images/screenshot.png" class="center-block" >
                                            </div>

                                            <div class="panel-footer bg-white bd-t" style="border-color: rgba(0,0,0,0.10)">
                                                <ul class="list-inline mg-b-0">
                                                    <li><a href="" class="text-danger fs-13"><i class="fa fa-heart fa-fw"></i> 192</a></li>
                                                    <li><a href="" class="text-link fs-13"><i class="fa fa-comment fa-fw"></i> 23</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ .panel -->

                                        <div class="panel panel-default mg-b-10">
                                            <div class="panel-heading">
                                                <div class="panel-title block">
                                                    <div class="vcard">
                                                        <a href="" class="vcard-heading">
                                                            <img src="images/avatar-1.png" class="img-circle" width="35" height="35" />
                                                        </a>
                                                        <div class="vcard-content pd-l-45">
                                                            <a href="" class="inline vcard-title text-primary">Greenwire Admin</a>
                                                            <span class="vcard-meta timestamp fs-12 font-base hint">Yesterday at 10:40 pm</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <p>Today is Gabriel Ceniza’s Birthday! Lets Greet him a Happy Birthday!!! wooooooh</p>
                                            </div>

                                            <div class="panel-footer bg-white bd-t" style="border-color: rgba(0,0,0,0.10)">
                                                <ul class="list-inline mg-b-0">
                                                    <li><a href="" class="text-danger fs-13"><i class="fa fa-heart fa-fw"></i> 192</a></li>
                                                    <li><a href="" class="text-link fs-13"><i class="fa fa-comment fa-fw"></i> 23</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ .panel -->

                                        <div class="panel panel-default mg-b-10">
                                            <div class="panel-heading">
                                                <div class="panel-title block">
                                                    <div class="vcard">
                                                        <a href="" class="vcard-heading">
                                                            <img src="images/avatar-1.png" class="img-circle" width="35" height="35" />
                                                        </a>
                                                        <div class="vcard-content pd-l-45">
                                                            <a href="" class="inline vcard-title text-primary">Greenwire Admin</a>
                                                            <span class="vcard-meta timestamp fs-12 font-base hint">Yesterday at 10:40 pm</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <p>Richard Ybias, deserves to have a vacation because of his outstanding performance!</p>
                                                <img src="images/screenshot-2.png" class="center-block" />
                                            </div>

                                            <div class="panel-footer bg-white bd-t" style="border-color: rgba(0,0,0,0.10)">
                                                <ul class="list-inline mg-b-0">
                                                    <li><a href="" class="text-danger fs-13"><i class="fa fa-heart fa-fw"></i> 192</a></li>
                                                    <li><a href="" class="text-link fs-13"><i class="fa fa-comment fa-fw"></i> 23</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ .panel -->

                                    </div>
                                </div>
                                <!--/ .row -->
                            </div>

                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@stop


@section('javascript')
<script type="text/javascript" src="/js/app/modules/profile.js"></script>

@stop