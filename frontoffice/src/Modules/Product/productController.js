app.controller('productController', ['$scope','app.products','$routeParams',function($scope,service,$routeParams){
    var me = this;
    me.loadProduct = function(id){
        $scope.productId=id;
        service.get(id).then(function(res){
            $scope.product = res.data.data;
        });
    }

    $scope.comment = function(){
        $scope.newComment = {
            pseudo : null,
            text : null
        };
    }

    $scope.saveComment = function(comment){
        service.comment($scope.productId,comment).then(function(res){
            me.loadProduct($scope.productId);
        });
    }

    me.loadProduct($routeParams.ID);
}]);
