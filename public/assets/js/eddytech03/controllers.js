var apps = angular.module('website.Controller', []);

apps.controller('homePage', ["$scope", "$rootScope", "$routeParams", "$location", "Articles", function($scope, $rootScope, $routeParams, $location, Articles) {

    $rootScope.headingborder = true;
    $rootScope.heading = {
        need: false
    };
    $rootScope.isActive = function(viewLocation) {
        return viewLocation === $location.path();
    };
    
    console.log($routeParams);
    
    Articles.listArticle($routeParams.query).then(function(data) {
        $scope.totalArtikel = data.total;
        $scope.lastPage = data.last_page;
        $scope.currentPage = data.current_page;
        $scope.perPage = data.per_page;
        $scope.articles = data.data;
        $scope.loops = new Array(data.last_page);
    });
    
}]);

apps.controller('artikel', ["$scope", "$rootScope", "$routeParams", "$location", "$sce", "Articles", function($scope, $rootScope, $routeParams, $location, $sce, Articles) {

    Articles.getArticle($routeParams.artikel).then(function(data) {
        if(typeof data !== 'undefined') {
            $rootScope.heading = {
                need: true,
                main: data.subject,
                description: data.snippet
            };
            
            Articles.getArticleContent($routeParams.artikel).then(function(data) {
                $scope.markdown = $sce.trustAsHtml(data);
            });
        }
        else {
            $location.path("/");
        }
    });
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
