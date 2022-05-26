<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<h2>Search Results</h2>';
    //Add code to perform SQL based on data fille out by user
    $sql = "SELECT * FROM $db_table WHERE ";
    //build rest of sql dynamically depending on what field is filled
    $data = [];
    //first name
    if (!empty($_POST["first"])) {
        array_push($data, "first_name LIKE {$db->quote($_POST["first"] . '%')}");
    }
    //last name
    if (!empty($_POST["last"])) {
        array_push($data, "last_name LIKE {$db->quote($_POST["last"] . '%')}");
    }
    if (!empty($_POST["student_id"])) {
        array_push($data, "student_id = {$_POST["student_id"]}");
    }
    if (!empty($_POST["gpa"])) {
        array_push($data, "gpa = {$_POST["gpa"]}");
    }
    //degreeprogram  
    array_push($data, "degree_program = {$db->quote($_POST["degree_program"])}");
    //financial aid
    array_push($data, "financial_aid = {$_POST["financial_aid"]}");

    if (!empty($_POST["email"])) {
        array_push($data, "email LIKE {$db->quote($_POST["email"] . '%')}");
    }
    if (!empty($_POST["phone"])) {
        array_push($data, "phone LIKE {$db->quote($_POST["phone"] . '%')}");
    }
    //graduation date
    if (!empty($_POST["graduation_date"])) {
        array_push($data, "graduation_date = {$db->quote($_POST["graduation_date"])}");
    }

    $sql = $sql . implode(" and ", $data);
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    display_record_table($results);
} else {
    echo '<div class="alert alert-info">';
    echo '<h2>Search results will appear here</h2>';
    echo '</div>';
}
