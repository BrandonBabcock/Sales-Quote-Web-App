<?php
echo '
<label class="large-label">Discovery</label>
<br /> <br />

<form name="quoteForm1">
    <div class="form-group">
       <label>Name</label>
        <input type="text" class="form-control" name="name" ng-model="formData.name" id="clientName" placeholder="Client Name" title="Enter Client Name">
        <label>Desired Start Date</label>
        <input type="text" class="form-control" name="startDate" ng-model="formData.startDate" id="desiredStartDate" placeholder="Desired Start Date: MM/DD/YYY" title="Enter Start Date">
     </div>
    <div class="form-group">
        <label>Quote Completion Date</label>
        <input type="text" class="form-control" name="completionDate" ng-model="formData.completionDate" id="todayDate" title="Today\'s Date" ng-disabled="true">

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

<a ui-sref="quote.form2" class="btn btn-block btn-primary">
    NEXT <span class="glyphicon glyphicon-circle-arrow-right"></span>
</a>
';
?>