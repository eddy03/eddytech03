var apps = angular.module('website.Controller', []);

apps.controller('homePage', ["$scope", "$rootScope", "$location", function($scope, $rootScope, $location) {

    $rootScope.headingborder = true;
    $rootScope.heading = {
        need: false
    };
    $rootScope.isActive = function(viewLocation) {
        return viewLocation === $location.path();
    };
}]);

apps.controller('portfolio', ["$scope", "$rootScope", "$location", function($scope, $rootScope, $location) {

    $rootScope.heading = {
        need: true,
        main: "Portfolio",
        description: "Senarai portfolio eddy"
    };
    $rootScope.isActive = function(viewLocation) {
        return viewLocation === $location.path();
    };
}]);

apps.controller('tentang', ["$scope", "$rootScope", "$location", function($scope, $rootScope, $location) {

    $rootScope.heading = {
        need: true,
        main: "Tentang eddytech03",
        description: "Maklumat ringkas mengenai pemilik eddytech03"
    };
    $rootScope.isActive = function(viewLocation) {
        return viewLocation === $location.path();
    };
}]);

apps.controller('log', ["$scope", function($scope) {

    $scope.pagename = "Log";

}]);

apps.controller('laravel', ["$scope", function($scope) {

    $scope.pagename = "Laravel";

}]);

apps.controller('bootstrap', ["$scope", function($scope) {

    $scope.pagename = "Bootstrap";

}]);

apps.controller('administrator', ["$scope", function($scope) {

    $scope.pagename = "ngerii";

}]);
