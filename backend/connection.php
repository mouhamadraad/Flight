<?php

header("Access-Control-Allow-Origin: *"); // Allowing requests from any origin
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$host = "localhost";
$db_user = "root";
$db_pass = ""; // Using an empty string for the password
$db_name = "airlinedb";

// Using object-oriented style for MySQLi
$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>
