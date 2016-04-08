<?php
session_start();
if (!isset($_SESSION['username'])) { // make sure user is logged in
    header("location:index.php");
    exit(6);
}
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
    header("location:index.php");
    exit(5);
}
echo '
<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../app/index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="../app/logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Manage Users</div>
        <div class="panel-body">
            <div class="col-sm-8 col-sm-offset-2">
                <form name="addNewUserForm" method="post" action="new-user.php">
                    <div class="form-group">
                        <label>New User Username</label>
                        <input type="text" class="form-control" name="newUserUsername" ng-model="newUserUsername" id="newUserUsername" placeholder="New User Username" title="Enter a username for the new user">
                        <label>New User Password</label>
                        <input type="password" class="form-control" name="newUserPassword" ng-model="newUserPassword" id="newUserPassword" placeholder="New User Password" title="Enter a password for the new user">
                    </div>
                    <div class="form-group-single">
                     <label>New User Administrator Status</label>
                        <select name="adminStatus" class="select-box" title="true grants the user admin privileges" ng-value="">
                            <option>true</option>
                            <option>false</option>
                        </select>
                        </div>
                        <br>
                    <input type="submit" class="btn btn-block btn-primary" Value="Add User">
                </form>
            </div>
        </div>
    </div>
</div>
';
?>