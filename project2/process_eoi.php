

<?php
require_once('settings.php');
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

// Function to sanitize inputs
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES);
    return $data;
}

?>

<html>
<head> <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&display=swap" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet"> </head>
    <body> <main> <?php    

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // Sanitise 
    $input_jobref = sanitize_input($_POST['jobref'] ?? '');
    $input_fname = sanitize_input($_POST['fname'] ?? '');
    $input_lname = sanitize_input($_POST['lname'] ?? '');
    $input_dob = sanitize_input($_POST['dob'] ?? '');
    $input_gender = $_POST['gender'] ?? '';
    $input_address = sanitize_input($_POST['address'] ?? '');
    $input_suburb = sanitize_input($_POST['suburb'] ?? '');
    $input_state = $_POST['state'] ?? '';
    $input_postcode = sanitize_input($_POST['postcode'] ?? '');
    $input_email = sanitize_input($_POST['email'] ?? '');
    $input_phone = sanitize_input($_POST['phone'] ?? '');
    $input_skills = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : ''; // convert array to string
    $input_otherskills = sanitize_input($_POST['otherskills'] ?? '');
    $input_status = 'New';

    // Validate 
    if (empty($input_jobref)) $errors[] = "Job Reference is required.";
    if (empty($input_fname)) $errors[] = "First name is required.";
    if (empty($input_lname)) $errors[] = "Last name is required.";
    if (empty($input_dob)) $errors[] = "Date of birth is required.";
    if (empty($input_gender)) $errors[] = "Gender must be selected.";
    if (empty($input_address)) $errors[] = "Address is required.";
    if (empty($input_suburb)) $errors[] = "Suburb is required.";
    if (empty($input_state)) $errors[] = "State must be selected.";
    if (empty($input_postcode)) $errors[] = "Postcode is required.";
    if (empty($input_email)) $errors[] = "Email address is required.";
    if (empty($input_phone)) $errors[] = "Phone number is required.";

    // Errors
    if (!empty($errors)) {
        echo "<h3>Submission failed:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    } else {
        // Insert into database
        $query = "INSERT INTO `eoi` (
            `JobReferenceNumber`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `StreetAddress`,
            `SuburbTown`, `State`, `Postcode`, `EmailAddress`, `PhoneNumber`, `Required TechnicalSkillList`,
            `OtherSkills`, `Status`
        ) VALUES (
            '$input_jobref', '$input_fname', '$input_lname', '$input_dob', '$input_gender', '$input_address',
            '$input_suburb', '$input_state', '$input_postcode', '$input_email', '$input_phone',
            '$input_skills', '$input_otherskills', '$input_status'
        )";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $eoi_number = mysqli_insert_id($conn);
            echo "Application submitted successfully. Your EOI number is: <strong>" . htmlspecialchars($eoi_number) . "</strong>";
        } else {
            echo "Error submitting application: " . mysqli_error($conn);
        }
    }
}


?></main> </body> </html>

