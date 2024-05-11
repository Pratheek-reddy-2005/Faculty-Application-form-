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
    
    // PhD Details
    $university = $_POST["university"];
    $department = $_POST["department"];
    $supervisor = $_POST["supervisor"];
    $join_year = $_POST["join_year"];
    $thesis_successful_date = $_POST["thesis_successful_date"];
    $thesis_award_date = $_POST["thesis_award_date"];
    $thesis_title = $_POST["thesis_title"];
    
    // M.TECH/PG Details
    $university_mtech = $_POST["university_mtech"];
    $branch_mtech = $_POST["branch_mtech"];
    $join_year_mtech = $_POST["join_year_mtech"];
    $passout_year_mtech = $_POST["passout_year_mtech"];
    $percentage_CGPA_mtech = $_POST["percentage_CGPA_mtech"];
    
    // B.TECH Details
    $university_btech = $_POST["university_btech"];
    $branch_btech = $_POST["branch_btech"];
    $join_year_btech = $_POST["join_year_btech"];
    $passout_year_btech = $_POST["passout_year_btech"];
    $percentage_CGPA_btech = $_POST["percentage_CGPA_btech"];
    
    // School Details
    $school_10th = $_POST["school_10th"];
    $passing_year_10th = $_POST["passing_year_10th"];
    $percentage_10th = $_POST["percentage_10th"];
    $school_12th = $_POST["school_12th"];
    $passing_year_12th = $_POST["passing_year_12th"];
    $percentage_12th = $_POST["percentage_12th"];
    
    // Additional Qualifications
    $degrees = $_POST["degree"];
    $universities = $_POST["university"];
    $branches = $_POST["branch"];
    $join_years = $_POST["join_year"];
    $passout_years = $_POST["passout_year"];
    $percentages_CGPAs = $_POST["percentage_CGPA"];
    
    // Prepare and bind SQL statement for form data insertion
    $stmt = $conn->prepare("INSERT INTO page2 (university, department, supervisor, join_year, thesis_successful_date, thesis_award_date, thesis_title, university_mtech, branch_mtech, join_year_mtech, passout_year_mtech, percentage_CGPA_mtech, university_btech, branch_btech, join_year_btech, passout_year_btech, percentage_CGPA_btech, school_10th, passing_year_10th, percentage_10th, school_12th, passing_year_12th, percentage_12th) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssssssssssss", $university, $department, $supervisor, $join_year, $thesis_successful_date, $thesis_award_date, $thesis_title, $university_mtech, $branch_mtech, $join_year_mtech, $passout_year_mtech, $percentage_CGPA_mtech, $university_btech, $branch_btech, $join_year_btech, $passout_year_btech, $percentage_CGPA_btech, $school_10th, $passing_year_10th, $percentage_10th, $school_12th, $passing_year_12th, $percentage_12th);

    if ($stmt->execute() !== TRUE) {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    
    // Additional Qualifications
    if (!empty($degrees)) {
        $additional_stmt = $conn->prepare("INSERT INTO additional_qualifications (degree, university, branch, join_year, passout_year, percentage_CGPA) VALUES (?, ?, ?, ?, ?, ?)");
        $additional_stmt->bind_param("ssssss", $degree, $university, $branch, $join_year, $passout_year, $percentage_CGPA);
        foreach ($degrees as $key => $degree) {
            $university = $universities[$key];
            $branch = $branches[$key];
            $join_year = $join_years[$key];
            $passout_year = $passout_years[$key];
            $percentage_CGPA = $percentages_CGPAs[$key];
            $additional_stmt->execute();
        }
        $additional_stmt->close();
    }
    
    // Redirect to next page
    header("Location: page3.html");
    exit;
}

// Close connection
$conn->close();
?>
