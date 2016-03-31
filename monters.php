<?php 
    require_once ("databases.php");
    require_once ("models/cabr.php");
    require_once ("session.php");
    $link=db_connect();
    $monters=monters_all($link, $_GET['id']);
    include("views/ltumonter.php"); 
?>