var profileApp = angular.module('profile', []);

profileApp.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}]);

profileApp.controller('mainCtrl', ['$scope', function ($scope) {
    $scope.message = 'Welcome';
}]);
