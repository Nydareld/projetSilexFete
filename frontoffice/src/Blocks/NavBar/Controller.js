app.controller('Block.NavBar.Controller', ['$scope',function($scope){

    var me = this;

    me.openSettings = function(){
        $scope.$emit('PUSH_OPEN_SETTING_BUTTON');
    }
}]);
