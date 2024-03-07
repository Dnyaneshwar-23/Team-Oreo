<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define upload directory
    $uploadDirectory = "uploads/";

    // Check if the upload directory exists, if not, create it
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Get file name
    $fileName = $_FILES["resume"]["name"];
    // Get file temporary name
    $fileTmpName = $_FILES["resume"]["tmp_name"];
    // Get file type
    $fileType = $_FILES["resume"]["type"];
    // Get file size
    $fileSize = $_FILES["resume"]["size"];

    // Check file size (maximum 5MB)
    if ($fileSize > 5 * 1024 * 1024) {
        echo "File is too large. Maximum file size allowed is 5MB.";
        exit;
    }

    // Set allowed file types
    $allowedTypes = array("application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");

    // Check if file type is allowed
    if (!in_array($fileType, $allowedTypes)) {
        echo "Invalid file type. Only PDF and DOCX files are allowed.";
        exit;
    }

    // Generate unique file name to prevent file overwrite
    $uniqueFileName = uniqid() . '_' . $fileName;

    // Move uploaded file to the upload directory
    if (move_uploaded_file($fileTmpName, $uploadDirectory . $uniqueFileName)) {
        // File uploaded successfully
        // Now you can process the form data (e.g., save to database, send email, etc.)
        $fullName = $_POST["name"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phone"];
        $positionAppliedFor = $_POST["position"];
        $additionalMessage = $_POST["message"];

        // Process the form data as needed

        // Send a success response
        echo "Application submitted successfully!";
    } else {
        // Failed to move file
        echo "An error occurred while uploading the file.";
    }
} else {
    // If the form is not submitted, redirect to the homepage or show an error message
    echo "Form submission error: Form not submitted.";
}
?>
