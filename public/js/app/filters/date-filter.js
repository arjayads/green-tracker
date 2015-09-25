(function () {

    var app = angular.module('dateFilters', []);

    app.filter('dateToMils', [function () {
        return function(input) {
            input = new Date(input).getTime();
            return input;
        };
    }]);
}).call(this);