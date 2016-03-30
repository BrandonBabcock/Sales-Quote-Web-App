<?php
session_start();
if ( !isset( $_SESSION['username'] ) ) { // make sure user is logged in
    header( "location:index.php" );
    exit(6);
}
$_SESSION['form'] = file_get_contents("php://input");
?>