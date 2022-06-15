<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","eshop");

    if(!$conn){
        echo "Connected" ;
    }
?>