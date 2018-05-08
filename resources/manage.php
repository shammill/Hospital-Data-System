<?php

require_once('../.class/resource.class.php');
require_once('../.class/render.class.php');

$resource = new resource();
$resource->getCurrentResource();

include('../.views/header.php');
if($staff->permissions()->has('UPDATE_RESOURCE', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}
?>
<div class="container">
<?php
if($resource->id() == 0){
    die("<p class='label label-danger'><span class='glyphicon glyphicon-remove'></span>Resource does not exist.</p><br/>");
}
echo '<h2>Managing '.$resource->name.'</h2>';
if($_POST){
    $resource->loadFromPost();
    $resource->save();
    $type = new resource_type($_POST['type']);
    $resource->type()->add($type);
    echo "<p class='label label-success'><span class='glyphicon glyphicon-ok'></span>Resource saved!</p><br/>";
}
?>
<div class="btn-group">
	<a class="btn btn-default" href="book.php?resource=<?=$resource->id()?>">View bookings for <?=$resource->name?></a>
	<a class="btn btn-default" href="create.php?resource=<?=$resource->id()?>">Create child resource for <?=$resource->name?></a>
</div>
<form name="update_resource" method="post" role="form">
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="form-control" placeholder="<?=$resource->name?>">
	</div>
	<div class="form-group">
		<label for="type">Resource type</label>
		<select name="type" id="type" class="form-control">
			<?php
			$type = new resource_type();
			$current = $resource->type()->get()->id();
			foreach($type->all() as $model){
				echo "<option value='".$model->id()."' ".($model->id() == $current ? 'selected' : '').">".$model->name.'</option>';
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="desc">Resource description:</label>
		<textarea name="description" class="form-control" id="desc"><?=$resource->description?></textarea>
	</div>
	<input type="submit" value="Update Resource" class="btn btn-default">
</form>

<?php
$children = $resource->children()->get();
if(count($children) == 0){
    echo '<p class="label label-warning">This resource does not have any child resources.</p>';
}else{
    echo '<h2>Child Resources</h2>';
    render::table($children,
        array(
            'ID' => '%id%',
            'Name' => '%name%',
            'Type' => function($model){
                    $type = $model->type()->get();
                    return '<a href="type.php?type='.$type->id().'">'.$type->name.'</a>';
                },
            'Schedule' => function($model){
                    if($model->children()->count() == 0){
                        return '<a href="book.php?resource='.$model->id().'">View or place a booking for this resource</a>';
                    } else {
                        return '<a href="book.php?resource='.$model->id().'">View bookings for this resource</a>';
                    }
                },
            'Adminstrative' => '<a href="manage.php?resource=%id%">Edit Resource</a>'
        )
    );
}

?>
<?PHP include("../.views/footer.php"); ?>