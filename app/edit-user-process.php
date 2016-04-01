<?php
require('db.php');
session_start();
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
    header('location:index.php');
    exit(5);
}
ob_start();
$data = array();
parse_str(file_get_contents('php://input'), $data);
$_POST = array_merge($data, $_POST); // merge parsed modify user data with _POST session values
$modifyUsername = $_SESSION['userToModify'];
$modifyPassword = mysqli_real_escape_string($mysqli, $_POST['newPassword']);
$modifyPassword = hash('sha512', $modifyPassword);
$modifyAdminStatus = mysqli_real_escape_string($mysqli, $_POST['adminStatus']);
$modifyEnabledStatus = mysqli_real_escape_string($mysqli, $_POST['enabled']);
$sql = "UPDATE users SET pass = '$modifyPassword', admin = '$modifyAdminStatus' WHERE username = '$modifyUsername'"; // update user in DB
$results = $mysqli->query($sql);
if ($results) {
    echo '<script type="text/javascript">
        alert ("' . $modifyUsername . ' modified successfully");
        window.location.href="view/user-results.php";
</script>';
} else {
    echo '<script type="text/javascript">
        alert ("' . $modifyUsername . ' modification failed");
        window.location.href="view/user-results.php";
</script>';
}
