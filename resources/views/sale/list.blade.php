@extends('layouts.normal')

@section('title', 'Sales')

@section('content')
    <div  ng-app="sale">
        <div ng-controller="listCtrl">
            <div id="primary" class="content-area mg-t-10 mg-b-10">
                <main id="main" class="site-main" role="main">
                    <div class="container">
                        <h2>Sales list</h2>
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
                                        <th>Processed by</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr  ng-repeat="sale in s = (sales | filter:query) track by $index" style="cursor: pointer;">
                                        <td><a href="/sales/<% sale.id %>/detail"><% sale.order_number %></a></td>
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