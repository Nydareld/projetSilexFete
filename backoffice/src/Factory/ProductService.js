app.factory('app.products', ['$http', function($http) {
    var url = 'http://fete.lc/api/product';

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
