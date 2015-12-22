var saleApp = angular.module('sale', ['config','ngTouch', 'ui.grid', 'ui.grid.pagination', 'ui.grid.resizeColumns']);

saleApp.controller('listCtrl', ['$scope', '$http',
    function($scope, $http) {
        $scope.sales = [];
        $scope.selectedStatus =  {id: 0, stat: 'Unverified'};

        $scope.statuses = [
            {id: -1, stat: 'All'},
            {id: 0, stat: 'Unverified'},
            {id: 1, stat: 'Verified'}
        ];

        $http.get('/campaign/list').success(function(data) {
            $scope.campaigns = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });

        var getSaleList = function() {
            var url = '/sales/list';
            if ($scope.selectedCampaign !== undefined && $scope.selectedCampaign != null) {
                url += '?campId=' + $scope.selectedCampaign.id;
                url += '&q=' + $scope.selectedStatus.id;
            } else {
                url += '?q=' + $scope.selectedStatus.id;
            }
            /*
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
            */

            $http.get(url).success(function(data) {
                $scope.sales = data;
                $scope.gridOptions1.data = $scope.sales;
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

        $scope.setVerified = function(sale){
            $http.post('/sales/' + sale.id + '/setVerified', {}).success(function(data) {
                if (data.success) {
                    toastr.success(data.message);
                    var index = $scope.sales.indexOf(sale);

                    if ($scope.selectedStatus.id == 0) {
                        $scope.sales.splice(index, 1);
                    } else {
                        $scope.sales[index].verified = 1;
                    }
                } else {
                    toastr.error(data.message);
                }
            }).error(function(data, a) {
                toastr.error('Something went wrong!');
            });
        }

        $scope.buildCellUrl = function(saleid) {
            var link = '/sales/' + saleid + '/detail';
            if ($scope.selectedCampaign !== undefined) {
                link += '?c=' + $scope.selectedCampaign.id;
            }

            return link;
        }

        var paginationOptions = {
            pageNumber: 1,
            pageSize: 15,
            sort: 'asc',
            sortCol: 'date_sold'
        };

        $scope.gridOptions1 = {
            paginationPageSizes: [15, 30, 45],
            paginationPageSize: 15,
            useExternalPagination: true,
            enableSorting: true,
            columnDefs: [
                {
                    field: 'order_number',
                    displayName: 'Order No',
                    width: '9%',
                    enableHiding: false,
                    cellTemplate: '<div class="ui-grid-cell-contents"><a href="{{grid.appScope.buildCellUrl(row.entity.id)}}">{{row.entity.order_number}}</a></div>'

                },
                {field: 'campaign_name', displayName: 'Campaign', enableHiding: false},
                {field: 'product_name', displayName: 'Product', enableHiding: false},
                {
                    field: 'date_sold',
                    type: 'date',
                    cellFilter: 'date:\'MMM dd, yyyy\'',
                    enableHiding: false
                },
                {
                    field: 'customer.first_name',
                    displayName: 'Customer',
                    cellTemplate: '<div class="ui-grid-cell-contents">{{row.entity.customer.first_name + " " + row.entity.customer.last_name}}</div>',
                    enableHiding: false

                },
                {field: 'customer.phone_number', displayName: 'Phone No', enableHiding: false},
                {field: 'processed_by', displayName: 'Agent' , enableHiding: false},
                {
                    field: 'verified',
                    displayName: '',
                    enableSorting: false,
                    enableHiding: false,
                    width: '2%',
                    cellTemplate: '<div id="sav" class="ui-grid-cell-contents"><i ng-click="grid.appScope.setVerified(row.entity)" title="Set as verified" class="cursor fa-2x fa {{row.entity.verified == \'0\' ? \'fa-check-circle \':\'\'}} "></i></div>'
                },
            ],
            onRegisterApi: function(gridApi) {
                $scope.gridApi = gridApi;
                $scope.gridApi.core.on.sortChanged($scope, function(grid, sortColumns) {
                    if (sortColumns.length == 0) {
                        paginationOptions.sort = 'asc';
                        paginationOptions.sortCol = 'order_number';
                    } else {
                        paginationOptions.sort = sortColumns[0].sort.direction;
                        paginationOptions.sortCol = sortColumns[0].field;
                    }
                    getSaleList();
                });
                gridApi.pagination.on.paginationChanged($scope, function (newPage, pageSize) {
                    paginationOptions.pageNumber = newPage;
                    paginationOptions.pageSize = pageSize;
                    getSaleList();
                });
            }
        }
    }
]);