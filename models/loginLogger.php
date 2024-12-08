<?php

$user=currentUser()->user_id."____".currentUser()->username;

$message=$user."____".date("d. m. Y H:i:s")."\n";

$file=fopen("data/login.txt","a");

fwrite($file, $message);

fclose($file);