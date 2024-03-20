<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["send_message"])) {
        if (isset($_POST["UserID"]) && isset($_POST["message"])) {
            $userID = $_POST["UserID"];
            $message = $_POST["message"];

            $stmt = $mysqli->prepare("INSERT INTO messages (UserID, message) VALUES (?, ?)");
            $stmt->bind_param("is", $userID, $message);

            $response = array();
            if ($stmt->execute()) {
                $response['status'] = "Message sent";
            } else {
                $response['status'] = "Message failed to send";
            }

            echo json_encode($response);
        }
        
    } elseif (isset($_POST["get_messages"])) {
        if (isset($_POST["UserID"])) {
            $userID = $_POST['UserID'];

            $stmt = $mysqli->prepare("SELECT * FROM messages WHERE UserID = ?");
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $messages = array();
            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
            echo json_encode($messages);
        } else {
            echo json_encode(array("status" => "Error", "message" => "UserID is required"));
        }
    } else {
        echo json_encode(array("status" => "Error", "message" => "No valid action specified"));
    }
} else {
    echo json_encode(array("status" => "Error", "message" => "Invalid request method"));
}
?>
