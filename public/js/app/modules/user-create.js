var userApp = angular.module('user', ['dirFormError']);

userApp.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}]);

userApp.controller('createCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.title = 'Create user';
    $scope.showForm = true;

    var resetSubmitBtn = function() {
        $scope.save = "Create";
        $scope.submitting = false;
    }

    $scope.resetForm = function() {
        $scope.selectedProduct = {};
        $scope.selectedCampaign = {};
        $scope.user = {'birthday' : $.datepicker.formatDate('mm/dd/yy', new Date())};
        resetSubmitBtn();
    }

    $scope.resetForm();

    $scope.loadShifts = function() {
        $http.get('/shift/list').success(function(data) {
            $scope.shifts = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });
    }

    $scope.createUser = function(){
        if ($scope.submitting) return; // prevent multiple submission
        $scope.save = 'Creating...';
        $scope.submitting = true;
        $scope.errors = {};

        var postData = $scope.user;
        postData['shift_id'] = $scope.selectedShift.id;

        $http.post('/user/create', postData).success(function(data) {
            if (data.success) {
                toastr.success('User successfully created');
                setTimeout(function() {
                    window.location = "/user";
                }, 3000);
            } else {
                toastr.error('Something went wrong!');
                resetSubmitBtn();
            }
        }).error(function(data, a) {
            if (a == '422') {
                $scope.errors = buildFormErrors($scope.errors, data);
            }
            toastr.error('Something went wrong!');
            resetSubmitBtn();
        });
    }


    $scope.loadShifts();

}]);