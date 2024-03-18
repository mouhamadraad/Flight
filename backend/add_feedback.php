<?php

include('connection.php');

$UserID = isset($_POST['UserID']) ? $_POST['UserID'] : '';
$FlightID = isset($_POST['FlightID']) ? $_POST['FlightID'] : '';
$reviewText = isset($_POST['reviewText']) ? $_POST['reviewText'] : '';
$Rating = isset($_POST['Rating']) ? $_POST['Rating'] : '';

$query = $mysqli->prepare('INSERT INTO flightreviews (UserID, FlightID, reviewText, Rating) VALUES (?,?,?,?)');

$query->bind_param('iisi', $UserID, $FlightID, $reviewText, $Rating);

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
