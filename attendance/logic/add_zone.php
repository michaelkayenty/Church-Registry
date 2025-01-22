<?php
require_once "../database/db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $admi_id = $_POST['admi_id'];

    // Query to insert new zone data
    $query = "INSERT INTO zone (name, location, admi_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $name, $location, $admi_id);

    if ($stmt->execute()) {
        header('location: ../zoneList.php'); // Redirect to a list of zones or another relevant page
    } else {
        echo "Error adding zone: " . $stmt->error;
    }
}
