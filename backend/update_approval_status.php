<?php
include('config.php'); // Include your database connection configuration

// Check if requestID and ApprovalStatus are set in $_POST
if (isset($_POST['requestID'], $_POST['ApprovalStatus'])) {
    $requestID = $_POST['requestID'];
    $newStatus = $_POST['ApprovalStatus'];

    // Prepare UPDATE statement for coinsrequest table
    $query = $con->prepare('UPDATE coinsrequest SET ApprovalStatus = ? WHERE requestID = ?');
    if (!$query) {
        $response['success'] = false;
        $response['message'] = "Prepare failed: (" . $con->errno . ") " . $con->error;
    } else {
        $query->bind_param('si', $newStatus, $requestID);

        // Execute the query
        if ($query->execute()) {
            if ($newStatus === "Accept") {
                // Prepare and execute additional query to update user's amount
                $updateCoinsQuery = $con->prepare('UPDATE users SET amount = amount + (SELECT coinsAmount FROM coinsrequest WHERE requestID = ?) WHERE UserID = (SELECT UserID FROM coinsrequest WHERE requestID = ?)');
                if (!$updateCoinsQuery) {
                    $response['success'] = false;
                    $response['message'] = "Prepare failed: (" . $con->errno . ") " . $con->error;
                } else {
                    $updateCoinsQuery->bind_param('ii', $requestID, $requestID);

                    if ($updateCoinsQuery->execute()) {
                        // Successfully updated user's amount
                        $response['success'] = true;
                        $response['message'] = "Approval status updated and user's amount updated";
                    } else {
                        // Handle failure to update user's amount
                        $response['success'] = false;
                        $response['message'] = "Error updating user's amount: " . $con->error;
                    }

                    $updateCoinsQuery->close();
                }
            } else {
                // No additional updates needed for other status changes
                $response['success'] = true;
                $response['message'] = "Approval status updated";
            }
        } else {
            // Handle query execution failure
            $response['success'] = false;
            $response['message'] = "Error updating approval status: " . $con->error;
        }

        // Close prepared statement
        $query->close();
    }
} else {
    // Handle case where requestID or ApprovalStatus is not set
    $response['success'] = false;
    $response['message'] = "Request ID or Approval Status not provided";
}

// Send JSON response back to client
header('Content-Type: application/json'); // Ensure JSON header
echo json_encode($response);

// Close database connection (if needed)
//$con->close(); // Uncomment if you need to close the connection
?>




