<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//echo json_encode($sessions);
include 'global.php';
include 'Info.php';

try {
    $con = new PDO($dsn, $user, $pass);
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $post =  file_get_contents('php://input');
    $data = json_decode($post);
    $username = safe_input($data->username,"");
    $password = safe_input($data->password,"");
    $query = "Select * from users WHERE `user_name` = :user AND `user_pass` = :pass";
    $sql = $con->prepare($query);
    $sql->bindParam(':user', $username, PDO::PARAM_STR);
    $sql->bindParam(':pass', $password, PDO::PARAM_STR);
    $sql->execute();
    $result = $sql->fetchALL(PDO::FETCH_ASSOC);
    $count = $sql->rowCount();
    if($count >= 1) {
        $result[0]['status'] = "allowed";
    } else {
        $result[0]['status'] = "denied";
    }
    print json_encode($result);
} catch(PDOException $e) {
    echo $e->getMessage() . "</br>";
}

?>