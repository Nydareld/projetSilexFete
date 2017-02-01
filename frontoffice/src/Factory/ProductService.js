app.factory('app.products', ['$http', 'app.config', function($http, config) {
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
    }
    return this;

}]);
