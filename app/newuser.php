<?php
require('db.php');
session_start();
$data = array();
parse_str(file_get_contents('php://input'), $data);
$_POST = array_merge($data, $_POST); // merge parsed login data with _POST session values
// testing data
$_POST['newusername'] = "test32";
$_POST['newpassword'] = "pass";
$_POST['newadmin'] = "true";
$newusername = mysqli_real_escape_string($mysqli, $_POST['newusername']);
$newpassword = mysqli_real_escape_string($mysqli, $_POST['newpassword']);
$newpassword = hash('sha512', $newpassword); // hash password
$newadmin = mysqli_real_escape_string($mysqli, $_POST['newadmin']);
$results = $mysqli->query("SELECT username from users WHERE username = '$newusername'"); // see if username already exists
if ($results->num_rows > 0) { // username already exists
    echo '<script type="text/javascript">
        alert ("username already exists!");
</script>';
} else {
    $sql = "INSERT into users (username, pass, admin) VALUES ('$newusername', '$newpassword', '$newadmin')";
    $mysqli->query($sql);
    echo '<script type="text/javascript">
        alert ("username created successfully");
</script>';
}
