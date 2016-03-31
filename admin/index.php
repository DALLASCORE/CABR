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
                        $a=$_GET['action'];
                        monter_delete($link, $_GET['id']);
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
                                    $b=box_clear($link, $id);
                                    header ("Location:index.php?action=boxedit&id=$id ");
                                    }
                       
                        } 
        
                      
     else
        
        include ("../views/info_admin.php"); 
?>



