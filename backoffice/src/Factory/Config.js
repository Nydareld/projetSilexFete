app.config(['$locationProvider', function($locationProvider) {
    $locationProvider.hashPrefix('');
}]);

app.config(['$routeProvider',function ($routeProvider) {

    var routes = [
        {
            "name" : "Accueil",
            "templateUrl" : "Modules/Main/Main.html",
            "route" : ""
        },{
            "name" : "NotFound",
            "templateUrl" : "Modules/Main/404.html",
            "route" : "404"
        },{
            "name" : "ProductModule",
            "templateUrl" : "Modules/Product/ProductModule.html",
            "route" : "products",
            "controller": "productController"
        },{
            "name" : "ImagesModule",
            "templateUrl" : "Modules/Images/ImagesModule.html",
            "route" : "images",
            "controller": "imagesController"

        }

    ];

    for (var i = 0; i < routes.length; i++) {
        var route = routes[i];
        $routeProvider.when('/'+route.route, {
            templateUrl: route.templateUrl,
            controller: route.controller,
            controllerAs: route.controller
        });
    }
    $routeProvider.otherwise({
        redirectTo: '/404'
    });
}]);



app.factory('app.config',[function(){
    this.apiurl = "http://localhost/~lecomte/projetSilexFete/";
    return this;
}]);
