var express = require('express'),
    app = express();
var bodyParser = require('body-parser');
var person = require("./model/person");
var journal = require("./model/journal");
var food = require("./model/food");
var email = require("./model/email");
var exercise = require("./model/exercise");
var session = require('express-session');
var userId = require("./inc/userid");

var unirest = require('unirest');
var Twit = require('twit');

var twit = new Twit({
    consumer_key:         'uJMw9JOU4YN53asR6xoqt6dax'
  , consumer_secret:      '0ihQ2a6YDKwQgj2bhPmpKpovGP5rZqCy27xtLGxkGTufup5Srw'
  , access_token:         '4355290401-mhC5xnoBzbxGNJaPADxWFWeeSm411AAk0sjEbK8'
  , access_token_secret:  '0s29PC9r8lfRRHv9XWS5mY1W1wjVQjQHSdvjOjvC2ObKj'
})




app.use(express.static(__dirname + '/public/'));
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(session({ secret: 'Wodin' }));

app.get("/person", function(req, res){
  
  person.get(null, function(err, rows){
    res.send(rows);
  })
    
})
.get("/person/:id", function(req, res){
  
  person.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
  
})
.post("/person", function(req, res){
  var errors = person.validate(req.body);
  if(errors){
    res.status(500).send(errors);
    return;
  }
  person.save(req.body, function(err, row){
      if(err){
        res.status(500).send(err);
        return;
      }
    res.redirect("/person/" + row.id);
  })
})
.delete("/person/:id", function(req, res){
  
  person.delete(req.params.id, function(err, rows){
      if(err){
        res.status(500).send(err);
      }else{
        res.send(req.params.id);
      }
  })
  
})


.get("/food", function(req, res){
  food.get(null, function(err, rows){
    res.send(rows);
  })
})
.get("/food/:id", function(req, res){
  food.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
})


.get("/food/search/:term", function(req, res){
    unirest.get("https://nutritionix-api.p.mashape.com/v1_1/search/" + req.params.term + "?fields=item_name%2Citem_id%2Cbrand_name%2Cnf_calories%2Cnf_total_fat")
    .header("X-Mashape-Key", "W5nU8b942wmshrxNQoyX1e9jmgozp11Q1fEjsnkbBNtiwR4RAR")
    .header("Accept", "application/json")
    .end(function (result) {
        res.send(result.body);
    });


})



.post("/food", function(req, res){
  var errors = food.validate(req.body);
  if(errors){
    res.status(500).send(errors);
    return;
  }
  food.save(req.body, function(err, row){
      if(err){
        res.status(500).send(err);
        return;
      }
    res.redirect("/food/" + row.id);
  })
})
.delete("/food/:id", function(req, res){
  food.delete(req.params.id, function(err, rows){
      if(err){
        res.status(500).send(err);
      }else{
        res.send(req.params.id);
      }
  })
})


.get("/exercise", function(req, res){
  exercise.get(null, function(err, rows){
    res.send(rows);
  })
})
.get("/exercise/:id", function(req, res){
  exercise.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
})
.post("/exercise", function(req, res){
  var errors = exercise.validate(req.body);
  if(errors){
    res.status(500).send(errors);
    return;
  }
  

  
  exercise.save(req.body, function(err, row){
      if(err){
        res.status(500).send(err);
        return;
      }
    res.redirect("/exercise/" + row.id);
  })
})
.delete("/exercise/:id", function(req, res){
  exercise.delete(req.params.id, function(err, rows){
      if(err){
        res.status(500).send(err);
      }else{
        res.send(req.params.id);
      }
  })
})




.get("/journal", function(req, res){
 journal.get(null, function(err, rows){
    res.send(rows);
  })
})
.get("/journal/:id", function(req, res){
  journal.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
})
.post("/journal", function(req, res){
  var errors = journal.validate(req.body);
  if(errors){
    res.status(500).send(errors);
    return;
  }
  
  
  
  twit.post('statuses/update', { status: req.body.Entry }, function(err, data, response) {
      console.log(data)
    })
  


  
  journal.save(req.body, function(err, row){
      if(err){
        res.status(500).send(err);
        return;
      }
    res.redirect("/journal/" + row.id);
  })
})
.delete("/journal/:id", function(req, res){
  journal.delete(req.params.id, function(err, rows){
      if(err){
        res.status(500).send(err);
      }else{
        res.send(req.params.id);
      }
  })
})







.post("/login", function(req, res){
    unirest.get("https://graph.facebook.com/me?access_token=" + req.body.access_token + "&fields=id,name,email")
    .end(function (result) {
        var fbUser = req.session.fbUser = JSON.parse(result.body);
        fbUser.access_token = req.body.access_token;
        person.get(fbUser.id, function(err, rows) {
            if(rows && rows.length){
                req.session.user = rows[0];
            }else{
              
                person.save({ Name: fbUser.name, Birthday: '2015-01-01', Height: '0', Weight: '0', Calorie_eatgoal: '0',  fbid: fbUser.id }, function(err, row) {
                email.save({Name: fbUser.email, Person_id: 1})   
                    req.session.user = row;
                })
            }
           res.send(result.body);
        }, 'facebook');
    });
})
.get("/fbUser", function(req, res){
    res.send(req.session.fbUser);
})
.get("/user", function(req, res){
    res.send(req.session.user);
})




.get("/logout", function(){
  
    session = null;
})



.get("/email", function(req, res){
  
  email.get(null, function(err, rows){
     if(err){
        res.status(500).send(err);
      }else{
        res.send(rows);
      }
  })
    
});






app.listen(process.env.PORT);
