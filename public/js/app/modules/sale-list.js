var saleApp = angular.module('sale', ['config']);

saleApp.controller('listCtrl', ['$scope', '$http',
    function($scope, $http) {
        $scope.sales = [];

        $http.get('/campaign/list').success(function(data) {
            $scope.campaigns = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });

        var getSaleList = function() {
            var url = '/sales/list';
            if ($scope.selectedCampaign !== undefined) {
                url += '?campId=' + $scope.selectedCampaign.id;
            }

            $http.get(url).success(function(data) {
                $scope.sales = data;
            }).error(function() {
                toastr.error('Something went wrong!');
            });
        }

        $scope.$watch('selectedCampaign', function(newValue, oldValue) {
            $scope.selectedCampaign = newValue;
            getSaleList();
        });
    }
]);