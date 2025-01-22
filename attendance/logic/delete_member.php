<?php
require_once "../database/db_connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to delete member data
    $query = "DELETE FROM members WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('location: ../index.php');
    } else {
        echo "Error deleting member: " . $stmt->error;
    }
}
