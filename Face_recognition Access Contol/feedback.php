<?php
// Database connection
    $servername = "127.0.0.1";
    $username = "srush";
    $password = "Sakshi@123";
    $dbname = "travel";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3308);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Check if the email exists in the database
    $sql = "SELECT * FROM register WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email exists, update subject and message
        $sql_update = "UPDATE register SET subject = '$subject', message = '$message' WHERE email = '$email'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Record updated successfully";
            header("Location: index1.html");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Email doesn't exist, insert a new record
        $sql_insert = "INSERT INTO register (email, subject, message) VALUES ('$email', '$subject', '$message')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
