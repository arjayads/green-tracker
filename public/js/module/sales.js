var sales = angular.module('sales', [
    'dirFormError',
    'dateFilters'
]);

sales.controller('salesListCtrl', ['$scope', '$http', '$rootScope', '$state',
    function($scope, $http, $rootScope, $state) {
        $rootScope.pageTitle = $state.current.pageTitle;

        $scope.sales = [];

        $http.get('/sales/list').success(function(data) {
            $scope.sales = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });
    }
]);

sales.controller('createSaleCtrl', ['$scope', '$http', '$rootScope', '$state',
    function($scope, $http, $rootScope, $state) {
        $rootScope.pageTitle = $state.current.pageTitle;

        $scope.showForm = true;
        $scope.save = "Save";
        $scope.sale = {'date_sold' : $.datepicker.formatDate('mm/dd/yy', new Date())};

        $scope.loadCampaigns = function() {
            $http.get('/campaign/list').success(function(data) {
                $scope.campaigns = data;
            }).error(function() {
                toastr.error('Something went wrong!');
            });
        }

        $scope.loadCampaigns();

        $scope.processForm = function() {

            if ($scope.submitting) return; // prevent multiple submission
            $scope.save ='Saving...';
            $scope.submitting = true;
            $scope.errors = {};

            var postData = $scope.sale;

            //validate
            if (undefined == $scope.sale.date_sold || $scope.sale.date_sold == '') {
                $scope.errors['dateSold'] = 'Please enter date sold';
            }
            if (undefined == $scope.sale.order_number || $.trim($scope.sale.order_number) == '') {
                $scope.errors['order_number'] = 'Please enter order number';
            }
            if (undefined == $scope.selectedCampaign) {
                $scope.errors['campaign'] = 'Please select campaign';
            } else if (undefined == $scope.selectedProduct) {
                $scope.errors['product'] = 'Select product';
            } else {
                postData['product_id'] = $scope.selectedProduct.id;
            }
            if (undefined == $scope.sale.customer.first_name || $.trim($scope.sale.customer.first_name) == '') {
                $scope.errors['firstName'] = 'Please enter first name';
            }
            if (undefined == $scope.sale.customer.last_name || $.trim($scope.sale.customer.last_name) == '') {
                $scope.errors['lastName'] = 'Please enter last name';
            }
            if (undefined == $scope.sale.customer.phone_number || $.trim($scope.sale.customer.phone_number) == '') {
                $scope.errors['phoneNumber'] = 'Please enter phone number';
            }

            $http.post('/sales/create', postData).success(function(data) {
                if (data.success) {
                    $state.go('sales', {}, {reload: true}); // redirect to main
                    toastr.success('Sale successfully created');
                } else {
                    $.each(data.messages, function(index, value) {
                        $scope.errors[index] = value;
                    });
                }
            }).error(function() {
                toastr.error('Something went wrong!');
                $scope.submitting = false;
                $scope.save = "Save";
            });

            $scope.submitting = false;
            $scope.save = "Save";
        }

        $scope.setSelectedCampaign = function(sc) {
            $scope.selectedCampaign  = sc;

            // load products of the selected campaign
            if (sc != null && sc !== undefined) {
                $http.get('/campaign/' + $scope.selectedCampaign.id + '/products').success(function (data) {
                    $scope.products = data;
                }).error(function () {
                    toastr.error('Something went wrong!');
                });
            } else {
                $scope.products = [];
            }
        }

        $scope.setSelectedProduct = function(sp) {
            $scope.selectedProduct  = sp;
        }
    }
]);

sales.controller('saleDetailCtrl', ['$scope', '$http', '$rootScope', '$state', '$stateParams',
    function($scope, $http, $rootScope, $state, $stateParams) {

        $scope.sale = {};

        $http.get('sales/statuses').success(function(data) {
            $scope.statuses = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });

        var hasValidId = !($stateParams.id === undefined);
        if (hasValidId) {
            $http.get('sales/' + $stateParams.id + '/detail').success(function(data) {
                $scope.sale = data;

                $rootScope.pageTitle = data.product_name;

            }).error(function() {
                toastr.error('Something went wrong!');
            });
        }

        $scope.main = function() {
            $state.go('sales');
        }

        $scope.setSelectedStatus = function(sa) {
            toastr.clear();
            if (sa !== null) {
                var res = confirm("You are about to set this sale as: " + sa.status + '. Do you want to continue?');
                if (res) {
                    $scope.selectedStatus = sa;

                    var postData = {
                        'sale_id' : $scope.sale.id,
                        'status_id' : sa.id
                    }

                    $http.post('/sales/process', postData).success(function(data) {
                        if (data.success) {
                            $state.go('sales', {}, {reload: true}); // redirect to main
                            toastr.success('Sale successfully set as ' + sa.status);
                        } else {
                            toastr.error(data.messages[0]);
                        }
                    }).error(function() {
                        toastr.error('Something went wrong!');
                    });

                } else {
                    $scope.selectedStatus = null;
                }
            }
        }
    }
]);