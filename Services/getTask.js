angular.module("App").factory("getList", function($http, $q){
    var doList;
    var defer = $q.defer();
    function getTask(taskId) {
        return $http({
            method:"POST",
            url: 'PHP_Controller/table.php',
            data: {
                'userId':taskId
            },
            headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
        }).then(function(response){
            doList = response.data;
            console.log(response.data);
            return doList;
        },function(error){
            defer.reject(error);
        });
    }


    function toDo() {
        return doList;
    }

    return {
        toDo : toDo,
        getTask : getTask
    }
});