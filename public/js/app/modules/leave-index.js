var leaveIndexApp = angular.module('leaveIndex', ['config', 'ngTouch']);

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

    getLeaves();
}]);