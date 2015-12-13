        angular.module('app')
        .controller('personDetails', function($http, alert, panel){
            var self = this;
            var url = window.location.href;
             
            url = url.split('/'); 
            url = url.pop();      
            var personid =  Number(url);
            
            
           $http.get("/person/" + personid)
            .success(function(data){
          
                self.rows = data;
            });
            
            
          
                
            
            
         
        
        });
