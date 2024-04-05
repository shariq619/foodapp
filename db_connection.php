<?php

// $servername = "localhost";
// $username = "sxraobako62b_foodappuser";
// $password = "2FHxQ7!rfUV5";
// $dbname = "sxraobako62b_foodapp";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
