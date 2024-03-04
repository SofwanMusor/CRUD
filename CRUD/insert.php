<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connect.php';

    $name = $_POST['Name'];
    $age = intval($_POST['Age']); // Convert to integer
    $tel = $_POST['Tel'];

    try {
        $stmt = $pdo->prepare('INSERT INTO registrations (Name, Age, Tel) VALUES (?, ?, ?)');
        $stmt->execute([$name, $age, $tel]);
        echo json_encode(['message' => 'Registration successful']);
    } catch (PDOException $e) {
        echo json_encode(['message' => 'Registration failed']);
    }
}

?>
