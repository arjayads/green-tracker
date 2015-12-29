var leaveIndexApp = angular.module('leaveIndex', ['config', 'ngTouch', 'ui.grid', 'ui.grid.pagination', 'ui.grid.resizeColumns']);

leaveIndexApp.controller('mainCtrl', ['$scope', '$http', '$filter', '$sce', function ($scope, $http, $filter, $sce) {
    $scope.title = 'Your leave is like a sun!';
    $scope.status = 'Pending';
    $scope.leaves = [];
    $scope.stats = [
        {id:1, status: 'Pending'},
        {id:2, status: 'Approved'},
        {id:3, status: 'Disapproved'}
    ];

    var getLeaves = function() {
        $http.get('/my/leaves/' + $scope.status).success(function(data){
            $scope.leaves = data;
            $scope.gridOptions1.data = data;
        });
    }

    $scope.parseDates = function(dates) {
        var ds = dates.split(",");
        if (ds.length > 0) {
            var str = '';
            for(var i = 0; i < ds.length; i++) {
                var date = ds[i];
                str += '<span class="label label-info">' + $filter('date')(date, 'MMM d, yyyy') + '</span> ';
            }
            return $sce.trustAsHtml(str);
        }
    }

    $scope.setSelectedStatus = function(status) {
        $scope.status = status === undefined ? 'Pending' : status.status;
        getLeaves();
    }

    $scope.gridOptions1 = {
        paginationPageSizes: [15, 30, 45],
        paginationPageSize: 15,
        useExternalPagination: true,
        enableSorting: true,
        //columnDefs: [
        //    {
        //        field: 'order_number',
        //        displayName: 'Order No',
        //        width: '9%',
        //        enableHiding: false,
        //        cellTemplate: '<div class="ui-grid-cell-contents"><a href="{{grid.appScope.buildCellUrl(row.entity.id)}}">{{row.entity.order_number}}</a></div>'
        //
        //    },
        //    {field: 'campaign_name', displayName: 'Campaign', enableHiding: false},
        //    {field: 'product_name', displayName: 'Product', enableHiding: false},
        //    {
        //        field: 'date_sold',
        //        type: 'date',
        //        cellFilter: 'date:\'MMM dd, yyyy\'',
        //        enableHiding: false
        //    },
        //    {
        //        field: 'customer.first_name',
        //        displayName: 'Customer',
        //        cellTemplate: '<div class="ui-grid-cell-contents">{{row.entity.customer.first_name + " " + row.entity.customer.last_name}}</div>',
        //        enableHiding: false
        //
        //    },
        //    {field: 'customer.phone_number', displayName: 'Phone No', enableHiding: false},
        //    {field: 'processed_by', displayName: 'Agent' , enableHiding: false},
        //    {
        //        field: 'verified',
        //        displayName: '',
        //        enableSorting: false,
        //        enableHiding: false,
        //        width: '2%',
        //        cellTemplate: '<div id="sav" class="ui-grid-cell-contents"><i ng-click="grid.appScope.setVerified(row.entity)" title="Set as verified" class="cursor fa-2x fa {{row.entity.verified == \'0\' ? \'fa-check-circle \':\'\'}} "></i></div>'
        //    },
        //],
        onRegisterApi: function(gridApi) {
            $scope.gridApi = gridApi;
            //$scope.gridApi.core.on.sortChanged($scope, function(grid, sortColumns) {
            //    if (sortColumns.length == 0) {
            //        paginationOptions.sort = 'asc';
            //        paginationOptions.sortCol = 'order_number';
            //    } else {
            //        paginationOptions.sort = sortColumns[0].sort.direction;
            //        paginationOptions.sortCol = sortColumns[0].field;
            //    }
            //    getSaleList();
            //});
            //gridApi.pagination.on.paginationChanged($scope, function (newPage, pageSize) {
            //    paginationOptions.pageNumber = newPage;
            //    paginationOptions.pageSize = pageSize;
            //    getSaleList();
            //});
        }
    }

    getLeaves();
}]);