angular.module("App").factory("Auth", function($http, $q, $window){
    var userId;
    function login(username, password) {
        var defer = $q.defer();
        $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
        $http({
            method:"POST",
            url: 'PHP_Controller/Conn_DB.php',
            data: {
                'username': username,
                'password': password
            },
            headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
        }).then(function(response){
            userId = {
                userName : response.data[0].user_name,
                Token : response.data[0].status,
                ID : response.data[0].user_id
            };
            $window.sessionStorage["userId"] = JSON.stringify(userId);
            defer.resolve(userId);
        }, function(error){
            defer.reject(error);
        });
        return defer.promise;
    }

    function Logout() {
        userInfo = null;
        $window.sessionStorage["userId"] = null;
    }

    function initialize() {
        if($window.sessionStorage["userId"]) {
            console.log($window.sessionStorage["userId"]);
            userId = JSON.parse($window.sessionStorage["userId"]);
        }
        console.log($window.sessionStorage["userId"]);
        console.log(userId);
    }
    initialize();

    function getUser() {
        return userId;
    }

    return {
        login: login,
        getUser: getUser,
        Logout : Logout
    };
});