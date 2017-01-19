app.controller('testController', ['$scope','app.testservice',function($scope,service){
    $scope.routes = service.get();
    console.log("céfé");
}]);
