<?php
include("connection.php");
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["send_message"])) {
      if (isset($_POST["UserID"]) && isset($_POST["message"]) && isset($_POST["recipientID"])) {
          $userID = $_POST["UserID"];
          $message = $_POST["message"];
          $recipientID = $_POST["recipientID"];

          $stmt = $mysqli->prepare("INSERT INTO messages (UserID, recipientID, message) VALUES (?, ?, ?)");
          $stmt->bind_param("iis", $userID, $recipientID, $message);

          $response = array();
          if ($stmt->execute()) {
              $response['status'] = "Message sent";
          } else {
              $response['status'] = "Message failed to send";
          }

          echo json_encode($response);
      } else {
          echo json_encode(array("status" => "Error", "message" => "All fields (UserID, message, recipientID) are required"));
      }
  } elseif (isset($_POST["get_messages"])) {
      // Handle getting messages here
  } else {
      echo json_encode(array("status" => "Error", "message" => "No valid action specified"));
  }
} else {
  echo json_encode(array("status" => "Error", "message" => "Invalid request method"));
}

?>


