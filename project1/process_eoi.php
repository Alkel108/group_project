

<?php





  



require_once('settings.php');
$conn = mysqli_connect($host, $user, $pwd, $sql_db);


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $input_jobref = trim($_POST['jobref']);
    $input_fname = trim($_POST['fname']);
    $input_lname = trim($_POST['lname']);
    $input_dob = trim($_POST['dob']);
    $input_gender = trim($_POST['gender']);
    $input_address = trim($_POST['address']);
    $input_suburb = trim($_POST['suburb']);
    $input_state = trim($_POST['state']);
    $input_postcode = trim($_POST['postcode']);
    $input_email = trim($_POST['email']);
    $input_phone = trim($_POST['phone']);
    $input_skills = isset($_POST['skills']) ? $_POST['skills'] : null;
    $input_otherskills = trim($_POST['otherskills']);
    $input_status = 'New';
   
    
    
    
    $query = "INSERT INTO `eoi` (
    `JobReferenceNumber`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `StreetAddress`,
    `SuburbTown`, `State`, `Postcode`, `EmailAddress`, `PhoneNumber`, `Required TechnicalSkillList`,
    `OtherSkills`, `Status`)
    VALUES ('$input_jobref', '$input_fname', '$input_lname', '$input_dob', '$input_gender', '$input_address',
    '$input_suburb', '$input_state', '$input_postcode', '$input_email', '$input_phone',
    '$input_skills', '$input_otherskills', '$input_status')";
    
    $result = mysqli_query($conn, $query);
    
    $eoi_number = $row['EOInumber'];
   

    echo htmlspecialchars($eoi_number);
    


}
?>

