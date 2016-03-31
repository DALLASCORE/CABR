<?php
require_once ("../databases.php");
session_start();
$id_session = session_id(); 
$link=db_connect();
$query = "DELETE FROM session WHERE id_session = '$id_session'"; 
mysqli_query($link, $query); 
unset($_SESSION['id']);
session_destroy();
header("Location:index.php"); 
?>