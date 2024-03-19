<?php
include ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["UserID"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $accessibility = $_POST["accessibility"];
    $seat = $_POST["seat"];
    $assistance = $_POST["assistance"];

    if (empty($user_id) || empty($name) || empty($email) || empty($gender) || empty($accessibility) || empty($seat) || empty($assistance)) {
        $response["status"] = "error";
        $response["message"] = "Please fill out all fields.";
        echo json_encode($response);
        exit;
    }

    $update_user = $mysqli->prepare('UPDATE users SET name=?, email=?, gender=?, accessibility=?, seat=?, assistance=? WHERE UserID = ?');
    $update_user->bind_param('ssssssi', $name, $email, $gender, $accessibility, $seat, $assistance, $user_id);
    if ($update_user->execute()) {
        $response['status'] = "success";
        $response['message'] = "User $email was updated successfully.";
    } else {
        $response['status'] = "error";
        $response['message'] = "Failed to update user.";
    }
    echo json_encode($response);
    exit;
}
?>
