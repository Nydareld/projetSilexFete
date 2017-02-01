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
    this.comment = function(id,comment){
        return $http({
            method: 'POST',
            url: url+'/'+id+'/comment',
            data:comment
        });
    }
    return this;

}]);
