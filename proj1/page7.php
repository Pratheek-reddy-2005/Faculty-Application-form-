<?php
// Assuming $user_data['user_name'] contains the user's name
$user_name = isset($user_data['user_name']) ? $user_data['user_name'] : '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have uploaded files and saved them to a folder on your server
    // Process the file paths here and save them to the database if needed

    // Now you can perform database operations or other necessary actions with this data
    // For simplicity, let's just redirect to page8.html
    header("Location: page8.html");
    exit(); // Make sure to stop the script execution after redirecting
}
?>
