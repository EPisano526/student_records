<?php // Filename: update.inc.php

require_once __DIR__ . "/../db/db_connect.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];
if (isset($_GET["id"])) {
    $id = $_GET['id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "inc/shared/form_check.inc.php";
    if (count($error_bucket) == 0) {
        $sql = "UPDATE $db_table SET first_name = :first, last_name = :last, email =:email, phone=:phone, gpa=:gpa, degree_program=:degree_program, financial_aid=:financial_aid, graduation_date=:graduation_date";
        $sql .= " WHERE id = :id LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute(["first" => $first, "last" => $last, "gpa" => $gpa, "financial_aid" => $financial_aid, "degree_program" => $degree_program, "email" => $email, "phone" => $phone, "id" => $id, "graduation_date" => $graduation_date]);

        if ($stmt->rowCount() <= 1) {
            header("Location: display-records.php?message=The record for $first has been updated.");
        }
    } else { //must still print out the errors if there are any using a function from the other file.
        display_error_bucket($error_bucket);
    }
}

$sql = "SELECT * FROM $db_table WHERE ID=:id";
$stmt = $db->prepare($sql);
$stmt->execute(["id" => $id]);
if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch();
    $first = $row->first_name;
    $last = $row->last_name;
    $student_id = $row->student_id;
    $gpa = $row->gpa;
    $degree_program = $row->degree_program;
    $financial_aid = $row->financial_aid;
    if ($financial_aid == 1) {
        $financial_aid = 1;
    } elseif ($financial_aid == 0) {
        $financial_aid = 0;
    }
    $email = $row->email;
    $phone = $row->phone;
    $graduation_date = $row->graduation_date;
    if (!empty($graduation_date)) {
        $graduation_date = $row->graduation_date;
    } else {
        $graduation_date = null;
    }
}
