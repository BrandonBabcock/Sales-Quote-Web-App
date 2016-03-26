<?php
session_start();
$_SESSION['form'] = file_get_contents("php://input");
?>