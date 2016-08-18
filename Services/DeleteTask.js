angular.module("App").factory("removeTask", function($http, $q){
    var msg;
    var defer = $q.defer();
    function getTask(taskId) {
        $http({
            method:"POST",
            url: 'PHP_Controller/DeleteTask.php',
            data: {
                'userId':taskId
            },
            headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
        }).then(function(response){
            msg = response.data;
            defer.resolve(msg);
        },function(error){
            defer.reject(error);
        });
        return defer.promise;
    }


    function getMsg() {
        return msg;
    }

    return {
        getMsg : getMsg,
        getTask : getTask
    }
});