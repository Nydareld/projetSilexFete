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
            "name" : "Products",
            "templateUrl" : "Modules/Products/Products.html",
            "route" : "produits",
            "controller": "productsController"
        },{
            "name" : "Product",
            "templateUrl" : "Modules/Product/Product.html",
            "route" : "produit/:ID",
            "controller": "productController"
        },{
            "name" : "Services",
            "templateUrl" : "Modules/Services/Services.html",
            "route" : "services",
            "controller": "servicesController"
        },{
            "name" : "Contact",
            "templateUrl" : "Modules/Contact/Contact.html",
            "route" : "contact",
            "controller": "contactController"
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
    this.apiurl = "http://fete.lc";
    return this;
}]);
