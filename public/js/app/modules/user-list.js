var userApp = angular.module('user', ['ngTouch', 'ui.grid', 'ui.grid.pagination']);

userApp.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}]);

userApp.controller('listCtrl', ['$scope', '$http',
    function($scope, $http) {
        var defUrl = '/user/list';

        var getUsers = function(url) {
            $http.get(url).success(function(data) {
                $scope.gridOptions1.data = data;
            }).error(function() {
                toastr.error('Something went wrong!');
            });
        }

        $scope.$watch('query', function(searchText, oldValue) {
            if (searchText !== undefined && $.trim(searchText).length >= 3) {
                var q = 'q='+ encodeURIComponent(searchText);
                getUsers(defUrl+'?'+q);
            } else
            if (searchText === undefined || $.trim(searchText).length == 0) {
                getUsers(defUrl);
            }

        });

        $scope.buildCellUrl = function(obj) {
            return '#';
        }

        $scope.gridOptions1 = {
            paginationPageSizes: [15, 30, 45],
            paginationPageSize: 15,
            columnDefs: [
                {field: 'id_number', enableSorting: true, enableHiding: false },
                {field: 'email', enableSorting: true, enableHiding: false },
                {field: 'full_name', enableSorting: true, enableHiding: false },
                {field: 'sex', enableSorting: true, enableHiding: false },
                {field: 'shift', enableSorting: false, enableHiding: false },
            ],
            onRegisterApi: function( gridApi ) {
                $scope.grid1Api = gridApi;
            }
        };

        getUsers(defUrl);

    }
]);