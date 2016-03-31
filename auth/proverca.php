<?php

        require_once ("../databases.php");
        require_once ("../models/cabr.php");
        header('Content-Type: text/html; charset=utf-8');

        session_start();//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    
    if (isset($_POST['login'])) 
        { 
            $login = $_POST['login']; 
                if ($login == '') 
                    { 
                    unset($login);
                    } 
        } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную

    if (isset($_POST['password'])) 
        { 
            $password=$_POST['password']; 
                if ($password =='') 
                    { 
                    unset($password);
                } 
        }

    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
    if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
        {
        header ("Location:index.php");
        }

    //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    
    //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
	
     //Подключаемся к базе данных.
    $link=db_connect();

    //извлекаем из базы все данные о пользователе с введенным логином
    $login_valid=valid($link, $login, $password);
    
    if (!empty($login_valid))
    {
        $sid=session_id();
        create_session_user ($link, $login_valid["login"], $login_valid["id"], $login_valid["role"], $sid);
        stats_login($link, $_SESSION['id']);
        header("Location:index.php"); 
    }

    ?>