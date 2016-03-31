<?php
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

                <form name="userUserForm">
                    <div class="form-group-single">
                        <label>ENABLED STATUS</label>
                        <select class="select-box" title="Enabled grants the user access to the application" ng-value="">
                            <option>ENABLED</option>
                            <option>DISABLED</option>
                        </select>
                    </div>

                    <br/>

                    <div class="form-group-single">
                        <label>ADMIN STATUS</label>
                        <select class="select-box" title="Enabled grants the user admin privileges" ng-value="">
                            <option>ENABLED</option>
                            <option>DISABLED</option>
                        </select>
                    </div>

                    <br/>

                    <div class="form-group-single">
                        <label>CHANGE PASSWORD</label>
                        <input type="text" class="form-control" title="Enter a new password for the user">
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>
';
?>