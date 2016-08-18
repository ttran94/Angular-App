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
    $username = safe_input($data->username,"");
    $password = safe_input($data->password,"");
    $email = safe_input($data->email,"");

    $query = "SELECT * from users WHERE `user_name` = :username";
    $sql = $con->prepare($query);
    $sql->bindParam(':username', $username, PDO::PARAM_STR);
    $sql->execute();
    if($sql->rowCount() >= 1) {
        $result[0]['status'] = "failed";
        $result[0]['msg'] = "Username already exists";
        print json_encode($result);
        exit();
    }
    $query = "INSERT INTO users (`user_name`,`user_pass`, `user_email`) VALUES (:username,:password,:email)";
    $sql = $con->prepare($query);
    $sql->bindParam(':username', $username, PDO::PARAM_STR);
    $sql->bindParam(':password', $password, PDO::PARAM_STR);
    $sql->bindParam(':email', $email, PDO::PARAM_STR);


    if($sql->execute()) {
        $result[0]['status'] = "success";
        $result[0]['msg'] = "Your account has been created.";
    } else {
        $result[0]['status'] = "failed";
        $result[0]['msg'] = "Something went wrong in the server.";
    }
    print json_encode($result);

} catch(PDOException $e) {
    echo $e->getMessage() . "</br>";
}

?>