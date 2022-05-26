<?php // Filename: form.inc.php 
?>

<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->

<?php
// Button label logic
if (basename($_SERVER['PHP_SELF']) == 'create-record.php') {
    $button_label = "Save New Record";
} else if (basename($_SERVER['PHP_SELF']) == 'update-record.php') {
    $button_label = "Save Updated Record";
} else if (basename($_SERVER['PHP_SELF']) == 'advanced-search.php') {
    $button_label = "Search...";
}
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <label class="col-form-label" for="first">First Name</label>
    <input class="form-control" type="text" id="first" name="first" value="<?= isset($first) ? $first : null ?>">
    <br>
    <label class="col-form-label" for="last">Last Name</label>
    <input class="form-control" type="text" id="last" name="last" value="<?= isset($last) ? $last : null ?>">
    <br>
    <label class="col-form-label" for="id">Student ID (Cannot be changed)</label>
    <input class="form-control" type="number" id="id" name="student_id" value="<?= isset($student_id) ? $student_id : null ?>">
    <br>
    <!-- Below are the three labels in which will show up on the form for GPA, financial aid, and degree -->
    <label class="col-form-label" for="gpa">GPA</label>
    <input class="form-control" type="number" id="gpa" name="gpa" min="0" max="4" step="0.01" value="<?= isset($gpa) ? $gpa : null ?>">
    <br>
    <label class="col-form-label" for="degree_program">Degree Program</label>
    <select class="form-select" id="degree_program" aria-label="Default select" name="degree_program">
        <option value="Undeclared" <?= (isset($degree_program) and ($degree_program == "Undeclared")) ? "selected" : null ?>>Undeclared</option>
        <option value="AAT Web Development" <?= (isset($degree_program) and ($degree_program == "AAT Web Development")) ? "selected" : null ?>>AAT Web Development</option>
        <option value="AAT Computer support" <?= (isset($degree_program) and ($degree_program == "AAT Computer support")) ? "selected" : null ?>>AAT Computer Support</option>
        <option value="AAT Network Technology" <?= (isset($degree_program) and ($degree_program == "AAT Network Technology")) ? "selected" : null ?>>AAT Network Technology</option>
        <option value="BAS Cybersecurity" <?= (isset($degree_program) and ($degree_program == "BAS Cybersecurity")) ? "selected" : null ?>>BAS Cybersecurity</option>
        <option value="AST2 Computer Science" <?= (isset($degree_program) and ($degree_program == "AST2 Computer Science")) ? "selected" : null ?>>AST2 Computer Science</option>
    </select>
    <br>
    <label class="col-form-label">Financial Aid</label>
    <br>
    <div class="form-check" id="financial_aid">
        <input class="form-check-input" type="radio" name="financial_aid" value="1" id="yes_finaid" <?= $financial_aid == 1 ? 'checked' : null ?>>
        <label class="form-check-label" for="yes_finaid">
            Yes
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="financial_aid" value="0" id="no_finaid" <?= $financial_aid == 0 ? 'checked' : null ?>>
        <label class="form-check-label" for="no_finaid">
            No
        </label>
    </div>
    <br>
    <label class="col-form-label" for="email">Email</label>
    <input class="form-control" type="text" id="email" name="email" value="<?= isset($email) ? $email : null ?>">
    <br>
    <label class="col-form-label" for="phone">Phone</label>
    <input class="form-control" type="text" id="phone" name="phone" value="<?= isset($phone) ? $phone : null ?>">
    <br>
    <!-- Graduation date -->
    <label class="col-form-label" for="graduation_date">Graduation Date</label>
    <input class="form-control" type="date" id="graduation_date" name="graduation_date" value="<?= !empty($graduation_date) ? $graduation_date : null ?>">
    <br>
    <br>
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit"><?= $button_label ?></button>
    <input type="hidden" name="id" value="<?= isset($id) ? $id : null; ?>">
</form>