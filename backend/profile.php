<?php
include 'connection.php';

$response = array();

// API to send a picture of the user to the database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $image = $_FILES["image"]["tmp_name"];
    $image_data = addslashes(file_get_contents($image)); // Addslashes to escape special characters

    $response = array();

    $query = $mysqli->prepare("INSERT INTO users (image) VALUES (?)");
    $query->bind_param('s', $image_data);

    if ($query->execute()) {
        $response["status"] = "success";
        $response["message"] = "Image uploaded successfully.";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error uploading image: " . $mysqli->error;
    }
} else {
    $response["status"] = "error";
    $response["message"] = "Please select an image to upload.";
}

echo json_encode($response);
?>
