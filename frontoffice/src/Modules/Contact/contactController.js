app.controller('contactController', ['$scope','$http','$routeParams', 'app.config',function($scope,$http,$routeParams,config){
    var me = this;

    $scope.saveContact = function(contact){
        $http({
            method: 'POST',
            data:contact,
            url: config.apiurl+"/api/contact"
        }).then(function(res){
            me.reloadForm();
            toastr["info"]("Message envoyé");
        });
    }
    me.reloadForm=function(){
        $scope.contact = {
            "pseudo"  : null,
            "email" : null,
            "comment" : null
        }
    }
    me.reloadForm();

}]);
