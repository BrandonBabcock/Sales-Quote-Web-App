<?php
require('db.php');
session_start();
$data = array();
parse_str(file_get_contents('php://input'), $data);
$_POST = array_merge($data, $_POST); // merge parsed form data with _POST session values
if (is_string($_SESSION['form'])) { // don't run if form data has already been parsed
    $_SESSION['form'] = json_decode($_SESSION['form'], true); // decodes JSON data sent by angularJS frontend and converts to PHP associative array
}
var_dump($GLOBALS);
$sql = "INSERT INTO Quotes (name, completionDate, model, additionalEnvironment, discountHourly, salesDiscount, servicesHourlyRate, numberOfEnvironments, haServers, globalIdentityGateways, passwordFilters, passwordManagement, numberOfAdminProvisioningTargets, hpam, federation, passwordManagementWorkshop, provWorkshop, hpamWorkshop, federationWorkshop, initiationPoints, passTargets, numberOfAdministrativeProvisionWorkflowsPerTarget, numberOfAutomatedProvisioningTargets, numberOfAutomatedProvisiongWorkflowsPerTarget, hpamAccountTypes, uniqueDefinitions, approvalConfiguration, selectableResource, resourceGroupConfigs, provisioningNumberOfPolicies, organizations, idpOrIaas, numOfIdp, shibboleth, discoveryServ, fedTargets, verifiedSfl, nonVerifiedSfl, attManProccess, onGoingAttManProccess, postImpServices, userAccountLoad, unknownPercentage, training, basicTraining, advancedTraining, kioskTraining, pinTraining, helpDeskTraining, selectServiceTraining, hpamTraining, federationConfigTraining )
 VALUES ({$_SESSION['form']['name']}, {$_SESSION['form']['completionDate']}, {$_SESSION['form']['model']}, {$_SESSION['form']['additionalEnvironment']}, {$_SESSION['form']['discountHourly']}, {$_SESSION['form']['salesDiscount']}, {$_SESSION['form']['servicesHourlyRate']}, {$_SESSION['form']['numberOfEnvironments']}, {$_SESSION['form']['haServers']}, {$_SESSION['form']['globalIdentityGateways']}, {$_SESSION['form']['passwordFilters']}, {$_SESSION['form']['passwordManagement']}, {$_SESSION['form']['provWorkshop']}, {$_SESSION['form']['hpamWorkshop']}, {$_SESSION['form']['federationWorkshop']}, {$_SESSION['form']['initiationPoints']}, {$_SESSION['form']['passTargets']}, {$_SESSION['form']['numberOfAdminProvisioningTargets']}, {$_SESSION['form']['numberOfAdministrativeProvisionWorkflowsPerTarget']}, {$_SESSION['form']['numberOfAutomatedProvisioningTargets']}, {$_SESSION['form']['numberOfAutomatedProvisiongWorkflowsPerTarget']}, {$_SESSION['form']['hpamAccountTypes']}, {$_SESSION['form']['uniqueDefinitions']}, {$_SESSION['form']['approvalConfiguration']}, {$_SESSION['form']['selectableResource']}, {$_SESSION['form']['resourceGroupConfigs']}, {$_SESSION['form']['provisioningNumberOfPolicies']}, {$_SESSION['form']['organizations']}, {$_SESSION['form']['idpOrIaas']}, {$_SESSION['form']['numOfIdp']}, {$_SESSION['form']['shibboleth']}, {$_SESSION['form']['discoveryServ']}, {$_SESSION['form']['fedTargets']}, {$_SESSION['form']['verifiedSfl']}, {$_SESSION['form']['nonVerifiedSfl']}, {$_SESSION['form']['attManProccess']}, {$_SESSION['form']['onGoingAttManProccess']}, {$_SESSION['form']['postImpServices']}, {$_SESSION['form']['userAccountLoad']}, {$_SESSION['form']['unknownPercentage']}, {$_SESSION['form']['training']}, {$_SESSION['form']['basicTraining']}, {$_SESSION['form']['advancedTraining']}, {$_SESSION['form']['kioskTraining']}, {$_SESSION['form']['pinTraining']}, {$_SESSION['form']['helpDeskTraining']}, {$_SESSION['form']['selectServiceTraining']}, {$_SESSION['form']['hpamTraining']}, {$_SESSION['form']['federationConfigTraining']} )";
