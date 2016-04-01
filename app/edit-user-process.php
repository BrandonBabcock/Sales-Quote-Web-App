<?php
require( 'db.php' );
session_start();
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
    header('location:index.php');
    exit(5);
}
ob_start();
$data = array();
parse_str( file_get_contents( 'php://input' ), $data );
$_POST    = array_merge( $data, $_POST ); // merge parsed modify user data with _POST session values
var_dump($GLOBALS);