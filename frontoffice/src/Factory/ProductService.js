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
    }
    return this;

}]);
