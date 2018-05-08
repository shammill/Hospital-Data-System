<?php

class render{

    //Render a table from a model data source
    public static function table($models, $columns=array()){
        echo '<table class="table table-striped">';
        echo '<tr style="font-weight: bold">';
        foreach($columns as $column_name => $value){
            echo '<td>'.$column_name.'</td>';
        }
        echo '</tr>';
        foreach($models as $model){
            echo '<tr>';
            foreach($columns as $column_name => $value){
                if(is_callable($value)){
                    $replaced = $value($model);
                } else {
                    $replaced = preg_replace_callback("/%\w*%/", function($m) use ($model){
                        $m = $m[0];
                        $m = substr($m, 1, strlen($m) - 2);
                        if(method_exists($model, $m)){
                            return $model->$m();
                        } else {
                            return $model->$m;
                        }
                    }, $value);
                }
                echo '<td>'.$replaced.'</td>';
            }
            echo '</tr>';
        }

        echo '</table>';
    }

}
