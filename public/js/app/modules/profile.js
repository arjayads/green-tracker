var profileApp = angular.module('profile', ['config', 'ngImgCrop', 'ngupload', 'dirFormError']);

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

profileApp.controller('coverCtrl', ['$scope', '$http', '$timeout', function ($scope, $http, $timeout) {
    $scope.savingInfo = false;
    $scope.savingInfoButton = 'Save changes';

    $scope.profilePhoto = 'images/avatar_2x.png';
    $scope.coverPhoto = 'images/cover.png';

    // profile pic
    $scope.myImage='';
    $scope.myCroppedImage='';

    // cover photo
    $scope.imageSrc = "";

    var loadProfilePhoto = function() {
        $scope.profilePhoto = '/profile/photo?t=' + Math.random();
    }

    var loadCoverPhoto = function() {
        $scope.coverPhoto = '/profile/cover?t=' + Math.random();
    }

    $scope.setProfilePic = function() {
        $("#profile-changer-modal").modal('show');
    }

    $scope.setCoverPic = function() {
        $("#cover-changer-modal").modal('show');
    }

    $scope.showUpdateInfoModal = function() {
        $("#info-changer-modal").modal('show');
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

    $scope.saveCoverPic = function() {
        $("#cover-changer-modal").modal('hide');

        if ($scope.imageSrc != '' ) {
            $http.post('/profile/updateCover', {'image' : $scope.imageSrc}).success(function(d) {
                if (d.success) {
                    $scope.coverPhoto = '/profile/cover?t=' + Math.random();
                } else {
                    toastr.error('Failed to update cover photo!');
                }
            }).error(function(data, a) {
                toastr.error("Something went wrong!");
            });
        }
    }
    $scope.saveInfo = function() {
        if ($scope.savingInfo) return; // prevent multiple submission
        $scope.saveInfoButton ='Saving...';
        $scope.savingInfo = true;
        $scope.errors = {};

        var postData = $scope.info;

        if (postData === undefined) {
            toastr.info("No changes made!");
            $("#info-changer-modal").modal('hide');
            $scope.savingInfo = false;

        } else {
            $http.post('/profile/updateInfo', postData).success(function(data) {

                if (data.success) {
                    $scope.infoSaved = false;
                    $scope.alertType = 'info';
                    toastr.success('Sale successfully created');

                    $scope.updateInfoMessage = 'Redirecting...'

                    $timeout(function() {
                        window.location.reload();
                    }, 3000);
                } else {
                    $scope.alertType = 'danger';
                    toastr.error('Something went wrong!');
                    $scope.savingInfo = false;
                }

            }).error(function(data, a) {
                if (a == '422') {
                    $scope.errors = buildFormErrors($scope.errors, data);
                }
                toastr.error('Something went wrong!');
                $scope.savingInfo = false;
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

    angular.element(document.querySelector('#profilePicInput')).on('change', handleProfilePicSelect);

    loadCoverPhoto();
    loadProfilePhoto();
}]);
