<?php
    require_once("databases.php");
    require_once("models/cabr.php");
    require_once ("session.php");

    $link=db_connect();

    $commbox=commbox_get($link, $_GET['id']);
    if (gettype($commbox)=="array") 
    {
        include("views/commbox.php"); 
    } else 
        include("views/nobox.php"); 
   

?>