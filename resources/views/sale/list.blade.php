@extends('layouts.master')

@section('title', 'Sales')

@section('css')
    <style>
        table#list td {
            padding: 9px 5px !important;
        }
        .fa-2x {
            font-size: 1.6em !important;
        }
    </style>
@stop

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
                                <div class="col-md-1 col-lg-6" style="padding-top: 10px">
                                    <div class="pull-right">
                                        <label>
                                            <input selected="" type="radio" ng-model="saleFlag.flag" value="-1">
                                            All
                                        </label>
                                        <label>
                                            <input type="radio" ng-model="saleFlag.flag" value="1">
                                            Verified
                                        </label>
                                        <label>
                                            <input type="radio" ng-model="saleFlag.flag" value="0">
                                            Unverified
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <table id="list" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Order number</th>
                                        <th>Campaign</th>
                                        <th>Product</th>
                                        <th>Date sold</th>
                                        <th>Remarks</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Agent</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr  ng-repeat="sale in s = (sales | filter:query) track by $index" style="cursor: pointer;">
                                        <td><a href="/sales/<% sale.id %>/detail?c=<% selectedCampaign.id %>"><% sale.order_number %></a></td>
                                        <td><% sale.campaign_name %></td>
                                        <td><% sale.product_name %></td>
                                        <td><% sale.date_sold | date:'MMM dd, yyyy' %></td>
                                        <td><% sale.remarks%></td>
                                        <td><% sale.customer.first_name %> <% sale.customer.last_name %></td>
                                        <td><% sale.customer.phone_number %></td>
                                        <td><% sale.processed_by %></td>
                                        <td><% sale.status %></td>
                                        <td><i ng-class="{'fa-check-circle':sale.verified == '0'}" title="Set as verified" ng-click="setVerified($index, sale.id)"  class="fa-2x fa"></i></td>
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