<?php

include 'Info.php';

$user_table = "CREATE TABLE IF NOT EXISTS `USERS`(
  `user_id` INT(255) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR (255) NOT NULL,
  `user_first` VARCHAR (255) NOT NULL,
  `user_last` VARCHAR (255) NOT NULL,
  `user_pass` VARCHAR (255) NOT NULL,
  `user_email` VARCHAR (255) NOT NULL,
  PRIMARY KEY (user_id)
)COLLATE ='utf8_bin'";

$task_table = "CREATE TABLE IF NOT EXISTS `TASK`(
  `unique_id` INT(255) NOT NULL AUTO_INCREMENT,
  `task_id` INT(255) NOT NULL,
  `task_title` VARCHAR (100) NOT NULL,
  `task_message` VARCHAR (255) NOT NULL,
  PRIMARY KEY (unique_id)
)COLLATE ='utf8_bin'";

try {
    $con = new PDO($dsn,$user,$pass);
    echo "Connected to database Successfully<br>";
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $con->exec($user_table);
    echo "User Table is Successfully created<br>";
    $con->exec($task_table);
    echo "Task Table is Successfully created<br>";

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>