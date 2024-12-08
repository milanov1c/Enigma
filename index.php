<?php
session_start();

ob_start();

include "models/functions.php";

include "config/conn.php";

include "views/fixed/head.php";

include "views/fixed/nav.php";

include "models/visitLogger.php";

include "vendor/autoload.php";


var_dump(md5("Adminiki1+"));

var_dump(md5("Adminiki1+")=="b32f177c0c0b07100aedc118c5f3531e");

var_dump(md5("admin"));
$page=get("page");

if(!$page) {
    require_once("views/pages/home.php");
} else {
    $page = strtolower($page);

    if(!file_exists("views/pages/" . $page . ".php")) {
        require_once("views/pages/404.php");
    } else {
        require_once("views/pages/$page.php");
    }
}


require_once "views/fixed/footer.php";