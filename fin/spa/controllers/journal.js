        angular.module('app')
        .controller('journal', function($http, alert, panel){
            var self = this;
            
            $http.get("/journal")
            .success(function(data){
                self.rows = data;
            });
        
            $http.get("/person")
            .success(function(data){
                self.persons = data;
            });
            
            self.create = function(){
                self.rows.push({ isEditing: true });
            }
            self.edit = function(row, index){
                row.isEditing = true;
            }
            self.save = function(row, index){
                $http.post('/journal/', row)
                .success(function(data){
                    data.isEditing = false;
                    self.rows[index] = data;
                }).error(function(data){
                    alert.show(data.code);
                });
            }
            self.delete = function(row, index){
                panel.show( {
                    title: "Delete an entry",
                    body: "Are you sure you want to delete " + row.Entry + "?",
                    confirm: function(){
                        $http.delete('/journal/' + row.id)
                        .success(function(data){
                            self.rows.splice(index, 1);
                        }).error(function(data){
                            alert.show(data.code);
                        });
                    }
                });
            }
            
        });
