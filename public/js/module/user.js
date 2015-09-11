var user = angular.module('user', [
    'dirFormError',
    'dateFilters'
]);

user.controller('userListCtrl', ['$scope', '$http', '$rootScope', '$state',
    function($scope, $http, $rootScope, $state) {
        $rootScope.pageTitle = $state.current.pageTitle;

        $scope.users = [];

        $http.get('/user/list').success(function(data) {
            $scope.users = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });
    }
]);

user.controller('createUserCtrl', ['$scope', '$http', '$rootScope', '$state',
    function($scope, $http, $rootScope, $state) {
        $rootScope.pageTitle = $state.current.pageTitle;

        $scope.save = "Create";
        $scope.user = {};

        $scope.loadShifts = function() {
            $http.get('/shift/list').success(function(data) {
                $scope.shifts = data;
            }).error(function() {
                toastr.error('Something went wrong!');
            });
        }

        $scope.loadShifts();

        $scope.displayErrors = function(data){
            var messages;
            if(undefined != data.messages){
                messages = data.messages;
            }else{
                messages = data;
            }
            $.each(messages, function(index, value) {
                $scope.errors[index] = value;
            }); 
        }

        $scope.createUser = function(){
            if ($scope.submitting) return; // prevent multiple submission
            $scope.save = 'Creating...';
            $scope.submitting = true;
            $scope.errors = {};

            var postData = $scope.user;

            //validate
            if (undefined == $scope.user.id_number || $scope.user.id_number == '') {
                $scope.errors['id_number'] = ['Please enter ID Number'];
            }
            if (undefined == $scope.user.first_name || $scope.user.first_name == '') {
                $scope.errors['first_name'] = ['Please enter first name'];
            }
            if (undefined == $scope.user.middle_name || $scope.user.middle_name == '') {
                $scope.errors['middle_name'] = ['Please enter middle name'];
            }
            if (undefined == $scope.user.last_name || $scope.user.last_name == '') {
                $scope.errors['last_name'] = ['Please enter last name'];
            }
            if (undefined == $scope.user.email || $scope.user.email == '') {
                $scope.errors['email'] = ['Please enter email'];
            }
            if (undefined == $scope.user.sex || $scope.user.sex == '') {
                $scope.errors['sex'] = ['Please select sex'];
            }
            if (undefined == $scope.user.birthday || $scope.user.birthday == '') {
                $scope.errors['birthday'] = ['Please enter birthday'];
            }
            if (undefined == $scope.selectedShift || $scope.selectedShift == '') {
                $scope.errors['shift_id'] = ['Please select shift'];
            } else {
                postData['shift_id'] = $scope.selectedShift.id;
            }

            $http.post('/user/create', postData).success(function(data) {
                if (data.success) {
                    $state.go('user', {}, {reload: true}); // redirect to main
                    toastr.options.timeOut = 0;
                    toastr.options.extendedTimeOut = 0;
                    toastr.success(data.messages[1], data.messages[0]);
                } else {
                    $scope.displayErrors(data);
                }
            }).error(function(data) {
                toastr.error('Something went wrong!');
                $scope.displayErrors(data);
               
                $scope.submitting = false;
                $scope.save = "Create";
            });

            $scope.submitting = false;
            $scope.save = 'Create';
        }    
    }
]);