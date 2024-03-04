<?php
include_once 'connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID to delete
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Delete data from the database
        $stmt = $pdo->prepare("DELETE FROM registrations WHERE id = ?");
        $stmt->execute([$id]);

        // Return a success message
        $response = ['message' => 'Data deleted successfully'];
        echo json_encode($response);
    } else {
        // Return an error message
        $response = ['message' => 'Invalid request'];
        echo json_encode($response);
    }
} else {
    // Return an error message
    $response = ['message' => 'Error getting registration'];
    echo json_encode($response);
}
?>




