<?php

include('connection.php');

$UserID = isset($_POST['UserID']) ? $_POST['UserID'] : '';
$coinsAmount = isset($_POST['coinsAmount']) ? $_POST['coinsAmount'] : '';
$ApprovalStatus = 'Pending';

$query = $mysqli->prepare('INSERT INTO coinsrequest (UserID, coinsAmount, ApprovalStatus) VALUES (?,?,?)');

$query->bind_param('iis', $UserID, $coinsAmount, $ApprovalStatus);

$response = [];

if ($query->execute()) {
    $response['success'] = true;
    $response['message'] = "Request sent";
} else {
    $response['success'] = false;
    $response['message'] = "Error, Request failed";
}

echo json_encode($response);

$mysqli->close();
