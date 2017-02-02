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

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
