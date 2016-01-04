var leaveApplicationApp = angular.module('leaveApplication', ['dirFormError', 'config', 'ngTouch']);

leaveApplicationApp.controller('mainCtrl', ['$scope', '$http', function ($scope, $http) {
    var today = $.datepicker.formatDate('mm/dd/yy', new Date());

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
        $http.get('/common/leaveTypes').success(function(data){
            $scope.leaveTypes = data;
        });
    }

    $scope.addDate = function() {
        var dFrom = $('#date_from').val();
        var dTo = $('#date_to').val();
        if (dFrom !== undefined && dFrom != '') {
            var d = dFrom + " - " + dTo;
            if ($scope.dates.indexOf(d) == -1) { // prevent duplicates
                $scope.dates.push(d);
            } else {
                toastr.warning('Please select different date range');
            }
        } else {
            toastr.warning('Please select start date');
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
            $scope.errors['date'] = ['Please add inclusive dates'];
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

    // Jkwari
    $('#date_from').on('change', function(e){
        setTodayOnInvalidDate($(this));

        var dTo = $('#date_to').val();
        if (dTo === undefined || dTo == '') {
            $('#date_to').val($(this).val());
        }
        setValidRange($(this), $('#date_to'));
    });

    $('#date_to').on('change', function(e){
        setTodayOnInvalidDate($(this));

        var dFrom = $('#date_from').val();
        if (dFrom === undefined || dFrom == '') {
            $('#date_from').val($(this).val());
        }

        setValidRange($('#date_from'), $(this));

        var to = new Date($(this).val());
        var from = new Date($('#date_from').val());

        if (from.getTime() > to.getTime()) {
            $('#date_from').val($(this).val());
        }
    });

    var setTodayOnInvalidDate = function(el) {
        var d = new Date(el.val());
        if(d == 'Invalid Date') {
            el.val(today);
        }
    }

    var setValidRange = function(elFrom, elTo){
        var from = new Date(elFrom.val());
        var to = new Date(elTo.val());

        if (from.getTime() > to.getTime()) {
            elTo.val(elFrom.val());
        }
    }

    $scope.resetForm();
    $scope.loadLeaveType();
}]);