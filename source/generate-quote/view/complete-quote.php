<?php
// view and insert new quote
require('../../../database/db.php');
session_start();
if (!isset($_SESSION['username'])) { // make sure user is logged in
    header("location:../../shared/redirect.php");
    exit(6);
}
require("../../shared/status.php");
if ($_SESSION['enabled'] != 'true') { // non-enabled account tried to access page
    header('location:../../shared/redirect.php');
    exit(5);
}
$data = array();
parse_str(file_get_contents('php://input'), $data);
$_POST = array_merge($data, $_POST); // merge parsed form data with _POST session values
$newQuote = false;
if (is_string($_SESSION['form'])) { // don't insert quote again into database if form data has already been parsed (user refreshed page)
    $_SESSION['form'] = json_decode($_SESSION['form'], true); // decodes JSON data sent by angularJS frontend and converts to PHP associative array
    $newQuote = true;
}
if (!isset($_SESSION['form']['numberOfEnvironments'])) { // make sure user submitted form data prior to accessing page
    header("location:../../shared/redirect.php#/home");
    exit(6);
}
$username = $_SESSION['username'];
$unknownRequirements = $_SESSION['form']['unknownPercentage'] / 100; // Metrics.B64
$result = $mysqli->query("SELECT * FROM Pricing WHERE id=1"); // Must read price from database
$row = mysqli_fetch_assoc($result);
$servicesHourlyRate = $row['servicesHourlyRate'];
$clientName = $_SESSION['form']['name'];
$startDate = $_SESSION['form']['startDate'];
$completionDate = $_SESSION['form']['completionDate'];
// Environment Specifics
$environmentPlatformInstallHours = (($_SESSION['form']['numberOfEnvironments'] * 2) * $unknownRequirements) + ($_SESSION['form']['numberOfEnvironments'] * 2); // =((+$Metrics.B15*2)*$Metrics.B64)+(+$Metrics.B15*2)
$haServerHours = ($_SESSION['form']['haServers'] * $unknownRequirements) + $_SESSION['form']['haServers']; // =((+$Metrics.B16*1)*$Metrics.B64)+(+$Metrics.B16*1)
$gigInstallHours = ((($_SESSION['form']['globalIdentityGateways'] * .5) * $unknownRequirements) + ($_SESSION['form']['globalIdentityGateways'] * .5));
$msPasswordFilterHours = (($_SESSION['form']['passwordFilters'] * .25) * $unknownRequirements) + ($_SESSION['form']['passwordFilters'] * .25); // =((+$Metrics.B18*15)/60*+$Metrics.B64)+((+$Metrics.B18*15)/60)
$environmentOrganizationConfigurationHours = $_SESSION['form']['organizations'] * $unknownRequirements + $_SESSION['form']['organizations']; // =(+$Metrics.B42*+$Metrics.B64)+(+$Metrics.B42)
$environmentConnectedSystemDefinitionsHours = ($_SESSION['form']['uniqueDefinitions'] * .25 * $unknownRequirements) + ($_SESSION['form']['uniqueDefinitions'] * .25);
$environmentDocumentConfigurationsHours = ($_SESSION['form']['numberOfEnvironments'] * .25 * $unknownRequirements) + ($_SESSION['form']['numberOfEnvironments'] * .25); // =((($Metrics.B15*15)/60)*$Metrics.B64)+(($Metrics.B15*15)/60) conflict between formula and comments
$environmentImplementationEffortHours = $environmentDocumentConfigurationsHours + $environmentConnectedSystemDefinitionsHours + $environmentOrganizationConfigurationHours + $environmentPlatformInstallHours + $haServerHours + $gigInstallHours + $msPasswordFilterHours;
$environmentProjectManagementHours = $environmentImplementationEffortHours * .1;
$environmentTotalPlatformInstallHours = $environmentPlatformInstallHours + $haServerHours + $gigInstallHours + $msPasswordFilterHours;
$totalEnvironmentHours = $environmentProjectManagementHours + $environmentImplementationEffortHours;
// Pasword Management Effort
$passwordWorkshopAndDesignDocHours = (($_SESSION['form']['passTargets'] * 2 * $unknownRequirements) + ($_SESSION['form']['passTargets'] * 2)) * 2;
$passwordConfigurationHours = ($_SESSION['form']['passTargets'] * 2 * $unknownRequirements) + ($_SESSION['form']['passTargets'] * 2);
$passwordProductionMigrationHours = ($_SESSION['form']['passTargets'] * 1 * $unknownRequirements) + ($_SESSION['form']['passTargets']);
$passwordPostImplementationServicesHours = ($_SESSION['form']['passTargets'] * 2 * $unknownRequirements) + ($_SESSION['form']['passTargets'] * 2);
$passwordUiTrainingHours = 0;
if ($_SESSION['form']['kioskTraining'] == 'YES') {
    $passwordUiTrainingHours = 1 * $unknownRequirements + 1;
} else {
    $passwordUiTrainingHours = 0;
}
$passwordSolutionDocumentationHours = ($_SESSION['form']['passTargets'] * 2 * $unknownRequirements) + ($_SESSION['form']['passTargets'] * 2);
$passwordImplmentationServiceHours = $passwordSolutionDocumentationHours + $passwordUiTrainingHours + $passwordProductionMigrationHours + $passwordPostImplementationServicesHours + $passwordConfigurationHours + $passwordWorkshopAndDesignDocHours;
$passwordProjectManagementHours = $passwordImplmentationServiceHours * .1;
$totalPasswordHours = $passwordProjectManagementHours + $passwordImplmentationServiceHours;
// Provisioning Effort
$numberOfAutomatedProvisioningTargets = $_SESSION['form']['numberOfAutomatedProvisioningTargets'];
$numberOfAutomatedProvisioningWorkflowsPerTarget = $_SESSION['form']['numberOfAutomatedProvisiongWorkflowsPerTarget'];
$numberOfAdminProvisioningTargets = $_SESSION['form']['numberOfAdminProvisioningTargets'];
$numberOfAdministrativeProvisioningWorkflowsPerTarget = $_SESSION['form']['numberOfAdministrativeProvisionWorkflowsPerTarget'];
$numberOfSourceOfAuthorities = $_SESSION['form']['initiationPoints'];
$provisioningWorkshopAndDesignDocHours = (($numberOfAutomatedProvisioningTargets * 4 * $unknownRequirements) + ($numberOfAdminProvisioningTargets * .5 * $unknownRequirements) + ($numberOfAutomatedProvisioningTargets * 4) + ($numberOfAdminProvisioningTargets * .5)) * 2;
$provisioningPostImplementationServicesHours = 0;
if ($_SESSION['form']['postImpServices'] == 'YES') {
    $provisioningPostImplementationServicesHours = ($numberOfAutomatedProvisioningTargets * 4 * $unknownRequirements) + ($numberOfAdminProvisioningTargets * .5 * $unknownRequirements) + ($numberOfAutomatedProvisioningTargets * 4) + ($numberOfAdminProvisioningTargets * .5);
} else {
    $provisioningPostImplementationServicesHours = 0;
}
$provisioningProductionMigrationHours = ($numberOfAutomatedProvisioningTargets * 4 * $unknownRequirements) + ($numberOfAdminProvisioningTargets * .5 * $unknownRequirements) + ($numberOfAutomatedProvisioningTargets * 4) + ($numberOfAdminProvisioningTargets * .5);
$provisioningUiTrainingHours = 0;
if ($_SESSION['form']['selectServiceTraining'] == 'YES') {
    $provisioningUiTrainingHours = $unknownRequirements * 2 + 2;
} else {
    $provisioningUiTrainingHours = 0;
}
$provisioningSolutionDocumentationHours = ($numberOfAutomatedProvisioningTargets * 4 * $unknownRequirements) + ($numberOfAdminProvisioningTargets * .5 * $unknownRequirements) + ($numberOfAutomatedProvisioningTargets * 4) + ($numberOfAdminProvisioningTargets * .5);
$provisioningPolicyHours = ($_SESSION['form']['provisioningNumberOfPolicies'] * 10 / 60 * $unknownRequirements) + ($_SESSION['form']['provisioningNumberOfPolicies'] * 10 / 60);
$provisioningResourcesHours = ($_SESSION['form']['selectableResource'] * 10 / 60 * $unknownRequirements) + ($_SESSION['form']['selectableResource'] * 10 / 60);
$provisioningUSSPHours = ($_SESSION['form']['resourceGroupConfigs'] * .25 * $unknownRequirements) + ($_SESSION['form']['resourceGroupConfigs'] * .25);
$provisioningApprovalsHours = ($_SESSION['form']['approvalConfiguration'] * .25 * $unknownRequirements) + ($_SESSION['form']['approvalConfiguration'] * .25);
$provisioningStudioTimeHours = (($numberOfAutomatedProvisioningTargets * 4 * $numberOfAutomatedProvisioningWorkflowsPerTarget + ($numberOfSourceOfAuthorities * 4)) * $unknownRequirements) + (($numberOfAutomatedProvisioningWorkflowsPerTarget * 4 * $numberOfAutomatedProvisioningTargets + ($numberOfSourceOfAuthorities * 4)));
$provisioningAdministrativeProvisioningWorkflowHours = ($numberOfAdministrativeProvisioningWorkflowsPerTarget * $numberOfAdminProvisioningTargets * 2 * $unknownRequirements) + ($numberOfAdministrativeProvisioningWorkflowsPerTarget * $numberOfAdminProvisioningTargets * 2);
$provisioningUserAccountLoadHours = 0;
if ($_SESSION['form']['userAccountLoad'] == 'Custom') {
    $provisioningUserAccountLoadHours = ($_SESSION['form']['uniqueDefinitions'] * 4 * $unknownRequirements) + ($_SESSION['form']['uniqueDefinitions'] * 4);
} else if ($_SESSION['form']['userAccountLoad'] == 'Simple') {
    $provisioningUserAccountLoadHours = 4 * $unknownRequirements + 4;
}
$provisioningConfiguration = $provisioningUserAccountLoadHours + $provisioningAdministrativeProvisioningWorkflowHours + $provisioningStudioTimeHours + $provisioningApprovalsHours + $provisioningUSSPHours + $provisioningResourcesHours + $provisioningPolicyHours;
$provisioningImplementationEffortHours = $provisioningSolutionDocumentationHours + $provisioningUiTrainingHours + $provisioningProductionMigrationHours + $provisioningPostImplementationServicesHours + $provisioningConfiguration + $provisioningWorkshopAndDesignDocHours;
$provisioningProjectManagementHours = $provisioningImplementationEffortHours * .1;
$totalProvisioningHours = $provisioningImplementationEffortHours + $provisioningProjectManagementHours;
// HPAM
$HPAMAnalysisWorkshopHours = 0;
if ($_SESSION['form']['hpamTraining'] == 'YES') {
    $HPAMAnalysisWorkshopHours = $_SESSION['form']['hpamAccountTypes'] * $unknownRequirements + $_SESSION['form']['hpamAccountTypes'];
} else {
    $HPAMAnalysisWorkshopHours = 0;
}
$HPAMDesignDocumentHours = ($_SESSION['form']['hpamAccountTypes'] * $unknownRequirements * .5) + ($_SESSION['form']['hpamAccountTypes'] * .5);
$HPAMOrgConfigurationHours = 0;
if ($_SESSION['form']['hpamAccountTypes'] != 0) {
    $HPAMOrgConfigurationHours = ($_SESSION['form']['passTargets'] * $unknownRequirements * .25) + ($_SESSION['form']['passTargets'] * .25);
} else {
    $HPAMOrgConfigurationHours = 0;
}
$HPAMApprovalsHours = 0;
if ($_SESSION['form']['hpamAccountTypes'] != 0) {
    $HPAMApprovalsHours = ($_SESSION['form']['approvalConfiguration'] * $unknownRequirements * .25) + ($_SESSION['form']['approvalConfiguration'] * .25);
} else {
    $HPAMApprovalsHours = 0;
}
$HPAMProductionMigrationHours = 0;
if ($_SESSION['form']['hpamAccountTypes'] != 0) {
    $HPAMProductionMigrationHours = $_SESSION['form']['passTargets'] * $unknownRequirements + $_SESSION['form']['passTargets'];
} else {
    $HPAMProductionMigrationHours = 0;
}
$HPAMPostImplementationServicesHours = 0;
if ($_SESSION['form']['postImpServices'] == 'YES') {
    $HPAMPostImplementationServicesHours = $_SESSION['form']['passTargets'] * $unknownRequirements + $_SESSION['form']['passTargets'];
} else {
    $HPAMPostImplementationServicesHours = 0;
}
$HPAMUiTrainingHours = 0;
if ($_SESSION['form']['hpamTraining'] == 'YES') {
    $HPAMUiTrainingHours = 1 * $unknownRequirements + 1;
} else {
    $HPAMUiTrainingHours = 0;
}
$HPAMWorkshopAndDesignDocHours = $HPAMAnalysisWorkshopHours + $HPAMDesignDocumentHours;
$HPAMSolutionDocumentationHours = ($_SESSION['form']['passTargets'] * $unknownRequirements * .5) + ($_SESSION['form']['passTargets'] * .5);
$HPAMImplementationEffortHours = $HPAMSolutionDocumentationHours + $HPAMUiTrainingHours + $HPAMPostImplementationServicesHours + $HPAMProductionMigrationHours + $HPAMOrgConfigurationHours + $HPAMDesignDocumentHours + $HPAMAnalysisWorkshopHours; // $HPAMApprovalsHours is never used, issue in spreadsheet
$HPAMProjectManagementHours = ($HPAMApprovalsHours + $HPAMImplementationEffortHours) * .1;
$totalHPAMHours = $HPAMProjectManagementHours + $HPAMImplementationEffortHours;
// Federation Effort
$federationAnalysisWorkshopHours = 0;
if ($_SESSION['form']['federationWorkshop'] == 'YES') {
    $federationAnalysisWorkshopHours = ((($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + $_SESSION['form']['verifiedSfl'] + ($_SESSION['form']['nonVerifiedSfl'] * 20) + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess'])) * $unknownRequirements)
        + ($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + $_SESSION['form']['verifiedSfl'] + ($_SESSION['form']['nonVerifiedSfl'] * 20) + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']);
}
$federationDesignDocumentHours = (($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']) * $unknownRequirements) + ($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']);
$federationWorkshopAndDesignDocHours = $federationAnalysisWorkshopHours + $federationDesignDocumentHours;
$federationStudioTimeHours = ((($_SESSION['form']['attManProccess'] * 8) + ($_SESSION['form']['onGoingAttManProccess'] * 4)) * $unknownRequirements) + ($_SESSION['form']['attManProccess'] * 8) + ($_SESSION['form']['onGoingAttManProccess'] * 4);
$federationInstallationidPsHours = ($_SESSION['form']['numOfIdp'] * 4 * $unknownRequirements) + ($_SESSION['form']['numOfIdp'] * 4);
$federationInstallationSPsHours = ($_SESSION['form']['shibboleth'] * 4 * $unknownRequirements) + ($_SESSION['form']['shibboleth'] * 4);
$federationInstallationDSHours = ($_SESSION['form']['discoveryServ'] * 4 * $unknownRequirements) + ($_SESSION['form']['discoveryServ'] * 4);
$federationInstallationHours = $federationInstallationDSHours + $federationInstallationidPsHours + $federationInstallationSPsHours;
$federationConfigurationHours = ((($_SESSION['form']['fedTargets'] * 4) + ($_SESSION['form']['verifiedSfl'] * 4) + ($_SESSION['form']['nonVerifiedSfl'] * 8)) * $unknownRequirements) +
    (($_SESSION['form']['fedTargets'] * 4) + ($_SESSION['form']['verifiedSfl'] * 4) + ($_SESSION['form']['nonVerifiedSfl'] * 4)); // formula does not match comment =(((+$Metrics.B47*4)+(+$Metrics.B48*4)+(+$Metrics.B49*8))*+$Metrics.B64)+((+$Metrics.B47*4)+(+$Metrics.B48*4)+(+$Metrics.B49*4)), B49 * 4 at end is WRONG
$federationTotalConfigurationHours = $federationConfigurationHours + $federationStudioTimeHours;
$federationProductionMigration = (($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']) * $unknownRequirements) + (($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + ($_SESSION['form']['attManProccess'] * 2) + $_SESSION['form']['onGoingAttManProccess']));
$federationPostImplementationServicesHours = ($_SESSION['form']['numOfIdp'] + ($_SESSION['form']['fedTargets']) + ($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets']) * $unknownRequirements);
$federationConfigurationOverviewHours;
if ($_SESSION['form']['federation'] == 'YES') {
    $federationConfigurationOverviewHours = 2 * $unknownRequirements + 2;
} else {
    $federationConfigurationOverviewHours = 0;
}
$federationSolutionDocumentationHours = ($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + $_SESSION['form']['attManProccess']) + (($_SESSION['form']['numOfIdp'] + $_SESSION['form']['fedTargets'] + $_SESSION['form']['attManProccess']) * $unknownRequirements);
$federationWorkshopAndDesignDocHours = $federationAnalysisWorkshopHours + $federationDesignDocumentHours;
$federationImplementationEffortHours = $federationSolutionDocumentationHours + $federationConfigurationOverviewHours + $federationPostImplementationServicesHours + $federationProductionMigration + $federationConfigurationHours + $federationInstallationDSHours + $federationInstallationSPsHours + $federationInstallationidPsHours + $federationStudioTimeHours + $federationDesignDocumentHours + $federationAnalysisWorkshopHours;
$federationProjectManagementHours = $federationImplementationEffortHours * .1;
$totalFederationHours = $federationImplementationEffortHours + $federationProjectManagementHours;
// Administration and Implementation Training
$administrationBasicTrainingHours;
if ($_SESSION['form']['basicTraining'] == 'YES') {
    $administrationBasicTrainingHours = 40;
} else {
    $administrationBasicTrainingHours = 0;
}
$administrationAdvancedTrainingTrainingHours;
if ($_SESSION['form']['advancedTraining'] == 'YES') {
    $administrationAdvancedTrainingTrainingHours = 40;
} else {
    $administrationAdvancedTrainingTrainingHours = 0;
}
$administrationKioskTrainingHours;
if ($_SESSION['form']['kioskTraining'] == 'YES') {
    $administrationKioskTrainingHours = 4;
} else {
    $administrationKioskTrainingHours = 0;
}
$administrationPinTrainingTrainingHours;
if ($_SESSION['form']['pinTraining'] == 'YES') {
    $administrationPinTrainingTrainingHours = 4;
} else {
    $administrationPinTrainingTrainingHours = 0;
}
$administrationHelpDeskTrainingTrainingHours;
if ($_SESSION['form']['helpDeskTraining'] == 'YES') {
    $administrationHelpDeskTrainingTrainingHours = 4;
} else {
    $administrationHelpDeskTrainingTrainingHours = 0;
}
$administrationSelectServiceTrainingTrainingHours;
if ($_SESSION['form']['selectServiceTraining'] == 'YES') {
    $administrationSelectServiceTrainingTrainingHours = 8;
} else {
    $administrationSelectServiceTrainingTrainingHours = 0;
}
$administrationHPAMUiTrainingHours;
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
if ($newQuote == true) { // only insert on new quote, prevents page refresh from inserting quote again
    $sql = $dbh->prepare("INSERT INTO Quotes (username, clientName, startDate, completionDate, servicesHourlyRate, environmentTotalPlatformInstallHours, environmentOrganizationConfigurationHours, environmentConnectedSystemDefinitionsHours, environmentDocumentConfigurationsHours, environmentProjectManagementHours, totalEnvironmentHours, passwordWorkshopAndDesignDocHours, passwordConfigurationHours, passwordPostImplementationServicesHours, passwordProductionMigrationHours, passwordUiTrainingHours,  passwordSolutionDocumentationHours, passwordProjectManagementHours, totalPasswordHours, provisioningWorkshopAndDesignDocHours, provisioningConfiguration,  provisioningPostImplementationServicesHours, provisioningProductionMigrationHours, provisioningUiTrainingHours, provisioningSolutionDocumentationHours, provisioningProjectManagementHours, totalProvisioningHours, HPAMWorkshopAndDesignDocHours, HPAMOrgConfigurationHours, HPAMPostImplementationServicesHours, HPAMProductionMigrationHours, HPAMUiTrainingHours, HPAMSolutionDocumentationHours, HPAMProjectManagementHours, totalHPAMHours, federationWorkshopAndDesignDocHours, federationInstallationHours, federationTotalConfigurationHours, federationPostImplementationServicesHours, federationProductionMigration, federationConfigurationOverviewHours, federationSolutionDocumentationHours, federationProjectManagementHours, totalFederationHours, administrationBasicTrainingHours, administrationAdvancedTrainingTrainingHours, administrationKioskTrainingHours, administrationPinTrainingTrainingHours, administrationHelpDeskTrainingTrainingHours, administrationSelectServiceTrainingTrainingHours, administrationHPAMUiTrainingHours, administrationFederationConfigTrainingHours, administrationProjectManagementHours, totalAdministrationHours, totalAllHours, phaseAssessmentDesignHours, phaseInstallationHours, phaseImplementationHours, phaseProjectManagementHours, phaseTrainingHours, modulesPasswordManagement, modulesProvisioning, modulesHPAM, modulesFederation)
    VALUES(:username, :clientName, :startDate, :completionDate, :servicesHourlyRate, :environmentTotalPlatformInstallHours, :environmentOrganizationConfigurationHours, :environmentConnectedSystemDefinitionsHours, :environmentDocumentConfigurationsHours, :environmentProjectManagementHours, :totalEnvironmentHours, :passwordWorkshopAndDesignDocHours, :passwordConfigurationHours, :passwordPostImplementationServicesHours, :passwordProductionMigrationHours, :passwordUiTrainingHours,  :passwordSolutionDocumentationHours, :passwordProjectManagementHours, :totalPasswordHours, :provisioningWorkshopAndDesignDocHours, :provisioningConfiguration,  :provisioningPostImplementationServicesHours, :provisioningProductionMigrationHours, :provisioningUiTrainingHours, :provisioningSolutionDocumentationHours, :provisioningProjectManagementHours, :totalProvisioningHours, :HPAMWorkshopAndDesignDocHours, :HPAMOrgConfigurationHours, :HPAMPostImplementationServicesHours, :HPAMProductionMigrationHours, :HPAMUiTrainingHours, :HPAMSolutionDocumentationHours, :HPAMProjectManagementHours, :totalHPAMHours, :federationWorkshopAndDesignDocHours, :federationInstallationHours, :federationTotalConfigurationHours, :federationPostImplementationServicesHours, :federationProductionMigration, :federationConfigurationOverviewHours, :federationSolutionDocumentationHours, :federationProjectManagementHours, :totalFederationHours, :administrationBasicTrainingHours, :administrationAdvancedTrainingTrainingHours, :administrationKioskTrainingHours, :administrationPinTrainingTrainingHours, :administrationHelpDeskTrainingTrainingHours, :administrationSelectServiceTrainingTrainingHours, :administrationHPAMUiTrainingHours, :administrationFederationConfigTrainingHours, :administrationProjectManagementHours, :totalAdministrationHours, :totalAllHours, :phaseAssessmentDesignHours, :phaseInstallationHours, :phaseImplementationHours, :phaseProjectManagementHours, :phaseTrainingHours, :modulesPasswordManagement, :modulesProvisioning, :modulesHPAM, :modulesFederation)"
    );
    $sql->bindParam(":username", $username, PDO::PARAM_STR);
    $sql->bindParam(":clientName", $clientName, PDO::PARAM_STR);
    $sql->bindParam(":startDate", $startDate, PDO::PARAM_STR);
    $sql->bindParam(":completionDate", $completionDate, PDO::PARAM_STR);
    $sql->bindParam(":servicesHourlyRate", $servicesHourlyRate, PDO::PARAM_STR);
    $sql->bindParam(":environmentTotalPlatformInstallHours", $environmentTotalPlatformInstallHours, PDO::PARAM_STR);
    $sql->bindParam(":environmentOrganizationConfigurationHours", $environmentOrganizationConfigurationHours, PDO::PARAM_STR);
    $sql->bindParam(":environmentConnectedSystemDefinitionsHours", $environmentConnectedSystemDefinitionsHours, PDO::PARAM_STR);
    $sql->bindParam(":environmentDocumentConfigurationsHours", $environmentDocumentConfigurationsHours, PDO::PARAM_STR);
    $sql->bindParam(":environmentProjectManagementHours", $environmentProjectManagementHours, PDO::PARAM_STR);
    $sql->bindParam(":totalEnvironmentHours", $totalEnvironmentHours, PDO::PARAM_STR);
    $sql->bindParam(":passwordWorkshopAndDesignDocHours", $passwordWorkshopAndDesignDocHours, PDO::PARAM_STR);
    $sql->bindParam(":passwordConfigurationHours", $passwordConfigurationHours, PDO::PARAM_STR);
    $sql->bindParam(":passwordPostImplementationServicesHours", $passwordPostImplementationServicesHours, PDO::PARAM_STR);
    $sql->bindParam(":passwordProductionMigrationHours", $passwordProductionMigrationHours, PDO::PARAM_STR);
    $sql->bindParam(":passwordUiTrainingHours", $passwordUiTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":passwordSolutionDocumentationHours", $passwordSolutionDocumentationHours, PDO::PARAM_STR);
    $sql->bindParam(":passwordProjectManagementHours", $passwordProjectManagementHours, PDO::PARAM_STR);
    $sql->bindParam(":totalPasswordHours", $totalPasswordHours, PDO::PARAM_STR);
    $sql->bindParam(":provisioningWorkshopAndDesignDocHours", $provisioningWorkshopAndDesignDocHours, PDO::PARAM_STR);
    $sql->bindParam(":provisioningConfiguration", $provisioningConfiguration, PDO::PARAM_STR);
    $sql->bindParam(":provisioningPostImplementationServicesHours", $provisioningPostImplementationServicesHours, PDO::PARAM_STR);
    $sql->bindParam(":provisioningProductionMigrationHours", $provisioningProductionMigrationHours, PDO::PARAM_STR);
    $sql->bindParam(":provisioningUiTrainingHours", $provisioningUiTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":provisioningSolutionDocumentationHours", $provisioningSolutionDocumentationHours, PDO::PARAM_STR);
    $sql->bindParam(":provisioningProjectManagementHours", $provisioningProjectManagementHours, PDO::PARAM_STR);
    $sql->bindParam(":totalProvisioningHours", $totalProvisioningHours, PDO::PARAM_STR);
    $sql->bindParam(":HPAMWorkshopAndDesignDocHours", $HPAMWorkshopAndDesignDocHours, PDO::PARAM_STR);
    $sql->bindParam(":HPAMOrgConfigurationHours", $HPAMOrgConfigurationHours, PDO::PARAM_STR);
    $sql->bindParam(":HPAMPostImplementationServicesHours", $HPAMPostImplementationServicesHours, PDO::PARAM_STR);
    $sql->bindParam(":HPAMProductionMigrationHours", $HPAMProductionMigrationHours, PDO::PARAM_STR);
    $sql->bindParam(":HPAMUiTrainingHours", $HPAMUiTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":HPAMSolutionDocumentationHours", $HPAMSolutionDocumentationHours, PDO::PARAM_STR);
    $sql->bindParam(":HPAMProjectManagementHours", $HPAMProjectManagementHours, PDO::PARAM_STR);
    $sql->bindParam(":totalHPAMHours", $totalHPAMHours, PDO::PARAM_STR);
    $sql->bindParam(":federationWorkshopAndDesignDocHours", $federationWorkshopAndDesignDocHours, PDO::PARAM_STR);
    $sql->bindParam(":federationInstallationHours", $federationInstallationHours, PDO::PARAM_STR);
    $sql->bindParam(":federationTotalConfigurationHours", $federationTotalConfigurationHours, PDO::PARAM_STR);
    $sql->bindParam(":federationPostImplementationServicesHours", $federationPostImplementationServicesHours, PDO::PARAM_STR);
    $sql->bindParam(":federationProductionMigration", $federationProductionMigration, PDO::PARAM_STR);
    $sql->bindParam(":federationConfigurationOverviewHours", $federationConfigurationOverviewHours, PDO::PARAM_STR);
    $sql->bindParam(":federationSolutionDocumentationHours", $federationSolutionDocumentationHours, PDO::PARAM_STR);
    $sql->bindParam(":federationProjectManagementHours", $federationProjectManagementHours, PDO::PARAM_STR);
    $sql->bindParam(":totalFederationHours", $totalFederationHours, PDO::PARAM_STR);
    $sql->bindParam(":administrationBasicTrainingHours", $administrationBasicTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":administrationAdvancedTrainingTrainingHours", $administrationAdvancedTrainingTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":administrationKioskTrainingHours", $administrationKioskTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":administrationPinTrainingTrainingHours", $administrationPinTrainingTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":administrationHelpDeskTrainingTrainingHours", $administrationHelpDeskTrainingTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":administrationSelectServiceTrainingTrainingHours", $administrationSelectServiceTrainingTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":administrationHPAMUiTrainingHours", $administrationHPAMUiTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":administrationFederationConfigTrainingHours", $administrationFederationConfigTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":administrationProjectManagementHours", $administrationProjectManagementHours, PDO::PARAM_STR);
    $sql->bindParam(":totalAdministrationHours", $totalAdministrationHours, PDO::PARAM_STR);
    $sql->bindParam(":totalAllHours", $totalAllHours, PDO::PARAM_STR);
    $sql->bindParam(":phaseAssessmentDesignHours", $phaseAssessmentDesignHours, PDO::PARAM_STR);
    $sql->bindParam(":phaseInstallationHours", $phaseInstallationHours, PDO::PARAM_STR);
    $sql->bindParam(":phaseImplementationHours", $phaseImplementationHours, PDO::PARAM_STR);
    $sql->bindParam(":phaseProjectManagementHours", $phaseProjectManagementHours, PDO::PARAM_STR);
    $sql->bindParam(":phaseTrainingHours", $phaseTrainingHours, PDO::PARAM_STR);
    $sql->bindParam(":modulesPasswordManagement", $modulesPasswordManagement, PDO::PARAM_STR);
    $sql->bindParam(":modulesProvisioning", $modulesProvisioning, PDO::PARAM_STR);
    $sql->bindParam(":modulesHPAM", $modulesHPAM, PDO::PARAM_STR);
    $sql->bindParam(":modulesFederation", $modulesFederation, PDO::PARAM_STR);
    $sql->execute();
}
echo '<link rel="stylesheet" href="../../../assets/css/custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/darkly/bootstrap.css">
<div class="left-right-margin"><h4>Client Name: ' . $clientName . '</h4>
<h4>Generated By: ' . $username . '</h4>
    <h4>' . $completionDate . '</h4>
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
            <td>' . '$' . number_format(($environmentTotalPlatformInstallHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($environmentTotalPlatformInstallHours, 2) . '</td>
            <td>All required infrastructure source, i.e.: GIGs, Test & Production Platforms</td>
        </tr>
        <tr>
            <td>Organization Configuration</td>
            <td>' . '$' . number_format(($environmentOrganizationConfigurationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($environmentOrganizationConfigurationHours, 2) . '</td>
            <td>Configure Organization specific settings, logo, page titles, etc..</td>
        </tr>

        <tr>
            <td>Configure Connected Systems</td>
            <td>' . '$' . number_format(($environmentConnectedSystemDefinitionsHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($environmentConnectedSystemDefinitionsHours, 2) . '</td>
            <td>15 minutes per system</td>
        </tr>

        <tr>
            <td>Document Configurations</td>
            <td>' . '$' . number_format(($environmentDocumentConfigurationsHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($environmentDocumentConfigurationsHours, 2) . '</td>
            <td>Document all server configuration settings</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . number_format(($environmentProjectManagementHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($environmentProjectManagementHours, 2) . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . number_format(($totalEnvironmentHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($totalEnvironmentHours, 2) . '</td>
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
            <td>' . '$' . number_format(($passwordWorkshopAndDesignDocHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($passwordWorkshopAndDesignDocHours, 2) . '</td>
            <td>All Password Management Requirements will be defined and a design document will be generated</td>
        </tr>

        <tr>
            <td>Configuration</td>
            <td>' . '$' . number_format(($passwordConfigurationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($passwordConfigurationHours, 2) . '</td>
            <td>Password Policies, Password System Groupings, Configuring Self-Registration / Self Claiming.</td>
        </tr>

        <tr>
            <td>Post Implementation Services</td>
            <td>' . '$' . number_format(($passwordPostImplementationServicesHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($passwordPostImplementationServicesHours, 2) . '</td>
            <td>Review system logging facilities for the purposes of troubleshooting, ensure system health and identify potential issues.</td>
        </tr>

        <tr>
            <td>Prod. Migration</td>
            <td>' . '$' . number_format(($passwordProductionMigrationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($passwordProductionMigrationHours, 2) . '</td>
            <td>Migrate implemented solution into production</td>
        </tr>

        <tr>
            <td>Training</td>
            <td>' . '$' . number_format(($passwordUiTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($passwordUiTrainingHours, 2) . '</td>
            <td>Self-Service UI training to ensure a complete understanding of UI elements and functionality.</td>
        </tr>

        <tr>
            <td>Solution Documentation</td>
            <td>' . '$' . number_format(($passwordSolutionDocumentationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($passwordSolutionDocumentationHours, 2) . '</td>
            <td>Document Solution specific password management configurations</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . number_format(($passwordProjectManagementHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($passwordProjectManagementHours, 2) . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . number_format(($totalPasswordHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($totalPasswordHours, 2) . '</td>
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
            <td>' . '$' . number_format(($provisioningWorkshopAndDesignDocHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($provisioningWorkshopAndDesignDocHours, 2) . '</td>
            <td>All Provisioning Requirements will be defined and a design document will be generated.</td>
        </tr>

        <tr>
            <td>Configuration</td>
            <td>' . '$' . number_format(($provisioningConfiguration * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($provisioningConfiguration, 2) . '</td>
            <td>All necessary product features will be configure to enable the required functionality.  The following provisioning process will be implemented to manage standard accounts and permissions of each provisioning target system: Add, Modify, Disable, Terminate.</td>
        </tr>

        <tr>
            <td>Post Implementation Services</td>
            <td>' . '$' . number_format(($provisioningPostImplementationServicesHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($provisioningPostImplementationServicesHours, 2) . '</td>
            <td>Review system logging facilities for the purposes of troubleshooting, ensure system health and identify potential issues.</td>
        </tr>

        <tr>
            <td>Prod. Migration</td>
            <td>' . '$' . number_format(($provisioningProductionMigrationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($provisioningProductionMigrationHours, 2) . '</td>
            <td>Migrate implemented solution into production</td>
        </tr>

        <tr>
            <td>Training</td>
            <td>' . '$' . number_format(($provisioningUiTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($provisioningUiTrainingHours, 2) . '</td>
            <td>Self-Service UI training to ensure a complete understanding of UI elements and functionality.</td>
        </tr>

        <tr>
            <td>Solution Documentation</td>
            <td>' . '$' . number_format(($provisioningSolutionDocumentationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($provisioningSolutionDocumentationHours, 2) . '</td>
            <td>Document Solution specific provisioning configurations</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . number_format(($provisioningProjectManagementHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($provisioningProjectManagementHours, 2) . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . number_format(($totalProvisioningHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($totalProvisioningHours, 2) . '</td>
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
            <td>' . '$' . number_format(($HPAMWorkshopAndDesignDocHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($HPAMWorkshopAndDesignDocHours, 2) . '</td>
            <td>All HPAM Requirements will be defined and a design document will be generated.</td>
        </tr>

        <tr>
            <td>Configuration</td>
            <td>' . '$' . number_format(($HPAMOrgConfigurationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($HPAMOrgConfigurationHours, 2) . '</td>
            <td>Configure HPAM Account Types, System Owners, HPAM Users.</td>
        </tr>

        <tr>
            <td>Post Implementation Services</td>
            <td>' . '$' . number_format(($HPAMPostImplementationServicesHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($HPAMPostImplementationServicesHours, 2) . '</td>
            <td>Review system logging facilities for the purposes of troubleshooting, ensure system health and identify potential issues.</td>
        </tr>

        <tr>
            <td>Prod. Migration</td>
            <td>' . '$' . number_format(($HPAMProductionMigrationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($HPAMProductionMigrationHours, 2) . '</td>
            <td>Migrate implemented solution into production</td>
        </tr>

        <tr>
            <td>Training</td>
            <td>' . '$' . number_format(($HPAMUiTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($HPAMUiTrainingHours, 2) . '</td>
            <td>Self-Service UI training to ensure a complete understanding of UI elements and functionality.</td>
        </tr>

        <tr>
            <td>Solution Documentation</td>
            <td>' . '$' . number_format(($HPAMSolutionDocumentationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($HPAMSolutionDocumentationHours, 2) . '</td>
            <td>Document Solution specific HPAM configurations</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . number_format(($HPAMProjectManagementHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($HPAMProjectManagementHours, 2) . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . number_format(($totalHPAMHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($totalHPAMHours, 2) . '</td>
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
            <td>' . '$' . number_format(($federationWorkshopAndDesignDocHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($federationWorkshopAndDesignDocHours, 2) . '</td>
            <td>All Federation Requirements will be defined and a design document will be generated.</td>
        </tr>

        <tr>
            <td>Federation Installations (IdPs, SPs & DS)</td>
            <td>' . '$' . number_format(($federationInstallationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($federationInstallationHours, 2) . '</td>
            <td>Installation of Federation IdPs, Shibboleth SPs and Discovery Services</td>
        </tr>

        <tr>
            <td>Configuration</td>
            <td>' . '$' . number_format(($federationTotalConfigurationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($federationTotalConfigurationHours, 2) . '</td>
            <td>Configure IdP, SP Metadata and Attribute Management Processes.</td>
        </tr>

        <tr>
            <td>Post Implementation Services</td>
            <td>' . '$' . number_format(($federationPostImplementationServicesHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($federationPostImplementationServicesHours, 2) . '</td>
            <td>Review system logging facilities for the purposes of troubleshooting, ensure system health and identify potential issues.</td>
        </tr>

        <tr>
            <td>Prod. Migration</td>
            <td>' . '$' . number_format(($federationProductionMigration * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($federationProductionMigration, 2) . '</td>
            <td>Migrate implemented solution into production</td>
        </tr>

        <tr>
            <td>Configuration Overview</td>
            <td>' . '$' . number_format(($federationConfigurationOverviewHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($federationConfigurationOverviewHours, 2) . '</td>
            <td>Implementation overview for the purposes of maintaining and administering solution.</td>
        </tr>

        <tr>
            <td>Solution Documentation</td>
            <td>' . '$' . number_format($federationSolutionDocumentationHours * $servicesHourlyRate, 2) . '</td>
            <td>' . number_format($federationSolutionDocumentationHours, 2) . '</td>
            <td>Document Solution specific Federation configurations</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . number_format(($federationProjectManagementHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($federationProjectManagementHours, 2) . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . number_format(($totalFederationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($totalFederationHours, 2) . '</td>
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
            <td>' . '$' . number_format(($administrationBasicTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($administrationBasicTrainingHours, 2) . '</td>
            <td>Overview of the basic source and product functionality.</td>
        </tr>

        <tr>
            <td>Advanced Features and Concepts</td>
            <td>' . '$' . number_format(($administrationAdvancedTrainingTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($administrationAdvancedTrainingTrainingHours, 2) . '</td>
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
            <td>' . '$' . number_format(($administrationKioskTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($administrationKioskTrainingHours, 2) . '</td>
            <td></td>
        </tr>

        <tr>
            <td>Pin Reset UI Training (Train the Trainer)</td>
            <td>' . '$' . number_format(($administrationPinTrainingTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($administrationPinTrainingTrainingHours, 2) . '</td>
            <td></td>
        </tr>

        <tr>
            <td>Help Desk UI Training (Train the Trainer)</td>
            <td>' . '$' . number_format(($administrationHelpDeskTrainingTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($administrationHelpDeskTrainingTrainingHours, 2) . '</td>
            <td></td>
        </tr>

        <tr>
            <td>Self Service Access Management UI Training (Train the Trainer)</td>
            <td>' . '$' . number_format(($administrationSelectServiceTrainingTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($administrationSelectServiceTrainingTrainingHours, 2) . '</td>
            <td></td>
        </tr>

        <tr>
            <td>HPAM UI Training (Train the Trainer)</td>
            <td>' . '$' . number_format(($administrationHPAMUiTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($administrationHPAMUiTrainingHours, 2) . '</td>
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
            <td>' . '$' . number_format(($administrationFederationConfigTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($administrationFederationConfigTrainingHours, 2) . '</td>
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
            <td>' . '$' . number_format(($administrationProjectManagementHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($administrationProjectManagementHours, 2) . '</td>
            <td>Project Management Activities</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . number_format(($totalAdministrationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($totalAdministrationHours, 2) . '</td>
            <td></td>
        </tr>

        <tr>
            <th><b>* Total Estimated Effort</b></th>
            <th>' . '$' . number_format(($totalAllHours * $servicesHourlyRate), 2) . '</th>
            <th>' . number_format($totalAllHours, 2) . '</th>
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
            <td>' . '$' . number_format(($phaseAssessmentDesignHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($phaseAssessmentDesignHours, 2) . '</td>
        </tr>

        <tr>
            <td>Installation</td>
            <td>' . '$' . number_format(($phaseInstallationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($phaseInstallationHours, 2) . '</td>
        </tr>

        <tr>
            <td>Implementation</td>
            <td>' . '$' . number_format(($phaseImplementationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($phaseImplementationHours, 2) . '</td>
        </tr>

        <tr>
            <td>Project Management</td>
            <td>' . '$' . number_format(($phaseProjectManagementHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($phaseProjectManagementHours, 2) . '</td>
        </tr>

        <tr>
            <td>Training</td>
            <td>' . '$' . number_format(($phaseTrainingHours * $servicesHourlyRate), 2) . '</td>
            <td>' . number_format($phaseTrainingHours, 2) . '</td>
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
            <td>' . '$' . number_format(($totalEnvironmentHours * $servicesHourlyRate), 2) . '</td>
            <td>' . (number_format(($totalEnvironmentHours / $totalAllHours), 2) * 100) . '%' . '</td>
            <td>No Customization changes to Self-Service Uis.  Only configurable changes allowed.</td>
        </tr>

        <tr>
            <td>Password Management</td>
            <td>' . '$' . number_format(($totalPasswordHours * $servicesHourlyRate), 2) . '</td>
            <td>' . (number_format(($totalPasswordHours / $totalAllHours), 2) * 100) . '%' . '</td>
            <td>All Connectors available.  Does not accommodate for any necessary development time or effort.</td>
        </tr>

        <tr>
            <td>Provisioning</td>
            <td>' . '$' . number_format(($totalProvisioningHours * $servicesHourlyRate), 2) . '</td>
            <td>' . (number_format(($totalProvisioningHours / $totalAllHours), 2) * 100) . '%' . '</td>
            <td>Does not accommodate for any unforeseen issues or solution customizations not supported via the standard UIs or RDM workflows.</td>
        </tr>

        <tr>
            <td>HPAM</td>
            <td>' . '$' . number_format(($totalHPAMHours * $servicesHourlyRate), 2) . '</td>
            <td>' . (number_format(($totalHPAMHours / $totalAllHours), 2) * 100) . '%' . '</td>
            <td>All necessary policy / roles have been defined.</td>
        </tr>

        <tr>
            <td>Federation</td>
            <td>' . '$' . number_format(($totalFederationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . (number_format(($totalFederationHours / $totalAllHours), 2) * 100) . '%' . '</td>
            <td>Will create standard application accounts.</td>
        </tr>

        <tr>
            <td>Training</td>
            <td>' . '$' . number_format(($totalAdministrationHours * $servicesHourlyRate), 2) . '</td>
            <td>' . (number_format(($totalAdministrationHours / $totalAllHours), 2) * 100) . '%' . '</td>
            <td>All Fischer Pre-Requisites have been satisfied prior to starting the implementation.</td>
        </tr>

        <tr>
            <td><b>Total</b></td>
            <td>' . '$' . number_format(($totalAllHours * $servicesHourlyRate), 2) . '</td>
            <td>' . (number_format(($totalAllHours / $totalAllHours), 2) * 100) . '%' . '</td>
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