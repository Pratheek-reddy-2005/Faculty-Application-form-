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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Application Details
    $post_applied = $_POST["post_applied"];
    $department = $_POST["department"];
    
    // Personal Details
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $nationality = $_POST["nationality"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $marital_status = $_POST["marital_status"];
    // Assume file upload for ID Proof
    
    // Additional Personal Details
    $father_name = $_POST["father_name"];
    $current_address = $_POST["current_address"];
    $permanent_address = $_POST["permanent_address"];
    
    // Contact Details
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $landline = $_POST["landline"];
    
    // Prepare and bind SQL statement for form data insertion
    $stmt = $conn->prepare("INSERT INTO page1(post_applied, department, first_name, middle_name, last_name, nationality, dob, gender, marital_status, father_name, current_address, permanent_address, mobile, email, landline) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssss", $post_applied, $department, $first_name, $middle_name, $last_name, $nationality, $dob, $gender, $marital_status, $father_name, $current_address, $permanent_address, $mobile, $email, $landline);
    if ($stmt->execute() !== TRUE) {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    
    // Redirect to next page
    header("Location: page2.html");
    exit;
}

// Close connection
$conn->close();
?>
