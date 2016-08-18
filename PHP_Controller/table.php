<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//echo json_encode($sessions);
include 'global.php';
include 'Info.php';

try {
    $con = new PDO($dsn, $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $post = file_get_contents('php://input');
    $data = json_decode($post);
    $user_id = safe_input($data->userId,"");
    $query = "Select * from task WHERE `task_id` = :userId";
    $sql = $con->prepare($query);
    $sql->bindParam(':userId', $user_id, PDO::PARAM_STR);
    $sql->execute();
    $result = $sql->fetchALL(PDO::FETCH_ASSOC);
    $count = $sql->rowCount();
    print json_encode($result);
} catch(PDOException $e) {
    echo $e->getMessage() . "</br>";
}

?>