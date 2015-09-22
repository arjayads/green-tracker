var saleApp = angular.module('sale', []);

saleApp.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}]);

saleApp.controller('processCtrl', ['$scope', '$http',
    function($scope, $http) {

        $scope.process = false;

        $http.get('/sales/statuses').success(function(data) {
            $scope.statuses = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });

        $scope.setSelectedStatus = function(sa) {
            $scope.process = true;

            if (sa !== null) {
                var res = confirm("You are about to set this sale as: " + sa.status + '. Do you want to continue?');
                if (res) {
                    $scope.selectedStatus = sa;

                    var postData = {
                        'sale_id' : $scope.saleId,
                        'status_id' : sa.id
                    }

                    $http.post('/sales/process', postData).success(function(data) {
                        if (data.success) {
                            toastr.success('Sale successfully set as ' + sa.status);
                            setTimeout(function() {
                                window.location = "/sales/listing";
                            }, 3000);
                        } else {
                            toastr.error(data.messages[0]);
                        }
                    }).error(function() {
                        toastr.error('Something went wrong!');
                    });

                } else {
                    $scope.selectedStatus = null;
                    $scope.process = false;
                }
            }
        }
    }
]);