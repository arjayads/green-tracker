var leaveShowApp = angular.module('leaveShow', ['config']);

leaveShowApp.controller('showCtrl', ['$scope', '$http', '$filter', function ($scope, $http, $filter) {
    $scope.title = 'Leave Application Details';
    $scope.processed = false;

    $scope.process = function(status) {
        if ($scope.leaveId !== undefined && parseInt($scope.leaveId) > 0){
            $http.post('/admin/leave/process', {id:  $scope.leaveId, status: status}).success(function(d){
                if (d.success) {
                    toastr.success(d.message);
                    $scope.processed = true; // hide cancel button
                    setTimeout(function() {
                        window.location = "/admin/leave";
                    }, 3000);
                } else {
                    toastr.error(d.message);
                }
            }).error(function(data, a) {
                toastr.error('Something went wrong!');
            });
        }
    }
}]);