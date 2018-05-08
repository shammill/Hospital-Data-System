<?php
ini_set("display_errors", 1);
error_reporting(-1);

include('../.views/header.php');
if($staff->permissions()->has('CREATE_RESOURCE', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}

require_once('../.class/resource.class.php');

$resource = new resource();
$resource->getCurrentResource();

if($_POST){
    $new_resource = new resource();
    $new_resource->loadFromPost();
    $new_resource->save();

    $type = new resource_type($_POST['type']);
    $new_resource->type()->add($type);

    if($resource->id() != 0){
        $new_resource->children()->add($type);
    }
    header('Location: /resources/manage.php?resource='.$new_resource->id());
    die;
}

?>
<div class="container">
<?php
if($resource->id() == 0){
    echo '<h2>Create new resource</h2>';
} else {
    echo '<h2>Create resource for '.$resource->name.'</h2>';
}
?>

<form name="create_resources" method="post">
	<div class="form-group">
		<label for="name">Resource name</label>
		<input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
		<label for="type">Resource type</label>
		<select name="type" id="type" class="form-control">
		   <?php
		   $type = new resource_type();
		   foreach($type->all() as $model){
			  echo "<option value='".$model->id()."'>".$model->name.'</option>';
		   }
		   ?>
		</select>
   </div>
   <div class="form-group">
		<label for="desc">Resource description</label>
		<textarea name="description" id="desc" class="form-control"	></textarea>
    </div>
    <input type="submit" value="Create Resource" class="btn btn-primary">
</form>
</div>
<?PHP include("../.views/footer.php"); ?>