<?php
require('../../database/db.php');
session_start();
if (!isset($_SESSION['username']) || $_SESSION['admin'] != 'true') { // non-administrator tried to access page
    header('location:../shared/redirect.php');
    exit(5);
}
require("../shared/status.php");
if ($_SESSION['enabled'] != 'true') { // non-enabled account tried to access page
    header('location:../shared/redirect.php');
    exit(5);
}
ob_start();
$data = array();
parse_str(file_get_contents('php://input'), $data);
$_POST = array_merge($data, $_POST); // merge parsed modify user data with _POST session values
$modifyUsername = $_SESSION['userToModify'];
$modifyPassword;
if (!empty($_POST['newPassword'])) {
    $modifyPassword = mysqli_real_escape_string($mysqli, $_POST['newPassword']);
    $modifyPassword = hash('sha512', $modifyPassword);
}
$modifyAdminStatus = mysqli_real_escape_string($mysqli, $_POST['adminStatus']);
$modifyEnabledStatus = mysqli_real_escape_string($mysqli, $_POST['enabled']);
$sql = "SELECT count(*) num from users where username = '$modifyUsername'";
$result = $mysqli->query($sql);
$row = mysqli_fetch_assoc($result);
if ($row['num'] == 1) {
    if (!empty($modifyPassword)) {
        $sql = "UPDATE users SET pass = '$modifyPassword', admin = '$modifyAdminStatus', enabled = '$modifyEnabledStatus' WHERE username = '$modifyUsername'"; // update user in database
    } else {
        $sql = "UPDATE users SET admin = '$modifyAdminStatus', enabled = '$modifyEnabledStatus' WHERE username = '$modifyUsername'"; // update user in database
    }
    $results = $mysqli->query($sql);
    if ($results) {
        echo '<script type="text/javascript">
        alert ("' . $modifyUsername . ' modified successfully");
        window.location.href="../../index.php#/home";
</script>';
    } else {
        echo '<script type="text/javascript">
        alert ("' . $modifyUsername . ' modification failed");
        window.location.href="../../index.php#/home";
</script>';
    }
} else {
    echo '<script type="text/javascript">
        alert ("' . $modifyUsername . ' modification failed");
        window.location.href="../../index.php#/home";
</script>';
}