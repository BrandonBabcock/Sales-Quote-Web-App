<?php
require('../db.php');
session_start();
if (!isset($_SESSION['username'])) { // make sure user is logged in
    header("location:index.php");
    exit(6);
}
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
    header("location:index.php");
    exit(5);
}
$user = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_STRING);
$user = mysqli_real_escape_string($mysqli, $user);
$_SESSION['userToModify'] = $user;
echo '
<!-- Link stylesheets -->
<!-- Documentation for second style sheet: https://bootswatch.com/darkly/ -->
<link rel="stylesheet" href="../../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/darkly/bootstrap.css">

<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="../logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Edit User</div>
        <div class="panel-body">
            <div class="row col-lg-4 col-lg-offset-4">

                <form name="userUserForm" method="post" action="../edit-user-process.php">
                <fieldset>
                    <div class="form-group-single">
                        <label>ENABLED STATUS</label>
                        <select name="enabled" class="select-box" title="true grants the user access to the application" ng-value="">
                            <option>true</option>
                            <option>false</option>
                        </select>
                    </div>

                    <br/>

                    <div class="form-group-single">
                        <label>ADMIN STATUS</label>
                        <select name="adminStatus" class="select-box" title="true grants the user admin privileges" ng-value="">
                            <option>true</option>
                            <option>false</option>
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