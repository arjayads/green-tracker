var saleApp = angular.module('sale', ['config']);

saleApp.controller('listCtrl', ['$scope', '$http',
    function($scope, $http) {
        $scope.sales = [];

        $http.get('/sales/list').success(function(data) {
            $scope.sales = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });
    }
]);