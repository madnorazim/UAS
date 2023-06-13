<?php 

$allowedUsernames = array("john", "jane", "jake"); 

$allowedPasswords = array("password1", "password2", "password3"); 

  

session_start(); 

  

// Function to sanitize and validate input 

function sanitizeInput($input) { 

  

    // Trim leading and trailing white spaces 

$input = preg_replace('/^\s+|\s+$/', '', $input); 

  

// Remove backslashes 

$input = str_replace('\\', '', $input); 

  

// Remove special characters 

$input = preg_replace('/[^\w\s]/', '', $input); 

  

  

    // Return the sanitized input 

    return $input; 

} 

  

// Check if the form is submitted 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    // Retrieve and sanitize the submitted username and password 

    $username = sanitizeInput($_POST["username"]); 

    $password = sanitizeInput($_POST["password"]); 

  

    // Store the sanitized input in the session 

    $_SESSION['sanitizedInput'] = 'This is sanitized input: Username - ' . $username . ', Password - ' . $password; 

  

    // Check if the username and password are in the whitelist and pass sanitization 

    if (in_array($username, $allowedUsernames) && in_array($password, $allowedPasswords)) { 

        // Sanitization and validation passed, redirect to welcome.php 

        $_SESSION['username'] = $username; 

        header("Location: welcome.php"); 

        exit(); 

    } else { 

        // Username or password is not in the whitelist or did not pass sanitization, set error message in session 

        $_SESSION['error'] = "Invalid username or password. Please try again."; 

        header("Location: login.php"); 

        exit(); 

    } 

} 

?> 

  

<!DOCTYPE html> 

<html> 

<head> 

  <title>Login Page</title> 

</head> 

<body> 

  <h2>Login</h2> 

  

  <?php 

  session_start(); 

  if (isset($_SESSION['error'])) { 

      echo "<p>" . htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') . "</p>"; 

      unset($_SESSION['error']); 

  } 

  ?> 

  

  <form action="register.php" method="POST"> 

    <div> 

      <label for="username">Username:</label> 

      <input type="text" id="username" name="username" required> 

    </div> 

    <div> 

      <label for="password">Password:</label> 

      <input type="password" id="password" name="password" required> 

    </div> 

    <div> 

      <input type="submit" value="Login"> 

    </div> 

  </form> 

</body> 

</html> 