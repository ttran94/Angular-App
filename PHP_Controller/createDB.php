<?php

include 'Info.php';
try {
    $con = new PDO($cb,$user,$pass);
    $db = "`".str_replace("`","``",$db)."`";
    echo $db;
    $sql = "CREATE DATABASE IF NOT EXISTS $db";
    $con->exec($sql);
    echo "DATABASE CREATED SUCCESSFULLY";
} catch(PDOException $e) {
    echo "<br>" . $e->getMessage();
}
?>