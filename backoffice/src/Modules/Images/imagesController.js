app.controller('imagesController', ['$scope','app.images',function($scope,service){

    var me = this;

    me.refreshCategory = function(){
        service.getCategoriesList().then(function(res){
            $scope.categories = res.data.data;
            $scope.setCurrent($scope.categories[0].name);
        });
    }

    $scope.setCurrent = function(categoryName){
        $scope.current = categoryName;
        if(!$scope.currentData){
            $scope.currentData = {};
        }
        if(!$scope.currentData[categoryName]){
            service.getCategory(categoryName).then(function(res){
                $scope.currentData[categoryName] = res.data.data;
                console.log($scope.currentData[categoryName]);
            });
        }
    }

    $scope.setCurrentProduct = function(image){
        $scope.currentImage = image;
    }

    $scope.getClass = function(categoryName){
        if($scope.current == categoryName){
            return "active";
        }else {
            return "";
        }
    }

    me.refreshCategory();

    return me;
}]);
