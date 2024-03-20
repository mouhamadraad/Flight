<?php

include('connection.php');

$query = $mysqli ->prepare('SELECT * FROM coinsrequest');

$query ->execute();

$query ->store_result();

$query ->bind_result($requestId, $UserID, $coinsAmount, $requestDate, $ApprovalStatus);

$response = [];

while ($query ->fetch()) {
    $news = [
        'requestId' => $requestId,
        'UserID' => $UserID,
        'coinsAmount' => $coinsAmount,
        'requestDate' => $requestDate,
        'ApprovalStatus' => $ApprovalStatus
    ];
    $response[] = $news;
}

echo json_encode($response);

$mysqli ->close();