<?php
include '../includes/config.php';

include '../includes/bank.php';


if (!isset($_SESSION['agentUserID'])) {
    header('location:../index.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Agent - Islamic Bank</title>
    <?php


    require '../includes/files.php';


    ?>



</head>
<body style="background: url(<?php echo SITEURL; ?>/assets/images/bg.jpg);background-size: 100%">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <a class="navbar-brand" href="#">

            <i class="d-inline-block  fa fa-building fa-fw"></i><?= BANKNAME; ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
           

        </div>


        <div class="btn btn-outline-warning">Welecome (Agent)</div>
        <a href="../logout.php" data-toggle="tooltip" title="Logout" class="btn btn-outline-danger mx-1"><i class="fa fa-sign-out fa-fw"></i></a>

    </nav>
    <br><br><br>