var express = require('express'),
    app = express();
var bodyParser = require('body-parser');

var food = require("./model/food");
var person = require("./model/person");
var exercise = require("./model/exercise");




app.use(express.static(__dirname + '/public/A'));
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.get("/food", function(req, res){
  
  food.get(null, function(err, rows){
     if(err){
        res.status(500).send(err);
      }
    res.send(rows);
  })
    
})
.get("/food/:id", function(req, res){
  
  food.get(req.params.id, function(err, rows){
     if(err){
        res.status(500).send(err);
      }
    res.send(rows[0]);
  })
  
})
.post("/food", function(req, res){
  var errors = food.validate(req.body);
  if(errors){
    res.status(500).send(errors);
    return;
  }
  food.save(req.body, function(err, row){
    
    res.send(row);
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

app.get("/exercise", function(req, res){
  
  exercise.get(null, function(err, rows){
     if(err){
        res.status(500).send(err);
      }
    res.send(rows);
  })
    
})
.get("/exercise/:id", function(req, res){
  
  exercise.get(req.params.id, function(err, rows){
     if(err){
        res.status(500).send(err);
      }
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
    res.send(row);
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



app.get("/person", function(req, res){
  
  person.get(null, function(err, rows){
     if(err){
        res.status(500).send(err);
      }
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
    res.send(row);
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

app.listen(process.env.PORT);
