<?php
session_start();
if ( !isset( $_SESSION['username'] ) ) { // make sure user is logged in
    header( "location:../shared/redirect.php" );
    exit(6);
}
require("../shared/status.php");
if ($_SESSION['enabled'] != 'true') { // non-enabled account tried to access page
    header('location:../shared/redirect.php');
    exit(5);
}
$_SESSION['form'] = file_get_contents("php://input");
?>