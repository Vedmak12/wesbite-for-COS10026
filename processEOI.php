<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>PROCESS EOI</title>
    <!-- other meta here -->
</head>
<body>



<?php

if ($_SERVER['REQUEST_METHOD']!== 'POST'|| !isset($_POST['referenceID'])){
    header('Location:apply.php');
    exit;
}
require_once "settings.php"; // Load MySQL login credentials

$conn = @mysqli_connect($host, $username, $password, $dbname);

function checkDatabaseExists($conn){
    // Log in and use database

    $query = 'CREATE TABLE IF NOT EXISTS EOI (
        EOI_reference VARCHAR(10) PRIMARY KEY,
        Job_reference VARCHAR(5),
        First_name VARCHAR(20),
        Last_name VARCHAR(20),
        Date_of_birth DATE,
        Gender ENUM("Male", "Female", "Other"),
        Street_address VARCHAR(40),
        Suburb_town VARCHAR(40),
        State ENUM("VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"),
        Postcode INT(4),
        Email_address VARCHAR(100),
        Phone_number VARCHAR(12),
        Other_skills VARCHAR(10),
        status varchar(7) NOT NULL DEFAULT 'NEW'
    );';


    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<p>Table Exists/Created</p>";
    } else {
        echo "<p>Error Creating Table: " . mysqli_error($conn) . "</p>";
    }
}
function sanitize_Data($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
 }
//sanitize and validating the user input
$EOI_reference = rand(1,10000);
$Job_reference =sanitize_Data($_POST['referenceID']);
$First_name = sanitize_Data($_POST['firstname']);
$Last_name = sanitize_Data($_POST['familyname']);
$Date_of_birth = sanitize_Data($_POST['dob']);
$Gender=sanitize_Data($_POST['gender']);
$Street_address= sanitize_Data($_POST['address']);
$Suburb_town=sanitize_Data( $_POST['suburb']);
$State= sanitize_Data($_POST['state']);
$Postcode= sanitize_Data($_POST['postcode']);
$Email_address= sanitize_Data($_POST['email']);
$Phone_number = sanitize_Data($_POST['phone']);
$Other_skills = sanitize_Data($_POST['addSkills']);





$required_fields=[
    'Job Reference'=> $Job_reference,
    'First Name'=> $First_name, 
    'Last Name'=> $Last_name,
    'Date of Birth'=> $Date_of_birth,
    'Gender'=> $Gender,
    'Street Address'=> $Street_address,
    'Suburb/Town'=> $Suburb_town,
    'State'=> $State,
    'Postcode'=> $Postcode,
    'Email Address'=> $Email_address,
    'Phone Number'=> $Phone_number,
];
foreach ($required_fields as $field_name => $value){
    if (empty($value)){
        echo "Error: $field_name  is required ";
        exit; 
    }
}

if (!preg_match('/^[A-Z]{2}-[0-9]{3}$/', $Job_reference)) {
    echo "Error: Job Reference must be exactly 5 alphanumeric characters.";
    exit;
}
if (!preg_match('/^[a-zA-Z]{2,20}$/',$First_name)){
    echo "Error: first name  must be between 2 and 20 alpha characters.";
    exit;
}
if (!preg_match('/^[a-zA-Z]{2,20}$/',$Last_name)){
    echo "Error: last name  must be between 2 and 20 alpha characters.";
    exit;
}



if (!validateDate($Date_of_birth)) {
    echo "Invalid date or age is not between 15 and 80.";
    exit;
}

function validateDate($Date_of_birth) {
    // Check if the date matches the format mm/dd/yyyy
    if (!preg_match('/^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/(19|20)\d\d$/', $Date_of_birth)) {
        return "Invalid date format"; // Invalid date format
    }

    // Split the date into month, day, and year
    list($month, $day, $year) = explode('/', $Date_of_birth);

    // Create DateTime object for the birthdate
    $birthdate = DateTime::createFromFormat('m/d/Y', $Date_of_birth);
    if (!$birthdate) {
        return "Invalid date"; // Invalid date
    }

    // Get the current date
    $today = new DateTime();

    // Calculate age
    $age = $today->diff($birthdate)->y;

    // Check if age is between 15 and 80
    if ($age < 15 || $age > 80) {
        return "Date is not within the age range of 15 to 80 years";
    }

    // Return the date in dd/mm/yyyy format
    return sprintf('%02d/%02d/%04d', $day, $month, $year);
}


if(strlen($Street_address)>40){
    echo"bad street address";
    exit;

}

if(strlen($Suburb_town)>40){
    echo"bad suburb";
    exit;

}



$State = strtoupper($_POST['state']);
$valid_States=array("VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT");
if (!in_array($State,$valid_States)){
    echo "bad state";
    exit;
}

$valid_postcodes=array(
    "VIC" => array_merge(range(3000, 3999), range(8000, 8999)),
    "NSW" => array_merge(range(2000, 2599), range(2619, 2899), range(2921, 2999)),
    "QLD" => array_merge(range(4000, 4999), range(9000, 9999)),
    "SA"  => range(5000, 5799),
    "WA"  => array_merge(range(6000, 6797), range(6800, 6999)),
    "TAS" => range(7000, 7999),
    "ACT" => range(2600, 2618),
    "NT"  => array_merge(range(800, 899), range(900, 999))
);

if (!preg_match('/^\d{4}$/',$Postcode)){
    echo "not a valid postcode";
    exit;
}

if (array_key_exists($State,$valid_postcodes) && !in_array((int)$Postcode,$valid_postcodes[$State])){
    echo "incorrect postcode for selected state $State";
    exit;
}

if (!filter_var($Email_address,FILTER_VALIDATE_EMAIL)){
    echo"email is not valid";
    exit;
}

// if (!preg_match('/^d{8-12}$/',str_replace(' ','',$Phone_number))){
//     echo"phone number not valid";
//     exit;
// }
if (!preg_match('/^\d{8,12}$/', str_replace(' ', '', $Phone_number))) {
    echo "Phone number not valid. It must be 8-12 digits long.";
    exit;
}

$isCheckboxSelected= isset($_POST['skillCheckbox']) && $_POST['skillCheckbox'] === 'true';

if ($isCheckboxSelected && empty($Other_skills)){
    echo"skills is empty";
    exit;
}
if (!$conn){
        echo "<p> database connection error </p>";

 }
else{
        $sql_table="EOI";
        $query="insert into $sql_table (EOI_reference,Job_reference,First_name,Last_name,Date_of_birth,Gender,Street_address,Suburb_town,State,Postcode,Email_address,Phone_number,Other_skills) values ('$EOI_reference','$Job_reference','$First_name','$Last_name','$Date_of_birth','$Gender','$Street_address','$Suburb_town','$State','$Postcode','$Email_address','$Phone_number','$Other_skills')";
        $result=mysqli_query($conn,$query);
        if(!$result){
            echo"<p> Something is wrong with",$query,"</p>";

        }
        else{
            echo"<p> successfully added new JOB record</p>";
        }
        mysqli_close($conn);

 }


?>

</body>
</html>
