<?php
require("../db.php");
session_start();
if ($_SESSION['admin'] != 'true') { // non-administrator tried to access page
    header("location:index.php");
    exit(5);
}
$result     = $mysqli->query( "SELECT * FROM Pricing WHERE id=1" ); // Must read price from DB
$row        = mysqli_fetch_assoc( $result );
$servicesHourlyRate = $row['servicesHourlyRate'];
echo '<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="../app/index.php#/home" class="btn btn-primary">Home</a>
        <a ng-model="logoutButton" href="../logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">MODIFY PRICING</div>
        <div class="panel-body">
            <form name="modifyPricingForm" method="post" action="modifypricing.php">
                <div class="form-group">
                    <label>CURRENT SERVICES HOURLY RATE</label>
                    <input type="text" class="form-control" name="currentServicesHourlyRate" ng-disabled="true" ng-value="' . $servicesHourlyRate . '" id="currentServicesHourlyRate" title="The current services hourly rate">
                    <label>NEW DESIRED SERVICES HOURLY RATE</label>
                    <input type="text" class="form-control" name="newServicesHourlyRate" ng-model="newServicesHourlyRate" id="newServicesHourlyRate" title="Enter the new services hourly rate" placeholder="New Services Hourly Rate">
                </div>
                <div align="center">
                    <input type="submit" class="btn btn-block btn-primary" value="Update Pricing">
                </div>
            </form>
        </div>
    </div>
</div>';
?>