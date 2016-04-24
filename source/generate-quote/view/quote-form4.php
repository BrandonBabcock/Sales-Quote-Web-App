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
<form name="quoteForm4">
    <label class="large-label">Training</label>
    <br />
    <select name="training" ng-model="formData.training" class="select-box" title="">
        <option>YES</option>
        <option>NO</option>
    </select>
    <br />
    <br />
    <div class="form-group">
        <label>Basic Training</label>
        <select name="basicTraining" ng-model="formData.basicTraining" class="select-box" title="Will basic product training be required? No if IaaS" ng-disabled="formData.model == \'IaaS\' || formData.training == \'NO\'">
            <option>YES</option>
            <option>NO</option>
        </select>
        <label>Advanced Training</label>
        <select name="advancedTraining" ng-model="formData.advancedTraining" class="select-box" title="Will advanced product training be required? No if IaaS" ng-disabled="formData.model == \'IaaS\' || formData.training == \'NO\'">
            <option>YES</option>
            <option>NO</option>
        </select>
    </div>

    <div class="form-group">
        <label>Kiosk UI Training</label>
        <br>
        <select name="kioskTraining" ng-model="formData.kioskTraining" class="select-box" title="Will Kiosk training be required?" ng-disabled="formData.training == \'NO\'">
            <option>YES</option>
            <option>NO</option>
        </select>
        <label>Pin Reset UI Training</label>
        <select name="pinTraining" ng-model="formData.pinTraining" class="select-box" title="Will SMS Pin Reset training be required?" ng-disabled="formData.training == \'NO\'">
            <option>YES</option>
            <option>NO</option>
        </select>
    </div>

    <div class="form-group">
        <label>Help Desk UI Training</label>
        <select name="helpDeskTraining" ng-model="formData.helpDeskTraining" class="select-box" title="Will Help Desk training be required?" ng-disabled="formData.training == \'NO\'">
            <option>YES</option>
            <option>NO</option>
        </select>
        <label>Self Service Access Management UI Training</label>
        <select name="selectServiceTraining" ng-model="formData.selectServiceTraining" class="select-box" title="Will Request Access, Change Access, Remove Access and Approval training be required?" ng-disabled="formData.training == \'NO\'">
            <option>YES</option>
            <option>NO</option>
        </select>
    </div>

    <div class="form-group">
        <label>HPAM UI Training </label>
        <select name="hpamTraining" ng-model="formData.hpamTraining" class="select-box" title="Will HPAM training be required" ng-disabled="formData.training == \'NO\'">
            <option>YES</option>
            <option>NO</option>
        </select>
        <label>Federation Configuration Testing</label>
        <select name="federationConfigTraining" ng-model="formData.federationConfigTraining" class="select-box" title="Will Configuration training be required?" ng-disabled="formData.training == \'NO\'">
            <option>YES</option>
            <option>NO</option>
        </select>
    </div>
</form>

<a class="btn btn-block btn-primary" ng-click="processForm()" ng-disabled="theForm.$invalid">
    SUBMIT<span class="glyphicon glyphicon-circle-arrow-right"></span>
</a>
';
?>