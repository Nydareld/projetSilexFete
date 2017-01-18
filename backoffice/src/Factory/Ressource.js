app.factory('app.resource', ['$resource', 'app.keycloak', function($resource,keycloak) {

    var defaultTransformResponse = function(res, headersGetter) {
        var data = angular.fromJson(res);
        return data['data'];
    };

	var defaultActions = {
		query : {
            method: 'GET',
            isArray: true,
            transformResponse : defaultTransformResponse
        },
        create: {
            method: 'POST',
            transformResponse : defaultTransformResponse
        },
        update : {
            method: 'PUT',
            transformResponse : defaultTransformResponse
        },
        get : {
            method: 'GET',
            transformResponse : defaultTransformResponse
        },
        remove : {
            method: 'DELETE',
            transformResponse : defaultTransformResponse
        }
	};

	return function(url, paramDefaults, actions) {
    	var mixinActions = angular.merge({}, defaultActions, actions);
     	return $resource(url, paramDefaults, mixinActions);
  	}

}]);
