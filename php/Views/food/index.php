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
