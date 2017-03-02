app.controller("dashboardController", ["$scope","$http","$filter","app.config",function($scope,$http,$filter,config){

    var me = this;

    me.reloadProps = function(){
        $http({
            method: "GET",
            url: config.apiurl+"/api/proposal"
        }).then(function(res){
            $scope.proposals = res.data.data;
        });
    };

    $scope.delProp = function(id){
        $http({
            method: "DELETE",
            url: config.apiurl+"/api/proposal/"+id
        });
    };

    me.reloadContact = function(){
        $http({
            method: "GET",
            url: config.apiurl+"/api/contact"
        }).then(function(res){
            $scope.contacts = res.data.data;
        });
    };

    $scope.delContact = function(id){
        $http({
            method: "DELETE",
            url: config.apiurl+"/api/contact/"+id
        });
    };

    me.reloadProps();
    me.reloadContact();

    return me;
}]);
