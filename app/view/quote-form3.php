<?php
echo '
<label class="large-label">Solution Specifics</label>
<br /> <br />

<form name="quoteForm3">
    <div class="form-group">
        <label>Number of Initiation Points (Source of Authority)</label>
        <input type="text" class="form-control" name="initiationPoints" ng-model="formData.initiationPoints" title="Enter the number of Source of Authorities">
        <label>Number of Password Management Targets</label>
        <input type="text" class="form-control" name="passTargets" ng-model="formData.passTargets" title="Enter the number of Password Management Targets" ng-disabled="formData.passwordManagement == \'NO\'">
    </div>

    <div class="form-group">
        <label>Number of Admin Provisioning Targets</label>
        <input type="text" class="form-control" name="numberOfAdminProvisioningTargets" ng-model="formData.numberOfAdminProvisioningTargets" title="Enter the number of Admin Provisioning Targets" ng-disabled="formData.provisioning == \'NO\'">
        <label>Number of Admin Prov. Workflows/Target</label>
        <input type="text" class="form-control" name="numberOfAdministrativeProvisionWorkflowsPerTarget" ng-model="formData.numberOfAdministrativeProvisionWorkflowsPerTarget" title="Enter the number of required Admin Provisioning workflows needed per target" ng-disabled="formData.provisioning == \'NO\'">
    </div>

    <div class="form-group">
        <label>Number of Automated Provisioning Targets</label>
        <input type="text" class="form-control" name="numberOfAutomatedProvisioningTargets" ng-model="formData.numberOfAutomatedProvisioningTargets" title="Enter the number of Auto Provisioning Targets" ng-disabled="formData.provisioning == \'NO\'">
        <label>Number of Automated Prov. Workflows/Target</label>
        <input type="text" class="form-control" name="numberOfAutomatedProvisiongWorkflowsPerTarget" ng-model="formData.numberOfAutomatedProvisiongWorkflowsPerTarget" title="Enter the number of required Auto Provisioning workflows needed per target. Add, Modify, Delete, Termination, Cleanup, etc..." ng-disabled="formData.provisioning == \'NO\'">
    </div>

    <div class="form-group">
        <label>Number of HPAM Account Types</label>
        <input type="text" class="form-control" name="hpamAccountTypes" ng-model="formData.hpamAccountTypes" title="Enter the number of unique HPAM Account Types that will be needed. Assumes Password Management Targets" ng-disabled="formData.hpam == \'NO\'">
        <label>Unique Connected System Definitions (total)</label>
        <input type="text" class="form-control" name="uniqueDefinitions" ng-model="formData.uniqueDefinitions" title="Enter the number of connected system definitions necessary to meet solution requirements. Assumes all target systems must be counted" ng-disabled="formData.passwordManagement == \'NO\' && formData.provisioning == \'NO\'">
    </div>

    <div class="form-group">
        <label>Number of Approval Configurations</label>
        <input type="text" class="form-control" name="approvalConfiguration" ng-model="formData.approvalConfiguration" title="" ng-disabled="formData.provisioning == \'NO\'">
        <label>Number of Selectable Resources</label>
        <input type="text" class="form-control" name="selectableResource" ng-model="formData.selectableResource" title="Enter the number of resources to be available for selection from the Self Service UI" ng-disabled="formData.provisioning == \'NO\'">
    </div>

    <div class="form-group">
        <label>Number of Resource Group Configurations</label>
        <input type="text" class="form-control" name="resourceGroupConfigs" ng-model="formData.resourceGroupConfigs" title="Number of different configurations necessary to meet known requirements" ng-disabled="formData.provisioning == \'NO\'">
        <label>Number of Policies</label>
        <input type="text" class="form-control" name="provisioningNumberOfPolicies" ng-model="formData.provisioningNumberOfPolicies" title="" ng-disabled="formData.provisioning == \'NO\'">
    </div>

    <div class="form-group">
        <label>Number of Organizations</label>
        <input type="text" class="form-control" name="organizations" ng-model="formData.organizations" title="Enter the number of organizations required to meet client\'s objectives">
        <label>Is IdP On-Premise or IaaS</label>
        <select name="idpOrIaas" ng-model="formData.idpOrIaas" class="select-box" title="" ng-disabled="formData.federation == \'NO\'" ng-change="idpOrIaasChange(formData.idpOrIaas)">
            <option>None</option>
            <option>IaaS</option>
            <option>On-Premise</option>
        </select>
    </div>

    <div class="form-group">
        <label>Number of IdPs</label>
        <input type="text" class="form-control" name="numOfIdp" ng-model="formData.numOfIdp" title="Enter the number of IdPs including Test and Production. 0 if IaaS" ng-disabled="formData.federation == \'NO\' || formData.model == \'IaaS\'">
        <label>Number of Shibboleth SPs to Shibbolize Apps</label>
        <input type="text" class="form-control" name="shibboleth" ng-model="formData.shibboleth" title="Enter the number of Shibboleth SPs to be installed for enabling application for SAML. Enter the number of SPs including Test and Production" ng-disabled="formData.federation == \'NO\'">
    </div>

    <div class="form-group">
        <label>Number of Discovery Services for Shibboleth SPs</label>
        <input type="text" class="form-control" name="discoveryServ" ng-model="formData.discoveryServ" title="Enter the number of Discovery Services to front-end Shibboleth SP to support multiple IdPs. Enter the number of DSs including Test and Production" ng-disabled="formData.federation == \'NO\'">
        <label>Number of SAML Enabled Fed. Targets (SPs)</label>
        <input type="text" class="form-control" name="fedTargets" ng-model="formData.fedTargets" title="Enter number of federated targets including Shibbolized applications, i.e: Google Apps, Salesforce, Educause, etc..." ng-disabled="formData.federation == \'NO\'">
    </div>

    <div class="form-group">
        <label># of Verified SFL Enabled Fed. Targets (SPs)</label>
        <input type="text" class="form-control" name="verifiedSfl" ng-model="formData.verifiedSfl" title="Enter the number of verified SLF federated targets, i.e: SunGard Portal" ng-disabled="formData.federation == \'NO\'">
        <label># of Non-Verified SFL Enabled Fed. Targets (SPs)</label>
        <input type="text" class="form-control" name="nonVerifiedSfl" ng-model="formData.nonVerifiedSfl" title="Enter number of non-verified SLF federated targets" ng-disabled="formData.federation == \'NO\'">
    </div>

    <div class="form-group">
        <label># of Attribute Management Processes</label>
        <input type="text" class="form-control" name="attManProccess" ng-model="formData.attManProccess" title="Enter the number of processes needed to manage the attributes required for federation" ng-disabled="formData.federation == \'NO\'">
        <label># of On-Going Attribute Management Processes</label>
        <input type="text" class="form-control" name="onGoingAttManProccess" ng-model="formData.onGoingAttManProccess" titl="Enter the number of on-going processes needed to manage the attributes required for federation" ng-disabled="formData.federation == \'NO\'">
    </div>

    <div class="form-group">
        <label>Include Post Implementation Services</label>
        <select name="postImpServices" ng-model="formData.postImpServices" class="select-box" title="Please select whether Post Implementation Services should be included in the estimate">
            <option>YES</option>
            <option>NO</option>
        </select>
        <label>User Account Load</label>
        <select name="userAccountLoad" ng-model="formData.userAccountLoad" class="select-box" title="If this option is selected, a load for each provisioning target will be assumed. Custom will assume multiple SOA\'s, Simple will assume a simple SoA flat file">
            <option>None</option>
            <option>Custom</option>
            <option>Simple</option>
        </select>
    </div>

    <label>Percentage of Solution Requirements Unknown</label>
    <input type="text" class="form-control" name="unknownPercentage" ng-model="formData.unknownPercentage" title="Enter the percentage of the solution requirements that are unknown. I.E: Very little of the solution requirements are known would equal a value of 90%">
</form>

<br />

<a ui-sref="quote.form4" class="btn btn-block btn-primary">
    NEXT <span class="glyphicon glyphicon-circle-arrow-right"></span>
</a>
';
?>