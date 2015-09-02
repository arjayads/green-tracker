var user = angular.module('user', [

]);

user.controller('userListCtrl', ['$scope', '$http',
    function($scope, $http) {

        $scope.user = [];

        $http.get('/user/list').success(function(data) {
            $scope.user = data;
        }).error(function() {
            toastr.error('Something went wrong!');
        });
    }
]);

user.controller('createUserCtrl', ['$scope', '$http',
    function($scope, $http) {
        $scope.save = 'Create';
    }
]);