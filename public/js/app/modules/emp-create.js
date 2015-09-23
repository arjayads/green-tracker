var employeeApp = angular.module('employee', ['dirFormError', 'config']);

employeeApp.controller('createCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.showForm = true;

    var resetSubmitBtn = function() {
        $scope.save = "Create";
        $scope.submitting = false;
    }

    var getEmp = function () {
        $http.get('/emp/'+$scope.empId+'/getForEdit').success(function(data) {
            $scope.employee = data;
            $scope.employee.birthday = $.datepicker.formatDate('mm/dd/yy', new Date(data.birthday));
            $scope.selectedShift = data.shift;
        }).error(function() {
            toastr.error('Something went wrong!');
        });
    }
    $scope.resetForm = function() {
        $scope.selectedProduct = {};
        $scope.selectedCampaign = {};
        $scope.employee = {'birthday' : $.datepicker.formatDate('mm/dd/yy', new Date())};
        resetSubmitBtn();

        if ($scope.empId !== undefined && parseInt($scope.empId) > 0) {
            getEmp();
        }
    }

    $scope.loadShifts = function() {
        $http.get('/shift/list').success(function(data) {
            $scope.shifts = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });
    }

    $scope.saveEmp = function(){
        if ($scope.submitting) return; // prevent multiple submission
        $scope.save = 'Saving...';
        $scope.submitting = true;
        $scope.errors = {};

        var postData = $scope.employee;
        postData['birthday'] = $('#birthday').val();
        postData['shift_id'] = $scope.selectedShift.id;

        $http.post('/emp/create', postData).success(function(d) {
            if (d.success) {
                toastr.success(d.messages[0]);
                setTimeout(function() {
                    window.location = "/emp/" + d.data.empId + '/detail';
                }, 3000);
            } else {
                toastr.error('Something went wrong!');
                $scope.errors = buildFormErrors($scope.errors, d.messages);
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

    $scope.$watch('empId', function(newValue, oldValue) {
        $scope.empId = newValue;
        if ($scope.empId !== undefined && parseInt($scope.empId) > 0) {
            $scope.save = "Save";

            getEmp();
        } else {
            $scope.save = "Create";
        }
    });

    $scope.resetForm();
    $scope.loadShifts();

}]);