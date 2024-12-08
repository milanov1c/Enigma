<?php

$user=currentUser()->user_id."_____".currentUser()->username;

$message=$user."____".date("d. m. Y H:i:s")."\n";

$file=fopen("../data/logout.txt","a");

fwrite($file, $message);

fclose($file);