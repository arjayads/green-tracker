(function () {
    var app;
    var app = angular.module('dirFormError', []);

    app.directive('formError', [function () {
        return {
            scope : {
                errField : '='
            },
            restrict: 'E',
            templateUrl: "/common/form-field-error-msg"
        };
    }]);
}).call(this);