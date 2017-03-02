app.controller("Block.SettingSideBar.Controller", ["$scope",function($scope){

    $scope.opened = false;

    $scope.switchOpened=function(){
        $scope.opened = !$scope.opened;
    };
    $scope.$on("OPEN_SETTING", function (event) {
        $scope.switchOpened();
    });

}]);
