<?php

header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Origin: *");

$host = "localhost";
$db_user = "root";
$db_pass = null;
$db_name = "airlinedb";

$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die( $mysqli->connect_error);
}
?>