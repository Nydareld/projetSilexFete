var app = angular
  .module('greenTeufBackOffice', [
    'ngResource',
    'ngRoute',
    'ngAnimate',
    'ngTouch',
    'ui.bootstrap',
    'bootstrap.fileField',
    'textAngular'
]);

app.controller('MainController', ['$scope', function($scope){

    $scope.$on('PUSH_OPEN_SETTING_BUTTON', function (event) {
        $scope.$broadcast('OPEN_SETTING');
    });

}]);
