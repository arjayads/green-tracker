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

        $scope.posterProfilePhoto = function(userId) {
            return '/profile/photo?uid=' + userId;
        }


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

        $scope.love = function(postId) {
            $http.post('/post/love', {'postId': postId}).success(function(d) {
                if (d.success) {
                    toastr.success(d.messages[0]);
                } else {
                    toastr.error(d.messages[0]);
                }
            }).error(function(data, a) {
                toastr.error("Something went wrong!");
            });
        }
}]);

profileApp.controller('chartsCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.salesToday = { 'today' : 0, 'toDate': 0 };
    $scope.weeklyChart = [];
    $scope.myTeam = [];
    $scope.topSellers = [];

    $http.get('/profile/myTeam').success(function(data) {
        $scope.myTeam = data;
    }).error(function() {
        toastr.error('Error loading team members!');
    });

    $http.get('/sales/my/count/today').success(function(data) {
        $scope.salesToday = data;
    }).error(function() {
        toastr.error('Error loading today\'s sales!');
    });

    $http.get('/profile/topSeller').success(function(data) {
        $scope.topSellers = data;
    }).error(function() {
        toastr.error('Error loading top sellers');
    });

    $scope.$watch('weeklyChart', function(newValue, oldValue) {
        $http.get('/sales/my/weekly-chart').success(function(data) {
            drawWeeklyChart(data);
        }).error(function() {
            toastr.error('Error loading weekly sales!');
        });
    });

    var drawWeeklyChart = function(values) {
        $('#weekly-chart').highcharts({
            chart: {
                type: 'area',
                backgroundColor: null,
                height: 150
            },
            legend: {
                enabled: false
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                tickmarkPlacement: 'on',
                title: {
                    enabled: false
                },
                labels: {
                    style: {
                        color: 'white'
                    }
                },
                min: 0.4,
                max: 4.5
            },
            yAxis: {
                title: {
                    text: ''
                },
                tickInterval: 0.5,
                labels: {
                    enabled: false
                }
            },
            tooltip: {
                shared: true
            },
            plotOptions: {
                area: {
                    stacking: 'normal',
                    lineColor: 'white',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: 'white',
                        fillColor: 'white'
                    }
                }
            },
            series: [{
                name: 'Sales',
                data: values
            }]
        });
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
                    $scope.errors = buildFormErrors($scope.errors, data.messages);
                    $scope.alertType = 'danger';
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
