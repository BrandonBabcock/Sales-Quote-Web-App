<?php
require("../../database/db.php");
session_start();
if (!isset($_SESSION['username'])) { // make sure user is logged in
    header("location:../shared/redirect.php");
    exit(6);
}
require("../shared/status.php");
if ($_SESSION['enabled'] != 'true') { // non-enabled account tried to access page
    header('location:../shared/redirect.php');
    exit(5);
}
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
	header('location:../shared/redirect.php');
	exit(5);
}
ob_start();
$data = array();
parse_str( file_get_contents( 'php://input' ), $data );
$_POST    = array_merge( $data, $_POST ); // merge parsed login data with _POST session values
$newHourlyServiceRate = $_POST['newServicesHourlyRate'];
$newHourlyServiceRate = floatval($newHourlyServiceRate);
$newHourlyServiceRate = mysqli_real_escape_string( $mysqli, $newHourlyServiceRate );

if (is_numeric($newHourlyServiceRate)) { // only perform query with numeric data
	$mysqli->query( "UPDATE Pricing SET servicesHourlyRate = '$newHourlyServiceRate' WHERE id=1" ); // update database pricing
     echo '<script type="text/javascript">
        alert ("Pricing modified successfully");
        window.location = "../../index.php#/home";
        </script>';
} else {
	echo '<script type="text/javascript">
        alert ("Pricing modification failed");
        window.location = "../../index.php#/home";
        </script>';
}