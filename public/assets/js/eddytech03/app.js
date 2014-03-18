var apps = angular.module("website", [
    'website.Controller',
    'ngRoute'
]);

apps.config(['$routeProvider', function($routeProvider) {
        $routeProvider
                .when("/", {
                    templateUrl: "public_html/home.html",
                    controller: "homePage"
                })
                .when("/portfolio", {
                    templateUrl: "public_html/portfolio.html",
                    controller: "portfolio"
                })
                .when("/tentang", {
                    templateUrl: "public_html/tentang.html",
                    controller: "tentang"
                })
                .when("/log", {
                    templateUrl: "public_html/home.html",
                    controller: "log"
                })
                .when("/laravel", {
                    templateUrl: "public_html/home.html",
                    controller: "laravel"
                })
                .when("/bootstrap", {
                    templateUrl: "public_html/home.html",
                    controller: "bootstrap"
                })
                .when("/administrator", {
                    templateUrl: "public_html/home.html",
                    controller: "administrator"
                })
                .otherwise({redirectTo: '/'});
    }]);