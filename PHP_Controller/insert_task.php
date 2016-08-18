<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
//echo json_encode($sessions);
include 'global.php';
include 'Info.php';

try {
    $con = new PDO($dsn, $user, $pass);
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $post =  file_get_contents('php://input');
    $data = json_decode($post);
    $task_id = safe_input($data->taskId,"");
    $task_message = safe_input($data->TaskTitle,"");
    $task_title = safe_input($data->taskMessage,"");
    $query = "INSERT INTO `task` (`task_message`, `task_title`,`task_id`) VALUES (:task_message,:task_title,:task_id)";
    $sql = $con->prepare($query);
    $sql->bindParam(':task_id', $task_id, PDO::PARAM_STR);
    $sql->bindParam(':task_message', $task_message, PDO::PARAM_STR);
    $sql->bindParam(':task_title', $task_message, PDO::PARAM_STR);
    if($sql->execute()) {
        $result[0]['status'] = "success";
        $result[0]['unique'] = $con->lastInsertId();
    } else {
        $result[0]['status'] = "failed";
    }
    print json_encode($result);
} catch(PDOException $e) {
    echo $e->getMessage() . "</br>";
}

?>