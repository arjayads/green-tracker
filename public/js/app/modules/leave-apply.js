var leaveApplicationApp = angular.module('leaveApplication', ['dirFormError', 'config', 'ngTouch']);

leaveApplicationApp.controller('mainCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.title = 'Application for Leave';
    $scope.showForm = true;
    $scope.selectedSupervisor = {};
    $scope.dates = [];

    var resetSubmitBtn = function() {
        $scope.save = "Save";
        $scope.submitting = false;
    }
    $scope.resetForm = function() {
        $scope.selectedReason = {};
        $scope.leave = {};
        resetSubmitBtn();
    }

    $scope.addDate = function() {
        var d = $('#date').val();
        if (d !== undefined && d != '') {
            if ($scope.dates.indexOf(d) == -1) { // prevent duplicates
                $scope.dates.push(d);
            } else {
                toastr.warning('Please select different date');
            }
        } else {
            toastr.warning('Please select date');
        }
    }

    $scope.removeDate = function(index) {
        $scope.dates.splice(index, 1);
    }

    //var getEmp = function () {
    //    $http.get('/admin/emp/'+$scope.empId+'/getForEdit').success(function(data) {
    //        $scope.employee = data;
    //        $scope.employee.birthday = $.datepicker.formatDate('mm/dd/yy', new Date(data.birthday));
    //        $scope.selectedShift = data.shift;
    //        $scope.selectedGroup = data.group;
    //
    //    }).error(function() {
    //        toastr.error('Something went wrong!');
    //    });
    //}

    //
    //$scope.loadShifts = function() {
    //    $http.get('/shift/list').success(function(data) {
    //        $scope.shifts = data;
    //    }).error(function() {
    //        toastr.error('Something went wrong!');
    //    });
    //}
    //
    //$scope.loadGroups = function() {
    //    $http.get('/group/list').success(function(data) {
    //        $scope.groups = data;
    //    }).error(function() {
    //        toastr.error('Something went wrong!');
    //    });
    //}
    //
    //$scope.remoteUrlRequestFn = function(str) {
    //    return {q: str};
    //};
    //
    //$scope.saveEmp = function(){
    //    if ($scope.submitting) return; // prevent multiple submission
    //    $scope.save = 'Saving...';
    //    $scope.submitting = true;
    //    $scope.errors = {};
    //
    //    var postData = $scope.employee;
    //    postData['birthday'] = $('#birthday').val();
    //    postData['shift_id'] = $scope.selectedShift.id;
    //    postData['group_id'] = $scope.selectedGroup.id;
    //    if ($scope.selectedSupervisor) {
    //        postData['supervisor_id'] = $scope.selectedSupervisor.originalObject.id;
    //    }
    //
    //    $http.post('/admin/emp/create', postData).success(function(d) {
    //        if (d.success) {
    //            toastr.success(d.messages[0]);
    //            setTimeout(function() {
    //                window.location = "/admin/emp/" + d.data.empId + '/detail';
    //            }, 3000);
    //        } else {
    //            toastr.error('Something went wrong!');
    //            $scope.errors = buildFormErrors($scope.errors, d.messages);
    //            resetSubmitBtn();
    //        }
    //    }).error(function(data, a) {
    //        if (a == '422') {
    //            $scope.errors = buildFormErrors($scope.errors, data);
    //        }
    //        toastr.error('Something went wrong!');
    //        resetSubmitBtn();
    //    });
    //}
    //
    //$scope.$watch('empId', function(newValue, oldValue) {
    //    $scope.empId = newValue;
    //    if ($scope.empId !== undefined && parseInt($scope.empId) > 0) {
    //        $scope.save = "Save";
    //
    //        getEmp();
    //    } else {
    //        $scope.save = "Create";
    //    }
    //});
    //
    $scope.resetForm();
    //$scope.loadShifts();
    //$scope.loadGroups();

}]);