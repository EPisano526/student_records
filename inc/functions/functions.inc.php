<?php // Filename: function.inc.php
//display_message function is to put a string in an alert box when someone updates the database successfully
function display_message()
{
    if (isset($_GET["message"])) {
        $message = $_GET["message"];
        echo '<div class="mt-4 alert alert-success" role="alert">';
        echo $message;
        echo '</div>';
    }
}
//display_letter_filters function is the top alphabet display on home page.
function display_letter_filters($filter)
{
    //here is the string before the array of letters.
    echo '<span class="d-inline-block mr-3">Filter by <strong>Last Name</strong></span> ';

    $letters = range('A', 'Z');
    //showing all letters in increments of one. 
    for ($i = 0; $i < count($letters); $i++) {
        if ($filter == $letters[$i]) {
            //mades the box dark if the $filter is selected as a letter.
            $class = 'class="d-inline-block text-light font-weight-bold p-2 mr-3 bg-dark"';
        } else { //if the $filter is not selected (as in no letter is clicked) then display light box
            $class = 'class="d-inline-block text-secondary p-2 mr-5 bg-light border rounded"';
        }
        //since all of the letters are links then we display each one as an anchor tag.
        //href='?filter=$letters[$i] is to tack on that info to the url.
        echo "<u><a $class href='?filter=$letters[$i]' title='$letters[$i]'>$letters[$i]</a></u>";
    }
    //this is the last button which is directed to clear the filter. 
    echo '<a class="text-secondary p-2 mx-2 bg-primary text-light border rounded" href="?clearfilter" title="Reset Filter">Reset</a>&nbsp;&nbsp;';
}
//display_record_table is to show all the data in the home page. 
function display_record_table($records)
{
    echo '<div class="table-responsive">';
    //this echo statement starts the table tag. Its to display the records neatly
    echo "<table class=\"table table-striped table-hover table-sm mt-3 table-bordered\">";
    //Esther added the three form fields of gpa, financial_aid & degree_program to the statement below so that they may appear in the home page of "Student Records Manager". It shows up as a whole column.
    // This is for the black title bar in the home page
    echo '<thead class="table-dark"><tr><th class="bg-primary">Actions</th>
    <th><a href="?sortby=student_id">Student ID</a></th>
    <th><a href="?sortby=first_name">First Name</a></th>
    <th><a href="?sortby=last_name">Last Name</a></th>
    <th><a href="?sortby=gpa">GPA</a></th>
    <th><a href="?sortby=financial_aid">Financial Aid</a></th>
    <th><a href="?sortby=degree_program">Degree Program</a></th>
    <th><a href="?sortby=email">Email</a></th>
    <th><a href="?sortby=phone">Phone</a></th>
    <th><a href="?sortby=graduation_date">Graduation Date</a></th></thead>';
    //foreach record make it a row with following information in it. 
    foreach ($records as $row) {
        # display rows and columns of data
        echo '<tr>';
        //buttons for update and delete
        echo "<td><a href=\"update-record.php?id={$row->id}\">Update</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <a href=\"delete-record.php?id={$row->id}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
        echo "<td>{$row->student_id}</td>";
        echo "<td><strong>{$row->first_name}</strong></td>";
        echo "<td><strong>{$row->last_name}</strong></td>";
        //this is to show the records in the row.
        if ($row->gpa < 2 and $row->gpa > 0) {
            $class = " class=\"bg-warning\"";
        } elseif ($row->gpa == 4) {
            $class = " class=\"bg-success text-white\"";
        } else {
            $class = "";
        }
        echo "<td{$class}><strong>{$row->gpa}</strong></td>";
        if ($row->financial_aid == 1) {
            $finaid_text = "&#9989;";
        } else {
            $finaid_text = "";
        }
        echo "<td class=\"text-center\"><strong>{$finaid_text}</strong></td>";
        if ($row->degree_program == "") {
            $degree_program = "Undeclared";
        } else {
            $degree_program = $row->degree_program;
        }
        echo "<td><strong>{$degree_program}</strong></td>";
        echo "<td>{$row->email}</td>";
        echo "<td>{$row->phone}</td>";
        //Graduation date added here
        if ($row->graduation_date != null and $row->graduation_date != "0000-00-00") {
            $date = date_format(date_create($row->graduation_date), "m/d/Y");
            echo "<td>{$date}</td>";
        } else {
            echo "<td></td>";
        }
        echo '</tr>';
    } // end while
    echo '</table>'; //end of table tag
    echo '</div>';
}
//error_bucket for Create Record page to display text when alert is needed. 
function display_error_bucket($error_bucket)
{
    echo '<div class="pt-4 alert alert-warning" role="alert">'; //creates the box for the error
    echo '<p>The following errors were detected:</p>'; //paragraph text
    echo '<ul>'; //unordered list for subject $text
    foreach ($error_bucket as $text) {
        echo '<li>' . $text . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '<p>All of these fields are required. Please fill them in.</p>';
}
//this function takes in the current file name and makes the label in the black navigation bar light up. 
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER["REQUEST_URI"], ".php");
    if ($current_file_name == $requestUri)
        echo ' active';
}
