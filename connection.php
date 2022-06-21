<?php

//database connection

$servername = "localhost";
$username = "root";
$password = "";
$db = "e-banking";

$conn = mysqli_connect($servername,$username,$password,$db);

if(!$conn){
    die("failed to connect ". mysqli_connect_error());
}

?>