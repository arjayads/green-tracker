var profileApp = angular.module('profile', ['config', 'ngImgCrop']);

profileApp.controller('newsfeedCtrl', ['$scope', '$http',
    function ($scope, $http) {

        $scope.profilePhoto = '/profile/photo?t=' + Math.random();
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

profileApp.controller('coverCtrl', ['$scope', '$http', function ($scope, $http) {

    // profile pic
    $scope.myImage='';
    $scope.myCroppedImage='';

    // cover pic
    $scope.myCoverImage='';
    $scope.myCroppedCoverImage='';

    $scope.message = 'No client has left in my arms unsatisfied';

    var loadProfilePhoto = function() {
        $scope.profilePhoto = '/profile/photo?t=' + Math.random();
    }

    $scope.setProfilePic = function() {
        $scope.myImage='';
        $scope.myCroppedImage='';

        $("#profile-changer-modal").modal('show');
    }

    $scope.setCoverPic = function() {
        $scope.myCoverImage='';
        $scope.myCroppedCoverImage='';

        $("#cover-changer-modal").modal('show');
    }

    $scope.saveProfilePic = function() {
        $("#profile-changer-modal").modal('hide');

        if ($scope.myCroppedImage != '' ) {
            $http.post('/profile/updatePhoto', {'image' : $scope.myCroppedImage}).success(function(d) {
                if (d.success) {
                    $scope.profilePhoto = '/profile/photo?t=' + Math.random();
                } else {
                    toastr.error('Failed to update profile photo!');
                }
            }).error(function(data, a) {
                toastr.error("Something went wrong!");
            });
        } 
    }

    var handleProfilePicSelect = function(evt) {
        var file = evt.currentTarget.files[0];

        if (/^image\/\w+$/.test(file.type)) {
            var reader = new FileReader();
            reader.onload = function (evt) {
                $scope.$apply(function($scope){
                    $scope.myImage = evt.target.result;
                });
            };

            if (file !== undefined) {
                reader.readAsDataURL(file);
            }
        } else {
            toastr.warning('Please choose an image file.');
        }
    };


    var handleCoverPicSelect = function(evt) {
        var file = evt.currentTarget.files[0];

        if (/^image\/\w+$/.test(file.type)) {
            var reader = new FileReader();
            reader.onload = function (evt) {
                $scope.$apply(function($scope){
                    $scope.myCoverImage = evt.target.result;
                });
            };

            if (file !== undefined) {
                reader.readAsDataURL(file);
            }
        } else {
            toastr.warning('Please choose an image file.');
        }
    };

    angular.element(document.querySelector('#profilePicInput')).on('change', handleProfilePicSelect);
    angular.element(document.querySelector('#coverPicInput')).on('change', handleCoverPicSelect);

    loadProfilePhoto();
}]);
