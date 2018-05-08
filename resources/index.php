<?php

include('../.views/header.php');
require_once('../.class/resource.class.php');
require_once('../.class/render.class.php');

$resource = new resource();
//Get all resources that arent in the children table
$resources = $resource->allParents();
?>
<div class="container">
<h2>Resources</h2>
<a href="create.php" class="btn btn-default">Click to create a new resource</a><br/><br/>

<?php
if(count($resources) == 0){
    echo 'You have no resources.';
} else {
    render::table($resources,
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
</div>
<?PHP include("../.views/footer.php"); ?>
