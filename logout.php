<?php
// Destroy the session and redirect to the login page
session_start();
session_destroy();
header("Location: index.php");
exit();
?>
