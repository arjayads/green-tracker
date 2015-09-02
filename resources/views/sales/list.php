<div ui-view>
    <div class="text-center">
        <h2>Sales list</h2>
        <div class="row">
            <div class="col-md-11 col-lg-11">
                <div class="input-group" style="width: 300px">
                    <input class="form-control" placeholder="Search" ng-model="query" />
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                </div>
            </div>
            <div class="col-md-1 col-lg-1">
                <a class="btn btn-primary" ui-sref="sales.create">Create</a>
            </div>
        </div>
        <hr />
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
                    <tr  ng-repeat="sale in s = (sales | filter:query) track by $index" style="cursor: pointer; mouse">
                        <td><a ui-sref="sales.detail({id:sale.id})">{{sale.order_number}}</a></td>
                        <td>{{sale.campaign_name}}</td>
                        <td>{{sale.product_name}}</td>
                        <td>{{sale.date_sold | date:'MMM dd, yyyy'}}</td>
                        <td>{{sale.ninety_days == 1 ? 'Yes' : 'No'}}</td>
                        <td>{{sale.remarks}}</td>
                        <td>{{sale.customer.first_name}} {{sale.customer.last_name}}</td>
                        <td>{{sale.customer.phone_number}}</td>
                        <td>{{sale.processed_by}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>