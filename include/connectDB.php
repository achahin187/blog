<?php



$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'blog';
$conn = new mysqli($host, $user, $pass, $db);
if (!$conn) {
    echo 'Error!' . mysqli_error($conn);
}