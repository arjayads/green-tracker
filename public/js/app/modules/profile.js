var profileApp = angular.module('profile', ['config']);

profileApp.controller('newsfeedCtrl', ['$scope', '$http',
    function ($scope, $http) {

        $scope.posts = [];

        $http.get('/post/list').success(function(data) {
            $scope.posts = data;
        }).error(function() {
            toastr.error('Error loading news feed!');
        });


        $scope.post = function() {

            if ($scope.newPost !== undefined && $.trim($scope.newPost.content).length > 0) {

                var postData = {'content': $scope.newPost.content}

                $http.post('/post/create', postData).success(function(d) {
                    if (d.success) {
                        $scope.newPost.content = '';
                        $scope.posts.unshift(d.data.post);
                    } else {
                        toastr.error(d.messages[0]);
                    }
                }).error(function(data, a) {
                    toastr.error("Something went wrong!");
                });
            } else {
                toastr.error("Input something to post!");
            }



        }
}]);

profileApp.controller('coverCtrl', ['$scope', function ($scope) {
    $scope.message = 'No client has left in my arms unsatisfied';
}]);