$unknownRequirements = $_SESSION['form']['unknownPercentage'] / 100; // Metrics.B64
// Must read price from DB
$servicesHourlyRate = 125.00;
// Environment Specifics
$environmentPlatformInstallHours = (($_SESSION['form']['numberOfEnvironments'] * 2) * $_SESSION['form']['unknownPercentage']) + ($_SESSION['form']['numberOfEnvironments'] * 2); // =((+$Metrics.B15*2)*$Metrics.B64)+(+$Metrics.B15*2)
$haServerHours = ($_SESSION['form']['haServers'] * $unknownRequirements) + $_SESSION['form']['numberOfEnvironments']; // =((+$Metrics.B16*1)*$Metrics.B64)+(+$Metrics.B16*1)
$gigInstallHours = ((($_SESSION['form']['globalIdentityGateways'] * .5) * $unknownRequirements) + ($_SESSION['form']['globalIdentityGateways'] * .5));
$msPasswordFilterHours = (($_SESSION['form']['passwordFilters'] * .25) * $unknownRequirements) + ($_SESSION['form']['passwordFilters'] * .25); // =((+$Metrics.B18*15)/60*+$Metrics.B64)+((+$Metrics.B18*15)/60)
$environmentOrganizationConfigurationHours = $_SESSION['form']['organizations'] * $unknownRequirements + $_SESSION['form']['organizations']; // =(+$Metrics.B42*+$Metrics.B64)+(+$Metrics.B42)
$environmentConnectedSystemDefinitionsHours = ($_SESSION['form']['uniqueDefinitions'] * .25 * $unknownRequirements) + ($_SESSION['form']['uniqueDefinitions'] * .25);
$environmentDocumentConfigurationsHours = ($_SESSION['form']['numberOfEnvironments'] * $unknownRequirements) + ($_SESSION['form']['numberOfEnvironments'] * .25); // =((($Metrics.B15*15)/60)*$Metrics.B64)+(($Metrics.B15*15)/60) conflict between formula and comments
$environmentImplementationEffortHours = $environmentDocumentConfigurationsHours + $environmentConnectedSystemDefinitionsHours + $environmentOrganizationConfigurationHours + $environmentPlatformInstallHours + $haServerHours + $haServerHours + $msPasswordFilterHours;
$environmentProjectManagementHours = $environmentImplementationEffortHours * .1;
$environmentTotalPlatformInstallHours = $environmentPlatformInstallHours + $haServerHours + $haServerHours + $msPasswordFilterHours;
$totalEnvironmentHours = $environmentProjectManagementHours + $environmentImplementationEffortHours;
// Pasword Management Effort
$passwordWorkshopAndDesignDocHours = ($_SESSION['form']['passTargets'] * 2 * $unknownRequirements) + ($_SESSION['form']['passTargets'] * 2) * 2;
$passwordConfigurationHours = ($_SESSION['form']['passTargets'] * 2 * $unknownRequirements) + ($_SESSION['form']['passTargets'] * 2);
$passwordProductionMigrationHours = ($_SESSION['form']['passTargets'] * 2 * $unknownRequirements) + ($_SESSION['form']['passTargets']);
$passwordPostImplementationServicesHours = ($_SESSION['form']['passTargets'] * 2 * $unknownRequirements) + ($_SESSION['form']['passTargets'] * 2);
if ($_SESSION['form']['kioskTraining'] == 'yes') {
    $passwordUiTrainingHours = 1 * $unknownRequirements + 1;
} else {
    $passwordUiTrainingHours = 0;
}
$passwordSolutionDocumentationHours = ($_SESSION['form']['passTargets'] * 2 * $unknownRequirements) + ($_SESSION['form']['passTargets']);
$passwordImplmentationServiceHours = $passwordSolutionDocumentationHours + $passwordUiTrainingHours + $passwordProductionMigrationHours + $passwordPostImplementationServicesHours + $passwordConfigurationHours + $passwordWorkshopAndDesignDocHours;
$passwordProjectManagementHours = $passwordImplmentationServiceHours * .1;
$totalPasswordHours = $passwordProjectManagementHours + $passwordImplmentationServiceHours;
// Provisioning Effort
$numberOfAutomatedProvisioningTargets = $_SESSION['form']['numberOfAutomatedProvisioningTargets'];
$numberOfAutomatedProvisioningWorkflowsPerTarget = $_SESSION['form']['numberOfAutomatedProvisiongWorkflowsPerTarget'];
$numberOfAdminProvisioningTargets = $_SESSION['form']['numberOfAdminProvisioningTargets'];
$numberOfAdministrativeProvisioningWorkflowsPerTarget = $_SESSION['form']['numberOfAdministrativeProvisionWorkflowsPerTarget'];
$numberOfSourceOfAuthorities = $_SESSION['form']['initiationPoints'];
$provisioningWorkshopAndDesignDocHours = ($numberOfAutomatedProvisioningTargets * 4 * $unknownRequirements) + ($numberOfAdminProvisioningTargets * .5 * $unknownRequirements) + ($numberOfAutomatedProvisioningTargets * 4) + ($numberOfAdminProvisioningTargets* .5);
if ($_SESSION['form']['postImpServices'] == 'YES') {
    $provisioningPostImplementationServicesHours = ($numberOfAutomatedProvisioningTargets * 4 * $unknownRequirements) + ($numberOfAdminProvisioningTargets * .5 * $unknownRequirements) + ($numberOfAutomatedProvisioningTargets * 4) + ($numberOfAdminProvisioningTargets* .5);
} else {
    $provisioningPostImplementationServicesHours = 0;
}
$provisioningProductionMigrationHours = ($numberOfAutomatedProvisioningTargets * 4 * $unknownRequirements) + ($numberOfAdminProvisioningTargets * .5 * $unknownRequirements) + ($numberOfAutomatedProvisioningTargets * 4) + ($numberOfAdminProvisioningTargets* .5);
if ($_SESSION['form']['selectServiceTraining'] == 'YES') {
    $provisioningUiTrainingHours = $unknownRequirements * 2 + 2;
} else {
    $provisioningUiTrainingHours = 0;
}
$provisioningSolutionDocumentationHours = ($numberOfAutomatedProvisioningTargets * 4 * $unknownRequirements) + ($numberOfAdminProvisioningTargets * .5 * $unknownRequirements) + ($numberOfAutomatedProvisioningTargets * 4) + ($numberOfAdminProvisioningTargets* .5);
$provisioningPolicyHours = ($_SESSION['form']['provisioningNumberOfPolicies'] * 10/60 * $unknownRequirements) + ($_SESSION['form']['provisioningNumberOfPolicies'] * 10/60);
$provisioningResourcesHours = ($_SESSION['form']['selectableResource'] * 10/60 * $unknownRequirements) + ($_SESSION['form']['selectableResource'] * 10/60);
$provisioningUSSPHours = ($_SESSION['form']['resourceGroupConfigs'] * .25 * $unknownRequirements) + ($_SESSION['form']['resourceGroupConfigs'] * .25);
$provisioningApprovalsHours = ($_SESSION['form']['approvalConfiguration'] * .25 * $unknownRequirements) + ($_SESSION['form']['approvalConfiguration'] * .25);
$provisioningStudioTimeHours = (($numberOfAutomatedProvisioningTargets * 4 * $numberOfAutomatedProvisioningWorkflowsPerTarget + ($numberOfSourceOfAuthorities * 4)) * $unknownRequirements)+ (($numberOfAutomatedProvisioningWorkflowsPerTarget * 4 * $numberOfAutomatedProvisioningTargets + ($numberOfSourceOfAuthorities * 4)));
$provisioningAdministrativeProvisioningWorkflowHours = ($numberOfAdministrativeProvisioningWorkflowsPerTarget * $numberOfAdminProvisioningTargets * 2 * $unknownRequirements) + ($numberOfAdministrativeProvisioningWorkflowsPerTarget * $numberOfAdminProvisioningTargets * 2);
if ($_SESSION['form']['userAccountLoad'] == 'Custom') {
    $provisioningUserAccountLoadHours = ( $_SESSION['form']['uniqueDefinitions'] * 4 * $unknownRequirements )  + ( $_SESSION['form']['uniqueDefinitions'] * 4 );
} else {
    $provisioningUserAccountLoadHours = 4 * $unknownRequirements + 12;
}
$provisioningConfiguration = $provisioningUserAccountLoadHours + $provisioningAdministrativeProvisioningWorkflowHours + $provisioningStudioTimeHours + $provisioningApprovalsHours + $provisioningUSSPHours + $provisioningResourcesHours + $provisioningPolicyHours;
$provisioningImplementationEffortHours = $provisioningSolutionDocumentationHours + $provisioningUiTrainingHours + $provisioningProductionMigrationHours + $provisioningPostImplementationServicesHours + $provisioningConfiguration + $provisioningWorkshopAndDesignDocHours;
$provisioningProjectManagementHours = $provisioningImplementationEffortHours * .1;
$totalProvisioningHours = $provisioningImplementationEffortHours + $provisioningProjectManagementHours;
// HPAM
if ($_SESSION['form']['hpamTraining'] == 'YES') {
	$HPAMAnalysisWorkshopHours = $_SESSION['form']['hpamAccountTypes'] * $unknownRequirements + $_SESSION['form']['hpamAccountTypes'];
	} else {
	$HPAMAnalysisWorkshopHours = 0;
}
$HPAMDesignDocumentHours = ($_SESSION['form']['hpamAccountTypes'] * $unknownRequirements * .5) + ($_SESSION['form']['hpamAccountTypes'] * .5);
if ($_SESSION['form']['hpamAccountTypes'] != 0) {
	$HPAMOrgConfigurationHours = ($_SESSION['form']['passTargets'] * $unknownRequirements * .25) + ($_SESSION['form']['passTargets'] * .25);
} else {
	$HPAMOrgConfigurationHours = 0;
}
if ($_SESSION['form']['hpamAccountTypes'] != 0) {
	$HPAMApprovalsHours = ($_SESSION['form']['approvalConfiguration'] * $unknownRequirements * .25) + ($_SESSION['form']['approvalConfiguration'] * .25);
} else {
	$HPAMApprovalsHours = 0;
}
if ($_SESSION['form']['hpamAccountTypes'] != 0) {
	$HPAMProductionMigrationHours = $_SESSION['form']['passTargets'] * $unknownRequirements + $_SESSION['form']['passTargets'];
} else {
	$HPAMProductionMigrationHours = 0;
}
if ($_SESSION['form']['postImpServices'] == 'YES') {
	$HPAMPostImplementationServicesHours =  $_SESSION['form']['passTargets'] * $unknownRequirements + $_SESSION['form']['passTargets'];
} else {
	$HPAMPostImplementationServicesHours = 0;
}
if ($_SESSION['form']['hpamTraining'] == 'YES') {
	$HPAMUiTrainingHours = 1 * $unknownRequirements + 1;
} else {
	$HPAMUiTrainingHours = 0;
}
$HPAMWorkshopAndDesignDocHours = $HPAMAnalysisWorkshopHours + $HPAMDesignDocumentHours;
$HPAMSolutionDocumentationHours = ($_SESSION['form']['passTargets'] * $unknownRequirements * .5) + ($_SESSION['form']['passTargets']  * .5);
$HPAMImplementationEffortHours = $HPAMSolutionDocumentationHours + $HPAMUiTrainingHours + $HPAMPostImplementationServicesHours + $HPAMProductionMigrationHours + $HPAMApprovalsHours + $HPAMOrgConfigurationHours + $HPAMDesignDocumentHours + $HPAMAnalysisWorkshopHours;
$HPAMProjectManagementHours = $HPAMImplementationEffortHours * .1;
$totalHPAMHours = $HPAMProjectManagementHours + $HPAMImplementationEffortHours;
// Federation Effort
$federationAnalysisWorkshopHours = (($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + $_SESSION['form']['verifiedSfl'] + ($_SESSION['form']['nonVerifiedSfl'] * 20) + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']) * $unknownRequirements) + ($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + $_SESSION['form']['verifiedSfl'] + ($_SESSION['form']['nonVerifiedSfl'] * 20) + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']);
$federationDesignDocumentHours = (($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']) * $unknownRequirements) + ($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']);
$federationWorkshopAndDesignDocHours = $federationAnalysisWorkshopHours + $federationDesignDocumentHours;
$federationStudioTimeHours = ($_SESSION['form']['attManProccess'] * 8) + ($_SESSION['form']['onGoingAttManProccess'] * 4 * $unknownRequirements) +  ($_SESSION['form']['attManProccess'] * 8) + ($_SESSION['form']['onGoingAttManProccess'] * 4);
$federationInstallationidPsHours = ($_SESSION['form']['numOfIdp'] * 4 * $unknownRequirements) + ($_SESSION['form']['numOfIdp'] * 4);
$federationInstallationSPsHours = ($_SESSION['form']['shibboleth'] * 4 * $unknownRequirements) + ($_SESSION['form']['shibboleth'] * 4);
$federationInstallationDSHours = ($_SESSION['form']['discoveryServ'] * 4 * $unknownRequirements) + ($_SESSION['form']['discoveryServ'] * 4);
$federationInstallationHours = $federationInstallationDSHours + $federationInstallationidPsHours + $federationInstallationSPsHours;
$federationConfigurationHours = ($_SESSION['form']['fedTargets'] * 4) + ($_SESSION['form']['verifiedSfl'] * 4) + ($_SESSION['form']['nonVerifiedSfl'] * 8) + (($_SESSION['form']['fedTargets'] * 4) + ($_SESSION['form']['verifiedSfl'] * 4) + ($_SESSION['form']['nonVerifiedSfl'] * 8) * $unknownRequirements); // formula does not match comment
$federationTotalConfigurationHours = $federationConfigurationHours + $federationStudioTimeHours;
$federationProductionMigration = $federationAnalysisWorkshopHours = (($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + $_SESSION['form']['verifiedSfl'] + ($_SESSION['form']['nonVerifiedSfl'] * 20) + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']) * $unknownRequirements) + ($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + $_SESSION['form']['verifiedSfl'] + ($_SESSION['form']['nonVerifiedSfl'] * 20) + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']);
$federationPostImplementationServicesHours = ($_SESSION['form']['numOfIdp'] +  ($_SESSION['form']['fedTargets']) + ($_SESSION['form']['numOfIdp'] +  $_SESSION['form']['fedTargets']) * $unknownRequirements);
if ($_SESSION['form']['federation'] == 'YES') {
	$federationConfigurationOverviewHours = 2 * $unknownRequirements + 2;
} else {
	$federationConfigurationOverviewHours = 0;
}
$federationSolutionDocumentationHours = ($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + $_SESSION['form']['attManProccess']) + (($_SESSION['form']['numOfIdp'] +  $_SESSION['form']['fedTargets'] + $_SESSION['form']['attManProccess']) * $unknownRequirements);
$federationWorkshopAndDesignDocHours = $federationAnalysisWorkshopHours + $federationDesignDocumentHours;
$federationImplementationEffortHours = $federationSolutionDocumentationHours + $federationConfigurationOverviewHours + $federationPostImplementationServicesHours + $federationProductionMigration + $federationConfigurationHours + $federationInstallationDSHours + $federationInstallationSPsHours + $federationInstallationidPsHours + $federationStudioTimeHours + $federationDesignDocumentHours + $federationAnalysisWorkshopHours;
$federationProjectManagementHours = $federationImplementationEffortHours * .1;
$totalFederationHours = $federationImplementationEffortHours + $federationProjectManagementHours;
// Administration and Implementation Training
if ($_SESSION['form']['basicTraining'] == 'YES') {
	$administrationBasicTrainingHours = 40;
} else {
	$administrationBasicTrainingHours = 0;
}
if ($_SESSION['form']['advancedTraining'] == 'YES') {
	$administrationAdvancedTrainingTrainingHours = 40;
} else {
	$administrationAdvancedTrainingTrainingHours = 0;
}
if ($_SESSION['form']['kioskTraining'] == 'YES') {
	$administrationKioskTrainingHours = 4;
} else {
	$administrationKioskTrainingHours = 0;
}
if ($_SESSION['form']['pinTraining'] == 'YES') {
	$administrationPinTrainingTrainingHours = 4;
} else {
	$administrationPinTrainingTrainingHours = 0;
}
if ($_SESSION['form']['helpDeskTraining'] == 'YES') {
	$administrationHelpDeskTrainingTrainingHours = 4;
} else {
	$administrationHelpDeskTrainingTrainingHours = 0;
}
if ($_SESSION['form']['selectServiceTraining'] == 'YES') {
	$administrationSelectServiceTrainingTrainingHours = 8;
} else {
	$administrationSelectServiceTrainingTrainingHours = 0;
}
if ($_SESSION['form']['hpamTraining'] == 'YES') {
	$administrationHPAMUiTrainingHours = 4;
} else {
	$administrationHPAMUiTrainingHours = 0;
}
if ($_SESSION['form']['federationConfigTraining'] == 'YES') {
	$administrationFederationConfigTrainingHours = 4;
} else {
	$administrationFederationConfigTrainingHours = 0;
}
$administrationImplementationHours = $administrationFederationConfigTrainingHours + $administrationHPAMUiTrainingHours + $administrationSelectServiceTrainingTrainingHours + $administrationHelpDeskTrainingTrainingHours +
	$administrationPinTrainingTrainingHours + $administrationKioskTrainingHours + $administrationAdvancedTrainingTrainingHours + $administrationBasicTrainingHours;
