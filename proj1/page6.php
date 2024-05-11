<?php
// Assuming $user_data['user_name'] contains the user's name
$user_name = isset($user_data['user_name']) ? $user_data['user_name'] : '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process Significant research contribution and future plans
    $research_contribution = $_POST['research_contribution'];

    // Process Research Statement and Projects
    $research_statement = $_POST['research_statement'];

    // Process Significant teaching contribution and future plans
    $teaching_contribution = $_POST['teaching_contribution'];

    // Process Any other relevant information
    $other_information = $_POST['other_information'];

    // Process Professional Service
    $professional_service = $_POST['professional_service'];

    // Process Journal Publications
    $journal_publications = $_POST['journal_publications'];

    // Process Conference Publications
    $conference_publications = $_POST['conference_publications'];

    // Now you can perform database operations or other necessary actions with this data
    // For simplicity, let's just redirect to page7.html
    header("Location: page7.html");
    exit(); // Make sure to stop the script execution after redirecting
}
?>
