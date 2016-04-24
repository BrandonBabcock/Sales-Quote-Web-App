<?php
// MySQL Connection Settings
$host     = "localhost"; // Host name
$username = "admin_salesform"; // Mysql username
$password = "mqJoPHm9LEz"; // Mysql password
$db_name  = "admin_salesform"; // Database name
$mysqli = new mysqli( $host, $username, $password, $db_name );
$dbh = new PDO('mysql:host=' . $host . ';' . 'dbname=' . $db_name, $username, $password);
?>