<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- page title is changed to $pagetitle of whatever file is used -->
    <title><?= $pageTitle ?></title>

</head>

<body>
    <?php
    //bringing in the variables for app_copyright, app_version, app_name, db_table
    require_once 'inc/app/config.inc.php';
    //probably will use functions so bringing in function file
    require_once __DIR__ . "/../functions/functions.inc.php";
    //provides the pretty navigation bar from navbar file. uses bootstrap and html
    require_once 'inc/layout/navbar.inc.php';
    ?>