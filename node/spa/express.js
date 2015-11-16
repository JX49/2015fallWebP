var express = require('express'),
    app = express();
var bodyParser = require('body-parser');

var food = require("./model/food");


var data = [{id: 0, Name: "Billy"}, {id: 1, Name: "Krackadilla"}, {id: 2, Name: "Morgul"}];

app.use(express.static(__dirname + '/public'));
app.use(bodyParser.urlencoded({
  extended: true
}));

app.get("/food", function(req, res){
  
  food.get(null, function(err, rows){
    res.send(rows);
  })
    
})
.get("/food/:id", function(req, res){
  
  food.get(req.params.id, function(err, rows){
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


app.listen(process.env.PORT);
