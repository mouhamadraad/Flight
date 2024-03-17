<?php
include 'connection.php'

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $response["status"] = "error";
        $response["message"] = "Please fill out all fields.";
        echo json_encode($response);
        exit;
    }

    $check_user = $mysqli->prepare('SELECT UserID, password FROM users WHERE email=?');
    $check_user->bind_param('s', $email);
    $check_user->execute();
    $check_user->store_result();

    if ($check_user->num_rows() == 0) {
        $response["status"] = "error";
        $response["message"] = "User with this email does not exist.";
        echo json_encode($response);
        exit;
}

$check_user->bind_result($userId, $hashed_password);
$check_user->fetch();

 if (password_verify($password, $hashed_password)) {
        $response["status"] = "success";
        $response["message"] = "Login successful.";
        $response["user_id"] = $userId;
    } else {
        $response["status"] = "error";
        $response["message"] = "Incorrect password.";
    }

    echo json_encode($response);
}