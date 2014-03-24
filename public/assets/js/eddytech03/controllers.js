var apps = angular.module('website.Controller', []);

apps.controller('homePage', ["$scope", "$rootScope", "$routeParams", "$location", "Articles", function($scope, $rootScope, $routeParams, $location, Articles) {

    $rootScope.headingborder = true;
    $rootScope.heading = {
        need: false
    };
    $rootScope.isActive = function(viewLocation) {
        return viewLocation === $location.path();
    };
        
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

apps.controller('log', ["$scope", "$rootScope", function($scope, $rootScope) {

    $rootScope.heading = {
        need: true,
        main: "Log eddytech03",
        description: "Log perkembangan penggunaan teknologi di eddytech03"
    };
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

apps.controller('gist', ["$scope", "$rootScope", function($scope, $rootScope) {
        
    $scope.zoom = 15;
    $scope.Clat = '3.067618';
    $scope.Clng = '101.499016';
    $scope.center = new Array();
    $scope.subject = 'This is the subject';
    $scope.strokeColor = '000000';
    $scope.fillColor = '000000';
    $scope.strokeOpacity = 0.9;
    $scope.strokeWeight = 1;
    $scope.fillOpacity = 0.25;
    $scope.latlng = new Array(
        new Array('3.06976', '101.491764'),
        new Array('3.064211', '101.491849'),
        new Array('3.063354', '101.494467'),
        new Array('3.062946', '101.498501'),
        new Array('3.062764', '101.503823'),
        new Array('3.063332', '101.508672'),        
        new Array('3.069117', '101.507127'),
        new Array('3.070403', '101.504166'),
        new Array('3.073274', '101.50099'),
        new Array('3.074431', '101.498201'),
        new Array('3.071774', '101.495969'),
        new Array('3.06946', '101.494167'),        
        new Array('3.06976', '101.491764')
    );
    $scope.addPointing = function() {
        $("#latlngDIV").append( $("#latlng").clone() );
    };
    $scope.generate = function() {
        $scope.center = new Array($scope.Clat.toString(), $scope.Clng.toString());        
        $scope.generatePath();
        $scope.generateMaps();
    };
    
    $scope.generatePath = function() {
        var latitude = new Array();
        var longitude = new Array();
        var index;

        $("input.latitude").each(function(i) {
            latitude[i] = this.value;
        });

        $("input.longitude").each(function(i) {
            longitude[i] = this.value;
        });

        if(latitude.length > 1) {
            $scope.latlng = new Array();

            for(index = 0; index < latitude.length; index++) {        
                $scope.latlng.push(new Array( latitude[index].toString(), longitude[index].toString() ));
            }
        }
    };
    
    $scope.generateMaps = function() {
        console.log("im execute");
        
        $("#gist").gmap3('destroy').gmap3({
            map: {
                options: {
                    center: $scope.center,
                    zoom: $scope.zoom
                }
            },
            infowindow:{
                latLng: $scope.center,
                options: {
                    content: $scope.subject
                }
            },
            polygon: {
                options: {
                    strokeColor: "#" + $scope.strokeColor,
                    strokeOpacity: $scope.strokeOpacity,
                    strokeWeight: $scope.strokeWeight,
                    fillColor: "#" + $scope.fillColor,
                    fillOpacity: $scope.fillOpacity,
                    paths: $scope.latlng
                }
            }
        });
    };
    
    $scope.$watch(
        function () {  },  
        function(newval, oldval){
            $scope.generate();
            $('#tabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show');
            });            
        },
        true
    );
        
    $rootScope.heading = {
        need: true,
        main: "GIST google maps testing",
        description: "Testing GIST google maps integration with jQuery GMAP3 plugin"
    };
}]);
