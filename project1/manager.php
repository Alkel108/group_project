<?php

require_once('settings.php');
$conn = mysqli_connect($host, $user, $pwd, $sql_db);


$query = "SELECT * FROM `eoi`"

mysqli_query($conn, $query);

?>