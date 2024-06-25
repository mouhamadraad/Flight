<?php

include('connection.php');
include('config.php');

$UserID = isset($_POST['UserID']) ? $_POST['UserID'] : '';
$coinsAmount = isset($_POST['coinsAmount']) ? $_POST['coinsAmount'] : '';
$ApprovalStatus = 'Pending';
$requestDate = date('Y-m-d H:i:s'); // Current date and time

$query = $mysqli->prepare('INSERT INTO coinsrequest (UserID, coinsAmount, requestDate, ApprovalStatus) VALUES (?,?,?,?)');
$query->bind_param('iiss', $UserID, $coinsAmount, $requestDate, $ApprovalStatus);

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

?>
