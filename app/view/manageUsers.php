<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../app/index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="../app/logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Manage Users</div>
        <div class="panel-body">
            <div class="col-sm-8 col-sm-offset-2">
                <form name="searchUsersForm">
                    <div class="form-group">
                        <input type="text" class="form-control" name="searchUsers" ng-model="searchUsers" id="searchUsers" placeholder="Username" title="Enter a username to search for">
                        <input type="submit" class="btn btn-block btn-primary" Value="Search for Users">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

?>
