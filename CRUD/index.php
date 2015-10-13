<?php
session_start();
    $name = 'User';
    
    $message = "Welcome $name";
    
    $person = array( 'Name' => $name, 'Age' => 20, CalorieGoal => 2000, CalorieBurnGoal => 3000);
  
    $food = $_SESSION['food'];
    if(!$food){
      $_SESSION['food'] = $food = array();
    }
        
    $total = 0;
    foreach ($food as $meal) {
        $total += $meal['Calories'];
    }
    
    
    
    
    
      
    $ex = $_SESSION['ex'];
    if(!$ex){
      $_SESSION['ex'] = $ex = array();
    }
        
    $total2 = 0;
    foreach ($ex as $try) {
        $total2 += $try['Calories'];
    }
    
    
    
    
    
    
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Log view</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
            <h1>Food and exercise log</h1>
            <h2><?=$message?></h2>
            <div class="panel panel-primary" id="display">
                <div class="panel-heading">Your Data</div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd><?=$person['Name']?></dd>
                        <dt>Age</dt>
                        <dd><?=$person['Age'] ?></dd>
                        <dt>Daily calorie goal</dt>
                        <dd><?=$person['CalorieGoal']?></dd>
                         <dt>Daily calorie burn goal</dt>
                        <dd><?=$person['CalorieBurnGoal']?></dd>
                        <dt>Today's caloric Intake</dt>
                        <dd><?=$total?></dd>
                         <dt>Today's calories burnt</dt>
                        <dd><?=$total2?></dd>
                    </dl>
                </div>
            </div>
      <div class="row">
        <div class="col-md-8 col-xs-10">
            <a href="editf.php" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus"></i>
                New meal
            </a>
            <a href="deleteall.php" class="btn btn-danger">
                <i class="glyphicon glyphicon-trash"></i>
                Delete all
                <span class="badge"><?=count($food)?></span>
            </a>
            <br />
            <table class="table table-condensed table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Time</th>
                  <th>Calories</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($food as $i => $meal): ?>
                <tr>
                  <th scope="row">
                    <div class="btn-group" role="group" aria-label="...">
                      <a href="editf.php?id=<?=$i?>" title="Edit" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                      <a href="delete.php?id=<?=$i?>" title="Delete" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </th>
                  <td><?=$meal['Name']?></td>
                  <td><?=$meal['Time']?></td>
                  <td><?=$meal['Calories']?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>  
          
        </div>

      </div>
       <div class="row">
        <div class="col-md-8 col-xs-10">
            <a href="edite.php" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus"></i>
                New exercise
            </a>
            <a href="deletealle.php" class="btn btn-danger">
                <i class="glyphicon glyphicon-trash"></i>
                Delete all
                <span class="badge"><?=count($ex)?></span>
            </a>
            <br />
            <table class="table table-condensed table-striped table-bordered table-hover" id="displaytable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Time</th>
                  <th>Calories burnt</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($ex as $i => $try): ?>
                <tr>
                  <th scope="row">
                    <div class="btn-group" role="group" aria-label="...">
                      <a href="edite.php?id=<?=$i?>" title="Edit" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                      <a href="delete.php?id=<?=$i?>" title="Delete" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </th>
                  <td><?=$try['Name']?></td>
                  <td><?=$try['Time']?></td>
                  <td><?=$try['Calories']?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>  
          
        </div>

      </div>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
            
    </div>

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
        (function($){
        $(function(){
          
          $("body").css("background-color", "#0099CC");
            $("i").css('color', '0099FF');
      
          
         
        
       
         
         
         
          
          
          
        });
      })(jQuery);
      </script>
  </body>
</html>
