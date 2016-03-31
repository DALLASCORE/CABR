<?php
 
     require_once ("../databases.php");
     require_once ("../models/cabr.php");
    
    //Стартуем сессии
        session_start();
        header('Content-Type: text/html; charset=utf-8');

// Проверяем, пусты ли переменные логина и id пользователя
   if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
       $a="Здравствуйте !  Авторизуйтесь"; 
        include("auth_form.php");
    }
    else 
        header("Location:../index.php");  
            
    ?> 
