<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $gender = $_POST["gender"];

    if (empty($name) || empty($email) || empty($password) || empty($gender)) {
        $response["status"] = "error";
        $response["message"] = "Please fill out all fields.";
        echo json_encode($response);
        exit;
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_user = $mysqli->prepare('SELECT email FROM users WHERE email=?');
    $check_user->bind_param('s', $email);
    $check_user->execute();
    $check_user->store_result();
    $user_exists = $check_user->num_rows();

    if ($user_exists > 0) {
        $response["status"] = "error";
        $response["message"] = "email already exists.";
    } else {
        $query = $mysqli->prepare('INSERT INTO users (name, email, password, gender) VALUES (?, ?, ?, ?)');
        $query->bind_param('ssss', $name, $email, $hashed_password, $gender);
        $query->execute();
    
        $response['status'] = "success";
        $response['message'] = "User $email was created successfully.";
    }
    
    echo json_encode($response);
}