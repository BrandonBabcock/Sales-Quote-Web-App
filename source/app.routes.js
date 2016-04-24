angular.module("salesQuoteApp.routes", ["ui.router"])

    // Route configuration
    .config(function ($stateProvider, $urlRouterProvider) {
        $stateProvider
        // Login page state
            .state("login", {
                url: "/login",
                templateUrl: "source/login/view/login.php"
            })

            // Landing page state
            .state("landing", {
                url: "/home",
                templateUrl: "source/login/view/landing.php"
            })

            // Wizard base state after clicking "Generate New Quote" from landing page
            .state("quoteForm", {
                url: "/quote",
                templateUrl: "source/generate-quote/view/quote-form-index.php",
                controller: "generateQuoteController"
            })

            // Wizard step 1 state
            .state("quoteForm.form1", {
                url: "/form1",
                templateUrl: "source/generate-quote/view/quote-form1.php"
            })

            // Wizard step 2 state
            .state("quoteForm.form2", {
                url: "/form2",
                templateUrl: "source/generate-quote/view/quote-form2.php"
            })

            // Wizard step 3 state
            .state("quoteForm.form3", {
                url: "/form3",
                templateUrl: "source/generate-quote/view/quote-form3.php"
            })

            // Wizard step 4 state
            .state("quoteForm.form4", {
                url: "/form4",
                templateUrl: "source/generate-quote/view/quote-form4.php"
            })

            // Quote search state after clicking "View Existing Quotes" from landing page
            .state("quoteSearch", {
                url: "/quote-search",
                templateUrl: "source/view-existing-quotes/view/quote-search.php"
            })

            // Admin portal state after clicking "Admin Portal" from landing page
            .state("adminPortal", {
                url: "/admin-portal",
                templateUrl: "source/admin-portal/view/admin-portal.php"
            })

            // Modify price state
            .state("modifyPrice", {
                url: "/modify-price",
                templateUrl: "source/modify-pricing/view/modify-pricing.php"
            })

            // Manage users state
            .state("userSearch", {
                url: "/user-search",
                templateUrl: "source/manage-users/view/user-search.php"
            })

            // Add new user state
            .state("addNewUser", {
                url: "/add-new-user",
                templateUrl: "source/manage-users/view/add-new-user.php",
                controller: "manageUsersController"
            });

        // Catch all route; sends users to the initial state
        $urlRouterProvider.otherwise("login");
    });