<?php
require('fpdf.php');

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

// Retrieve data from page1 table
$sql_page1 = "SELECT * FROM page1 ORDER BY id DESC LIMIT 1";
$result_page1 = $conn->query($sql_page1);

// Retrieve data from page2 table
$sql_page2 = "SELECT * FROM page2 ORDER BY id DESC LIMIT 1";
$result_page2 = $conn->query($sql_page2);

$sql_page3 = "SELECT * FROM present_employment ORDER BY id DESC LIMIT 1"; // Corrected variable name
$result_present_employment = $conn->query($sql_page3); // Corrected variable name

// Retrieve data from teaching_experience table
$sql_teaching = "SELECT * FROM teaching_experience";
$result_teaching = $conn->query($sql_teaching);
$teachingData = [];
if ($result_teaching->num_rows > 0) {
    while ($row = $result_teaching->fetch_assoc()) {
        $teachingData[] = $row;
    }
}

// Retrieve data from research_experience table
$sql_research = "SELECT * FROM research_experience";
$result_research = $conn->query($sql_research);
$researchData = [];
if ($result_research->num_rows > 0) {
    while ($row = $result_research->fetch_assoc()) {
        $researchData[] = $row;
    }
}

// Retrieve data from industrial_experience table
$sql_industrial = "SELECT * FROM industrial_experiences";
$result_industrial = $conn->query($sql_industrial);
$industrialData = [];
if ($result_industrial->num_rows > 0) {
    while ($row = $result_industrial->fetch_assoc()) {
        $industrialData[] = $row;
    }
}


