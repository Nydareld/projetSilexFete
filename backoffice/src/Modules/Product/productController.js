app.controller('productController', ['$scope','app.products',function($scope,service){
    service.cget().query().$promise.then(function(data){
        console.log(data[0].name);
        $scope.products = data;
        for (product of $scope.products) {
            console.log(product.name);
        }
    });
}]);
