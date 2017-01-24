app.factory('app.products', ['app.resource', function(ressource) {
    var url = 'http://fete.lc/api/product';

    this.cget = function(){
        return ressource(url, {}, "GET");
    };
    this.get = function(id){
        return ressource(url+'/'+id, {}, "GET");
    };

    return this;

}]);
