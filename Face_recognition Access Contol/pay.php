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
    $username = $_POST['username']; // Corrected from 'Username' to 'username'
    $destination = $_POST['destination'];
    $transportation_mode = $_POST['transportation_mode'];
    $datetime = $_POST['datetime'];

    // Validate the user against the database (replace with your actual validation logic)
    $sql = "SELECT * FROM register WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, redirect to index.html
        $_SESSION['user'] = $username;  // Store the username in the session
        $updateQuery = "UPDATE register SET destination='$destination', transportation_mode='$transportation_mode', datetime='$datetime' WHERE username='$username'";
        
        if ($conn->query($updateQuery) === TRUE) {
            // If the update query executed successfully, redirect to pay2.html
            header("Location: pay2.html");
            exit();
        } else {
            // If there was an error with the query, set the error message
            $error_message = "Error updating record: " . $conn->error;
        }
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
header("Location: pay.html");
exit();

?>
