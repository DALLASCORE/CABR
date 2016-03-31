<?php
    //Стартуем сессии
 session_start();
 require_once ("databases.php");
 require_once ("models/cabr.php");
 header('Content-Type: text/html; charset=utf-8');

// Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {  
        header("Location:auth/index.php");  
    }else 
        $link=db_connect();
        $id_session = session_id();
        online_users($link, $id_session, $_SESSION['login']);
        stats_hits($link, $_SESSION['id']);  
?>