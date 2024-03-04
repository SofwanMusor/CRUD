<?php
include_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before saving to the database
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert data into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashedPassword]);

    $response = ['message' => 'success'];
    echo json_encode($response);
} else {
    $response = ['message' => 'error'];
    echo json_encode($response);
}
?>
