     angular.module('app')
        .controller('email', function($http, alert, panel){
            var self = this;
            
            $http.get("/journal")
            .success(function(data){
                self.rows = data;
            });
        });
