app.controller('productController', ['$scope','app.products','$filter',function($scope,service,$filter){

    var me = this;

    /**
     * recharge les produits de la liste
     * @method reloadProducts
     */
    me.reloadProducts = function(){
        service.cget().then(function(res){
            $scope.products = res.data.data;
        });
    }

    /**
     * Rafraichie le nombre de comentaires
     * @method reloadComentsCount
     */
    me.reloadComentsCount = function(){
        $scope.comments = 0;
        if($scope.products){
            for (var i = 0; i < $scope.products.length; i++) {
                $scope.comments += $scope.products[i].comments_count;
            }
        }
    }

    /**
     * Ajout une produit ou en met a jours un
     * @method addProduct
     * @param  product   product le produit a ajouter
     */
    me.addProduct = function(product){
        var oldProduct = $filter('getById')($scope.products,product.id);
        if(oldProduct){
            $scope.products.splice($scope.products.indexOf(oldProduct),1);
        }
        $scope.products.push(product);
    }

    /**
     * Reinitialise le produit de la modal
     * @method resetCurrentProduct
     */
    $scope.resetCurrentProduct = function(){
        $scope.modalProduct = {
            name :null,
            description :"",
            price :null
        };
    }

    /**
     * Attribue le produit de la modal
     * @method setCurrentProduct
     * @param  product          product Produit a editer dans la modal
     */
    $scope.setCurrentProduct = function(product){
        $scope.modalProduct = angular.copy(product);
    }

    /**
     * Sauvegarde un produit
     * @method saveProduct
     * @param  product    product le produit a sauvgarder
     */
    $scope.saveProduct = function(product){
        service.save(product).then(function(res){
            me.addProduct(res.data.data);
            angular.element('#ProductModal').modal('hide');
        });
    }

    $scope.addImageToProduct = function(image){
        if($scope.modalProduct){
            if (!$scope.modalProduct.images) {
                $scope.modalProduct.images = [];
            }
            if (image.selected) {
                $scope.modalProduct.images.splice($scope.modalProduct.images.indexOf(image));
                image.selected = false;
            }else {
                $scope.modalProduct.images.push(image);
                image.selected = true;
            }
        }
    }

    $scope.addImages = function(product){
        return $scope.$broadcast('selectImages',product);
    }

    $scope.$watch('products', function() { me.reloadComentsCount() }, true);

    me.reloadProducts();

    return me;
}]);
