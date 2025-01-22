<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $code = $_POST['code'];

    if ($code === "Cem@2024") {
        header('Location: ../signup.php');
        exit();
    } else {
        header('Location: ../signin.php');
        exit();
    }
}
