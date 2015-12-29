var leaveApplicationApp = angular.module('leaveApplication', ['dirFormError', 'config', 'ngTouch']);

leaveApplicationApp.controller('mainCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.title = 'Application for Leave';
    $scope.errors = {};
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

    $scope.loadLeaveType = function() {
        $http.get('/my/leaveTypes').success(function(data){
            $scope.leaveTypes = data;
        });
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


    $scope.setSelectedReason = function(reason) {
        if(reason !== undefined) {
            if ($scope.leave.purpose == undefined || '' == $.trim($scope.leave.purpose)) {
                $scope.leave.purpose = reason.description;
            }
        }
    }

    $scope.processForm = function(){
        if ($scope.submitting) return; // prevent multiple submission
        $scope.save = 'Saving...';
        $scope.submitting = true;
        $scope.errors = {};

        if ($scope.dates.length == 0) {
            $scope.errors['date'] = ['Please select date'];
        }

        if (!$.isEmptyObject($scope.errors)) {
            resetSubmitBtn();
            return;
        }

        var postData = $scope.leave;
        if ($scope.selectedReason !== undefined) {
            postData['leave_type_id'] = $scope.selectedReason.id;
        }

        postData['dates'] = $scope.dates;

        $http.post('/my/leaveApplication', postData).success(function(d) {
            if (d.success) {
                $scope.save = 'Saved';
                toastr.success(d.messages[0]);
                setTimeout(function() {
                    window.location = "/my/leave";
                }, 3000);
            } else {
                toastr.error(d.messages[0]);
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

    $scope.resetForm();
    $scope.loadLeaveType();
}]);