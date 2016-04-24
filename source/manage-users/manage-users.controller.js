angular.module("salesQuoteApp.manageUsersController", [])

    .controller("manageUsersController", function ($scope, $http, $window) {
        $scope.processNewUser = function () {
            $http({
                method: 'POST',
                url: 'processuser.php',
                data: $scope.userData
            }).then(
                function (result) {
                    console.log(result);
                    $window.location.href = "view/user-search.php"
                },
                function (error) {
                    console.log(error)
                }
            );
        };
    });