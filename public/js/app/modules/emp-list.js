var userApp = angular.module('user', ['config', 'ngTouch', 'ui.grid', 'ui.grid.pagination']);
 
userApp.controller('listCtrl', ['$scope', '$http',
    function($scope, $http) {

        var q = ""; // query string
        var paginationOptions = {
            pageNumber: 1,
            pageSize: 15,
            sort: 'asc',
            sortCol: 'id_number'
        };

        var getEmps = function() {

            var query = [];

            var searchUrl = '/admin/emp/list';
            var countSearchUrl ='/admin/emp/countFind';
            query.push('sortCol=' + paginationOptions.sortCol);
            query.push('direction=' + paginationOptions.sort);
            query.push('offset=' + ((paginationOptions.pageSize * paginationOptions.pageNumber) - paginationOptions.pageSize));
            query.push('limit=' + paginationOptions.pageSize);
            query.push(q);

            var params = "";
            for(var x = 0; x < query.length; x++) {
                params += query[x] + "&";
            }
            searchUrl += "?" + params;
            countSearchUrl += "?" + params;

            $http.get(countSearchUrl).success(function(data) {
                $scope.gridOptions1.totalItems = data;
            });

            $http.get(searchUrl).success(function(data) {
                $scope.gridOptions1.data = data;
            }).error(function() {
                toastr.error('Something went wrong!');
            });
        }

        $scope.$watch('query', function(searchText, oldValue) {
            if (searchText !== undefined && $.trim(searchText).length >= 3) {
                q = 'q='+ encodeURIComponent(searchText);
                getEmps();
            } else
            if (searchText === undefined || $.trim(searchText).length == 0) {
                q = '';
                getEmps();
            }

        });

        $scope.buildCellUrl = function(empId) {
            return '/admin/emp/' + empId + '/detail' ;
        }

        $scope.gridOptions1 = {
            paginationPageSizes: [15, 30, 45],
            paginationPageSize: 15,
            useExternalPagination: true,
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
            onRegisterApi: function(gridApi) {
                $scope.gridApi = gridApi;
                $scope.gridApi.core.on.sortChanged($scope, function(grid, sortColumns) {
                    if (sortColumns.length == 0) {
                        paginationOptions.sort = 'asc';
                        paginationOptions.sortCol = 'id_number';
                    } else {
                        paginationOptions.sort = sortColumns[0].sort.direction;
                        paginationOptions.sortCol = sortColumns[0].field;
                    }
                    getEmps();
                });
                gridApi.pagination.on.paginationChanged($scope, function (newPage, pageSize) {
                    paginationOptions.pageNumber = newPage;
                    paginationOptions.pageSize = pageSize;
                    getEmps();
                });
            }
        };
    }
]);