<?php

include('connection.php');

    $requestID = $_POST['requestID'];
    $newStatus = $_POST['ApprovalStatus'];

    $query = $mysqli->prepare('UPDATE coinsrequest SET ApprovalStatus = ? WHERE requestID = ?');
    $query->bind_param('si', $newStatus, $requestID);

    $response = [];

    if ($query->execute()) {
        if ($newStatus === "Accept") {
            $updateCoinsQuery = $mysqli->prepare('UPDATE users SET amount = amount + (SELECT coinsAmount FROM coinsrequest WHERE requestID = ?) WHERE UserID = (SELECT UserID FROM coinsrequest WHERE requestID = ?)');
            $updateCoinsQuery->bind_param('ii', $requestID, $requestID);
            
            if ($updateCoinsQuery->execute()) {
                $response['success'] = true;
                $response['message'] = "Approval status updated and user's amount updated";
            } else {
                $response['success'] = false;
                $response['message'] = "Error updating user's amount";
            }
        } else {
            $response['success'] = true;
            $response['message'] = "Approval status updated";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating approval status";
    }

echo json_encode($response);

$mysqli->close();
