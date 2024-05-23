<?php
// Connection details
$host = "localhost";
$user = "uwera";
$pass = "ruth";
$database = "virtual_time_management_training_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>