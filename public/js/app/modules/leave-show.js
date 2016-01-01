var leaveShowApp = angular.module('leaveShow', ['config']);

leaveShowApp.controller('showCtrl', ['$scope', '$http', '$filter', function ($scope, $http, $filter) {
    $scope.title = 'Leave Application Details';
}]);