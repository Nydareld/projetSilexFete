app.factory('app.images', ['$http', function($http) {

    var categoriesURL = 'http://fete.lc/api/images/categories';
    var categoryURL = 'http://fete.lc/api/images/category';
    var postImageURL = 'http://fete.lc/api/images';

    this.getCategoriesList = function(){
        return $http({
            method: 'GET',
            url: categoriesURL
        });
    };

    this.getCategory = function(catergoryName){
        return $http({
            method: 'GET',
            url: categoryURL+'/'+catergoryName
        });
    };

    this.save = function(image){
        return $http({
            method: 'POST',
            url: postImageURL,
            data : image
        });
    }

    return this;

}]);
