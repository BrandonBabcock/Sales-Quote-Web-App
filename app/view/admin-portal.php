<?php
echo '
<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../app/index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="../app/logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">WHAT WOULD YOU LIKE TO DO?</div>
        <div class="panel-body">
            <div class="row col-lg-4 col-lg-offset-4">
                <a ui-sref="modifyPrice" class="btn btn-block btn-primary">
                    Modify Pricing <span class="glyphicon glyphicon-circle-arrow-right"></span>
                </a>
                <br />
                <a ui-sref="users" class="btn btn-block btn-primary">
                   Manage Users  <span class="glyphicon glyphicon-circle-arrow-right"></span>
                </a>

            </div>
        </div>
    </div>
</div>
';
?>