// Check if both queries were successful
if ($result_page1->num_rows > 0 && $result_page2->num_rows > 0 && $result_present_employment->num_rows > 0) {
    $row_page1 = $result_page1->fetch_assoc();
    $row_page2 = $result_page2->fetch_assoc();
    $row_page3 = $result_present_employment->fetch_assoc();
    // Create new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('Arial', '', 12);

    // Add content to the PDF from page1
    $pdf->Cell(0, 10, 'Page 1 - Application Details', 0, 1, 'C');
    $pdf->Ln();
    $pdf->Cell(0, 10, 'Post Applied: ' . $row_page1['post_applied'], 0, 1);
    $pdf->Cell(0, 10, 'Department: ' . $row_page1['department'], 0, 1);
    $pdf->Cell(0, 10, 'First Name: ' . $row_page1['first_name'], 0, 1);
    $pdf->Cell(0, 10, 'Middle Name: ' . $row_page1['middle_name'], 0, 1);
    $pdf->Cell(0, 10, 'Last Name: ' . $row_page1['last_name'], 0, 1);
    $pdf->Cell(0, 10, 'Nationality: ' . $row_page1['nationality'], 0, 1);
    $pdf->Cell(0, 10, 'Date of Birth: ' . $row_page1['dob'], 0, 1);
    $pdf->Cell(0, 10, 'Gender: ' . $row_page1['gender'], 0, 1);
    $pdf->Cell(0, 10, 'Marital Status: ' . $row_page1['marital_status'], 0, 1);
    $pdf->Cell(0, 10, 'Father\'s Name: ' . $row_page1['father_name'], 0, 1);
    $pdf->Cell(0, 10, 'Current Address: ' . $row_page1['current_address'], 0, 1);
    $pdf->Cell(0, 10, 'Permanent Address: ' . $row_page1['permanent_address'], 0, 1);
    $pdf->Cell(0, 10, 'Mobile: ' . $row_page1['mobile'], 0, 1);
    $pdf->Cell(0, 10, 'Email: ' . $row_page1['email'], 0, 1);
    $pdf->Cell(0, 10, 'Landline: ' . $row_page1['landline'], 0, 1);
    $pdf->Ln();

    // Add content to the PDF from page2
    $pdf->Cell(0, 10, 'Page 2 - PhD Details', 0, 1, 'C');
    $pdf->Ln();
    $pdf->Cell(0, 10, 'University: ' . $row_page2['university'], 0, 1);
    $pdf->Cell(0, 10, 'Department: ' . $row_page2['department'], 0, 1);
    $pdf->Cell(0, 10, 'Name of Supervisor: ' . $row_page2['supervisor'], 0, 1);
    $pdf->Cell(0, 10, 'Year of Joining: ' . $row_page2['join_year'], 0, 1);
    $pdf->Cell(0, 10, 'Date of Successful Thesis: ' . $row_page2['thesis_successful_date'], 0, 1);
    $pdf->Cell(0, 10, 'Date of Award: ' . $row_page2['thesis_award_date'], 0, 1);
    $pdf->Cell(0, 10, 'Title of PhD Thesis: ' . $row_page2['thesis_title'], 0, 1);
    // Add other fields from page2 similarly

    $pdf->Ln();

    // M.TECH/PG Details
    $pdf->Cell(0, 10, 'M.TECH/PG Details', 0, 1, 'C');
    $pdf->Ln();
    $pdf->Cell(0, 10, 'University: ' . $row_page2['university_mtech'], 0, 1);
    $pdf->Cell(0, 10, 'Department: ' . $row_page2['branch_mtech'], 0, 1);
    $pdf->Cell(0, 10, 'Year of Joining: ' . $row_page2['join_year_mtech'], 0, 1);
    $pdf->Cell(0, 10, 'Year of Passout: ' . $row_page2['passout_year_mtech'], 0, 1);
    $pdf->Cell(0, 10, 'Percentage/CGPA: ' . $row_page2['percentage_CGPA_mtech'], 0, 1);
    $pdf->Ln();

    // B.TECH Details
    $pdf->Cell(0, 10, 'B.TECH Details', 0, 1, 'C');
    $pdf->Ln();
    $pdf->Cell(0, 10, 'University: ' . $row_page2['university_btech'], 0, 1);
    $pdf->Cell(0, 10, 'Department: ' . $row_page2['branch_btech'], 0, 1);
    $pdf->Cell(0, 10, 'Year of Joining: ' . $row_page2['join_year_btech'], 0, 1);
    $pdf->Cell(0, 10, 'Year of Passout: ' . $row_page2['passout_year_btech'], 0, 1);
    $pdf->Cell(0, 10, 'Percentage/CGPA: ' . $row_page2['percentage_CGPA_btech'], 0, 1);
    $pdf->Ln();

    // School Details
    $pdf->Cell(0, 10, 'School Details', 0, 1, 'C');
    $pdf->Ln();
    $pdf->Cell(0, 10, '10th School: ' . $row_page2['school_10th'], 0, 1);
    $pdf->Cell(0, 10, 'Year of Passing (10th): ' . $row_page2['passing_year_10th'], 0, 1);
    $pdf->Cell(0, 10, 'Percentage/CGPA (10th): ' . $row_page2['percentage_10th'], 0, 1);
    $pdf->Cell(0, 10, '12th School: ' . $row_page2['school_12th'], 0, 1);
    $pdf->Cell(0, 10, 'Year of Passing (12th): ' . $row_page2['passing_year_12th'], 0, 1);
    $pdf->Cell(0, 10, 'Percentage/CGPA (12th): ' . $row_page2['percentage_12th'], 0, 1);
    $pdf->Ln();

    // Additional Qualifications
    $pdf->Cell(0, 10, 'Additional Qualifications', 0, 1, 'C');
    $pdf->Ln();
    
    $pdf->Ln();
    $pdf->Cell(0, 10, 'Present Employment Details', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Position: ' . $row_page3['position'], 0, 1);
    $pdf->Cell(0, 10, 'Organisation/Institution: ' . $row_page3['organisation'], 0, 1);
    $pdf->Cell(0, 10, 'Date of Joining: ' . $row_page3['date_of_joining'], 0, 1);
    $pdf->Ln();

    // Teaching Experience
    $pdf->Cell(0, 10, 'Teaching Experience', 0, 1, 'C');
    foreach ($teachingData as $teaching) {
        $pdf->Cell(0, 10, 'Institution: ' . $teaching['institution'], 0, 1);
        $pdf->Cell(0, 10, 'Position: ' . $teaching['position'], 0, 1);
        $pdf->Cell(0, 10, 'Years of Experience: ' . $teaching['years_of_experience'], 0, 1);
        $pdf->Ln();
    }

    // Research Experience After PhD
    $pdf->Cell(0, 10, 'Research Experience After PhD', 0, 1, 'C');
    foreach ($researchData as $research) {
        $pdf->Cell(0, 10, 'Institution: ' . $research['institution'], 0, 1);
        $pdf->Cell(0, 10, 'Position: ' . $research['position'], 0, 1);
        $pdf->Cell(0, 10, 'Years of Experience: ' . $research['years_of_experience'], 0, 1);
        $pdf->Ln();
    }

    // Industrial Experiences
$pdf->Cell(0, 10, 'Industrial Experiences', 0, 1, 'C');
foreach ($industrialData as $industrial) {
    $pdf->Cell(0, 10, 'Organization: ' . $industrial['organization'], 0, 1);
    $pdf->Cell(0, 10, 'Work Profile: ' . $industrial['work_profile'], 0, 1);
    $pdf->Cell(0, 10, 'Position: ' . $industrial['position'], 0, 1);
    $pdf->Cell(0, 10, 'Years of Experience: ' . $industrial['years_of_experience'], 0, 1);
    $pdf->Ln();
}

    // Output PDF
    $pdf->Output('filled_form.pdf', 'D'); // 'D' forces download, use 'I' to display inline
} else {
    echo "No data found!";
}

// Close connection
$conn->close();
?>
