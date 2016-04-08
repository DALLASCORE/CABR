<?php 
   error_reporting(0);

    session_start();
    require_once ("../databases.php");
    require_once ("../models/cabr.php");
    
    if (empty($_SESSION['login']) or empty($_SESSION['id']) or empty($_SESSION['role'])) {
        if ($_SESSION['role']!=admin){
        header("Location:../auth/index.php");
        }
    }
    $link=db_connect();
    $cabr_info=ltu_all($link);
    $date=russian_date();
    $user=session_user($link, $_SESSION['login'], $_SESSION['id']);
    $login_users=login_users_count($link);
    
    
    if(isset($_GET['action']))
        $action=$_GET['action'];
    else
        $action="";

    
        if($action=="monteradd") 
            {
         
        
        if(!empty($_POST))
        {
            $a=monter_new($link, $_POST['firstname'], $_POST['secondname'], $_POST['operator'], $_POST['phone'], $_POST['id_ltu']);
                if ($a==false) {
                echo "работник уже есть в БД/n";
                            }
                            else header("Location: index.php");
        }   
            $ltu=ltu($link); 
            include("../views/monter_admin.php");   
        
    }

        else if ($action=="monterdel") 
            {
            
            $monters=monters($link);
            include("../views/ltumonter.php");
                
                if (isset($_GET['id'])) 
                    {
                        $monter=monter_get($link, $_GET['id']);
                        $a=$_GET['action'];
                        monter_delete($link, $_GET['id'], $monter['firstname']);
                        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]?action=$a'>");
                        
                    }
                
            }
        
        else if ($action=="monteredit") 
            {
                    
                    if (!isset($_GET['id']) or empty($_GET['id'])) 
                        {
                        $monters=monters($link);
                        include("../views/ltumonter.php");
                        }
                            else 
                            {
                                $id=(int)$_GET['id'];
                                if(!empty($_POST) && $id>0)
                                    {
                            monter_edit($link, $id, $_POST['firstname'], $_POST['secondname'], $_POST['operator'], $_POST['phone'], $_POST['id_ltu']);
                                    header ("Location:index.php?action=monteredit");
                                    }else {
                
                            $ltu=ltu($link); 
                            $monter=monter_get($link, $id);
                            include("../views/monter_admin.php");    
                                }
                       
                        } 
        }

        else if ($action=="boxshow") 
            {
                if (isset($_GET['id'])) 
                    {
                            $commbox=commbox_getw($link, $_GET['id']);
                            if (isset($commbox)) 
                                    {
                                            include("../views/commbox.php");
                                    } else 
                                            include("../views/nobox.php"); 
                }
            
    }
        
        else if ($action=="boxmontershow")     
            {
                $commbox=commbox_get($link, $_GET['id']);
            if (gettype($commbox)=="array") 
                {
                        include("../views/commbox.php"); 
                } else 
        include("../views/nobox.php"); 
            
    }
    
        else if ($action=="boxadd") 
            {
                           if(!empty($_POST))
                           {
                    $a=box_add($link, $_POST['number'], $_POST['type'], $_POST['address'], $_POST['note'], $_POST['id_monter'], $_POST['id_ltu']);
                    if ($a==false) {
                    echo "Шкаф уже есть в БД/n";
                   }
                    else header("Location: index.php");
            }   
                    $monters=monters($link);
                    $ltu=ltu($link); 
                    include("views/box_admin.php");   
    }
        
        else if ($action=="boxapp") 
            {
                        $a=(int)$_GET['id'];
                        $id_box=$_POST['id_box'];
                        if (!empty($id_box)) {
                            
                            if (isset($_POST['id_monter']) and !empty($_POST['id_monter']))
                                {
                                    $n=count($id_box);
                                    for ($i=0; $i<$n; $i++)
                                        {
                                            box_app($link, $id_box[$i], $_POST['id_monter'], $_POST['id_ltu']); 
                                        }
                                }
                                    else if (isset($_POST['id_ltu']) and !empty($_POST['id_ltu']))
                                    {
                                    $n=count($id_box);
                                    for ($i=0; $i<$n; $i++)
                                        {
                                            box_app($link, $id_box[$i], $_POST['id_monter'], $_POST['id_ltu']); 
                                        }
                                    } else if (isset($a) && !empty($a)) 
                                    {
                                        $n=count($id_box);
                                                for ($i=0; $i<$n; $i++)
                                                    {
                                                        box_app($link, $id_box[$i], $a, $_POST['id_ltu']); 
                                                    } 
                                    }else  header ("Location:index.php?action=boxnull"); 
                            
                            header ("Location:index.php?action=boxnull"); 
                            
                        } else       
                { 
                        $id=0;
                        $id_ltu=0;
                        $box=commbox_get($link, $id, $id_ltu);
                        $monters=monters($link);
                        $ltu=ltu($link); 
                        include("../views/output_commbox.php");
                    }
        }
        
        else if ($action=="boxdel") 
            {
            $box=box($link);
            include("../views/output_commbox.php");
                
                if (isset($_GET['id'])) 
                    {
                        $a=$_GET['action'];
                        box_del($link, $_GET['id']);
                        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]?action=$a'>");
                    }
                
            }
        
        else if ($action=="boxnull") 
            { 
                        $id=0;
                        $id_ltu=0;
                        $a=$_GET['action'];
                        $box=commbox_get($link, $id, $id_ltu);
                        $ltu=ltu($link);
                        $monters=monters($link);
                        include("../views/output_commbox.php");
                    }
        
        else if ($action=="boxedit") 
            {
                    
                    if (!isset($_GET['id']) or empty($_GET['id'])) 
                        {
                        $box=box($link);
                        include("../views/output_commbox.php");
                        }
                            else 
                            {
                                
                                $id=(int)$_GET['id'];
                                $box=commbox_getw($link, $id);
                                if(!empty($_POST) && $id>0) 
                                {
                                    if (empty($_POST['id_monter'])) { 
                                        $_POST['id_monter']=$box['id_monter'];
                                    }
                                    if (empty($_POST['id_ltu'])) 
                                        $_POST['id_ltu']=$box['id_ltu'];
                                                                     
                                    $b=box_edit($link, $id, $_POST['number'], $_POST['address'], $_POST['note'], $_POST['id_monter'], $_POST['id_ltu']);
                                    header ("Location:index.php?action=boxedit&id=$id ");
                                    }else {
                
                    $monters=monters($link);
                    $ltu=ltu($link); 
                    $box=commbox_getw($link, $_GET['id']);
                    include("views/box_admin.php");  
                                }
                       
                        } 
        }

        else if ($action=="boxclear") 
            {
                    
                    if (!isset($_GET['id']) or empty($_GET['id'])) 
                        {
                            $monters=monters($link);
                            $ltu=ltu($link); 
                            include("views/box_admin.php");   
                        }
                            else 
                            {
                                
                                    $id=(int)$_GET['id']; 
                                    $firstname=$_GET['name'];
                                    $ltu=$_GET['ltu'];
                                    $b=box_clear($link, $id, $firstname, $ltu);
                                    header ("Location:index.php?action=boxedit&id=$id ");
                                    }
                       
                        } 

        else if ($action=="search") 
        {
            $query=trim($_POST['query']);
            $address=trim($_POST['address']);
            
            if ($query==""){
        
                if($address==""){
                    header("Location: index.php");  
        }           else if($monter=search_address($link, $address)) {
                    include("../views/output_address.php");
                        }
            else 
            {
            $commbox="По вашему запросу нечего не найдено.<br>Убедитесь в правильности вводимых данных";
            include("../views/nobox.php");
            }  
            }else if(ctype_space($query)){
                $commbox="Пустой запрос";
                    include("views/nobox.php");  
            }else if (!is_numeric($query)){
                if($monter=search_monter ($link, $query)) {
                    include("../views/output_monter.php");
            }else {
            $commbox="По вашему запросу нечего не найдено.<br>Убедитесь в правильности вводимых данных";
            include("../views/nobox.php");
            }
    }           else if($box=search_commbox($link, $query)){
                include("../views/output_commbox.php"); 
        }else {
            $commbox="По вашему запросу нечего не найдено.<br>Убедитесь в правильности вводимых данных";
            include("../views/nobox.php");
        }
            }
        
        else if ($action=="select") 
        {
            switch ($_POST['post']){
                
            case "showMonterForInsert":
                echo '<label>Монтер<br>';
                echo '<select size="1" class="form-item" name="id_monter">';
                $rows = monters_all($link, $_POST['id_ltu']);
                foreach ($rows as $numRow => $row) 
                    {
                        echo ('<option value="'.$row['id'].'">'.$row['firstname'].'  '.$row['secondname'].'</option>');
                    };
                echo '</select></label><br>';
                break;
                
       
        
};

        }
     else
        
        include ("../views/info_admin.php"); 
?>



