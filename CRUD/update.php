<?php
include_once 'connect.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $name = $_POST["Name"];
    $age = $_POST["Age"];
    $tel = $_POST["Tel"];

    // Update data in the database
    $sql = "UPDATE registrations SET Name = :name, Age = :age, Tel = :tel WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":age", $age);
        $stmt->bindParam(":tel", $tel);
        
        $stmt->execute();

        // Return a success message
        echo "Data updated successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>