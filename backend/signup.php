<?php
include ('connection.php');
include ('config.php');
//store user information from signup into the DB
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
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

// Get and display userinfo depending on the ID
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {


    if (!isset($_GET['UserID'])) {
        $response = [
            'status' => 'error',
            'message' => 'UserID is missing'
        ];
        echo json_encode($response);
        exit;
    }

    $user_id = $_GET['UserID'];

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE UserID = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userInfo = [];
        while ($row = $result->fetch_assoc()) {
            $userInfo[] = $row;
        }
        $response = [
            'status' => 'success',
            'user_info' => $userInfo
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'No user found with the given ID'
        ];
    }

    echo json_encode($response);
}
