<?php
session_start();
require_once '../database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telephone = mysqli_real_escape_string($conn, $_POST['phone']);


    // Hash the password for security
    $hashed_password = md5($password); // Again, consider using bcrypt or Argon2

    // Prepare and execute the query using prepared statements
    $query = "INSERT INTO admin (username, password, telephone, email) VALUES (?, ?, ?, ?)";
    $addAdmin = $conn->prepare($query);
    $addAdmin->bind_param("ssss", $username, $hashed_password, $telephone, $email);

    if ($addAdmin->execute()) {
        // Successfully added admin, redirect to index or login page
        $_SESSION['admin'] = true;
        header('Location: ../index.php');
        exit();
    } else {
        // Error occurred during insert
        echo 'Something went wrong during adding admin. Try again later.';
        exit();
    }

    $addAdmin->close();
} else {
    // Redirect if accessed directly without POST request
    header('location: ../signup.php');
    exit();
}

$conn->close();
