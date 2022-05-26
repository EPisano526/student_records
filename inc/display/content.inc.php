<?php // Filename: connect.inc.php
//connects this file to the database
require __DIR__ . "/../db/db_connect.inc.php";

$orderby = 'last_name';
$filter = '';
//if the filter is set then set the filter to the variable $filter which was empty before.
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}
//if the sortby is set then set that field to $orderby
if (isset($_GET['sortby'])) {
    $orderby = $_GET['sortby'];
}
//if the clear filter button is set then make the $filter blank.
if (isset($_GET['clearfilter'])) {
    $filter = '';
}
if (isset($_GET["filter"])) {
    //tells the database that we wish to find all the lastnames that start with the filtered letter
    $sql = "SELECT * FROM $db_table WHERE last_name LIKE :filter";
    $stmt = $db->prepare($sql);
    $stmt->execute(["filter" => $filter . '%']);
} elseif (isset($_GET["sortby"])) {
    //if its sorted through using the labels such as id or financial aid
    if ($orderby == "first_name") {
        $sql = "SELECT * FROM $db_table ORDER BY first_name ASC";
    } elseif ($orderby == "last_name") {
        $sql = "SELECT * FROM $db_table ORDER BY last_name ASC";
    } elseif ($orderby == "student_id") {
        $sql = "SELECT * FROM $db_table ORDER BY student_id ASC";
    } elseif ($orderby == "gpa") {
        $sql = "SELECT * FROM $db_table ORDER BY gpa DESC";
    } elseif ($orderby == "financial_aid") {
        $sql = "SELECT * FROM $db_table ORDER BY financial_aid DESC";
    } elseif ($orderby == "degree_program") {
        $sql = "SELECT * FROM $db_table ORDER BY degree_program ASC";
    } elseif ($orderby == "phone") {
        $sql = "SELECT * FROM $db_table ORDER BY phone ASC";
    } elseif ($orderby == "email") {
        $sql = "SELECT * FROM $db_table ORDER BY email ASC";
    } elseif ($orderby == "graduation_date") {
        $sql = "SELECT * FROM $db_table ORDER BY graduation_date DESC";
    }
    $stmt = $db->prepare($sql);
    $stmt->execute();
} else { //if nothing is in the url then show the data table.  
    $sql = "SELECT * FROM $db_table ORDER BY data_created DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
}
//this is an array of objects holding all of the information which was filtered out above and holding all of it in a $records variable.
$records = $stmt->fetchAll();
//if there are no records and the filter is set to empty then give an alert.
if ($stmt->rowCount() == 0 && $filter != '') {
    echo "<h2 class=\"mt-4 alert alert-warning\">No Records for <strong>last names</strong> starting with <strong>$filter</strong></h2>";
} else { //if empty filter dont have any text
    if (empty($filter)) {
        $text = '';
    } else { //if there are things in that filter then display this text
        $text = " - last names starting with $filter";
    }
    //now printing out the alert which were defined in the if else statements above.
    echo "<h2 class=\"mt-4 alert alert-info\">" . $stmt->rowCount() . " Student Records" . $text . '</h2>';
}

// display alphabet filters
display_letter_filters($filter);

// display message if any
display_message();

// display the data
display_record_table($records);
