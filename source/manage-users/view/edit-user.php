<?php
require('../../../database/db.php');
session_start();
if (!isset($_SESSION['username'])) { // make sure user is logged in
    echo '<script type="text/javascript">
        alert ("Access Denied");
        window.location.href = "../../shared/redirect.php";
        </script>';
    exit(6);
}
require("../../shared/status.php");
if ($_SESSION['enabled'] != 'true') { // non-enabled account tried to access page
    echo '<script type="text/javascript">
        alert ("Access Denied");
        window.location.href = "../../shared/redirect.php";
        </script>';
    exit(5);
}
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
    echo '<script type="text/javascript">
        alert ("Access Denied");
        window.location.href = "../../shared/redirect.php";
        </script>';
    exit(5);
}
$user = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_STRING);
$user = mysqli_real_escape_string($mysqli, $user);
$_SESSION['userToModify'] = $user;
$sql = $dbh->prepare("
        SELECT
              admin, enabled
        FROM
              users
        WHERE
              username = :username
        ");
$sql->bindParam(":username", $user, PDO::PARAM_STR);
$valid = $sql->execute();
if ($sql->rowCount() < 1) { // user doesn't exist
    echo '<script type="text/javascript">
        alert ("User does not exist!");
        window.location = "../../../index.php#/user-search";
</script>';
}
$results = $sql->fetch(PDO::FETCH_ASSOC);
$accountEnabled;
$accountDisabled;
if ($results['enabled'] == 'true') {
    $accountEnabled = 'selected';
    $accountDisabled = '';
} else {
    $accountEnabled = '';
    $accountDisabled = 'selected';
}
$adminEnabled;
$adminDisabled;
if ($results['admin'] == 'true') {
    $adminEnabled = 'selected';
    $adminDisabled = '';
} else {
    $adminEnabled = '';
    $adminDisabled = 'selected';
}
echo '
        <!-- Link stylesheets -->
        <!-- Documentation for second style sheet: https://bootswatch.com/darkly/ -->
	    <link rel="stylesheet" href="../../../assets/css/custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/darkly/bootstrap.min.css">

        <!-- Load in Global Dependencies -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.18/angular-ui-router.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular-animate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.5.5/angular-messages.min.js"></script>

<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../../../index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="../../shared/logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Edit User</div>
        <div class="panel-body">
            <div class="row col-lg-4 col-lg-offset-4">

                <form name="userUserForm" method="post" action="../update-user.php">
                <fieldset>
                    <div class="form-group-single">
                        <label>ADMIN STATUS</label>
                        <select name="adminStatus" class="select-box" title="true grants the user admin privileges">
                            <option ' . $adminEnabled . '>true</option>
                            <option ' . $adminDisabled . '>false</option>
                        </select>
                    </div>

                    <br/>
                    <div class="form-group-single">
                        <label>ENABLED STATUS</label>
                        <select name="enabled" class="select-box" title="true grants the user access to the application">
                            <option ' . $accountEnabled . '>true</option>
                            <option ' . $accountDisabled . '>false</option>
                        </select>
                    </div>

                    <br/>

                    <div class="form-group-single">
                        <label>CHANGE PASSWORD</label>
                        <input type="text" name="newPassword" class="form-control" title="Enter a new password for the user" placeholder="New Password">
                    </div>
                    </fieldset>
                    <br />
                 <input type="submit" class="btn btn-block btn-primary" value="Update User">
                </form>
            </div>
        </div>
    </div>
</div>
';
?>