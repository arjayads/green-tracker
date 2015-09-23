var profileApp = angular.module('profile', ['config']);

profileApp.controller('mainCtrl', ['$scope', function ($scope) {
    $scope.message = 'Welcome';
}]);
