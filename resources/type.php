<?php

require_once('../.class/resource.class.php');
require_once('../.class/render.class.php');

include('../.views/header.php');

if(isset($_GET['type'])==false){
    die('Sorry we could not find that resource type.');
}
$type = new resource_type($_GET['type']);
?>
<div class="container">
<h2><?php echo $type->name ?></h2>
<a href="create.php" class="btn btn-default">Click to create a new resource</a><br/><br/>

<?php
$resources = $type->resources()->get();
if(count($resources) == 0){
    echo 'There is no resources with this type.';
} else {
    render::table($resources,
        array(
            'Resource ID' => '%id%',
            'Name' => '%name%',
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
