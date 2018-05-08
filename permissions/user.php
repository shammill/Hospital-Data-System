<?php

    require_once('../.class/staff.class.php');
    require_once('../.class/acl.class.php');
    include('../.views/header.php');

    if($staff->permissions()->has('MANAGE_PERMISSIONS_TO_ROLE', 'name')==false){
        echo '<div class="alert alert-danger"><center>';
        echo 'Sorry, you do not have permission to access this resource.';
        echo '</center></div>';
        die;
    }

    if($staff->permissions()->has('MANAGE_PERMISSIONS_TO_STAFF', 'name')==false){
        echo '<div class="alert alert-danger"><center>';
        echo 'Sorry, you do not have permission to access this resource.';
        echo '</center></div>';
        die;
    }

    if(isset($_POST['update_permissions'])){
        $staff->permissions()->removeAll();
        foreach($_POST['permissions'] as $posted){
            $permission_model = new permission($posted);
            $staff->permissions()->add($permission_model);
        }
    }else if(isset($_POST['update_role'])){
        $new_role = new role($_POST['role_type']);
        $staff->changeRole($new_role);
    }

    echo '<div class="container-fluid" id="patient-page">';
    echo '<div class="form-group">';
    echo '<h1>Current User</h1>';
    $role_id = $staff->role()->get()->id();
    echo '<form method="post">';
    echo '<div class="row">';
    echo '<div class="col-md-4">';
    echo '<select name="role_type" class="form-control">';
    $roles = new role();
    foreach($roles->all() as $role){
        echo '<option value="'.$role->id().'" '.($role_id == $role->id() ? 'selected' : '').'>'.$role->role_name.'</option>';
    }
    echo '</select>';
    echo '</div>';
    echo '<div class="col-md-4 col-md-offset-4">';
    echo '<input type="submit" name="update_role" value="Update Role" class="btn btn-primary">';
    echo '</div></div>';
    echo '</form>';

    echo '<h3>Granted</h3>';
    foreach($staff->permissions()->get() as $permission){
        echo $permission->name.': '.($permission->description == '' ? 'No Description' : $permission->description).'<br>';
    }

    echo '<h3>Complete</h3>';
    $permission_list = new permission();
    echo '<form name="permission" method="post">';
    echo '<table class="table table-condensed table-striped">';
    foreach($permission_list->all() as $permission){
        $granted = $staff->permissions()->has($permission->id());
        echo '<tr>';
        echo '<td>'.$permission->id().'</td>';
        echo '<td>'.$permission->name.'</td>';
        echo '<td><input type="checkbox" name="permissions[]" value="'.$permission->id().'" '.($granted ? 'checked' : '').'> '.($granted ? 'Granted' : 'Not Granted').'</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<input type="submit" value="Update permissions" name="update_permissions" class="btn btn-primary">';
    echo '</form>';
    echo '</div></div>';

    //Checking a permsision
    //echo $staff->permissions()->has('ACCESS_ALL', 'name') ? 'You can access all.' : 'You cannot access everything.';

?>


<br/>