app.controller('servicesController', ['$scope','$http','$routeParams', 'app.config',function($scope,$http,$routeParams,config){
    var me = this;

    $scope.saveProposal = function(proposal){
        $http({
            method: 'POST',
            data:proposal,
            url: config.apiurl+"/api/proposal"
        }).then(function(res){
            me.reloadForm();
            toastr["info"]("Message envoyé");
        });
    }
    me.reloadForm=function(){
        $scope.proposal = {
            "pseudo"  : null,
            "productName" : null,
            "comment" : null
        }
    }
    me.reloadForm();

}]);
