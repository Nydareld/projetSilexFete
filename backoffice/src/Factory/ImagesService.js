app.factory('app.images', ['$http', "app.config", function($http,config) {
    console.log(config.apiurl);
    var categoriesURL = config.apiurl+'/api/images/categories';
    var categoryURL = config.apiurl+'/api/images/category';
    var postImageURL = config.apiurl+'/api/images';

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
        var payload = new FormData();
        angular.forEach(image,function(value,key){
            payload.append(key,value);
        });

        return $http({
            method: 'POST',
            url: postImageURL,
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined},
            data : payload
        });
    }

    return this;

}]);
