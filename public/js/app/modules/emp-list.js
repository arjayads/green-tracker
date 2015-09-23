var userApp = angular.module('user', ['config', 'ngTouch', 'ui.grid', 'ui.grid.pagination']);
 
userApp.controller('listCtrl', ['$scope', '$http',
    function($scope, $http) {
        var defUrl = '/emp/list';

        var getEmps = function(url) {
            $http.get(url).success(function(data) {
                $scope.gridOptions1.data = data;
            }).error(function() {
                toastr.error('Something went wrong!');
            });
        }

        $scope.$watch('query', function(searchText, oldValue) {
            if (searchText !== undefined && $.trim(searchText).length >= 3) {
                var q = 'q='+ encodeURIComponent(searchText);
                getEmps(defUrl+'?'+q);
            } else
            if (searchText === undefined || $.trim(searchText).length == 0) {
                getEmps(defUrl);
            }

        });

        $scope.buildCellUrl = function(empId) {
            return '/emp/' + empId + '/detail' ;
        }

        $scope.gridOptions1 = {
            paginationPageSizes: [15, 30, 45],
            paginationPageSize: 15,
            columnDefs: [
                {
                    field: 'id_number', enableSorting: true, enableHiding: false,
                    cellTemplate: '<a href="{{grid.appScope.buildCellUrl(row.entity.employee_id)}}" class="ui-grid-cell-contents">{{row.entity.id_number}}</a>'

                },
                {field: 'email', enableSorting: true, enableHiding: false },
                {field: 'full_name', enableSorting: true, enableHiding: false },
                {field: 'sex', enableSorting: true, enableHiding: false },
                {field: 'shift', enableSorting: false, enableHiding: false },
            ],
            onRegisterApi: function( gridApi ) {
                $scope.grid1Api = gridApi;
            }
        };

        getEmps(defUrl);

    }
]);