<?php

//learn from w3schools.com
//Unset all the server side variables

session_start();
if (!isset($_SESSION['admin'])) {
    // Redirect back to login page if verification code is not set
    header('Location: signin.php');
    exit();
}
