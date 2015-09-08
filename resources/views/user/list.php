<div ui-view class="text-center">
    <h2>User list</h2>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="input-group" style="width: 300px">
                <input class="form-control" placeholder="Search" ng-model="query" />
                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
            </div>
        </div>
    </div>
    <div class="row">
        <a ui-sref="user.create">Create</a>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Sex</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="user in s = (users | filter:query)">
                    <td>{{user.id_number}}</td>
                    <td>{{user.first_name}}</td>
                    <td>{{user.last_name}}</td>
                    <td>{{user.sex}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>