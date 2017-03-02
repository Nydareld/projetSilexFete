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
            if ($scope.categories[0]) {
                $scope.setCurrentCategory($scope.categories[0].name);
            }
            else {
                $scope.setCurrentCategory("_");
            }

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
        $scope.imageToSet = true;
        $scope.newImage = {
            name : null,
            description : null,
            category : null,
            path : null,
            creator : null,
            image: {
                name : null
            }
        }
    }
    $scope.pathChange = function(path){
        if(path != "" || path != null){
            $scope.imageToSet = false;
        }else if($scope.newImage.image.name == "" || $scope.newImage.image.name == null ){
            $scope.imageToSet = true;
        }
    }
    $scope.uploadChange = function(name){
        if(name != "" || name != null){
            $scope.imageToSet = false;
        }else if($scope.newImage.path == "" || $scope.newImage.path == null ){
            $scope.imageToSet = true;
        }
    }
    $scope.setCurrentCategory = function(categoryName){
        $scope.current = categoryName;
        if(!$scope.currentData){
            $scope.currentData = {};
        }
        service.getCategory(categoryName).then(function(res){
            $scope.currentData[categoryName] = res.data.data;
        });
        me.verifySelected($scope.currentData[categoryName]);
    }
    me.verifySelected = function(images){
        if(me.product){
            images.forEach(function(image){
                image.selected = false;
                me.product.images.forEach(function(imageProduct){
                    if (image.id == imageProduct.id) {
                        image.selected = true;
                    }
                });
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

    $scope.$on('selectImages',function(e,product) {
        me.product = product;
        me.verifySelected($scope.currentData[$scope.current]);
    });


    me.refreshCategory();

    return me;
}]);
