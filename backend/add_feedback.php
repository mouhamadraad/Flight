<?php

include('connection.php');

$UserID = $_POST['UserID'];
$FlightID = $_POST['FlightID'];
$reviewText = $_POST['reviewText'];
$rating = $_POST['rating'];

$query = $mysqli->prepare('INSERT INTO flightreviews (UserID, FlightID, reviewText, rating) VALUES (?,?,?,?)');

$query->bind_param('iisi', $UserID, $FlightID, $reviewText, $rating);

$response = [];

if ($query->execute()) {
    $response['success'] = true;
    $response['message'] = "Feedback added";
} else {
    $response['success'] = false;
    $response['message'] = "Error, Feedback not added";
}

echo json_encode($response);

$mysqli->close();
