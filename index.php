<<<<<<< 83053ec6ff6679d510ec54d45d976f8cde8beaa3
<?php 
    require_once ("databases.php");
    require_once ("session.php");
    require_once ("models/cabr.php");
    
    $link=db_connect();
    $cabr_info=ltu_all($link);
    $date=russian_date();
    $user=session_user($link, $_SESSION['login'], $_SESSION['id']);
    if ($user['role']=='admin') {
        $admin="<a href=admin/index.php>Консоль администратора</a> ";
    }else $admin="";
    $login_users=login_users_count($link);
    include("views/info.php"); 
=======
<?php
$a="Hello World";
print_r($a);
$b="Everybody";
echo $b;
echo "Goodbye";
<<<<<<< c09821038f35f1b23522dbd89a3eb244234c8e18
>>>>>>> a5e30ebc6540c28a517d1a119a003673970842c5
=======
echo "kon";
>>>>>>> 2d6700526895c5b459839766899a4ae9e611954a
?>