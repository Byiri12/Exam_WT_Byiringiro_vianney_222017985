<?php
// Connection details
$host = "localhost";
$user = "vianney07";
$pass = "222017985";
$database = "crowd-voting_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Checking connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
