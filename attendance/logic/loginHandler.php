<?php
session_start();
require_once '../database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password for security
    $hashed_password = md5($password); // You should consider using stronger hashing methods like bcrypt or Argon2

    // Prepare and execute the query
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$hashed_password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Authentication successful
        $_SESSION['admin'] = true;
        $_SESSION['admin_name'] = $username;
        header('location: ../index.php');
        exit();
    } else {
        // Authentication failed
        header('location: ../signin.php');
        exit();
    }
} else {
    // Redirect if accessed directly without POST request
    header('location: ../signin.php');
    exit();
}
