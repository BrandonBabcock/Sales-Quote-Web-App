<?php
require('../../database/db.php');
session_start();
ob_start();
$data = array();
parse_str( file_get_contents( 'php://input' ), $data );
$_POST    = array_merge( $data, $_POST ); // merge parsed login data with _POST session values
// Define $myusername and $mypassword
$myusername = $_POST['inputUsername'];
$mypassword = $_POST['inputPassword'];

$myusername = mysqli_real_escape_string( $mysqli, $myusername );
$mypassword = mysqli_real_escape_string( $mysqli, $mypassword );
$mypassword = hash('sha512', $mypassword);
$stmt = $dbh->prepare( "
        SELECT 
            * 
         FROM 
            users 
        WHERE 
            username = :myusername
            AND
            pass = :mypassword
			AND
			enabled = 'true'
    " );

// Bind the query parameters
$stmt->bindParam( ':myusername', $myusername, PDO::PARAM_STR );
$stmt->bindParam( ':mypassword', $mypassword, PDO::PARAM_STR );
$stmt->execute();

if ( $stmt->errorCode() != 00000 ) { // exit on connection failure
	printf( "Connect failed: %s\n", $mysqli->connect_error );
	exit();
}
// If result has a valid match of $myusername and $mypassword, 1 row should be returned
if ( $stmt->rowCount() == 1 ) {
	$result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch as an associative array
	$_SESSION['username'] = $result['username'];
	$_SESSION['admin']    = $result['admin']; // store admin status, will be 'true' if user is admin
	header( "location:../../index.php#/home" );
} else { // invalid login
	echo '<script type="text/javascript">
        alert ("An invalid username or password was entered");
        window.location.href = "../../index.php";
        </script>';}
ob_end_flush();
?>