$administrationProjectManagementHours = $administrationImplementationHours * .1;
$totalAdministrationHours = $administrationImplementationHours + $administrationProjectManagementHours;
$totalAllHours = $totalAdministrationHours + $totalPasswordHours + $totalEnvironmentHours + $totalFederationHours + $totalHPAMHours + $totalProvisioningHours;
// Phase Total Hours (per Task)
$phaseAssessmentDesignHours = $passwordWorkshopAndDesignDocHours + $provisioningWorkshopAndDesignDocHours + $HPAMWorkshopAndDesignDocHours + $federationWorkshopAndDesignDocHours;
$phaseInstallationHours = $environmentTotalPlatformInstallHours + $environmentOrganizationConfigurationHours + $environmentConnectedSystemDefinitionsHours + $environmentDocumentConfigurationsHours;
$phaseImplementationHours = $passwordConfigurationHours + $passwordProductionMigrationHours + $passwordPostImplementationServicesHours + $passwordUiTrainingHours + $passwordSolutionDocumentationHours + $provisioningConfiguration +
	$provisioningPostImplementationServicesHours + $provisioningProductionMigrationHours + $provisioningUiTrainingHours + $provisioningSolutionDocumentationHours + $HPAMOrgConfigurationHours + $HPAMPostImplementationServicesHours +
	$HPAMPostImplementationServicesHours + $HPAMProductionMigrationHours + $HPAMUiTrainingHours + $HPAMSolutionDocumentationHours + $federationTotalConfigurationHours + $federationPostImplementationServicesHours
	 + $federationProductionMigration + $federationConfigurationOverviewHours + $federationSolutionDocumentationHours;
