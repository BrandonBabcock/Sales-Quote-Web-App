<?php
session_start();
$_SESSION['form'] = file_get_contents("php://input");
//parse_str(file_get_contents('php://input'), $data);
?>