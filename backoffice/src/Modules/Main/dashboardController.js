app.controller('dashboardController', ['$scope','$http','$filter','app.config',function($scope,$http,$filter,config){

    var me = this;

    me.reloadProps = function(){
        $http({
            method: 'GET',
            url: config.apiurl+"/api/proposal"
        }).then(function(res){
            $scope.proposals = res.data.data;
        });
    }

    $scope.delProp = function(id){
        $http({
            method: 'DELETE',
            url: config.apiurl+"/api/proposal/"+id
        });
    }

    me.reloadContact = function(){

    }

    me.reloadProps();
    me.reloadContact();

    return me;
}]);
