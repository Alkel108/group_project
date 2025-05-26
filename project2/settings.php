<?php

$host = "localhost";         // because XAMPP runs the server locally
$user = "root";          // default username for XAMPP's MySQL
$pwd = "";             
$sql_db = "part_2";  // replace with the actual name of  database



$conn = mysqli_connect($host, $user, $pwd, $sql_db );

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>