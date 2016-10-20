
angular.module('bootstrapAngularTemplate')
.config(function ($routeProvider) {

    for (var route of routes) {
        $routeProvider.when('/'+route.route, {
            templateUrl: route.templateUrl,
            controller: route.controller,
            controllerAs: route.controller
        });
    }
    $routeProvider.otherwise({
        redirectTo: '/404'
    });

});
