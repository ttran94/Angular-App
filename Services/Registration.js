angular.module("App").factory("Registration", function($http, $q) {
    var access = null;
    var defer = $q.defer();

    function register(username, password, email) {
        $http({
            method:"POST",
            url: 'PHP_Controller/registration.php',
            data: {
                'username':username,
                'password':password,
                'email':email
            },
            headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
        }).then(function(response){
            access = {
                Token: response.data[0].status,
                Error: response.data[0].msg
            };
            console.log(access);
            defer.resolve(access);
        },function(error){
            defer.reject(error);
        });
        return defer.promise;
    }

    function getAccess() {
        return access;
    }

    return {
        register : register,
        getAccess: getAccess
    }
});