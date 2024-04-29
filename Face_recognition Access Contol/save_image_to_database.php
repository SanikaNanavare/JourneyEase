<?php
// Check if image data is sent
if(isset($_POST['image'])) {
    // Get the base64-encoded image data
    $image_data = $_POST['image'];

    // Remove the "data:image/jpeg;base64," from the base64 string
    $image_data = str_replace('data:image/jpeg;base64,', '', $image_data);
    $image_data = str_replace(' ', '+', $image_data);

    // Decode the base64-encoded image data
    $image_decoded = base64_decode($image_data);

    // Set the file path where you want to save the image on the server
    $file_path = 'uploads/'.uniqid().'.jpg'; // You can change the file format if needed

    // Save the image to the server
    file_put_contents($file_path, $image_decoded);

    // Now, you can save the file path to the database, or do whatever you want with the image data
    // Below is an example of how you can save the file path to a MySQL database

    // Database connection parameters
    $servername = "127.0.0.1";
    $username = "localhost";
    $password = "Sakshi@123";
    $db_name = "travel";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, 3308);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert the file path into the database
    $stmt = $conn->prepare("INSERT INTO register (picture) VALUES (?)");
    $stmt->bind_param("s", $file_path);

    // Execute the SQL statement
    if ($stmt->execute() === TRUE) {
        echo "Image saved to database successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If image data is not sent, return an error message
    echo "Error: Image data not received.";
}
?>
