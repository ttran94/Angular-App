
var app = angular.module("App",['ngRoute','ngAnimate']);

app.config(function ($routeProvider) {
    $routeProvider.when("/login", {
        templateUrl : "template/login.html"
    }).when("/register", {
        templateUrl : "template/register.html"
    }).when("/",{
        templateUrl : "template/home.html",
        resolve: {
            auth: function ($q, Auth) {
                var userId = Auth.getUser();
                console.log(userId);
                if (userId) {
                    if (userId.Token == "allowed") {
                        return $q.when(userId);
                    } else if(userId.Token == "denied") {
                        return $q.reject({authentication: "denied"});
                    }
                } else {
                    return $q.reject({authentication: "denied"});
                }
            }
        }
    });
});


app.controller('form_register', function($scope, $location, $q, Registration){
    
    $scope.registered = function() {
        Registration.register($scope.username, $scope.password, $scope.email).then(function(response){
            response = Registration.getAccess();
            if(response.Token== "success"){
                $location.path('/login');
            } else if(response.Token == "failed") {
                $scope.registerError = response.Error;
                console.log(response.Token);
            }
        },function (error) {
            $scope.registration = "";
            $scope.registerError = "Oops, There is something wrong with the server"
        });
    };
});

app.run(function($rootScope, $location){
    $rootScope.$on("$routeChangeSuccess", function (userId) {
        $rootScope.todoList = "";
       if(userId.Token == "denied") {
           location.path("/login");
       }
    });
    $rootScope.$on("$routeChangeError", function(event, current, previous, obj){
        if(obj.authentication == "denied"){
            $location.path("/login");
        }
    });
});

app.controller('form_login', function($scope, $route, $window, $location, $http, Auth, getList){
    $scope.authUsername = false;
    $scope.authPassowrd = false;
    $scope.submitted = false;
    $scope.submit = function() {
        $scope.submitted = true;
    };
    $scope.IsError = function(field, validation) {
        return ($scope.submitted && $scope.loginForm[field].$error[validation]);
    };
    $scope.userId = null;
    $scope.login = function() {
        Auth.login($scope.username, $scope.password).then(function(response) {
            if(response.Token == "denied") {
                $scope.loginError = "Username/Email is incorrect.";
            } else {
                $location.path('/');
            }
        }, function(error){
            $scope.loginError = "Username/Email is incorrect.";
            console.log(error);
        });
    };
});

app.controller('homeController', function($scope, $http, $location, addTask, $q, getList,removeTask, Auth){
    var canceler = $q.defer();
    var getTas = addTask.getTask();
    canceler.reject(getTas);
    $scope.logout = function() {
        Auth.Logout();
        $scope.todoList = [];
        $location.path('/login');
    };


    var getID = Auth.getUser().ID;
    $scope.userD = Auth.getUser().ID;
    $scope.todoList =  [];
    getList.getTask(getID).then(function(response){
        var adder = response;
        $scope.todoList.push(adder);

    });
    

    $scope.todoAdd = function() {
        if(($scope.taskMessage != "") && ($scope.taskTitle != "")) {
            addTask.addItem(getID, $scope.taskTitle, $scope.taskMessage).then(function (response) {
                $scope.todoList[0].push({
                    task_id: getID,
                    task_message: $scope.taskMessage,
                    task_title: $scope.taskTitle,
                    unique_id : response.Error.unique
                });
                $scope.taskTitle = "";
                $scope.taskMessage = "";
                console.log($scope.todoList);

            });
            canceler.reject(getTas);
        }
        if(($scope.taskMessage != "") && ($scope.taskTitle != "")) {
            console.log(true);
        }
    };
    

    $scope.remove = function(index) {
        removeTask.getTask($scope.todoList[0][index].unique_id).then(function(response){
            $scope.todoList[0].splice(index, 1);
            console.log(response);
        });

    };
});



