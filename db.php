<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "society_management";

$conn = new mysqli($host, $user, $pass, $dbname,3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
