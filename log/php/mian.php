<?php
    echo '<pre>';
    include './mysql.php';
    $check = $_GET["check"];
    print_r($check);
    $Mysql = new Mysql();
    $Mysql->$check($_POST);
?>