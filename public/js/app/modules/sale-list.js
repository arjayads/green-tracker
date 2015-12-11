var saleApp = angular.module('sale', ['config']);

saleApp.controller('listCtrl', ['$scope', '$http',
    function($scope, $http) {
        $scope.sales = [];
        $scope.saleFlag = {};
        $scope.saleFlag['flag'] = 0;

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
            url += '?q=' + $scope.saleFlag.flag;

            $http.get(url).success(function(data) {
                $scope.sales = data;
            }).error(function() {
                toastr.error('Something went wrong!');
            });
        }

        $scope.$watch('campaign', function(newValue, oldValue) {
            if (newValue !== undefined && parseInt(newValue) > 0) {
                $scope.selectedCampaign = {'id': newValue};
            }
            getSaleList();
        });

        $scope.setSelectedCampaign = function() {
            if ($scope.selectedCampaign === undefined) {
                $scope.campaign = undefined;
            }
            getSaleList();

        }

        $scope.setVerified = function(index, saleId) {
            $http.post('/sales/' + saleId + '/setVerified', {}).success(function(data) {
                if (data.success) {
                    toastr.success(data.message);
                    $scope.sales.splice(index, 1);
                } else {
                    toastr.error(data.message);
                }
            }).error(function(data, a) {
                toastr.error('Something went wrong!');
            });
        }

        $scope.$watch('saleFlag.flag', function(newValue, oldValue) {
            if (newValue != oldValue) {
                getSaleList();
            }
        });
    }
]);