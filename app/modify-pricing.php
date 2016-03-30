<?php
require("db.php");
session_start();
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
	header('location:index.php');
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
	$mysqli->query( "UPDATE Pricing SET servicesHourlyRate = '$newHourlyServiceRate' WHERE id=1" ); // update DB pricing
}
header('location:index.php#/home');