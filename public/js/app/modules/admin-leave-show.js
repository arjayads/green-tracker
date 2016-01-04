var leaveShowApp = angular.module('leaveShow', ['config']);

leaveShowApp.controller('showCtrl', ['$scope', '$http', '$filter', function ($scope, $http, $filter) {
    $scope.title = 'Leave Application Details';
    $scope.cancelled = false;

    //$scope.cancel = function() {
    //    if ($scope.leaveId !== undefined && parseInt($scope.leaveId) > 0){
    //        $http.post('/my/leave/' + $scope.leaveId + "/cancel").success(function(d){
    //            if (d.success) {
    //                toastr.success(d.message);
    //                $scope.cancelled = true; // hide cancel button
    //                setTimeout(function() {
    //                    window.location = "/my/leave";
    //                }, 3000);
    //            } else {
    //                toastr.error(d.message);
    //            }
    //        }).error(function(data, a) {
    //            toastr.error('Something went wrong!');
    //        });
    //    }
    //}
}]);