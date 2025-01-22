<?php
require_once "../database/db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $residence = $_POST['residence'];
    $dob = $_POST['dob'];
    $marital_status = $_POST['marital_status'];
    $occupation = $_POST['occupation'];
    $telephone = $_POST['telephone'];
    $zone_id = $_POST['zone'];
    $ministry = $_POST['ministry'];

    // Handle departments as an array
    $departments = isset($_POST['departments']) ? implode(", ", $_POST['departments']) : '';

    // Query to update member data
    $query = "UPDATE members SET name = ?, gender = ?, residence = ?, DoB = ?, marital_status = ?, ocupation = ?, telephone = ?, zone_id = ?, ministry = ?, departmnent = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssssi", $name, $gender, $residence, $dob, $marital_status, $occupation, $telephone, $zone_id, $ministry, $departments, $id);

    if ($stmt->execute()) {
        header('location: ../index.php');
    } else {
        echo "Error updating member: " . $stmt->error;
    }
}
