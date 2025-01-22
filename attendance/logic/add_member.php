<?php
require_once "../database/db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $residence = $_POST['residence'];
    $dob = $_POST['dob'];
    $marital_status = $_POST['marital_status'];
    $occupation = $_POST['occupation'];
    $telephone = $_POST['telephone'];
    $zone_id = intval($_POST['zone']); // Ensure zone_id is an integer
    $ministry = $_POST['ministry'];
    $departments = isset($_POST['departments']) ? implode(", ", $_POST['departments']) : '';

    // Query to insert new member data with corrected column name "departmnent"
    $query = "INSERT INTO members (name, gender, residence, DoB, marital_status, ocupation, telephone, zone_id, ministry, departmnent) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    // Bind parameters: 9 strings and 1 integer (zone_id)
    $stmt->bind_param("ssssssssss", $name, $gender, $residence, $dob, $marital_status, $occupation, $telephone, $zone_id, $ministry, $departments);

    if ($stmt->execute()) {
        header('location: ../index.php');
    } else {
        echo "Error adding new member: " . $stmt->error;
    }
}
