var userApp = angular.module('user', []);

userApp.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}]);

userApp.controller('listCtrl', ['$scope', '$http',
    function($scope, $http) {
        $scope.users = [];

        $http.get('/user/list').success(function(data) {
            $scope.users = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });
    }
]);