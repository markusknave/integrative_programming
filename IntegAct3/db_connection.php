<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = "integdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die('Could not Connect MySql Server:' . $conn -> connect_error);
    }
?>