<?php
// Assuming $user_data['user_name'] contains the user's name
$user_name = isset($user_data['user_name']) ? $user_data['user_name'] : '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process Memberships
    $membership_organizations = $_POST['membership_organization'];
    $membership_types = $_POST['membership_type'];

    // Process Awards and Recognition
    $award_names = $_POST['award_name'];
    $award_years = $_POST['award_year'];

    // Process Professional Training
    $training_titles = $_POST['training_title'];
    $training_organizations = $_POST['training_organization'];
    $training_years = $_POST['training_year'];

    // Process Projects
    $project_organizations = $_POST['organisation'];
    $project_titles = $_POST['title_of_project'];
    $project_amounts = $_POST['amount'];
    $project_periods = $_POST['period'];
    $project_statuses = $_POST['status'];

    // Now you can perform database operations or other necessary actions with this data
    // For simplicity, let's just redirect to page5.html
    header("Location: page6.html");
    exit(); // Make sure to stop the script execution after redirecting
}
?>
