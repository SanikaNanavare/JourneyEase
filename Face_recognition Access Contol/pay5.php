<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $allowed_types = array("image/jpeg", "image/png", "image/gif");
        // Check if the uploaded file type is allowed
        if (in_array($_FILES["file"]["type"], $allowed_types)) {
            // Get the temporary file name of the uploaded file
            $temp_name = $_FILES["file"]["tmp_name"];
            // Read the uploaded file content
            $img_content = file_get_contents($temp_name);
            
            // Database connection details
            $servername = "127.0.0.1";
            $username = "srush";
            $password = "Sakshi@123";
            $db_name = "travel";
            
            // Connect to your database
            $conn = new mysqli($servername, $username, $password, $db_name, 3308);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO register (picture) VALUES (?)");
            $stmt->bind_param("b", $img_content);
            
            // Execute the statement
            if ($stmt->execute() === TRUE) {
                echo "Image uploaded successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            // Close the statement and connection
            $stmt->close();
            $conn->close();
        } else {
            echo "Error: Only JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "Error: " . $_FILES["file"]["error"]; // Print the file upload error code
    }
} else {
    echo "Error: Form not submitted.";
}
?>
