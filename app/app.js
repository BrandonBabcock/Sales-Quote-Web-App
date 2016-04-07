// app.js

// Create angular app and inject ngAnimate and ui-router
angular.module("salesQuoteApp", ["ngAnimate", "ui.router"])

    // Route configuration
    .config(function($stateProvider, $urlRouterProvider) {
        $stateProvider
            // Initial state for logging in
            .state("login", {
                url: "/login",
                templateUrl: "view/quote-login.php"
            })

            // State to select "Generate New Quote" or "View Existing Quotes"
            .state("home", {
                url: "/home",
                templateUrl: "view/landing.php"
            })
            .state("portal",{
                url: "/adminPortal",
                templateUrl:"view/admin-portal.php"
            })



            // Wizard Base State
            .state("quote", {
                url: "/quote",
                templateUrl: "view/quote.php",
                controller: "quoteController"
            })

            // Wizard Step 1 State
            .state("quote.form1", {
                url: "/form1",
                templateUrl: "view/quote-form1.php"
            })

            // Wizard Step 2 State
            .state("quote.form2", {
                url: "/form2",
                templateUrl: "view/quote-form2.php"
            })

            // Wizard Step 3 State
            .state("quote.form3", {
                url: "/form3",
                templateUrl: "view/quote-form3.php"
            })

            // Wizard Step 4 State
            .state("quote.form4",{
                url:"/form4",
                templateUrl:"view/quote-form4.php"
            })

            .state("users",{
                url:"/users",
                templateUrl:"view/manage-users.php"
            })

            .state("addUser",{
                url:"/addUser",
                templateUrl:"view/add-user.php"
            })

            .state("modifyPrice",{
                url:"/modifyPrice",
                templateUrl:"view/modify-price.php"
            })

            //.state("userResults",{
            //    url:"/userResults",
            //    templateUrl:"view/user-results.php"
            //})

            .state("searchQuote", {
                url:"/search-quote",
                templateUrl:"view/view-existing-quotes.php"
            })

            .state("addNewUser", {
                url:"/add-new-user",
                templateUrl:"view/add-new-user.php"
            })

        ;



        // Catch all route; sends users to the initial state
        $urlRouterProvider.otherwise("login");
    })

    // Form controller
    .controller("quoteController", function($scope, $http, $window) {
        // Returns the current date in the MM/DD/YYYY format (used for Quote Completion Date)
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
            newServicesHourlyRate: "",

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
            unknownPercentage: "10.00%",

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
                    $scope.formData.uniqueDefinitions = 3;
                } else {
                    $scope.formData.uniqueDefinitions = 1;
                }
            } else {
                $scope.formData.passwordManagementWorkshop = "NO";
                $scope.formData.passTargets = 0;

                if ($scope.formData.provisioning == "YES") {
                    $scope.formData.uniqueDefinitions = 2;
                } else {
                    $scope.formData.uniqueDefinitions = 0;
                }
            }
        };

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
                    $scope.formData.uniqueDefinitions = 3;
                } else {
                    $scope.formData.uniqueDefinitions = 2;
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
                    $scope.formData.uniqueDefinitions = 1;
                } else {
                    $scope.formData.uniqueDefinitions = 0;
                }
            }
        };

        $scope.hpamChange = function (option) {
            if (option == "YES") {
                $scope.formData.hpamWorkshop = "YES";
                $scope.formData.hpamAccountTypes = 1;
            } else {
                $scope.formData.hpamWorkshop = "NO";
                $scope.formData.hpamAccountTypes = 0;
            }
        };

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

        $scope.idpOrIaasChange = function (option) {
            if (option == "IaaS") {
                $scope.formData.attManProccess = 1;
            } else {
                $scope.formData.attManProccess = 0;
            }
        };

        // Function to process the form (used for testing)
        $scope.processForm = function () {
            $http({
                method: 'POST',
                url: 'process.php',
                data:$scope.formData
            }).then(
                function (result) {
                    console.log(result);
                    $window.location.href = "quote.php"
                },
                function (error) {
                    console.log(error)
                });
        };

        $scope.processNewUser = function () {

            $http({
                method: 'POST',
                url: 'processuser.php',
                data: $scope.userData
            }).then(
                function (result) {
                    console.log(result);
                    $window.location.href = "view/manage-users.php"
                },
                function (error) {
                    console.log(error)
                }
            );
        };
    });
