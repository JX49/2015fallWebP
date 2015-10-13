<?php
session_start();
  $ex = $_SESSION['ex'];
  if($_POST){
    if(isset($_GET['id'])){
      $ex[$_GET['id']] = $_POST;
    }else{
      $ex[] = $_POST;
    }
    
    $_SESSION['ex'] = $ex;
    header('Location: ./');
  }
    
  if(isset($_GET['id'])){
    $try = $ex[$_GET['id']];
  }else{
    $try = array();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>exercise: Edit</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

  
  </head>
  <body>
    <div class="container">

        <div class="page-header">
          <h1>Log meals and exercise<small>         Stay healthy with our meal and exercise tracker!</small></h1>
        </div>
         
        <form class="form-horizontal" name="form1" action="" method="post" >
         
          <div class="form-group" id="formname">
            <label for="txtName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtName" name="Name" placeholder="Exercise Name" value="<?=$try['Name']?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="txtCalories">Calories burnt</label>
            <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtCalories" name="Calories" placeholder="Calories"  value="<?=$try['Calories']?>">
            </div>
          </div>
          <div class="form-group" id="formtime">
            <label class="col-sm-2 control-label" for="txtDate">exercise time</label>
            <div class="col-sm-10">
                  <select class="form-control date" id="txtDate" name="Time" placeholder="Date"  value="<?=$try['Time']?>">
              <option value="" selected disabled><?=$meal['Time']?></option>       
              <option value="12:00 am">12:00 am</option>
              <option value="12:30 am">12:30 am</option>
              <option value="1:00 am">1:00 am</option>
              <option value="1:30 am">1:30 am</option>
              <option value="2:00 am">2:00 am</option>
              <option value="2:30 am">2:30 am</option>
              <option value="3:00 am">3:00 am</option>
              <option value="3:30 am">3:30 am</option>
              <option value="4:00 am">4:00 am</option>
              <option value="4:30 am">4:30 am</option>
              <option value="5:00 am">5:00 am</option>
              <option value="5:30 am">5:30 am</option>
              <option value="6:00 am">6:00 am</option>
              <option value="6:30 am">6:30 am</option>
              <option value="7:00 am">7:00 am</option>
              <option value="7:30 am">7:30 am</option>
              <option value="8:00 am">8:00 am</option>
              <option value="8:30 am">8:30 am</option>
              <option value="9:00 am">9:00 am</option>
              <option value="9:30 am">9:30 am</option>
              <option value="10:00 am">10:00 am</option>
              <option value="10:30 am">10:30 am</option>
              <option value="11:00 am">11:00 am</option>
              <option value="11:30 am">11:30 am</option>
              <option value="12:00 am">12:00 am</option>
              <option value="12:30 pm">12:30 am</option>
              <option value="1:00 pm">1:00 pm</option>
              <option value="1:30 pm">1:30 pm</option>
              <option value="2:00 pm">2:00 pm</option>
              <option value="2:30 pm">2:30 pm</option>
              <option value="3:00 pm">3:00 pm</option>
              <option value="3:30 pm">3:30 pm</option>
              <option value="4:00 pm">4:00 pm</option>
              <option value="4:30 pm">4:30 pm</option>
              <option value="5:00 pm">5:00 pm</option>
              <option value="5:30 pm">5:30 pm</option>
              <option value="6:00 pm">6:00 pm</option>
              <option value="6:30 pm">6:30 pm</option>
              <option value="7:00 pm">7:00 pm</option>
              <option value="7:30 pm">7:30 pm</option>
              <option value="8:00 pm">8:00 pm</option>
              <option value="8:30 pm">8:30 pm</option>
              <option value="9:00 pm">9:00 pm</option>
              <option value="9:30 pm">9:30 pm</option>
              <option value="10:00 pm">10:00 pm</option>
              <option value="10:30 pm">10:30 pm</option>
               <option value="11:00 pm">11:00 pm</option>
              <option value="11:30 pm">11:30 pm</option>
           
              
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember me
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary" id="submit">Record</button>
            </div>
          </div>
        </form>
      
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
      (function($){
        $(function(){
          
             $("body").css("background-color", "#0099CC");
            $("#form1").css("color", "#80CCFF");
            $("small").css("color", "black");
          
          

         $("#submit").on('click', function(e){
           var x = document.forms["form1"]["txtName"].value;
           var y = document.forms["form1"]["txtCalories"].value;
           var z = document.forms["form1"]["txtDate"].value;
           
           
           if (x == null || x == "") {
              e.preventDefault();
              toastr.error("Name must be filled out");
         
            return false;
             }
             
             
             
              if (y == null || y == "") {
              e.preventDefault();
            toastr.error("Calories must be filled out");
            return false;
             }else if(isNaN(y)){
                e.preventDefault();
                toastr.error("Callories must be a number!");
                 return false;
             }
             
             
             
             if (z == null || z == "") {
              e.preventDefault();
          toastr.error("Time must be filled out");
               return false;
             }
             
             
             
             
             
             
             

           
         })
          
          
          
        });
      })(jQuery);
    </script>
  </body>
</html>
