<?php
// Start session
session_start();

// Destroy session data
session_unset();
session_destroy();

// Redirect to login page or any other appropriate page
header("Location: login.php");
exit;
?>