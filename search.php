<?php 
    require_once ("databases.php");
    require_once ("models/cabr.php");
    require_once ("session.php");
    
    $link=db_connect();
    $query=trim($_POST['query']);
    $address=trim($_POST['address']);
    if ($query==""){
        
        if($address==""){
            header("Location: index.php");  
        }else if($monter=search_address($link, $address)) {
            include("views/output_address.php");
        }
    else 
    {
        $commbox="По вашему запросу нечего не найдено.<br>Убедитесь в правильности вводимых данных";
        include("views/nobox.php");
        }  
    }else if(ctype_space($query)){
        $commbox="Пустой запрос";
        include("views/nobox.php");  
    }else if (!is_numeric($query)){
        if($monter=search_monter ($link, $query)) {
            include("views/output_monter.php");
        }else {
        $commbox="По вашему запросу нечего не найдено.<br>Убедитесь в правильности вводимых данных";
        include("views/nobox.php");
        }
    }   else if($box=search_commbox($link, $query)){
        include("views/output_commbox.php"); 
    }else {
        $commbox="По вашему запросу нечего не найдено.<br>Убедитесь в правильности вводимых данных";
        include("views/nobox.php");
    }
    
?>

