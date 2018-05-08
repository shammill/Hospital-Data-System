<?php

require_once('../.class/billable.class.php');
require_once('../.class/render.class.php');

$billable = new billable();
$billable->getCurrentBillableItem();

include('../.views/header.php');
/*
if($staff->permissions()->has('UPDATE_BILLABLE', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this billable.';
    echo '</center></div>';
    die;
}
*/
?>
<div class="container">
<?php
if($billable->id() == 0){
    die("<p class='label label-danger'><span class='glyphicon glyphicon-remove'></span>Billable item does not exist.</p><br/>");
}
echo '<h2>Managing '.$billable->item.'</h2>';
if($_POST){
    $billable->loadFromPost();
    $billable->save();
    echo "<p class='label label-success'><span class='glyphicon glyphicon-ok'></span>Billable item saved!</p><br/>";
}
?>
    <form name="update_billable" method="post" role="form">
        <div class="form-group">
            <label for="name">Billable item name</label>
            <input type="text" name="item" id="item" value="<?=$billable->item?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="desc">Billable description</label>
            <textarea name="description" id="desc" class="form-control"	><?=$billable->description?></textarea>
        </div>
        <div class="form-group">
            <label for="desc">Billable standard price</label>
            <textarea name="price" id="price" class="form-control"	><?=$billable->price?></textarea>
        </div>
        <div class="form-group">
            <label for="desc">Billable standard tax</label>
            <textarea name="tax" id="tax" class="form-control"	><?=$billable->tax?></textarea>
        </div>
        <div class="form-group">
            <label for="desc">Billable medicare price</label>
            <textarea name="medicare_price" id="medicare_price" class="form-control"	><?=$billable->medicare_price?></textarea>
        </div>
        <div class="form-group">
            <label for="desc">Billable medicare tax</label>
            <textarea name="medicare_tax" id="medicare_tax" class="form-control"	><?=$billable->medicare_tax?></textarea>
        </div>
        <input type="submit" value="Update billable item" class="btn btn-default">
    </form>

<?PHP include("../.views/footer.php"); ?>