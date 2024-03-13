<?php
// Initialize the session
session_start();
 
// Unset the session variable for msg
unset($_SESSION['msg']);
 
// Redirect to welcome page
header("location: welcome.php");
exit;
?>
