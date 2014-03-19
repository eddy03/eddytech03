var apps = angular.module('website.article', []);

apps.factory('Articles', ['$http', function($http) {
    
    return {
        listArticle: function(pagination) {
            pagination = (!pagination)? '' : '?page=' + pagination;
            return $http.get('artikel' + pagination).then(function(response) {
                console.log(response);
                return response.data;
            });
        },
        getArticle: function(urls) {
            return $http.get('artikel/' + urls).then(function(response) {
                return response.data[0];
            });
        },
        getArticleContent: function(urls) {
            return $http.get('artikelContent/' + urls).then(function(response) {
                return response.data;
            });
        }
    }    
}]);