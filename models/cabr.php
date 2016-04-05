<?php
function ltu_all($link){
   //Запрос
    $query="SELECT ltu.id, ltunum, firstname, secondname, phone, operator FROM ltu, info_cabr where ltu.id_admin=info_cabr.id ORDER BY ltu.id";
    $result=mysqli_query($link, $query);
    if (!$result) die (mysqli_error($link));
    
    //Извлечение из базы данных
    $n=mysqli_num_rows($result);
    $cabr_info=array();
    
    for ($i=0; $i<$n; $i++){
        $row=mysqli_fetch_assoc($result);
        $cabr_info[]=$row;
    }
    return $cabr_info; 
}
function ltu($link){
   //Запрос
    $query="SELECT * FROM ltu";
    $result=mysqli_query($link, $query);
    if (!$result) die (mysqli_error($link));
    
    //Извлечение из базы данных
    $n=mysqli_num_rows($result);
    $ltu=array();
    
    for ($i=0; $i<$n; $i++){
        $row=mysqli_fetch_assoc($result);
        $ltu[]=$row;
    }
    return $ltu; 
}

function monters_all($link, $id_ltu){
    //Запрос
    $query=sprintf("SELECT info_cabr.id, firstname, secondname, phone from info_cabr where id_ltu=%d ORDER BY info_cabr.firstname",(int)$id_ltu);
    $result=mysqli_query($link, $query);
    if (!$result) die (mysqli_error($link));
    
    //Извлечение из базы данных
    $n=mysqli_num_rows($result);
    $monters=array();
    
    for ($i=0; $i<$n; $i++){
        $row=mysqli_fetch_assoc($result);
        $monters[]=$row;
    } 
    return $monters;
}
function monters($link){
    //Запрос
    $query="SELECT info_cabr.id, firstname, secondname, operator, phone, ltunum FROM info_cabr left join ltu on info_cabr.id_ltu=ltu.id";
    $result=mysqli_query($link, $query);
    if (!$result) die (mysqli_error($link));
    
    //Извлечение из базы данных
    $n=mysqli_num_rows($result);
    $monters=array();
    
    for ($i=0; $i<$n; $i++){
        $row=mysqli_fetch_assoc($result);
        $monters[]=$row;
    } 
    return $monters;
}
function monter_get($link, $id){
   //Запрос
    $query=sprintf("SELECT * FROM `info_cabr` WHERE id=%d",(int)$id);
    $result=mysqli_query($link, $query);
    if (!$result) die (mysqli_error($link));
    
    //Извлечение из базы данных
       
        $row=mysqli_fetch_assoc($result);
        $monter=$row;

    return $monter; 
}

