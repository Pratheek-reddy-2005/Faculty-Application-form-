<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming $user_data['user_name'] contains the user's name
$user_name = isset($user_data['user_name']) ? $user_data['user_name'] : '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process Present Employment Details
    $position = $_POST['position'];
    $organisation = $_POST['organisation'];
    $date_of_joining = $_POST['date_of_joining'];

    // SQL query to insert present employment details
    $sql_present_employment = "INSERT INTO present_employment (position, organisation, date_of_joining) 
                               VALUES ('$position', '$organisation', '$date_of_joining')";
    
    if ($conn->query($sql_present_employment) === TRUE) {
        echo "Present Employment Details inserted successfully. ";
    } else {
        echo "Error: " . $sql_present_employment . "<br>" . $conn->error;
    }

    // Now you can similarly insert other form data into respective tables

    // For simplicity, let's just redirect to page4.html after insertion
    header("Location: page4.html");
    exit(); // Make sure to stop the script execution after redirecting
}
?>
