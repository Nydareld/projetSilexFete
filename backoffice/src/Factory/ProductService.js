app.factory('app.products', ['$http', "app.config", function($http,config){
    var url = config.apiurl+'/api/product';

    this.cget = function(){
        return $http({
            method: 'GET',
            url: url
        });
    };
    this.get = function(id){
        return $http({
            method: 'GET',
            url: url+'/'+id
        });
    };
    this.save = function(product){
        if (product.id) {
            return $http({
                method: 'PUT',
                url: url+'/'+product.id,
                data : product
            });
        }else {
            return $http({
                method: 'POST',
                url: url,
                data : product
            });
        }
    }

    return this;

}]);
