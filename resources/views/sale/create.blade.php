@extends('layouts.normal')

@section('title', 'Create sale')

@section('css')
    <link href="{{asset('css/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/datapicker/angular-datapicker.css')}}" rel="stylesheet">
@stop

@section('content')
    <div  ng-app="sale">
        <div ng-controller="createCtrl">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <h2><% title %></h2>
                        <form ng-submit="processForm()" ng-show="showForm">
                            <hr/>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="date-sold">Date sold</label>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-filter"></i></span>
                                            <input required="" ng-changed="test" ng-model="sale.date_sold" class="datepicker" type="text" class="input-sm form-control" id="date-sold">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <form-error err_field="errors.date_sold"></form-error>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top: 10px;"></div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="order-number">Order number</label>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            <input required="" placeholder="Enter order number" ng-model="sale.order_number" class="form-control" id="order-number" type="text"/>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <form-error err_field="errors.order_number"></form-error>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="campaign">Campaign</label>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-filter"></i></span>
                                            <select required="" ng-change="setSelectedCampaign(selectedCampaign)" class="form-control" id="campaign" ng-model="selectedCampaign"
                                                    ng-options="campaign.name for campaign in campaigns track by campaign.id">
                                                <option value="">Select campaign</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="product">Product</label>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-filter"></i></span>
                                            <select required="" class="form-control" id="product" ng-model="selectedProduct"
                                                    ng-options="product.name for product in products track by product.id">
                                                <option value="">Select product</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <form-error err_field="errors.product_id"></form-error>
                                    </div>
                                </div>
                            </div>

                            <hr/>
                            <h4>Customer information</h4>
                            <hr/>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="first-name">First name</label>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            <input  required="" placeholder="Enter first name"  ng-model="sale.customer.first_name" class="form-control" id="first-name" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <form-error err_field="errors['customer.first_name']"></form-error>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="last-name">Last name</label>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            <input required="" placeholder="Enter last name"  ng-model="sale.customer.last_name" class="form-control" id="last-name" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <form-error err_field="errors['customer.last_name']"></form-error>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="phone-number">Phone number</label>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                            <input required="" placeholder="Enter phone number" ng-model="sale.customer.phone_number" class="form-control" id="phone-number" type="text" />
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <form-error err_field="errors['customer.phone_number']"></form-error>
                                    </div>
                                </div>
                            </div>

                            <hr/>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                    </div>
                                    <div class="col-md-5 col-lg-5 text-left">
                                        <label style="cursor: pointer"><input ng-model="sale.ninety_days" type="checkbox" id="ninety-days"> Ninety days</label>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-2 col-lg-2">
                                        <label class="input-label" for="remarks">Remarks</label>
                                    </div>
                                    <div class="col-md-5 col-lg-5">
                                        <textarea placeholder="Enter remarks" ng-model="sale.remarks" class="form-control" id="remarks"></textarea>
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
                                                    class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> <% save %></button>
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
    <script src="{{asset('js/app/modules/sale.js')}}"></script>

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