<?php
?>
            <a href="?action=create" class="btn btn-success ajax">
                <i class="glyphicon glyphicon-plus"></i>
                New Record
            </a>
            <a href="#" class="btn btn-danger">
                <i class="glyphicon glyphicon-trash"></i>
                Delete All
                <span class="badge"><?=count($model)?></span>
            </a>
            <br />


<div class="modal fade" id="myDialog">
  <div class="modal-dialog">
    <div class="modal-content">
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<table class="table table-striped">
    <thead>
        <tr>
            <th>Actions</th>
            <th>Name</th>
            <th>Time</th>
            <th>Calories</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($model as $row): ?>
            <tr>
                  <th scope="row">
                    <div class="btn-group" role="group" aria-label="...">
                      <a href="" title="View" class="btn btn-default btn-xs ajax"><i class="glyphicon glyphicon-eye-open"></i></a>
                      <a href="?action=edit&id=<?=$row['Food_id']?>" title="Edit" class="btn btn-default btn-xs edit"><i class="glyphicon glyphicon-edit"></i></a>
                      <a href="?action=delete&id=<?=$row['Food_id']?>" title="Delete" class="btn btn-default btn-xs ajax"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </th>
                <td><?=$row['Name']?></td>
                <td><?=$row['Time']?></td>
                 <td><?=$row['Calories']?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.4/handlebars.min.js"></script>
<script type="text/javascript">
     $(function(){
        var editTemplate = Handlebars.compile($("#edit-tpl").html());
        $(".ajax").click(function(){
            $.get(this.href + "&format=plain").then(function(data){
                $("#myDialog .modal-content").html(data);
                $("#myDialog").modal('show');
            });
            return false;
        });
        $(".edit").click(function(){
            var $self = $(this);
            $.getJSON(this.href + "&format=json").then(function(data){
                var html = editTemplate(data);
                var $tr = $self.closest("tr").after(html).hide()
            });
            return false;
        });
    });
</script>
<script type="text/template" id="edit-tpl" >
    <tr>
       <td><input type="text" name="Name" class="form-control" placeholder="Name" value="{{Name}}" /></td>
       <td><input type="text" name="Time" class="form-control" placeholder="Time" value="{{Time}}" /></td>
       <td><input type="text" name="Calories" class="form-control" placeholder="Calories" value="{{Calories}}" /></td>
       <td>
         <input type="submit" value="Submit" class="btn btn-primary"/>
         <input type="hidden" name="Food_id" value="{{Food_id}}" /> 
       </td>
    </tr>
</script>
