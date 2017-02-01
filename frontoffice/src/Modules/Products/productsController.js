app.controller('productsController', ['$scope','app.products',function($scope,service){
    var me = this;
    me.reloadProducts = function(){
        service.cget().then(function(res){
            $scope.products = res.data.data;
        });
    }
    me.reloadProducts();

}]);
