<?php
require 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_depart = $_POST['id_depart'];
    $nam_depart = $_POST['nam_depart'];

    // Example query to update the department
    $sql = "UPDATE `departement` SET `nam_depart` = ? WHERE `id_depart` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $nam_depart, $id_depart);

    if ($stmt->execute()) {
        echo "Department updated successfully!";
    } else {
        http_response_code(500);
        echo "Failed to update department.";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(400);
    echo "Invalid request method.";
}
?>



