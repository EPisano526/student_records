<?php
if (isset($_POST["id"])) {
    $id = $_POST["id"];
}
if (empty($_POST["first"])) {
    array_push($error_bucket, "<p>A first name is required.</p>");
} else {
    $first = $_POST["first"];
}
if (empty($_POST["last"])) {
    array_push($error_bucket, "<p>A last name is required.</p>");
} else {
    $last = $_POST["last"];
}
if (empty($_POST["student_id"])) {
    array_push($error_bucket, "<p>A student ID is required.</p>");
} else {
    $student_id = intval($_POST["student_id"]);
}
//I have added the error displays for gpa, financial_aid, and degree_program. If it is filled then post to the variable attached in the else statement. 
//gpa logic of if set to empty then make it 0 in database otherwise post the writen float number. 
if (empty($_POST["gpa"])) {
    $gpa = 0;
} else {
    $gpa = floatval($_POST["gpa"]);
}
//if first name is empty then push text into error bucket which then uses the error_bucket function to add it to a unordered list. 
if (isset($_POST["financial_aid"])) {
    if ($_POST["financial_aid"] == 1) {
        $financial_aid = $_POST['financial_aid'];
    } else {
        $financial_aid = $_POST['financial_aid'];
    }
} else {
    echo '<div class="alert alert-warning">Please select a value for Financial Aid</div>';
}
//Degree program select will always have an option selected so no need for an if else statement
$degree_program = $_POST["degree_program"];
if (empty($_POST["email"])) {
    array_push($error_bucket, "<p>An email address is required.</p>");
} else {
    $email = $_POST["email"];
}
if (empty($_POST["phone"])) {
    array_push($error_bucket, "<p>A phone number is required.</p>");
} else {
    $phone = $_POST["phone"];
}
// graduation date
if (empty($_POST["graduation_date"])) {
    $graduation_date = "";
} else {
    $graduation_date = $_POST["graduation_date"];
}
