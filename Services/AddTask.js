angular.module("App").factory("addTask", function($http, $q){
    var taskId;
    var defer = $q.defer();
    function addItem(taskId, TaskTitle, taskMessage) {
        $http({
            method:"POST",
            url: 'PHP_Controller/insert_task.php',
            data: {
                'taskId':taskId,
                'TaskTitle' : TaskTitle,
                'taskMessage' : taskMessage
            },
            headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
        }).then(function(response){
            taskId = {
                Error: response.data[0].status
            };
            defer.resolve(taskId);
        },function(error){
            defer.reject(error);
        });
        return defer.promise;
    }


    function getTask() {
        return taskId;
    }

    return {
        getTask : getTask,
        addItem : addItem
    }
});
