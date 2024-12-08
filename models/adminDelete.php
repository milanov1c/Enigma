<?php

include "adminFunctions.php";

$table=$_GET['table'];

$id=$_GET['id'];

if(!empty($table) && !empty($id)){
    include "../config/conn.php";

    adminDelete($table, $id);

    header("Location: ../index.php?page=admin");
}