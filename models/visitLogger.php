<?php
if(isset($_SESSION['user'])){

    $user=currentUser()->user_id."_____".currentUser()->username;

}else{
    $user="unauthorized____user";
}
$pageUrl=$_SERVER['REQUEST_URI'];

$ipAddress=$_SERVER['REMOTE_ADDR'];

$message=$user."____".$pageUrl."____".$ipAddress."____".date("d. m. Y H:i:s")."\n";

$file=fopen("data/visit.txt","a");

fwrite($file, $message);

fclose($file);