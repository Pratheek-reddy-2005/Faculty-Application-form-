<?php
// Assuming $user_data['user_name'] contains the user's name
$user_name = isset($user_data['user_name']) ? $user_data['user_name'] : '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your database
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

    // Prepare SQL statement to insert referee information into the database
    $sql = "INSERT INTO Referees (user_name, referee_name_1, referee_position_1, referee_association_1, referee_institution_1, referee_email_1, referee_contact_1, referee_name_2, referee_position_2, referee_association_2, referee_institution_2, referee_email_2, referee_contact_2)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssss", $user_name, $_POST['referee_name_1'], $_POST['referee_position_1'], $_POST['referee_association_1'], $_POST['referee_institution_1'], $_POST['referee_email_1'], $_POST['referee_contact_1'], $_POST['referee_name_2'], $_POST['referee_position_2'], $_POST['referee_association_2'], $_POST['referee_institution_2'], $_POST['referee_email_2'], $_POST['referee_contact_2']);

    // Execute the statement
    if ($stmt->execute()) {
        // Close statement and connection
        $stmt->close();
        $conn->close();
        
        // Redirect to print.php
        header("Location: print.php");
        exit(); // Stop further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
