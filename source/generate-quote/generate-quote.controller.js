angular.module("salesQuoteApp.generateQuoteController", [])

    // Controller for quote generation
    .controller("generateQuoteController", function ($scope, $http, $window) {
        // Returns the current date in the MM/DD/YYYY format (used for Quote Completion Date field)
        $scope.getCurrentDate = function () {
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();

            if (day < 10) {
                day = '0' + day
            }

            if (month < 10) {
                month = '0' + month
            }

            currentDate = month + '/' + day + '/' + year;
            return currentDate;
        };

        $scope.userData = {
            newUserName: "",
            newlastName: "",
            newusername: "",
            newpassword: "",
            newuseradmin: ""
        };

        // All form data is stored in this object
        $scope.formData = {
            // Step 1
            name: "",
            startDate: "",
            completionDate: $scope.getCurrentDate(),
            model: "IaaS",
            additionalEnvironment: "NO",

            // Step 2
            numberOfEnvironments: 0,
            haServers: 0,
            globalIdentityGateways: 2,
            passwordFilters: 0,
            passwordManagement: "NO",
            provisioning: "NO",
            hpam: "NO",
            federation: "NO",
            passwordManagementWorkshop: "NO",
            provWorkshop: "NO",
            hpamWorkshop: "NO",
            federationWorkshop: "NO",

            // Step 3
            initiationPoints: 1,
            passTargets: 0,
            numberOfAdminProvisioningTargets: 0,
            numberOfAdministrativeProvisionWorkflowsPerTarget: 0,
            numberOfAutomatedProvisioningTargets: 0,
            numberOfAutomatedProvisiongWorkflowsPerTarget: 0,
            hpamAccountTypes: 0,
            uniqueDefinitions: 0,
            approvalConfiguration: 0,
            selectableResource: 0,
            resourceGroupConfigs: 0,
            provisioningNumberOfPolicies: 0,
            organizations: 1,
            idpOrIaas: "None",
            numOfIdp: 0,
            shibboleth: 0,
            discoveryServ: 0,
            fedTargets: 0,
            verifiedSfl: 0,
            nonVerifiedSfl: 0,
            attManProccess: 0,
            onGoingAttManProccess: 0,
            postImpServices: "YES",
            userAccountLoad: "Custom",
            unknownPercentage: 10.00,

            // Step 4
            training: "NO",
            basicTraining: "NO",
            advancedTraining: "NO",
            kioskTraining: "NO",
            pinTraining: "NO",
            helpDeskTraining: "NO",
            selectServiceTraining: "NO",
            hpamTraining: "NO",
            federationConfigTraining: "NO"
        };

        // Sets proper field values when Password Management is changed
        $scope.passwordManagementChange = function (option) {
            if (option == "YES") {
                $scope.formData.passwordManagementWorkshop = "YES";
                $scope.formData.passTargets = 1;

                // Total Number of Unique Connected System Definitions has dependent data on both Password Management
                // and Provisioning, so the if statement is needed
                if ($scope.formData.provisioning == "YES") {
                    $scope.formData.uniqueDefinitions = $scope.formData.passTargets + $scope.formData.numberOfAdminProvisioningTargets
                        + $scope.formData.numberOfAutomatedProvisioningTargets;
                } else {
                    $scope.formData.uniqueDefinitions = $scope.formData.passTargets + $scope.formData.numberOfAdminProvisioningTargets
                        + $scope.formData.numberOfAutomatedProvisioningTargets;
                }
            } else {
                $scope.formData.passwordManagementWorkshop = "NO";
                $scope.formData.passTargets = 0;

                if ($scope.formData.provisioning == "YES") {
                    $scope.formData.uniqueDefinitions = $scope.formData.passTargets + $scope.formData.numberOfAdminProvisioningTargets
                        + $scope.formData.numberOfAutomatedProvisioningTargets;
                } else {
                    $scope.formData.uniqueDefinitions = $scope.formData.passTargets + $scope.formData.numberOfAdminProvisioningTargets
                        + $scope.formData.numberOfAutomatedProvisioningTargets;
                }
            }
        };

        // Sets proper field values when Provisioning is changed
        $scope.provisioningChange = function (option) {
            if (option == "YES") {
                $scope.formData.provWorkshop = "YES";
                $scope.formData.numberOfAdminProvisioningTargets = 1;
                $scope.formData.numberOfAdministrativeProvisionWorkflowsPerTarget = 1;
                $scope.formData.numberOfAutomatedProvisioningTargets = 1;
                $scope.formData.numberOfAutomatedProvisiongWorkflowsPerTarget = 3;
                $scope.formData.approvalConfiguration = 1;
                $scope.formData.selectableResource = 5;
                $scope.formData.resourceGroupConfigs = 1;
                $scope.formData.provisioningNumberOfPolicies = 5;

                // Total Number of Unique Connected System Definitions has dependent data on both Password Management
                // and Provisioning, so the if statement is needed
                if ($scope.formData.passwordManagement == "YES") {
                    $scope.formData.uniqueDefinitions = $scope.formData.passTargets + $scope.formData.numberOfAdminProvisioningTargets
                        + $scope.formData.numberOfAutomatedProvisioningTargets;
                } else {
                    $scope.formData.uniqueDefinitions = $scope.formData.passTargets + $scope.formData.numberOfAdminProvisioningTargets
                        + $scope.formData.numberOfAutomatedProvisioningTargets;
                }
            } else {
                $scope.formData.provWorkshop = "NO";
                $scope.formData.numberOfAdminProvisioningTargets = 0;
                $scope.formData.numberOfAdministrativeProvisionWorkflowsPerTarget = 0;
                $scope.formData.numberOfAutomatedProvisioningTargets = 0;
                $scope.formData.numberOfAutomatedProvisiongWorkflowsPerTarget = 0;
                $scope.formData.approvalConfiguration = 0;
                $scope.formData.selectableResource = 0;
                $scope.formData.resourceGroupConfigs = 0;
                $scope.formData.provisioningNumberOfPolicies = 0;

                if ($scope.formData.passwordManagement == "YES") {
                    $scope.formData.uniqueDefinitions = $scope.formData.passTargets + $scope.formData.numberOfAdminProvisioningTargets + $scope.formData.numberOfAutomatedProvisioningTargets;
                } else {
                    $scope.formData.uniqueDefinitions = $scope.formData.passTargets + $scope.formData.numberOfAdminProvisioningTargets
                        + $scope.formData.numberOfAutomatedProvisioningTargets;
                }
            }
        };

        // Sets proper field values when HPAM is changed
        $scope.hpamChange = function (option) {
            if (option == "YES") {
                $scope.formData.hpamWorkshop = "YES";
                $scope.formData.hpamAccountTypes = 1;
            } else {
                $scope.formData.hpamWorkshop = "NO";
                $scope.formData.hpamAccountTypes = 0;
            }
        };

        // Sets proper field values when Federation is changed
        $scope.federationChange = function (option) {
            if (option == "YES") {
                $scope.formData.federationWorkshop = "YES";
                $scope.formData.idpOrIaas = "IaaS";
                $scope.formData.shibboleth = 1;
                $scope.formData.discoveryServ = 1;
                $scope.formData.fedTargets = 1;
                $scope.formData.verifiedSfl = 1;
                $scope.formData.nonVerifiedSfl = 1;
                $scope.formData.attManProccess = 1;
                $scope.formData.onGoingAttManProccess = 0;

                // Number of IdPs is disabled is the Model is IaaS, so the if statement is needed
                if ($scope.formData.model == "On-Premise") {
                    $scope.formData.numOfIdp = 1;
                }
            } else {
                $scope.formData.federationWorkshop = "NO";
                $scope.formData.idpOrIaas = "None";
                $scope.formData.shibboleth = 0;
                $scope.formData.discoveryServ = 0;
                $scope.formData.fedTargets = 0;
                $scope.formData.verifiedSfl = 0;
                $scope.formData.nonVerifiedSfl = 0;
                $scope.formData.attManProccess = 0;
                $scope.formData.onGoingAttManProccess = 0;
                $scope.formData.numOfIdp = 0;
            }
        };

        // Changes the Number of Environments and Additional HA Servers based on Model and Additional Development Environment
        $scope.changeNumOfEnvironAndHA = function () {
            if ($scope.formData.model == "IaaS") {
                $scope.formData.numberOfEnvironments = 0;
                $scope.formData.haServers = 0;
                $scope.formData.numOfIdp = 0;
            } else if ($scope.formData.model == "On-Premise" && $scope.formData.additionalEnvironment == "NO") {
                $scope.formData.numberOfEnvironments = 2;
                $scope.formData.haServers = 1;
                $scope.formData.numOfIdp = 1;
            } else if ($scope.formData.model == "On-Premise" && $scope.formData.additionalEnvironment == "YES") {
                $scope.formData.numberOfEnvironments = 3;
                $scope.formData.haServers = 1;
                $scope.formData.numOfIdp = 1;
            }
        };

        // Updates Unique Connected System Definitions when one of the influencing values is modified
        $scope.updateUniqueConnectedSystemsDefinitions = function() {
            $scope.formData.uniqueDefinitions = $scope.formData.passTargets + $scope.formData.numberOfAdminProvisioningTargets
                + $scope.formData.numberOfAutomatedProvisioningTargets;
        }

        $scope.idpOrIaasChange = function (option) {
            if (option == "IaaS") {
                $scope.formData.attManProccess = 1;
            } else {
                $scope.formData.attManProccess = 0;
            }
        };

        // Function to process the form and generate the quote
        $scope.processForm = function () {
            var key;
            for (key in $scope.formData) {
                if ($scope.formData[key] === "" || $scope.formData[key] == null) {
                    alert("One or more required fields have been left empty and must be filled out!");
                    return;
                }
            }
            var regEx = /^\d{2}\/\d{2}\/\d{4}$/; // check data syntax
            if (!regEx.test($scope.formData.startDate)) {
                alert("Desired completion date format is invalid!!");
                return;
            }

            $http({
                method: 'POST',
                url: 'source/generate-quote/process-quote.php',
                data: $scope.formData
            }).then(
                function (result) {
                    $window.location.href = "source/generate-quote/view/complete-quote.php"
                },
                function (error) {
                    console.log(error)
                });
        };
    });