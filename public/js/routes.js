var js = function(file) {
    return '/js/' + file + '.js';
}

var css = function(file) {
    return '/css/' + file + '.css';
}

function config($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise("main");
    $stateProvider

        .state('main', {
            url:  '/main',
            templateUrl: '/main',
            pageTitle: "Home",
            controller: function($rootScope, $state) {
                $rootScope.pageTitle = $state.current.pageTitle;
            }
        })

        .state('sales', {
            url:  '/sales',
            templateUrl: '/html/sales/list',
            controller: 'salesListCtrl',
            pageTitle: "Sales",
            resolve: {
                store: function ($ocLazyLoad) {
                    return $ocLazyLoad.load(
                        {
                            name: "sales",
                            files: [
                                js('/module/sales'),
                                js('/directives/form-error'),
                                js('/filters/date-filter')
                            ]
                        }
                    )
                }
            }
        })

        .state('sales.create', {
            url:  '/create',
            templateUrl: '/html/sales/create',
            controller: 'createSaleCtrl',
            pageTitle: "Add sale"
        })

        .state('sales.detail', {
            url:  '/{id}/detail',
            templateUrl: '/html/sales/detail',
            controller: 'saleDetailCtrl'
        })

        .state('user', {
            url:  '/user/list',
            templateUrl: '/html/user/list',
            controller: 'userListCtrl',
            resolve: {
                store: function ($ocLazyLoad) {
                    return $ocLazyLoad.load(
                        {
                            name: "user",
                            files: [
                                js('/module/user')
                            ]
                        }
                    )
                }
            }
        })

        .state('user.create', {
            url:  '^/user/create',
            templateUrl: '/html/user/create',
            controller: 'createUserCtrl'
        })

        .state('myProfile', {
            url:  '/profile',
            templateUrl: '/html/user/profile',
            controller: 'mainCtrl',
            resolve: {
                store: function ($ocLazyLoad) {
                    return $ocLazyLoad.load(
                        {
                            name: "profile",
                            files: [
                                js('/module/profile')
                            ]
                        }
                    )
                }
            }
        })
}

function decorator($provide) {
    $provide.decorator('$state', function ($delegate) {

        // let's locally use 'state' name
        var state = $delegate;

        // let's extend this object with new function
        // 'baseGo', which in fact, will keep the reference
        // to the original 'go' function
        state.baseGo = state.go;

        // here comes our new 'go' decoration
        var go = function (to, params, options) {
            options = options || {};

            // only in case of missing 'reload'
            // append our explicit 'true'
            if (angular.isUndefined(options.reload)) {

                options.reload = true;
            }

            // return processing to the 'baseGo' - original
            this.baseGo(to, params, options);
        };

        // assign new 'go', right now decorating the old 'go'
        state.go = go;

        return $delegate;
    });
}

angular
    .module('social')
    .config(config)
    .run(['$rootScope', '$state', function($rootScope, $state) {
        $rootScope.$state = $state;
        $rootScope.$on("$locationChangeStart", function (event, next, current) {
            // ajax check user authenticity
            if ($state.current.pageTitle === undefined) {
                $rootScope.pageTitle = false;
            }
        });
    }]);
