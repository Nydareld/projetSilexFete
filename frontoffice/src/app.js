var app = angular
  .module('greenTeufFrontOffice', [
    'ngResource',
    'ngRoute',
    'ngAnimate',
    'ngTouch',
    'ngSanitize',
    'ui.bootstrap',
    'textAngular'
]);

app.controller('MainController', ['$scope', function($scope){

    $scope.$on('PUSH_OPEN_SETTING_BUTTON', function (event) {
        $scope.$broadcast('OPEN_SETTING');
    });

}]);
