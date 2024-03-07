<?php

$servername = "localhost"; // Change this if your database server is different
$username = "username"; // Replace with your database username
$password = "password"; // Replace with your database password
$dbname = "career_cruise_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$sql = "INSERT INTO job_applications (full_name, email, phone, position_applied_for, additional_message, resume_file_path)
VALUES (?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $fullName, $email, $phoneNumber, $positionAppliedFor, $additionalMessage, $resumeFilePath);

// Set parameters and execute
$fullName = $_POST["name"];
$email = $_POST["email"];
$phoneNumber = $_POST["phone"];
$positionAppliedFor = $_POST["position"];
$additionalMessage = $_POST["message"];
$resumeFilePath = "uploads/" . $uniqueFileName; // Assuming you have uploaded files to the "uploads" directory

if ($stmt->execute()) {
    echo "Application submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();

?>
