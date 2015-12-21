@extends('layouts.master')

@section('title', 'Sales')

@section('content')

@include ('includes.menu')
    <div  ng-app="sale">
        <div ng-controller="listCtrl">
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
                                        <select required="" ng-change="setSelectedCampaign()" class="form-control" id="campaign" ng-model="selectedCampaign"
                                                ng-options="campaign.name for campaign in campaigns track by campaign.id">
                                            <option value="">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6" style="padding-top: 10px">
                                    <div class="pull-right dropdown">

                                             <div class="col-md-5 col-lg-5">
                                                <label class="input-label" for="campaign">Campaign</label>
                                            </div>

                                            <div class="col-md-7 col-lg-7">
                                                <select required="" ng-change="setSelectedCampaign()" class="form-control" id="campaign" ng-model="selectedCampaign"
                                                    ng-options="campaign.name for campaign in campaigns track by campaign.id">
                                                    <option value="">Status</option>
                                                </select>
                                            </div>

                                        <!-- <label>
                                            <input selected="" ng-model="saleFlag.flag" value="-1">
                                            All
                                        </label>
                                        <label>
                                            <input ng-model="saleFlag.flag" value="1">
                                            Verified
                                        </label>
                                        <label>
                                            <input ng-model="saleFlag.flag" value="0">
                                            Unverified
                                        </label> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <table id="list" class="table table-striped">
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
                    </div>
                </main>
            </div>
        </div>
    </div>
@stop


@section('javascript')
    <script src="{{asset('js/app/modules/sale-list.js')}}"></script>
@stop