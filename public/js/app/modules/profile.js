var profileApp = angular.module('profile', ['config']);

profileApp.controller('newsfeedCtrl', ['$scope', '$http',
    function ($scope, $http) {

        $scope.posts = [];

        $http.get('/post/list').success(function(data) {
            $scope.posts = data;
        }).error(function() {
            toastr.error('Error loading news feed!');
        });
}]);

profileApp.controller('coverCtrl', ['$scope', function ($scope) {
    $scope.message = 'No client has left in my arms unsatisfied';
}]);