function commbox_getw($link, $id){
    //Запрос
    $query=sprintf("SELECT commbox.id, number, type, address, note, firstname, secondname, ltunum, commbox.id_ltu, commbox.id_monter,  phone FROM `commbox` 
left join `info_cabr` on commbox.id_monter=info_cabr.id 
left join `ltu` on commbox.id_ltu=ltu.id
where commbox.id=%d",(int)$id);
    $result=mysqli_query($link, $query);
    if (!$result) die (mysqli_error($link));
    
    //Извлечение из базы данных
    $n=mysqli_num_rows($result);
    if ($n>0){
    $commbox=array();
    for ($i=0; $i<$n; $i++){
        $row=mysqli_fetch_assoc($result);
        $commbox=$row;
    } 
        
    } else 
        $commbox="За данным специалистом шкафы связи не закреплены";
    
    return $commbox;
}
function commbox_get($link, $id_monter, $id_ltu){
    //Запрос
    $query=sprintf("SELECT commbox.id, name_lost, ltu_lost, number, address, type, note, firstname, phone, ltunum FROM `commbox` 
    left join `info_cabr` on commbox.id_monter=info_cabr.id
    left join `ltu` on commbox.id_ltu=ltu.id 
    WHERE commbox.id_ltu='%d' or commbox.id_monter='%d'", (int)$id_ltu, (int)$id_monter);
    $result=mysqli_query($link, $query);
    if (!$result) die (mysqli_error($link));
    
    //Извлечение из базы данных
    $n=mysqli_num_rows($result);
    if ($n>0){
    $commbox=array();
    for ($i=0; $i<$n; $i++){
        $row=mysqli_fetch_assoc($result);
        $commbox[]=$row;
    } 
        
    } else 
        $commbox="За данным специалистом шкафы связи не закреплены";
    
    return $commbox;
}
function box($link){
    //Запрос
    $query="SELECT commbox.id, number, type, address, note, firstname, secondname, phone, ltunum FROM commbox 
left JOIN ltu on commbox.id_ltu=ltu.id
left JOIN info_cabr on commbox.id_monter=info_cabr.id;";
    $result=mysqli_query($link, $query);
    if (!$result) die (mysqli_error($link));
    
    //Извлечение из базы данных
    $n=mysqli_num_rows($result);
    $box=array();
    
    for ($i=0; $i<$n; $i++){
        $row=mysqli_fetch_assoc($result);
        $box[]=$row;
    } 
    return $box;
}


function search_commbox ($link, $query) {
    
    $query = trim($query); 
    $query = (int)$query;
    $query = mysqli_real_escape_string($link, $query);
    $query = htmlspecialchars($query);
    if($query=="")
        return false;
            
        $q = sprintf("SELECT commbox.id, number, type, address, note, firstname, secondname, phone, ltunum FROM commbox 
JOIN ltu on commbox.id_ltu=ltu.id
JOIN info_cabr on commbox.id_monter=info_cabr.id
where number=%d",$query);
            $result = mysqli_query($link, $q);
            if (!$result) die (mysqli_error($link));
    
            if (mysqli_affected_rows($link) > 0) 
            { 
                $box=array();
                for ($i=0; $i<(mysqli_num_rows($result)); $i++){
                $row=mysqli_fetch_assoc($result);
                $box[]=$row;
            } 
            }else 
                {
                    $t = "SELECT commbox.id, number, type, address, note, firstname, secondname, phone, ltunum FROM commbox 
left JOIN ltu on commbox.id_ltu=ltu.id
left JOIN info_cabr on commbox.id_monter=info_cabr.id
WHERE number LIKE '$query%' ";
                   
                    $result = mysqli_query($link, $t);
                    if (!$result) die (mysqli_error($link));
    
                    if (mysqli_affected_rows($link) > 0) 
                        { 
                        $box=array();
                        for ($i=0; $i<(mysqli_num_rows($result)); $i++){
                        $row=mysqli_fetch_assoc($result);
                        $box[]=$row;
                        }
                    }
                    
                }
    
    return $box;

}
function search_monter ($link, $query) {
    
    $query = trim($query); 
    $query = mysqli_real_escape_string($link, $query);
    $query = htmlspecialchars($query);
    if($query=="")
        return false;
            $q =    "SELECT info_cabr.id, firstname, secondname, phone, ltunum FROM info_cabr 
            left Join ltu on info_cabr.id_ltu=ltu.id WHERE firstname LIKE '$query%' or  secondname LIKE '$query%' ";
            $result = mysqli_query($link, $q);
            if (!$result) die (mysqli_error($link));
    
            if (mysqli_affected_rows($link) > 0) 
            { 
                $monter=array();
                for ($i=0; $i<(mysqli_num_rows($result)); $i++){
                $row=mysqli_fetch_assoc($result);
                $monter[]=$row;
            }
    return $monter;
}
}
function search_address ($link, $query) {
    
    $query = trim($query); 
    $query = mysqli_real_escape_string($link, $query);
    $query = htmlspecialchars($query);
    if($query=="")
        return false;
            $q = "SELECT address, note, type, number, firstname, secondname FROM commbox join info_cabr on commbox.id_monter=info_cabr.id WHERE address LIKE '$query%' ";
            $result = mysqli_query($link, $q);
            $monter=array();
            if (!$result) die (mysqli_error($link));
    
            if (mysqli_affected_rows($link) > 0) 
            { 
                
                for ($i=0; $i<(mysqli_num_rows($result)); $i++){
                $row=mysqli_fetch_assoc($result);
                $monter[]=$row;
            } 
            }
    else   {
                    $t="SELECT address, note, type, number, firstname, secondname FROM commbox join info_cabr on commbox.id_monter=info_cabr.id WHERE address LIKE '%$query%'";
                        $result = mysqli_query($link, $t);
                        if (!$result) die (mysqli_error($link));
                    
                        if (mysqli_affected_rows($link) > 0) { 
               // $monter=array();
                for ($i=0; $i<(mysqli_num_rows($result)); $i++){
                $row=mysqli_fetch_assoc($result);
                $monter[]=$row;
                    }
                          
                    }
           
                } 
  return $monter;
}

function russian_date(){
        $date=explode(".", date("w.d.m.Y"));
        switch ($date[2]){
                case 1: $m='января'; break;
                case 2: $m='февраля'; break;
                case 3: $m='марта'; break;
                case 4: $m='апреля'; break;
                case 5: $m='мая'; break;
                case 6: $m='июня'; break;
                case 7: $m='июля'; break;
                case 8: $m='августа'; break;
                case 9: $m='сентября'; break;
                case 10: $m='октября'; break;
                case 11: $m='ноября'; break;
                case 12: $m='декабря'; break;
        }
        switch ($date[0]){
                case 0: $d='Воскресенье'; break;
                case 1: $d='Понедельник'; break;
                case 2: $d='Вторник'; break;
                case 3: $d='Среда'; break;
                case 4: $d='Четверг'; break;
                case 5: $d='Пятница'; break;
                case 6: $d='Субота'; break;
                
        }        
 
$date="$d <br> $date[1] $m $date[3]";
    return $date;
}


function monter_new($link, $firstname, $secondname, $operator, $phone,  $id_ltu){
    //Подготовка
             $firstname=trim($firstname); //удаляем пробемы 
             $secondname=trim($secondname);
            $id_ltu=(int)$id_ltu;
            
            
    //Проверка
    if($firstname=="")
        return false;
        
    if(!preg_match("/^[^a-яА-Я]+$/", $firstname) or !preg_match("/^[^a-яА-Я]+$/", $secondname)) {
        
             $firstname=mb_strtoupper($firstname); //переводим в верхний регистр
             $secondname=mb_strtoupper($secondname);
        
        
        $q="SELECT * FROM info_cabr where firstname='$firstname' and secondname='$secondname'";
        $res=mysqli_query($link, $q);

        if (mysqli_num_rows($res)==0) {
    //Запрос
                    $t="INSERT INTO info_cabr (firstname, secondname, operator, phone,  id_ltu) values ('%s', '%s', '%s', '%s', '%d')";
                    $query = sprintf ($t, mysqli_real_escape_string($link, $firstname),  mysqli_real_escape_string($link, $secondname),  mysqli_real_escape_string($link, $operator), mysqli_real_escape_string($link, $phone),   $id_ltu);
    
                    $result=mysqli_query($link, $query);
                    if (!$result) die(mysqli_error($link));
                    return $a=true;
        }else $a=false;
    return $a;
    }else $b="Недопустимое значение Имени или Фамилии";
    return $b;
}
function monter_delete($link, $id, $firstname){
        $id=(int)$id;
        $firstname = mysqli_real_escape_string($link, $firstname);
        $q="UPDATE `commbox` SET `id_monter` = '', `name_lost`='$firstname' WHERE `commbox`.`id_monter` = '$id' ";
        $query="DELETE FROM `info_cabr` WHERE id='$id'";
        $result=mysqli_query($link, $q);
        if (!$result) die(mysqli_error($link));
        $result=mysqli_query($link, $query);
        if (!$result) die(mysqli_error($link));
    return true;
}
function monter_edit($link, $id, $firstname, $secondname, $operator, $phone,  $id_ltu){
    
                $firstname=trim($firstname); //удаляем пробемы 
                $secondname=trim($secondname);
                $phone=trim($phone);
                $operator=trim($operator);
                $id_ltu=(int)$id_ltu;
                $id=(int)$id;
    
                if($firstname=="" and $secondname=="")
                return false;
                        
                        $sql="UPDATE `info_cabr` SET firstname='%s', secondname='%s',   operator='%s', phone='%s', id_ltu='%d' where id ='%d'";
                        $query=sprintf($sql,    mysqli_real_escape_string ($link, $firstname), 
                                                mysqli_real_escape_string ($link, $secondname), 
                                                mysqli_real_escape_string ($link, $operator), 
                                                mysqli_real_escape_string ($link, $phone), 
                                                $id_ltu, $id);
                        
                        $result=mysqli_query($link, $query);
                        if (!$result) die (mysqli_error($link));
                        
                        return mysqli_affected_rows($link);
                    
                        }
function box_add($link, $number, $type, $address, $note,  $id_monter, $id_ltu) {
    //Подготовка
    
                $number=trim($number); //удаляем пробемы 
                $number=(int)$number;
                
    //Проверка
    if($number=="")
        return false;
        
    if(is_numeric($number))
       {
            $q="SELECT * FROM commbox WHERE number='$number'";
            $res=mysqli_query($link, $q);

        if(mysqli_num_rows($res)==0){ 
        
                    $id_monter=(int)$id_monter;
                    $id_ltu=(int)$id_ltu;
    //Запрос
                    $t="INSERT INTO commbox (number, type, address, note, id_monter,  id_ltu) values ('%d', '%s', '%s', '%s', '%d', '%d')";
                    $query = sprintf ($t, $number,  mysqli_real_escape_string($link, $type),  mysqli_real_escape_string($link, $address), mysqli_real_escape_string($link, $note), $id_monter,  $id_ltu);
    
                    $result=mysqli_query($link, $query);
                    if (!$result) die(mysqli_error($link));
                    return $a=true;
        }else $a=false;
    return $a;
    }
}
function box_del($link, $id) {
    $id=(int)$id;
        $query="DELETE FROM `commbox` WHERE id='$id'";
        $result=mysqli_query($link, $query);
        if (!$result) die(mysqli_error($link));
    return true;
}
function box_edit($link, $id, $number, $address, $note, $id_monter, $id_ltu){
    
                $number=trim($number);
                $number=(int)$number;//удаляем пробемы 
                $address=trim($address);
                $note=trim($note);
                $id_ltu=(int)$id_ltu;
                $id_monter=(int)$id_monter;
    
                if($number=="")
                return false;
                        
                        $sql="UPDATE `commbox` SET number='%d', address='%s',   note='%s', id_monter='%d', id_ltu='%d' where id ='%d'";
                        $query=sprintf($sql,  $number, 
                                                mysqli_real_escape_string ($link, $address), 
                                                mysqli_real_escape_string ($link, $note), 
                                                $id_monter, $id_ltu, $id);
                        
                        $result=mysqli_query($link, $query);
                        if (!$result) die (mysqli_error($link));
                        
                        return mysqli_affected_rows($link);
                    
}
function box_app($link, $id_commbox, $id_monter, $id_ltu){
    
                $id_commbox=(int)$id_commbox;
                $id_monter=(int)$id_monter;
                $id_ltu=(int)$id_ltu;
                        if (!empty($id_monter)&&!empty($id_ltu))
                        {
                                $query="UPDATE `commbox` SET id_monter='$id_monter', id_ltu='$id_ltu'  where `id` ='$id_commbox'";
                        
                        $result=mysqli_query($link, $query);
                        if (!$result) die (mysqli_error($link));  
                        }else if (empty($id_monter) && !empty($id_ltu))
                        {
                             $query="UPDATE `commbox` SET id_ltu='$id_ltu'  where `id` ='$id_commbox'";
                        
                        $result=mysqli_query($link, $query);
                        if (!$result) die (mysqli_error($link));  
                            
                        }else if (empty($id_ltu)&&!empty($id_monter))
                        {
                             $query="UPDATE `commbox` SET id_monter='$id_monter'  where `id` ='$id_commbox'";
                        
                        $result=mysqli_query($link, $query);
                        if (!$result) die (mysqli_error($link)); 
                        }
                        return mysqli_affected_rows($link);
                                           
}
function box_clear($link, $id, $firstname, $ltu) {
        $firstname = trim($firstname); 
        $firstname = mysqli_real_escape_string($link, $firstname);
        $firstname = htmlspecialchars($firstname);
        $ltu = trim($ltu); 
        $ltu = mysqli_real_escape_string($link, $ltu);
        $ltu = htmlspecialchars($ltu);
        $id=(int)$id;
        $query="UPDATE `commbox` SET `id_monter` = '', `id_ltu`='', `name_lost`='$firstname', `ltu_lost`='$ltu' WHERE `commbox`.`id` = '$id' ";
        $result=mysqli_query($link, $query);
        if (!$result) die(mysqli_error($link));
    return true;
}
       

function valid($link, $login, $password){
    //Запрос
    $query="SELECT * FROM users_valid WHERE login='$login'  and password = md5('$password')";
    $result = mysqli_query($link, $query);
    if (!$result) die (mysqli_error($link));
    
    //Извлечение из базы данных
    $login = mysqli_fetch_array($result);
    return $login;
}
function session_user($link, $login, $id){
    //Запрос
    $query = "SELECT * FROM users_valid WHERE login='$login' and id=$id ";
    $result=mysqli_query($link, $query);
    if (!$result) die (mysqli_error($link));
    
    //Извлечение из базы данных
    $user=mysqli_fetch_assoc($result);
    return $user;
}
function login_users_count($link){
    $query="SELECT * FROM session";
    $result = mysqli_query($link, $query);
    $a=mysqli_num_rows($result);
    return $a;
}
function stats_login($link, $id){
    
        $a="SELECT * FROM stats WHERE date=CURRENT_DATE() and id_users_valid ='".$_SESSION[id]."'";
        $b=mysqli_query($link, $a);
        if (mysqli_num_rows($b)==0) {
            mysqli_query($link, "INSERT INTO stats (id_users_valid, date, login,hits) VALUES('".$_SESSION[id]."', CURDATE(), '1', '1')");         
        }else {
            mysqli_query($link, "UPDATE stats SET login=login+1 WHERE date=CURDATE() and id_users_valid='".$_SESSION[id]."';");
        }
}
function stats_hits($link, $id){
            $a="SELECT * FROM stats WHERE date=CURRENT_DATE() and id_users_valid ='".$_SESSION['id']."'";
            $b=mysqli_query($link, $a);
                if (mysqli_num_rows($b)>0) 
                {
                mysqli_query($link, "UPDATE stats SET hits=hits+1 WHERE date=CURDATE() and id_users_valid='".$_SESSION['id']."';");        
            }      
    else 
                mysqli_query($link, "INSERT INTO stats (id_users_valid, date, login,hits) VALUES('".$_SESSION['id']."', CURDATE(), '1', '1')"); 
}
function create_session_user ($link, $login, $id, $role, $sid) {
        $_SESSION['login']=$login; 
        $_SESSION['id']=$id;
        $_SESSION['role']=$role;
        mysqli_query($link, "UPDATE users_valid SET sid='$sid' WHERE `id`='$id'");
        mysqli_query($link, "UPDATE users_valid SET ip='".$_SERVER['REMOTE_ADDR']."' WHERE `id`='$id';");
        mysqli_query($link, "INSERT INTO session VALUES('$sid', NOW(), '$login', '".$_SERVER['REMOTE_ADDR']."')");
}
function online_users ($link, $sid, $login) {
    
        $query = "SELECT * FROM session WHERE id_session = '$sid'";
        $ses = mysqli_query($link, $query);
        if(!$ses) exit("<p>Ошибка в запросе к таблице сессий</p>"); 
        if(mysqli_num_rows($ses)>0) 
            { 
            $query = "UPDATE session SET putdate = NOW(), user = '$login'  WHERE id_session = '$sid'"; 
            mysqli_query($link, $query); 
            } 
            $query = "DELETE FROM session WHERE putdate < NOW() -  INTERVAL '15' MINUTE"; 
            mysqli_query($link, $query); 
}
?>