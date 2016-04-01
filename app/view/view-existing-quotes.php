<?php
session_start();
if ( !isset( $_SESSION['username'] ) ) { // make sure user is logged in
    header( "location:index.php" );
    exit(6);
}
echo '

<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../app/index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="../app/logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">View Existing Quotes</div>
        <div class="panel-body">
            <div class="col-sm-8 col-sm-offset-2">
                <form name="searchQuotesForm" method=POST" action="quote-search.php">
                    <div class="form-group">
                        <input type="text" class="form-control" name="searchQuotes" ng-model="searchQuotes" id="searchQuotes" placeholder="Client Name" title="Enter a client name to search for quotes for that client">
                        <input type="submit" class="btn btn-block btn-primary" Value="Search for Quotes">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

';
?>