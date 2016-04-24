<?php
session_start();
if (!isset($_SESSION['username'])) { // make sure user is logged in
	echo '<script type="text/javascript">
        alert ("Access Denied");
        window.location.href = "../../shared/redirect.php";
        </script>';
	exit(6);
}
require("../../shared/status.php");
if ($_SESSION['enabled'] != 'true') { // non-enabled account tried to access page
	echo '<script type="text/javascript">
        alert ("Access Denied");
        window.location.href = "../../shared/redirect.php";
        </script>';
	exit(5);
}
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
    echo '<script type="text/javascript">
        alert ("Access Denied");
        window.location.href = "../../shared/redirect.php";
        </script>';
    exit(5);
}
echo '
<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="source/shared/logout.php" class="btn btn-primary">Log Out</a>
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
                <a ui-sref="userSearch" class="btn btn-block btn-primary">
                   Manage Users  <span class="glyphicon glyphicon-circle-arrow-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>
';
?>