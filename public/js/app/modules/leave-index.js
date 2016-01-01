var leaveIndexApp = angular.module('leaveIndex', ['config', 'ngTouch', 'ui.grid', 'ui.grid.pagination', 'ui.grid.resizeColumns']);

leaveIndexApp.controller('mainCtrl', ['$scope', '$http', '$filter', '$sce', function ($scope, $http, $filter, $sce) {
    $scope.title = 'Leave Monitoring';
    $scope.selectedStatus = {id:1, status: 'Pending'};
    $scope.leaves = [];
    $scope.stats = [
        $scope.selectedStatus,
        {id:2, status: 'Approved'},
        {id:3, status: 'Disapproved'}
    ];

    var getLeaves = function() {
        $http.get('/my/leaves/' + $scope.selectedStatus.status).success(function(data){
            $scope.leaves = data;
            $scope.gridOptions1.data = data;
        });
    }

    $scope.parseDates = function(dates) {

        var str = '';
        for(var i = 0; i < dates.length; i++) {
            var f = $filter('date')(dates[i].date_from, 'MMM d, yyyy');
            var t = $filter('date')(dates[i].date_to, 'MMM d, yyyy');

            var date = f; // from and to are same dates
            if (f != t) date = f + " - " + t;  // from and to are diff dates

            str += '<span class="label label-info">' + $filter('date')(date, 'MMM d, yyyy') + '</span> ';
        }
        return $sce.trustAsHtml(str);
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
        columnDefs: [
            {
                field: 'date_filed',
                type: 'date',
                cellFilter: 'date:\'MMM dd, yyyy\'',
                enableHiding: false
            },
            {field: 'leave_type', displayName: 'Leave Type', enableHiding: false},
            {field: 'purpose', displayName: 'Purpose', enableHiding: false, width: '25%'},
            {field: 'no_of_days', displayName: 'No of days', enableHiding: false, width: '9%'},

            {
                field: 'dates',
                displayName: 'Inclusive dates',
                enableHiding: false,
                width: '40%',
                cellTemplate: '<div class="ui-grid-cell-contents" ng-bind-html="grid.appScope.parseDates(row.entity.dates)"></div>'
            },
        ],
        onRegisterApi: function(gridApi) {
            $scope.gridApi = gridApi;
        }
    }

    getLeaves();
}]);