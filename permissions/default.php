<?php

    require_once('../.class/staff.class.php');
    require_once('../.class/acl.class.php');
    require_once('../.class/render.class.php');
    include('../.views/header.php');

    if($staff->permissions()->has('MANAGE_PERMISSIONS_TO_ROLE', 'name')==false){
        echo '<div class="alert alert-danger"><center>';
        echo 'Sorry, you do not have permission to access this resource.';
        echo '</center></div>';
        die;
    }

    $roles = new role();
    $roles = $roles->all();
    $permissions = new permission;
    $permissions = $permissions->all();

    if($_POST){
        foreach($roles as $role){
            $role->permissions()->removeAll();
            if(isset($_POST['role_'.$role->id()])){
                foreach($_POST['role_'.$role->id()] as $perm){
                    $new = new permission($perm);
                    $role->permissions()->add($new);
                }
            }
        }
        echo 'Updated default permissions succesfully! <b>Note: That this doesn"t affect previously created users permissions!</b>';
    }
    
    if(count($roles) == 0){
        echo 'There are currently no roles.';
    } else {
        echo '<form name="update_default_permissions" method="post">';
    
    echo '<div class="container-fluid" id="patient-page">';
    echo '<h2>Default Role Permissions</h2>';
    echo '<div class="panel-group" id="accordion">';
    
        $div_counter = 0;
        
        foreach($roles as $role){
            $div_counter = $div_counter + 1;
            
    echo '<div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$div_counter.'">';
          
            echo $role->role_name.' <span class="pull-right">'.$role->id().'</span>';
          
        echo '</a>
      </h4>
    </div>
    <div id="collapse'.$div_counter.'" class="panel-collapse collapse">
      <div class="panel-body">';
        
            echo '<table class="table table-condensed table-striped">';
            foreach($permissions as $permission){
                $granted = $role->permissions()->has($permission->id());
                echo '<tr>';
                echo '<td>'.$permission->id().'</td>';
                echo '<td>'.$permission->name.'</td>';
                echo '<td><input type="checkbox" name="role_'.$role->id().'[]" value="'.$permission->id().'" '.($granted ? 'checked' : '').'> '.($granted ? 'Granted' : 'Not Granted').'</td>';
                echo '</tr>';
            }
            echo '</table>';
            
      echo '</div>';
      echo '</div></div>';
      }
    echo '</div>';
    }
  
    echo '<input type="submit" value="Update default permissions" class="btn btn-default">';
    echo '</form>';
    echo '</div></div>';
    include("../.views/footer.php");
?>