$phaseProjectManagementHours = $environmentProjectManagementHours + $passwordProjectManagementHours + $provisioningProjectManagementHours + $HPAMProjectManagementHours + $federationProjectManagementHours + $administrationProjectManagementHours;
$phaseTrainingHours = $administrationBasicTrainingHours + $administrationAdvancedTrainingTrainingHours + $administrationKioskTrainingHours + $administrationPinTrainingTrainingHours + $administrationHelpDeskTrainingTrainingHours + $administrationSelectServiceTrainingTrainingHours +
	$administrationHPAMUiTrainingHours + $administrationFederationConfigTrainingHours;
// Totals
// Modules
$modulesPasswordManagement = $_SESSION['form']['passwordManagement'];
$modulesProvisioning = $_SESSION['form']['provisioning'];
$modulesHPAM = $_SESSION['form']['hpam'];
$modulesFederation = $_SESSION['form']['federation'];
echo '<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/darkly/bootstrap.css">
<div><h4>Client Name: ' . $_SESSION['form']['name'] . '</h4>
    <h4>' . $_SESSION['form']['completionDate'] . '</h4>
    <table class="table table-bordered table-hover">
        <!----------ENVIRONMENT TASKS---------->
        <tr>
            <th>Environment Tasks</th>
            <th>Cost</th>
            <th>Hours</th>
            <th>Comments</th>
        </tr>

        <tr>
            <td>Platform Install</td>
            <td>' . '$' . ($environmentTotalPlatformInstallHours * $servicesHourlyRate) . '</td>
            <td>' . $environmentTotalPlatformInstallHours . '</td>
            <td>All required infrastructure components, i.e.: GIGs, Test & Production Platforms</td>
        </tr>
        <tr>
            <td>Organization Configuration</td>
            <td>' . '$' . ($environmentOrganizationConfigurationHours * $servicesHourlyRate) . '</td>
            <td>' . $environmentOrganizationConfigurationHours . '</td>
            <td>Configure Organization specific settings, logo, page titles, etc..</td>
        </tr>

        <tr>
            <td>Configure Connected Systems</td>
            <td>' . '$' . ($environmentConnectedSystemDefinitionsHours * $servicesHourlyRate)  . '</td>
            <td>' . $environmentConnectedSystemDefinitionsHours . '</td>
            <td>15 minutes per system</td>
        </tr>

        <tr>
            <td>Document Configurations</td>
            <td>' . '$' . ($environmentDocumentConfigurationsHours * $servicesHourlyRate) . '</td>
            <td>' . $environmentDocumentConfigurationsHours . '</td>
            <td>Document all server configuration settings</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . ($environmentProjectManagementHours * $servicesHourlyRate) . '</td>
            <td>' . $environmentProjectManagementHours . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . ($totalEnvironmentHours * $servicesHourlyRate) . '</td>
            <td>' . $totalEnvironmentHours . '</td>
            <td></td>
        </tr>

        <!----------PASSWORD MANAGEMENT TASKS---------->
        <tr>
            <th>Password Management Tasks</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <tr>
            <td>Workshop & Design Doc</td>
            <td>' . '$' . ($passwordWorkshopAndDesignDocHours * $servicesHourlyRate) . '</td>
            <td>' . $passwordWorkshopAndDesignDocHours . '</td>
            <td>All Password Management Requirements will be defined and a design document will be generated</td>
        </tr>

        <tr>
            <td>Configuration</td>
            <td>' . '$' . ($passwordConfigurationHours * $servicesHourlyRate) . '</td>
            <td>' . $passwordConfigurationHours . '</td>
            <td>Password Policies, Password System Groupings, Configuring Self-Registration / Self Claiming.</td>
        </tr>

        <tr>
            <td>Post Implementation Services</td>
            <td>' . '$' . ($passwordPostImplementationServicesHours * $servicesHourlyRate) . '</td>
            <td>' . $passwordPostImplementationServicesHours . '</td>
            <td>Review system logging facilities for the purposes of troubleshooting, ensure system health and identify potential issues.</td>
        </tr>

        <tr>
            <td>Prod. Migration</td>
            <td>' . '$' . ($passwordProductionMigrationHours * $servicesHourlyRate) . '</td>
            <td>' . $passwordProductionMigrationHours . '</td>
            <td>Migrate implemented solution into production</td>
        </tr>

        <tr>
            <td>Training</td>
            <td>' . '$' . ($passwordUiTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $passwordUiTrainingHours . '</td>
            <td>Self-Service UI training to ensure a complete understanding of UI elements and functionality.</td>
        </tr>

        <tr>
            <td>Solution Documentation</td>
            <td>' . '$' . ($passwordSolutionDocumentationHours * $servicesHourlyRate) . '</td>
            <td>' . $passwordSolutionDocumentationHours . '</td>
            <td>Document Solution specific password management configurations</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . ($passwordProjectManagementHours * $servicesHourlyRate) . '</td>
            <td>' . $passwordProjectManagementHours . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . ($totalPasswordHours * $servicesHourlyRate) . '</td>
            <td>' . $totalPasswordHours . '</td>
            <td></td>
        </tr>

        <!----------PROVISIONING TASKS---------->
        <tr>
            <th>Provisioning Tasks</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <tr>
            <td>Workshop & Design Doc</td>
            <td>' . '$' . ($provisioningWorkshopAndDesignDocHours * $servicesHourlyRate) . '</td>
            <td>' . $provisioningWorkshopAndDesignDocHours . '</td>
            <td>All Provisioning Requirements will be defined and a design document will be generated.</td>
        </tr>

        <tr>
            <td>Configuration</td>
            <td>' . '$' . ($provisioningConfiguration * $servicesHourlyRate) . '</td>
            <td>' . $provisioningConfiguration . '</td>
            <td>All necessary product features will be configure to enable the required functionality.  The following provisioning process will be implemented to manage standard accounts and permissions of each provisioning target system: Add, Modify, Disable, Terminate.</td>
        </tr>

        <tr>
            <td>Post Implementation Services</td>
            <td>' . '$' . ($provisioningPostImplementationServicesHours * $servicesHourlyRate) . '</td>
            <td>' . $provisioningPostImplementationServicesHours . '</td>
            <td>Review system logging facilities for the purposes of troubleshooting, ensure system health and identify potential issues.</td>
        </tr>

        <tr>
            <td>Prod. Migration</td>
            <td>' . '$' . ($provisioningProductionMigrationHours * $servicesHourlyRate) . '</td>
            <td>' . $provisioningProductionMigrationHours . '</td>
            <td>Migrate implemented solution into production</td>
        </tr>

        <tr>
            <td>Training</td>
            <td>' . '$' . ($provisioningUiTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $provisioningUiTrainingHours . '</td>
            <td>Self-Service UI training to ensure a complete understanding of UI elements and functionality.</td>
        </tr>

        <tr>
            <td>Solution Documentation</td>
            <td>' . '$' . ($provisioningSolutionDocumentationHours * $servicesHourlyRate) . '</td>
            <td>' . $provisioningSolutionDocumentationHours . '</td>
            <td>Document Solution specific provisioning configurations</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . ($provisioningProjectManagementHours * $servicesHourlyRate) . '</td>
            <td>' . $provisioningProjectManagementHours . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . ($totalProvisioningHours * $servicesHourlyRate) . '</td>
            <td>' . $totalProvisioningHours . '</td>
            <td></td>
        </tr>

        <!----------HPAM TASKS---------->
        <tr>
            <th>HPAM Tasks</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <tr>
            <td>Workshop & Design Doc</td>
            <td>' . '$' . ($HPAMWorkshopAndDesignDocHours * $servicesHourlyRate) . '</td>
            <td>' . $HPAMWorkshopAndDesignDocHours . '</td>
            <td>All HPAM Requirements will be defined and a design document will be generated.</td>
        </tr>

        <tr>
            <td>Configuration</td>
            <td>' . '$' . ($HPAMOrgConfigurationHours * $servicesHourlyRate) . '</td>
            <td>' . $HPAMOrgConfigurationHours . '</td>
            <td>Configure HPAM Account Types, System Owners, HPAM Users.</td>
        </tr>

        <tr>
            <td>Post Implementation Services</td>
            <td>' . '$' . ($HPAMPostImplementationServicesHours * $servicesHourlyRate) . '</td>
            <td>' . $HPAMPostImplementationServicesHours . '</td>
            <td>Review system logging facilities for the purposes of troubleshooting, ensure system health and identify potential issues.</td>
        </tr>

        <tr>
            <td>Prod. Migration</td>
            <td>' . '$' . ($HPAMProductionMigrationHours * $servicesHourlyRate) . '</td>
            <td>' . $HPAMProductionMigrationHours . '</td>
            <td>Migrate implemented solution into production</td>
        </tr>

        <tr>
            <td>Training</td>
            <td>' . '$' . ($HPAMUiTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $HPAMUiTrainingHours . '</td>
            <td>Self-Service UI training to ensure a complete understanding of UI elements and functionality.</td>
        </tr>

        <tr>
            <td>Solution Documentation</td>
            <td>' . '$' . ($HPAMSolutionDocumentationHours * $servicesHourlyRate) . '</td>
            <td>' . $HPAMSolutionDocumentationHours . '</td>
            <td>Document Solution specific HPAM configurations</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . ($HPAMProjectManagementHours * $servicesHourlyRate) . '</td>
            <td>' . $HPAMProjectManagementHours . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . ($totalHPAMHours * $servicesHourlyRate) . '</td>
            <td>' . $totalHPAMHours . '</td>
            <td></td>
        </tr>

        <!----------FEDERATION TASKS---------->
        <tr>
            <th>Federation Tasks</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <tr>
            <td>Workshop & Design Doc</td>
            <td>' . '$' . ($federationWorkshopAndDesignDocHours * $servicesHourlyRate) . '</td>
            <td>' . $federationWorkshopAndDesignDocHours . '</td>
            <td>All Federation Requirements will be defined and a design document will be generated.</td>
        </tr>

        <tr>
            <td>Federation Installations (IdPs, SPs & DS)</td>
            <td>' . '$' . ($federationInstallationHours * $servicesHourlyRate) . '</td>
            <td>' . $federationInstallationHours . '</td>
            <td>Installation of Federation IdPs, Shibboleth SPs and Discovery Services</td>
        </tr>

        <tr>
            <td>Configuration</td>
            <td>' . '$' . ($federationTotalConfigurationHours * $servicesHourlyRate) . '</td>
            <td>' . $federationTotalConfigurationHours . '</td>
            <td>Configure IdP, SP Metadata and Attribute Management Processes.</td>
        </tr>

        <tr>
            <td>Post Implementation Services</td>
            <td>' . '$' . ($federationPostImplementationServicesHours * $servicesHourlyRate) . '</td>
            <td>' . $federationPostImplementationServicesHours . '</td>
            <td>Review system logging facilities for the purposes of troubleshooting, ensure system health and identify potential issues.</td>
        </tr>

        <tr>
            <td>Prod. Migration</td>
            <td>' . '$' . ($federationProductionMigration * $servicesHourlyRate) . '</td>
            <td>' . $federationProductionMigration . '</td>
            <td>Migrate implemented solution into production</td>
        </tr>

        <tr>
            <td>Configuration Overview</td>
            <td>' . '$' . ($federationConfigurationOverviewHours * $servicesHourlyRate) . '</td>
            <td>' . $federationConfigurationOverviewHours . '</td>
            <td>Implementation overview for the purposes of maintaining and administering solution.</td>
        </tr>

        <tr>
            <td>Solution Documentation</td>
            <td>' . '$' . $federationSolutionDocumentationHours * $servicesHourlyRate . '</td>
            <td>' . $federationSolutionDocumentationHours . '</td>
            <td>Document Solution specific Federation configurations</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . ($federationProjectManagementHours * $servicesHourlyRate) . '</td>
            <td>' . $federationProjectManagementHours . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . ($totalFederationHours * $servicesHourlyRate) . '</td>
            <td>' . $totalFederationHours . '</td>
            <td></td>
        </tr>

        <!----------ADMINISTRATION AND IMPLEMENTATION TRAINING---------->
        <tr>
            <th>Administration and Implementation Training</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <tr>
            <td>Basic Overview</td>
            <td>' . '$' . ($administrationBasicTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $administrationBasicTrainingHours . '</td>
            <td>Overview of the basic components and product functionality.</td>
        </tr>

        <tr>
            <td>Advanced Features and Concepts</td>
            <td>' . '$' . ($administrationAdvancedTrainingTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $administrationAdvancedTrainingTrainingHours . '</td>
            <td>Overview of the advanced features of the product suite, IE: Account Matching, HPAM, Workflow Design and Best Practices, etc..  Will be modified to meet the specific features that are utilized during the implementation of the above solution.</td>
        </tr>

        <tr>
            <td><b>IaaS Training</b></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>Kiosk UI Training (Train the Trainer)</td>
            <td>' . '$' . ($administrationKioskTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $administrationKioskTrainingHours . '</td>
            <td></td>
        </tr>

        <tr>
            <td>Pin Reset UI Training (Train the Trainer)</td>
            <td>' . '$' . ($administrationPinTrainingTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $administrationPinTrainingTrainingHours . '</td>
            <td></td>
        </tr>

        <tr>
            <td>Help Desk UI Training (Train the Trainer)</td>
            <td>' . '$' . ($administrationHelpDeskTrainingTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $administrationHelpDeskTrainingTrainingHours . '</td>
            <td></td>
        </tr>

        <tr>
            <td>Self Service Access Management UI Training (Train the Trainer)</td>
            <td>' . '$' . ($administrationSelectServiceTrainingTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $administrationSelectServiceTrainingTrainingHours . '</td>
            <td></td>
        </tr>

        <tr>
            <td>HPAM UI Training (Train the Trainer)</td>
            <td>' . '$' . ($administrationHPAMUiTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $administrationHPAMUiTrainingHours . '</td>
            <td></td>
        </tr>

        <tr>
            <td><b>Federation Training</b></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>Federation Configuration Training</td>
            <td>' . '$' . ($administrationFederationConfigTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $administrationFederationConfigTrainingHours . '</td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . ($administrationProjectManagementHours * $servicesHourlyRate) . '</td>
            <td>' . $administrationProjectManagementHours . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . ($totalAdministrationHours * $servicesHourlyRate) . '</td>
            <td>' . $totalAdministrationHours . '</td>
            <td></td>
        </tr>

        <tr>
            <th><b>* Total Estimated Effort</b></th>
            <th>' . '$' . ($totalAllHours * $servicesHourlyRate) . '</th>
            <th>' . $totalAllHours . '</th>
            <th></th>
        </tr>

    </table>

    <br />

    <!----------PHASE TABLE---------->
    <table class="table table-bordered table-hover">

        <tr>
            <th>Phase</th>
            <th>Cost</th>
            <th>Hours</th>
        </tr>

        <tr>
            <td>Assessment/Design (Workshop)</td>
            <td>' . '$' . ($phaseAssessmentDesignHours * $servicesHourlyRate) . '</td>
            <td>' . $phaseAssessmentDesignHours . '</td>
        </tr>

        <tr>
            <td>Installation</td>
            <td>' . '$' . ($phaseInstallationHours *$servicesHourlyRate) . '</td>
            <td>' . $phaseInstallationHours . '</td>
        </tr>

        <tr>
            <td>Implementation</td>
            <td>' . '$' . ($phaseImplementationHours * $servicesHourlyRate) . '</td>
            <td>' . $phaseImplementationHours . '</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . ($phaseProjectManagementHours * $servicesHourlyRate) . '</td>
            <td>' . $phaseProjectManagementHours . '</td>
        </tr>

        <tr>
            <td>Training</td>
            <td>' . '$' . ($phaseTrainingHours * $servicesHourlyRate) . '</td>
            <td>' . $phaseTrainingHours . '</td>
        </tr>

    </table>

    <br />

    <!----------TOTALS TABLE---------->
    <table class="table table-bordered table-hover">

        <tr>
            <th>Totals</th>
            <th>Cost to Client</th>
            <th>Cost Percent</th>
            <th>* Assumptions</th>
        </tr>

        <tr>
            <td>Environment</td>
            <td>Cost to Client Here</td>
            <td>Cost Percent Here</td>
            <td>No Customization changes to Self-Service Uis.  Only configurable changes allowed.</td>
        </tr>

        <tr>
            <td>Password Management</td>
            <td>Cost to Client Here</td>
            <td>Cost Percent Here</td>
            <td>All Connectors available.  Does not accommodate for any necessary development time or effort.</td>
        </tr>

        <tr>
            <td>Provisioning</td>
            <td>Cost to Client Here</td>
            <td>Cost Percent Here</td>
            <td>Does not accommodate for any unforeseen issues or solution customizations not supported via the standard UIs or RDM workflows.</td>
        </tr>

        <tr>
            <td>HPAM</td>
            <td>Cost to Client Here</td>
            <td>Cost Percent Here</td>
            <td>All necessary policy / roles have been defined.</td>
        </tr>

        <tr>
            <td>Federation</td>
            <td>Cost to Client Here</td>
            <td>Cost Percent Here</td>
            <td>Will create standard application accounts.</td>
        </tr>

        <tr>
            <td>Training</td>
            <td>Cost to Client Here</td>
            <td>Cost Percent Here</td>
            <td>All Fischer Pre-Requisites have been satisfied prior to starting the implementation.</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>Total Cost to Client Here</td>
            <td>Total Cost Percent Here</td>
            <td>The effort required to load legacy account information is out of scope for this effort and will need to be estimated separately.</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>All workshops will be held onsite and design documents will be developed remotely.</td>
        </tr>

    </table>

    <br />

    <!----------MODULES LICENSED TABLE---------->
    <table class="table table-bordered table-hover">

        <tr>
            <th>Modules</th>
            <th>Licensed</th>
        </tr>

        <tr>
            <td>Password Management</td>
            <td>' . $modulesPasswordManagement . '</td>
        </tr>

        <tr>
            <td>Provisioning</td>
            <td>' . $modulesProvisioning . '</td>
        </tr>

        <tr>
            <td>HPAM</td>
            <td>' . $modulesHPAM . '</td>
        </tr>

        <tr>
            <td>Federation</td>
            <td>' . $modulesFederation . '</td>
        </tr>

    </table>

</div>';
?>