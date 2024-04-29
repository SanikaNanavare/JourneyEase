<?php
session_start();
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your existing PHP code here
    $servername = "127.0.0.1";
    $username = "srush";
    $password = "Sakshi@123";
    $db_name = "travel";
    $conn = new mysqli($servername, $username, $password, $db_name, 3308);

    if ($conn->connect_error) {
        die("connection failed!");
    }

    // Assuming successful login, you may need to perform actual validation
    $username = $_POST['Username'];
    $password = $_POST['password'];

    // Validate the user against the database (replace with your actual validation logic)
    $sql = "SELECT * FROM register WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, redirect to index1.html
        $_SESSION['user'] = $username;  // Store the username in the session
        
        // Display a pop-up message
        echo '<script>alert("You have logged in successfully."); window.location.href = "index1.html";</script>';
        exit();
    } else {
        // Invalid credentials, set the error message
        $error_message = "Invalid username or password";
    }
} else {
    // Handle other cases or redirect
    $error_message = "Invalid request method.";
}

// Store the error message in the session
$_SESSION['error_message'] = $error_message;
header("Location: login.html");
exit();
?>
