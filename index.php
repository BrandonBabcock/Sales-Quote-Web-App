<?php
session_start();
echo '
<!DOCTYPE html>
<html>
    <head>
        <title>Sales Quote</title>
        <meta charset="UTF-8">

        <!-- Link stylesheets -->
        <!-- Documentation for second style sheet: https://bootswatch.com/darkly/ -->
	    <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/darkly/bootstrap.min.css">

        <!-- Load in Global Dependencies -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.18/angular-ui-router.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.5/angular-animate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.5.5/angular-messages.min.js"></script>

        <!-- Load in main application -->
        <script src="source/app.js"></script>
        <script src="source/app.routes.js"></script>
        <script src="source/generate-quote/generate-quote.controller.js"></script>
        <script src="source/manage-users/manage-users.controller.js"></script>

    </head>

    <body ng-app="salesQuoteApp">
        <div ng-cloak="">
            <!-- Views will be injected here -->
            <div ui-view></div>
        </div>
    </body>
</html>
';
?>