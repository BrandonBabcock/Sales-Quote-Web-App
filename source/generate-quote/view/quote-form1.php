<?php
session_start();
if ( !isset( $_SESSION['username'] ) ) { // make sure user is logged in
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
echo '
<label class="large-label">Discovery</label>
<br /> <br />

<form name="quoteForm1">
    <div class="form-group">
       <label>Name</label>
        <input type="text" class="form-control" name="name" ng-model="formData.name" id="clientName" placeholder="Client Name" title="Enter Client Name" required>
        <div ng-messages="theForm.name.$error">
            <div ng-message="required" class="error-text">Field Required</div>
        </div>
        <label>Desired Start Date</label>
        <input type="text" class="form-control" name="startDate" ng-model="formData.startDate" id="desiredStartDate" placeholder="Desired Start Date: MM/DD/YYYY" title="Enter Start Date" required pattern="[0-9]{2}[/][0-9]{2}[/][0-9]{4}$">
        <div ng-messages="theForm.startDate.$error">
            <div ng-message="required" class="error-text">Field Required</div>
            <div ng-message="pattern" class="error-text">Invalid Date Format: Use MM/DD/YYYY</div>
        </div>
     </div>

    <div class="form-group">
        <label>Quote Completion Date</label>
        <input type="text" class="form-control" name="completionDate" ng-model="formData.completionDate" id="todayDate" title="Today\'s Date" disabled>

        <label>Model</label><br>
        <select name="model" ng-model="formData.model" class="select-box" title="Enter IaaS / On-Premise" ng-change="changeNumOfEnvironAndHA()">
            <option>IaaS</option>
            <option>On-Premise</option>
        </select>
    </div>

    <div>
        <label>Additional Development Environment</label>
        <select name="additionalEnvironment" ng-model="formData.additionalEnvironment" class="select-box" id="additionalEnvironment" title="Enter Yes / No" ng-change="changeNumOfEnvironAndHA()">
            <option>YES</option>
            <option>NO</option>
        </select>
    </div>
</form>

<br />

<a ui-sref="quoteForm.form2" class="btn btn-block btn-primary">
    NEXT <span class="glyphicon glyphicon-circle-arrow-right"></span>
</a>
';
?>