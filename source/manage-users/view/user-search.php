<?php
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
if ($_SESSION['admin'] != 'true') {
    echo '<script type="text/javascript">
        alert ("Access Denied");
        window.location.href = "../../shared/redirect.php";
        </script>';
    exit(2);
}
echo '
<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="source/shared/logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Manage Users</div>
        <div class="panel-body">
            <div class="col-sm-8 col-sm-offset-2">
                <form name="searchUsersForm" method="post" action="source/manage-users/view/user-results.php">
                    <div class="form-group">
                        <input type="text" class="form-control" name="searchUsers" ng-model="searchUsers" id="searchUsers" placeholder="Username" title="Enter a username to search for">
                        <input type="submit" class="btn btn-block btn-primary" Value="Search for Users">
                    </div>
                </form>
				<a ui-sref="addNewUser" class="btn btn-block btn-primary">
					Add New User</span>
				</a>
            </div>
        </div>
    </div>
</div>
';
?>
