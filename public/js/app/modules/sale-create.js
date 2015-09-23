var saleApp = angular.module('sale', ['config', 'dirFormError']);

saleApp.controller('createCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.title = 'Create sale';
    $scope.showForm = true;

    var resetSubmitBtn = function() {
        $scope.save = "Create";
        $scope.submitting = false;
    }

    $scope.resetForm = function() {
        $scope.selectedProduct = {};
        $scope.selectedCampaign = {};
        $scope.sale = {'date_sold' : $.datepicker.formatDate('mm/dd/yy', new Date())};
        resetSubmitBtn();
    }

    $scope.resetForm();

    $scope.loadCampaigns = function() {
        $http.get('/campaign/list').success(function(data) {
            $scope.campaigns = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });
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


    $scope.processForm = function() {

        if ($scope.submitting) return; // prevent multiple submission
        $scope.save ='Saving...';
        $scope.submitting = true;
        $scope.errors = {};

        var postData = $scope.sale;
        postData['date_sold'] = $('#date-sold').val();
        if ($scope.selectedProduct !== undefined) {
            postData['product_id'] = $scope.selectedProduct.id;
        }

        $http.post('/sales/create', postData).success(function(data) {
            if (data.success) {
                toastr.success('Sale successfully created');
                $scope.resetForm();
            } else {
                toastr.error('Something went wrong!');
            }
            resetSubmitBtn();
        }).error(function(data, a) {
            if (a == '422') {
                $scope.errors = buildFormErrors($scope.errors, data);
            }
            toastr.error('Something went wrong!');
            resetSubmitBtn();
        });
    }

    $scope.loadCampaigns();
}]);