<form method="post" action="?action=save">
 <?php include __DIR__ . '/../shared/_Errors.php'; ?>
<table class="table">
    <tr>
       <td><input type="text" name="Name" class="form-control" placeholder="Name" value="<?=$model['Name']?>" /></td>
       <td><input type="text" name="Time" class="form-control" placeholder="Time" value="<?=$model['Time']?>" /></td>
       <td><input type="text" name="Calories_burned" class="form-control" placeholder="Calories_burned" value="<?=$model['Calories_burned']?>" /></td>
       <td>
         <input type="submit" value="submit" class="btn btn-primary"/>
         <input type="hidden" name="Exercise_id" value="<?=$model['Exercise_id']?>" /> 
       </td>
    </tr>
</table>
</form>   
