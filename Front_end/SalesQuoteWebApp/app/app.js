// app.js

// Create angular app and inject ngAnimate and ui-router
angular.module("quoteApp", ["ngAnimate", "ui.router"])

    // Route configuration
    .config(function($stateProvider, $urlRouterProvider) {
        $stateProvider
            // Route to show basic form (/quote)
            .state("quote", {
                url: "/quote",
                templateUrl: "view/quote.html",
                controller: "quoteController"
            })
            // Nested states
            // Each of these sections will have their own view
            // URL will be nested (/quote/login)
            .state("quote.login", {
                url: "/login",
                templateUrl: "view/quote-login.html"
            })
            // URL will be /quote/home
            .state("quote.home", {
                url: "/home",
                templateUrl: "view/quote-home.html"
            })

            // URL will be /quote/form1
            .state("quote.form1", {
                url: "/form1",
                templateUrl: "view/quote-form1.html"
            });
        //// Catch all route
        //// Send users to the form page
        $urlRouterProvider.otherwise("quote/login");
    })

    // Form controller
    .controller("quoteController", function($scope) {
        // All form data is stored in this object (used for testing)
        $scope.formData = {};

        // Function to process the form (used for testing)
        $scope.processForm = function() {
            alert("Your sales quote has been generated.");
        };
    });