<?php 

session_start(); 

  

// Check if the user is logged in 

if (!isset($_SESSION['username'])) { 

    // User is not logged in, redirect back to login.php 

    header("Location: login.php"); 

    exit(); 

} 

  

// Get the username from the session 

$username = $_SESSION['username']; 

  

// Display the welcome message 

echo "Welcome, $username!"; 

?> 