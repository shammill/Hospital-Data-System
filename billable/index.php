<?php

require_once('../.class/billable.class.php');
require_once('../.class/render.class.php');
include("../.views/header.php");

/*
if($staff->permissions()->has('VIEW_ITEMS', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}
*/

$billable = new billable();
//Get all resources that arent in the children table
$billables = $billable->all();

?>
<div class="container">
    <h2>Billables</h2>
    <a href="create.php" class="btn btn-default">Click to create a new billable item</a><br/><br/>

    <?php
    if(count($billables) == 0){
        echo 'You have no billable items.';
    } else {
        render::table($billables,
            array(
                'ID' => '%id%',
                'Item' => '%item%',
                'Adminstrative' => '<a href="manage.php?billable=%id%">Edit Item</a>'
            )
        );
    }

    ?>
</div>
<?PHP include("../.views/footer.php"); ?>
