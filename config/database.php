<?php
    // error_reporting(0);

    session_start();

    require_once 'function.php';
    //error_reporting(0);
    $db = new mysqli("localhost" ,"root"," ","bicyclesql");

    // echo mysqli_connect_errno();

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    // echo "Connected successfully";
    
    
?>


