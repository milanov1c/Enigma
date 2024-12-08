<?php
session_start();
include "functions.php";

if(isset($_SESSION['user'])){
    include "logoutLogger.php";
    unset($_SESSION['user']);
    header("Location: ../index.php?page=home");
}