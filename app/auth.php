<?php
ob_start();
$params = json_decode(file_get_contents('php://input'),true);
var_dump($GLOBALS);
echo json_last_error();
$host     = "localhost"; // Host name
$username = "admin_salesform"; // Mysql username
$password = "mqJoPHm9LEz"; // Mysql password
$db_name  = "admin_salesform"; // Database name
$tbl_name = "users"; // Table name
exit(1);
// Connect to server and select databse.
$mysqli = new mysqli( $host, $username, $password, $db_name );

// Define $myusername and $mypassword
$myusername = $_POST['inputUsername'];
$mypassword = $_POST['inputPassword'];

$myusername = stripslashes( $myusername ); // Stripslashes function prevents SQL injections
$mypassword = stripslashes( $mypassword );
$myusername = mysqli_real_escape_string( $mysqli, $myusername );
$mypassword = mysqli_real_escape_string( $mysqli, $mypassword );
$result     = $mysqli->query( "SELECT * FROM $tbl_name WHERE username='$myusername' and pass='$mypassword'" );
$row        = mysqli_fetch_assoc( $result );
// Mysql_num_row is counting table row
$count = mysqli_num_rows( $result );

// If result matched $myusername and $mypassword, table row must be 1 row
if ( $count == 1 ) {
	session_start();

// Register $myusername, $mypassword and redirect to file "main.php"
	$_SESSION['username'] = $myusername;
	$_SESSION['admin'] = $row['admin']; // store admin status, will be 'true' if user is admin
	header( "location:index.php#/home" );
} else { // invalid login
	header( "location:index.php" );
}
ob_end_flush();
?>