<?php
session_start();
unset($_SESSION["admin"]);
unset($_SESSION["admin_name"]);
session_destroy();
header("Location: ../signin.php");
exit();
