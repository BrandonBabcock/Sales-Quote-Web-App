<?php
session_start();
if (!isset($_SESSION['username'])) { // make sure user is logged in
    header("location:index.php");
    exit(6);
}
require("../status.php");
if ($_SESSION['enabled'] != 'true') { // non-enabled account tried to access page
    header('location:index.php');
    exit(5);
}
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
    header('location:index.php');
    exit(5);
}
echo '
<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../app/index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="../app/logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">WHAT WOULD YOU LIKE TO DO?</div>
        <div class="panel-body">
            <div class="row col-lg-4 col-lg-offset-4">
                <a ui-sref="modifyPrice" class="btn btn-block btn-primary">
                    Modify Pricing <span class="glyphicon glyphicon-circle-arrow-right"></span>
                </a>
                <br />
                <a ui-sref="users" class="btn btn-block btn-primary">
                   Manage Users  <span class="glyphicon glyphicon-circle-arrow-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>
';
?>