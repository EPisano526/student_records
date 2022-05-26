<?php // Filename: connect.inc.php
// __DIR__ is used when we are using a file that is one or more levels deep in a file.
require_once __DIR__ . "/../db/db_connect.inc.php"; //helps this code talk to the database 
require_once __DIR__ . "/../functions/functions.inc.php"; //we call a function in this file which is in the functions file.
require_once __DIR__ . "/../app/config.inc.php"; //config has some set variables that may be needed in this file. 

$error_bucket = []; //empty array bucket
$financial_aid = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") { //when the form is posted do...
    // First insure that all required fields are filled in
    require "inc/shared/form_check.inc.php";
    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        //This is where we insert the given information into the variable $db_table which is attached to the student_v2 database in config.inc.php
        $sql = "INSERT INTO $db_table (first_name,last_name,student_id,gpa,financial_aid,degree_program,email,phone,graduation_date) ";
        //and below we attach the values also for the student_v2 database with their same name partner. 
        $sql .= "VALUES (:first,:last,:student_id,:gpa,:financial_aid,:degree_program,:email,:phone,:graduation_date)";
        //prepare the database engine to accept some sql information
        //the $db came from db_connect.inc.php which was attached at the top
        $stmt = $db->prepare($sql);
        //key/value pairs were used to send the information to database with Values and variables.
        $stmt->execute(["first" => $first, "last" => $last, "gpa" => $gpa, "financial_aid" => $financial_aid, "degree_program" => $degree_program, "email" => $email, "phone" => $phone, "student_id" => $student_id, "graduation_date" => $graduation_date]);
        //if something does go wrong and database does not get record make an error box
        if ($stmt->rowCount() == 0) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you.</div>';
        } else { //successful record making alert
            header("Location: display-records.php?message=The record for $first has been created.");
        }
    } else { //must still print out the errors if there are any using a function from the other file.
        display_error_bucket($error_bucket);
    }
}
