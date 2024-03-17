<?php

include('connection.php');

$query = $mysqli ->prepare('SELECT * FROM flightreviews');

$query ->execute();

$query ->store_result();

$query ->bind_result($ReviewID, $UserID, $FlightID, $Rating, $reviewText, $reviewDate);

$response = [];

while ($query ->fetch()) {
    $news = [
        'ReviewID' => $ReviewID,
        'UserID' => $UserID,
        'FlightID' => $FlightID,
        'Rating' => $Rating,
        'reviewText' => $reviewText,
        'ReviewDate' => $reviewDate
    ];
    $response[] = $news;
}

echo json_encode($response);

$mysqli ->close();