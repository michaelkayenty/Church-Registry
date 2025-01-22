<?php
require_once "../database/db_connection.php";

if (isset($_GET['id'])) {
    $zone_id = $_GET['id'];

    // Delete the zone from the database
    $delete_query = "DELETE FROM zone WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $zone_id);

    if ($stmt->execute()) {
        header("Location: ../zoneList.php");
        exit();
    } else {
        echo "Error deleting zone: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
