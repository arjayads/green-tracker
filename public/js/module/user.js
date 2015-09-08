var user = angular.module('user', [

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

        $scope.createUser = function(){
            if ($scope.submitting) return; // prevent multiple submission
            $scope.save = 'Creating...';
            $scope.submitting = true;
            $scope.errors = {};

            var postData = $scope.user;

            //validate
            if (undefined == $scope.user.id_number || $scope.user.id_number == '') {
                $scope.errors['id_number'] = 'Please enter ID Number';
            }
            if (undefined == $scope.user.first_name || $scope.user.first_name == '') {
                $scope.errors['first_name'] = 'Please enter first name';
            }
            if (undefined == $scope.user.last_name || $scope.user.last_name == '') {
                $scope.errors['last_name'] = 'Please enter last name';
            }
            if (undefined == $scope.user.email || $scope.user.email == '') {
                $scope.errors['email'] = 'Please enter email';
            }
            if (undefined == $scope.user.sex || $scope.user.sex == '') {
                $scope.errors['sex'] = 'Please select sex';
            }
            if (undefined == $scope.user.birthday || $scope.user.birthday == '') {
                $scope.errors['birthday'] = 'Please enter birthday';
            }

            $http.post('/user/create', postData).success(function(data) {
                if (data.success) {
                    $state.go('user', {}, {reload: true}); // redirect to main
                    toastr.success('User successfully created');
                } else {
                    $.each(data.messages, function(index, value) {
                        $scope.errors[index] = value;
                    });
                }
            }).error(function(data) {
                toastr.error('Something went wrong!');
                $.each(data.messages, function(index, value) {
                    $scope.errors[index] = value;
                });
               
                $scope.submitting = false;
                $scope.save = "Create";
            });

            $scope.submitting = false;
            $scope.save = 'Create';
        }    
    }
]);