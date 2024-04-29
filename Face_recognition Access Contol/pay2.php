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
    if (isset($_POST['radio_val'])) {
        $busName = $_POST['radio_val'];

        // Prepare and bind statement
        $stmt = $conn->prepare("INSERT INTO register (bus_name) VALUES (?)");
        $stmt->bind_param("s", $busName);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "Selected bus name stored successfully";
            header("Location: pay3.html");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "No bus selected";
    }
}

$conn->close();
?>
