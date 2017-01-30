app.controller('imagesController', ['$scope','app.images','$filter',function($scope,service,$filter){

    var me = this;

    $scope.properties=[
        {
            name : "Nom",
            value : "name"
        },{
            name : "Description",
            value : "description"
        },{
            name : "Categorie",
            value : "category"
        },{
            name : "Lien",
            value : "path"
        },{
            name : "Créateur",
            value : "creator"
        },{
            name : "Date de création",
            value : "creationDate",
            render : function(value){
                return $filter('date')($filter('dateToISO')(value.date), 'dd/MM/yyyy HH:mm:ss',value.timezone);
            }
        }
    ];

    me.refreshCategory = function(){
        return service.getCategoriesList().then(function(res){
            $scope.categories = res.data.data;
            $scope.setCurrentCategory($scope.categories[0].name);
        });
    }
    me.addImage = function(image){
        me.refreshCategory().then(function(){
            $scope.setCurrentCategory(image.category);
        });
    }

    $scope.setNewImageCategory = function(category){
        $scope.newImage.category = category;
    }

    $scope.clearNewImage = function(){
        $scope.newImage = {
            name : null,
            description : null,
            category : null,
            path : null,
            creator : null
        }
    }
    $scope.setCurrentCategory = function(categoryName){
        $scope.current = categoryName;
        if(!$scope.currentData){
            $scope.currentData = {};
        }
        if(!$scope.currentData[categoryName]){
            service.getCategory(categoryName).then(function(res){
                $scope.currentData[categoryName] = res.data.data;
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

    $scope.addImage = function(newImage){
        service.save(newImage).then(function(res){
            me.addImage(res.data.data);
            angular.element('#addImage').modal('hide');
        });
    }

    me.refreshCategory();

    return me;
}]);
