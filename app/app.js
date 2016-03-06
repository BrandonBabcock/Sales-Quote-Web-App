// app.js

// Create angular app and inject ngAnimate and ui-router
angular.module("quoteApp", ["ngAnimate", "ui.router"])


    // Route configuration
    .config(function($stateProvider, $urlRouterProvider) {
        $stateProvider
        // Initial state
            .state("login", {
                url: "/login",
                templateUrl: "view/quote-login.html"
            })
            // State to select "Generate New Quote" or "View Existing Quotes"
            .state("home", {
                url: "/home",
                templateUrl: "view/quote-home.html"
            })
            // Wizard Base State
            .state("quote", {
                url: "/quote",
                templateUrl: "view/quote.html",
                controller: "quoteController"
            })
            // Wizard Step 2 State
            .state("quote.form1", {
                url: "/form1",
                templateUrl: "view/quote-form1.html"
            })

            .state("quote.form2", {
                url: "/form2",
                templateUrl: "view/quote-form2.html"
            })

            .state("quote.form3", {
                url: "/form3",
                templateUrl: "view/quote-form3.html"
            })

            .state("quote.form4",{
                url:"/form4",
                templateUrl:"view/quote-form4.html"
    });

        //// Catch all route
        //// Send users to the initial state
        $urlRouterProvider.otherwise("login");
    })

    // Form controller
    .controller("quoteController", function($scope) {
        // All form data is stored in this object (used for testing)
        $scope.formData = {
            federationWorkshop: "IaaS",
            additionalEnvironment: "NO",
            passwordManagement: "YES",
            provisioning: "YES",
            hpam: "YES",
            federation: "YES",
            passwordManagementWorkshop: "YES",
            provWorkshop: "YES",
            hpamWorkshop: "YES",
            federationWorkshop: "YES",
            postImpServices: "YES",
            userAccountLoad: "NONE",
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

        $scope.setDisables = function() {

        };

        // Function to process the form (used for testing)
        $scope.processForm = function() {
            alert("Your sales quote has been generated.");
        };
    });

