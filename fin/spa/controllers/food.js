

        angular.module('app')
        .controller('food', function($http, alert, panel){
            var self = this;
            
            $http.get("/food")
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
                $http.post('/food/', row)
                .success(function(data){
                    data.isEditing = false;
                    self.rows[index] = data;
                }).error(function(data){
                    alert.show(data.code);
                });
            }
            self.delete = function(row, index){
                panel.show( {
                    title: "Delete a food",
                    body: "Are you sure you want to delete " + row.Name + "?",
                    confirm: function(){
                        $http.delete('/food/' + row.id)
                        .success(function(data){
                            self.rows.splice(index, 1);
                        }).error(function(data){
                            alert.show(data.code);
                        });
                    }
                });
            }
            
        })
        .controller('foodNew', function($http, alert, panel){
            var self = this;
            
            self.row = {};
            self.term = null;
            self.choices = [];
            
            self.search = function(){
                $http.get("/food/search/" + self.term)
                .success(function(data){
                    self.choices = data.hits;
                });
            }
            self.choose = function(choice){
                self.row.Name = choice.fields.item_name;
                self.row.Calories = choice.fields.nf_calories;
                self.row.Fat = choice.fields.nf_total_fat;
                self.choices = [];
            }
        })
   .controller('foodNew', function($http, alert, panel){
            var self = this;
            
            self.row = {};
            self.term = null;
            self.choices = [];
            
            self.search = function(){
                $http.get("/food/search/" + self.term)
                .success(function(data){
                    self.choices = data.hits;
                });
            }
            self.choose = function(choice){
                self.row.Name = choice.fields.item_name;
                self.row.Calories = choice.fields.nf_calories;
                self.row.Fat = choice.fields.nf_total_fat;
                self.choices = [];
            }
        })
