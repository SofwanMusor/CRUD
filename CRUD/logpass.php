<?php
include_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the hashed password from the database based on the given username
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashedPasswordFromDB = $row['password'];

        // Verify the entered password with the hashed password from the database
        if (password_verify($password, $hashedPasswordFromDB)) {
            $response = ['message' => 'success'];
            echo json_encode($response);
        } else {
            $response = ['message' => 'error'];
            echo json_encode($response);
        }
    } else {
        $response = ['message' => 'error'];
        echo json_encode($response);
    }
} else {
    $response = ['message' => 'error'];
    echo json_encode($response);
}
?>
