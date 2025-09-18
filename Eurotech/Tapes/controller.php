<?php 
    include "model.php";

    $model = new model();
    $model->cn();
    $logs = [];
    $Renewlogs = [];
    
    if (isset($_POST["txtsearch"])){
        $txtsearch = $_POST["txtsearch"];
    }    
    else {
        $txtsearch ="";
    }
    

    $logs = $model->search();

    include 'view.php';
?>