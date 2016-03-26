<?php
require('db.php');
session_start();
ob_start();
$data = array();
parse_str(file_get_contents('php://input'), $data);
$_POST = array_merge($data, $_POST); // merge parsed login data with _POST session values
$tbl_name = 'users';

$userFirstName = $_POST['newUserName'];
$userLastName = $_POST['newlastName'];
$useruserName = $_POST['newusername'];
$userpassName = $_POST['newpassword'];
$useradminName = $_POST['newuseradmin'];

$userFirstName = stripslashes( $userFirstName ); // Stripslashes function prevents SQL injections
$userLastName = stripslashes( $userLastName );
$useruserName = stripslashes( $useruserName );
$userpassName = stripslashes( $userpassName );
$useradminName  = stripslashes( $useradminName  );

$userFirstName= mysqli_real_escape_string( $mysqli, $userFirstName );
$userLastName= mysqli_real_escape_string( $mysqli, $userLastName );
$useruserName= mysqli_real_escape_string( $mysqli, $useruserName );
$userpassName= mysqli_real_escape_string( $mysqli, $userpassName );
$useradminName = mysqli_real_escape_string( $mysqli, $useradminName );

$sql   = "INSERT INTO '$tbl_name' (username,password,admin) VALUES('$useruserName','$userpassName','false')";
$mysqli->query($sql);
if ($mysqli->connect_errno) { // exit on connection failure
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
header( "location:index.php#/users" );

