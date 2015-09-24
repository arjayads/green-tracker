@extends('layouts.normal')

@section('title', 'Sales')

@section('content')
    <div  ng-app="sale">
        <div ng-controller="listCtrl">
            <input type="hidden" ng-model="campaign" ng-init="campaign = {{ session('campaign') ? session('campaign') : '0'}} ">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <h2>Sales list</h2>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="col-md-1 col-lg-1" style="padding-left: 0; padding-top: 10px">
                                    <label class="input-label" for="campaign">Campaign</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-filter"></i></span>
                                        <select required="" ng-change="setSelectedCampaign()" class="form-control" id="campaign" ng-model="selectedCampaign"
                                                ng-options="campaign.name for campaign in campaigns track by campaign.id">
                                            <option value="">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1 col-lg-1" style="padding-top: 10px">
                                    <label class="input-label pull-right" for="query">Filter</label>
                                </div>
                                <div class="col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <input id="query" class="form-control" placeholder="Order number, Product ..." ng-model="query" />
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Order number</th>
                                        <th>Campaign</th>
                                        <th>Product</th>
                                        <th>Date sold</th>
                                        <th>Is ninety days</th>
                                        <th>Remarks</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Agent</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr  ng-repeat="sale in s = (sales | filter:query) track by $index" style="cursor: pointer;">
                                        <td><a href="/sales/<% sale.id %>/detail?c=<% selectedCampaign.id %>"><% sale.order_number %></a></td>
                                        <td><% sale.campaign_name %></td>
                                        <td><% sale.product_name %></td>
                                        <td><% sale.date_sold | date:'MMM dd, yyyy' %></td>
                                        <td><% sale.ninety_days == 1 ? 'Yes' : 'No' %></td>
                                        <td><% sale.remarks%></td>
                                        <td><% sale.customer.first_name %> <% sale.customer.last_name %></td>
                                        <td><% sale.customer.phone_number %></td>
                                        <td><% sale.processed_by %></td>
                                    </tr>
                                    </tbody>
                                </table>
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
@stop