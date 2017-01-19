app.factory('app.testservice', ['app.resource', function(ressource) {
    var url = 'http://localhost:4000/api/template'

    this.get = function(){
        return ressource(url, {}, "GET");
    }

    return this;

}]);
