@extends('layouts.master')

@section('title', 'Create sale')

@section('css')
    <link href="{{asset('css/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/datapicker/angular-datapicker.css')}}" rel="stylesheet">
@stop

@section('content')

@include ('includes.menu')
    <div  ng-app="sale">
        <div ng-controller="createCtrl">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <div class="col-md-9">
                            <div class="panel pd-20">
                                <h2><% title %></h2>

                                <form ng-submit="processForm()" ng-show="showForm">
                                    <hr/>
                                    

                                    <div class="col-md-12">
                                        <div class="stepwizard mg-b-40">
                                           <div class="stepwizard-row setup-panel">
                                              <div class="stepwizard-step">
                                                 <a href="#step-1" type="button" class="btn btn-circle btn-default btn-active">1</a>
                                                 <p>Product Information</p>
                                              </div>
                                              <div class="stepwizard-step">
                                                 <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                                 <p>Customer Information</p>
                                              </div>
                                              <div class="stepwizard-step">
                                                 <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                                 <p>Confirmation</p>
                                              </div>
                                           </div>
                                        </div>
                                    </div>

                                    <div class="setup-content" id="step-1">
                                       <h4 class="text-gray">Product information</h4>

                                        <div class="col-md-6 col-lg-6">
                                            
                                            <label class="input-label text-gray" for="date-sold">Date sold</label>
                                            <div class="input-group w100 mg-y-5">
                                                <input required="" ng-changed="test" ng-model="sale.date_sold" class="datepicker w100" type="text" class="input-sm form-control" id="date-sold">
                                            </div>

                                            <!-- Error Message -->
                                            <form-error err_field="errors.date_sold"></form-error>

                                            <label class="input-label text-gray" for="campaign">Campaign</label>
                                            <div class="input-group w100 mg-y-5">
                                                <select required="" ng-change="setSelectedCampaign(selectedCampaign)" class="form-control" id="campaign" ng-model="selectedCampaign"
                                                        ng-options="campaign.name for campaign in campaigns track by campaign.id">
                                                    <option value="">Select campaign</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <label class="input-label text-gray" for="order-number">Order number</label>
                                            <div class="input-group w100 mg-y-5">
                                                <input required="" placeholder="Enter order number" ng-model="sale.order_number" class="form-control" id="order-number" type="text"/>
                                            </div>

                                            <!-- Error Message -->
                                            <form-error err_field="errors.order_number"></form-error>

                                            <label class="input-label text-gray" for="product">Product</label>
                                            <div class="input-group w100 mg-y-5">
                                                <select required="" class="form-control" id="product" ng-model="selectedProduct"
                                                        ng-options="product.name for product in products track by product.id">
                                                    <option value="">Select product</option>
                                                </select>

                                            <form-error err_field="errors.product_id"></form-error>
                                            </div>

                                        <button type="button" class="btn nextBtn btn-next pull-right bg-success mg-y-10">Next</button>
                                        </div>
                                    </div> <!-- end of step 1 -->
                                    
                                     <div class="setup-content" id="step-2">
                                       <h4 class="mg-y-20 text-gray">Customer information</h4>

                                       <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <label class="input-label text-gray" for="first-name">First name</label>
                                                <div class="input-group w100">
                                                    <input  required="" placeholder="Enter first name"  ng-model="sale.customer.first_name" class="form-control" id="first-name" type="text" />
                                                </div>
                                                
                                                <!-- Error Message -->
                                                <form-error err_field="errors['customer.first_name']"></form-error>

                                                <label class="input-label text-gray" for="last-name">Last name</label>

                                                <div class="input-group w100">
                                                    <input required="" placeholder="Enter last name"  ng-model="sale.customer.last_name" class="form-control" id="last-name" type="text" />
                                                </div>
                                                
                                                <!-- Error Message -->
                                                <form-error err_field="errors['customer.last_name']"></form-error>
                                            </div>

                                             <div class="col-md-6 col-lg-6">
                                                <label class="input-label text-gray" for="phone-number">Phone number</label>
                                                <div class="input-group w100">
                                                    <input required="" placeholder="Enter phone number" ng-model="sale.customer.phone_number" class="form-control" id="phone-number" type="text" />
                                                </div>
                                                
                                                <!-- Error Message -->
                                                <form-error err_field="errors['customer.phone_number']"></form-error>
                                            </div>
                                        </div>

                                         <button type="button" class="btn prevBtn blue-gradient pull-left bg-success mg-y-10">Previous</button>
                                        <button type="button" class="btn nextBtn blue-gradient pull-right bg-success mg-y-10">Next</button>
                                    </div><!-- end of step 2 -->

                                    <div class="setup-content" id="step-3">
                                       <h4 class="text-gray pull-left">Remarks</h4>
                                       <div class="checkbox checkbox-primary pull-right">
                                            <input ng-model="sale.ninety_days" type="checkbox" name="remember" id="ninety-days">
                                            <label for="ninety-days" class="fs-15 bold text-gray">Ninety Days</label>
                                        </div>

                                        <!-- <div class="checkbox checkbox-primary">
                                            <label style="cursor: pointer" class="pull-right" for="checkbox1"> Ninety Days </label>
                                                <input ng-model="sale.ninety_days" type="checkbox" name="remember" id="ninety-days" id="checkbox1"> 
                                        </div> -->

                                            <div class="col-md-12 col-lg-12 pd-t-20">
                                                <textarea placeholder="Enter remarks" ng-model="sale.remarks" class="form-control" id="remarks"></textarea>
                                            </div>

                                    <div style="margin-top: 10px;"></div>

                                    <div class="clearfix"></div>
                                    <button type="button" class="btn prevBtn blue-gradient pull-left bg-success mg-t-30">Previous</button>

                                    <button type="button" ng-click="resetForm()" class="btn btn-default pull-right mg-t-30"><span class="glyphicon glyphicon-refresh"></span> Reset</button>


                                    <button ng-mousedown="submit = true" type="submit"class="btn btn-success pull-right mg-t-30 mg-r-10"><span class="glyphicon glyphicon-floppy-disk"></span> <% save %></button>


                                    </div><!-- end of step 3  -->
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>

                        <div  ng-controller="chartsCtrl" class="col-md-3 mg-b-10">
                            <div class="panel mg-b-10 bg-danger">
                                <div class="panel-heading">
                                    <div class="panel-title text-white">Sales</div>
                                </div>
                                <div class="panel-body">
                                    <div style="text-align: center; font-size: 65px;">0</div>
                                </div>
                                <div class="panel-footer bg-transparent bd-none">
                                    <ul class="list-inline mg-b-0">
                                        <li class="block clearfix"><span>Total sales to date</span>
                                            <span class="pull-right">Separation Pay</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ .panel -->

                            <div class="panel mg-b-10 bg-info">
                                <div class="panel-heading">
                                    <div class="panel-title text-white">Sales Weekly Chart</div>
                                </div>
                                <div class="panel-body"> 
                                    <div id="weekly-chart"></div>
                                </div>
                            </div>
                            <!--/ .panel -->

                            <div class="panel mg-b-10 bg-success">
                                <div class="panel-heading">
                                    <div class="panel-title text-white">Top Sellers</div>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-unstyled mg-b-0">
                                        <li class="block mg-b-10 pd-b-10"><span class="inline text-white font-heading">Agent</span> <span class="pull-right text-white font-heading">Rank</span></li>

                                        <li ng-repeat="seller in topSellers"
                                            class="block mg-b-10 pd-b-10 bd-b bd-transparent-white"><a href=""><img width="32" height="32" src="/profile/photo?id=<%seller.user_id%>"
                                                                                                                    class="inline img-circle mg-r-5"> <span class="inline text-white"><%seller.first_name%> <%seller.last_name%></span> <span class="pull-right text-white"><%seller.rank%></span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ .panel -->

                            <div class="panel mg-b-10 bg-warning">
                                <div class="panel-heading">
                                    <div class="panel-title text-white">In Your Team</div>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-inline" ng-hide="myTeam.length == 0">
                                        <li ng-repeat="player in myTeam" class="mg-b-10"><a href=""><img alt="" title="<%player.email%>" src="/profile/photo?id=<%player.id%>" class="avatar" width="48" height="48"></a></li>
                                    </ul>
                                    <span ng-hide="myTeam.length > 0">You are not in a team!</span>
                                </div>
                            </div>
                            <!--/ .panel -->
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@stop


@section('javascript')
    <script src="{{asset('js/datepicker/datepicker.js')}}"></script>
    <script src="{{asset('js/app/directives/form-error.js')}}"></script>
    <script src="{{asset('js/app/modules/sale-create.js')}}"></script>

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