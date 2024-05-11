<?php
// Assuming $user_data['user_name'] contains the user's name
$user_name = isset($user_data['user_name']) ? $user_data['user_name'] : '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process Areas of Specialization
    $areas_of_specialization = $_POST['areas_of_specialization'];

    // Process Current Areas of Research
    $current_areas_of_research = $_POST['current_areas_of_research'];

    // Process Summary of Publications
    $publication_titles = $_POST['publication_title'];
    $publication_types = $_POST['publication_type'];
    $publication_years = $_POST['publication_year'];

    // Process Google Scholar Link
    $google_scholar_link = $_POST['google_scholar_link'];

    // Now you can perform database operations or other necessary actions with this data
    // For simplicity, let's just redirect to page5.html
    header("Location: page5.html");
    exit(); // Make sure to stop the script execution after redirecting
}
?>
