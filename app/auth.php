<?php
require('db.php');
session_start();
ob_start();
$data = array();
parse_str(file_get_contents('php://input'), $data);
$_POST = array_merge($data, $_POST); // merge parsed login data with _POST session values
$tbl_name = 'users';
// Define $myusername and $mypassword
$myusername = $_POST['inputUsername'];
$mypassword = $_POST['inputPassword'];

$myusername = stripslashes( $myusername ); // Stripslashes function prevents SQL injections
$mypassword = stripslashes( $mypassword );

$myusername = mysqli_real_escape_string( $mysqli, $myusername );
$mypassword = mysqli_real_escape_string( $mysqli, $mypassword );
$result     = $mysqli->query( "SELECT * FROM $tbl_name WHERE username='$myusername' and pass='$mypassword'" );

if ($mysqli->connect_errno) { // exit on connection failure
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}
$row        = mysqli_fetch_assoc( $result );

// Mysql_num_row is counting table row
$count = mysqli_num_rows( $result );
// If result matched $myusername and $mypassword, table row must be 1 row
if ( $count == 1 ) {
// Register $myusername, $mypassword and redirect to file "main.php"
	$_SESSION['username'] = $myusername;
	$_SESSION['admin'] = $row['admin']; // store admin status, will be 'true' if user is admin
	if($_SESSION['admin']=='true'){
		header( "location:index.php#/adminLanding" );
	}else{
		header( "location:index.php#/home" );
	}

} else { // invalid login
	header( "location:index.php" );
}
ob_end_flush();
?>