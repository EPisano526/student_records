<?php // Filename: create-record.php //shows the create record page
$pageTitle = "Create Record"; //variable string to display elsewhere
require_once 'inc/layout/header.inc.php'; //pulls in the header html through include file
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-sm-12 col-md-6 col-lg-6">
			<div class="alert alert-info">
				<!-- main heading in blue -->
				<h1>Create a New Record</h1>
			</div>
			<!-- __DIR__ is used when we are using a file that is one or more levels deep in a file. -->
			<?php require_once __DIR__ . '/inc/create/create.inc.php'; //this is to sort whether each input is filled in. if not it will display an error in the function error_bucket 
			?>
			<?php require_once __DIR__ . '/inc/shared/form.inc.php'; //this displays label and input box nicely on the create record form. 
			?>
		</div>
	</div>
</div>
<?php require_once 'inc/layout/footer.inc.php'; //here is the footer for the page 
?>