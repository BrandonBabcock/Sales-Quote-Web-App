<?php
require("../../../database/db.php");
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
$result     = $mysqli->query( "SELECT * FROM Pricing WHERE id=1" ); // Must read price from database
$row        = mysqli_fetch_assoc( $result );
$servicesHourlyRate = $row['servicesHourlyRate'];
echo '<div align="right" class="btn-toolbar rightCornerButton">
    <a ng-model="homeButton" href="index.php#/home" class="btn btn-primary">Home</a>
    <a ng-model="logoutButton" href="source/shared/logout.php" class="btn btn-primary">Log Out</a>
</div>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">MODIFY PRICING</div>
        <div class="panel-body">
            <form name="modifyPricingForm" method="post" action="source/modify-pricing/update-pricing.php" novalidate>
                <div class="form-group">
                    <label>CURRENT SERVICES HOURLY RATE</label>
                    <input type="text" class="form-control" name="currentServicesHourlyRate" ng-disabled="true" ng-value="' . $servicesHourlyRate . '" id="currentServicesHourlyRate" title="The current services hourly rate">
                    <label>NEW DESIRED SERVICES HOURLY RATE</label>
                    <input type="number" class="form-control" name="newServicesHourlyRate" ng-model="newServicesHourlyRate" id="newServicesHourlyRate" title="Enter the new services hourly rate" placeholder="New Services Hourly Rate" required>
                    <div ng-messages="modifyPricingForm.newServicesHourlyRate.$error">
                        <div ng-message="required" class="error-text">Required</div>
                    </div>
                </div>
                <div align="center">
                    <input type="submit" class="btn btn-block btn-primary" value="Update Pricing" ng-disabled="modifyPricingForm.$invalid">
                </div>
            </form>
        </div>
    </div>
</div>';
?>
