<?php
// Initialize the session
session_start();

// Check if the user is an admin, if not, redirect to the login page
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("location: ../admin");
   
    exit;
}
?>