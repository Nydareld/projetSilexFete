app.factory('app.images', ['$http', function($http) {

    var categories = 'http://fete.lc/api/image/categories';
    var category = 'http://fete.lc/api/images/category';

    this.getCategoriesList = function(){
        return $http({
            method: 'GET',
            url: categories
        });
    };

    this.getCategory = function(catergoryName){
        return $http({
            method: 'GET',
            url: category+'/'+catergoryName
        });
    };

    return this;

}]);
