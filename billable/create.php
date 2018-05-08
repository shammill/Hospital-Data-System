<?php
ini_set("display_errors", 1);
error_reporting(-1);

include('../.views/header.php');

/*
if($staff->permissions()->has('CREATE_RESOURCE', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}
*/

require_once('../.class/billable.class.php');

if($_POST){
    $billable = new billable();
    $billable->loadFromPost();
    $billable->save();
    header('Location: /billable/manage.php?billable='.$billable->id());
    die;
}

?>
    <div class="container">
        <h2>Create new billable item</h2>
        <form name="create_billable" method="post">
            <div class="form-group">
                <label for="name">Billable item name</label>
                <input type="text" name="item" id="item" class="form-control">
            </div>
            <div class="form-group">
                <label for="desc">Billable description</label>
                <textarea name="description" id="desc" class="form-control"	></textarea>
            </div>
            <div class="form-group">
                <label for="desc">Billable standard price</label>
                <textarea name="price" id="price" class="form-control"	></textarea>
            </div>
            <div class="form-group">
                <label for="desc">Billable standard tax</label>
                <textarea name="tax" id="tax" class="form-control"	></textarea>
            </div>
            <div class="form-group">
                <label for="desc">Billable medicare price</label>
                <textarea name="medicare_price" id="medicare_price" class="form-control"	></textarea>
            </div>
            <div class="form-group">
                <label for="desc">Billable medicare tax</label>
                <textarea name="medicare_tax" id="medicare_tax" class="form-control"	></textarea>
            </div>
            <input type="submit" value="Create Billable Item" class="btn btn-primary">
        </form>
    </div>
<?PHP include("../.views/footer.php"); ?>