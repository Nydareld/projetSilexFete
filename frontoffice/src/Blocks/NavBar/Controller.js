app.controller('Block.NavBar.Controller', ['$scope','$location',function($scope,$location){
    $scope.getClass = function (path) {
        if(path == "home"){
            return ($location.path() === "/") ? 'active' : '';
        }
        return ($location.path().substr(0, path.length) === path) ? 'active' : '';
    }
}]);
