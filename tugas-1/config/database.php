<?php

$hostname = "localhost";
$user = "root";
$password = "";
$db_name = "kul_db_web1";

try {
    $conn = mysqli_connect($hostname, $user, $password, $db_name);
} catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
    echo ' <small><a href="config/create_db.php" class="btn btn-outline-success float-right" onclick="return confirm(`Are you sure?`);">Buat Database</a></small>';
}
?>