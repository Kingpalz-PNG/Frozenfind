<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db =  'frozenfind';

    $conn = mysqli_connect($host, $user, $pass, $db);

    //if($conn){
        //echo 'Database Tersambung';
    //}

    mysqli_select_db($conn, $db);

?>