<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ЦАБР</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    </head>
<body>
    <div class="container">
         <?php $i=1 ?>
        <h3><a href="index.php">Админ Панель</a></h3>
        <h3><a href="../index.php">на сайт</a></h3>
        <div align="right"><?php echo $user['name'];?>  <?php echo $user['secondname']; ?></div>
        <div align="right">IP адрес<?php echo $_SERVER['REMOTE_ADDR']; ?></div>
        <div align="right">Online пользователей <?php echo $login_users; ?></div>
        <div align="right"><a href="../auth/exit.php">Выйти</a></div>
              <form name="search" method="post" action="index.php?action=search">
            <input type="search" name="query" placeholder="Номер шкафа">
                 <input type="search" name="address" placeholder="Улица"><br>
                <button type="submit">Найти</button> 
            <input type="button" onclick="history.back(-1);" value="Назад"/>
                 </form>
        <div>
            <div align="right"><?php echo $date;?></div>
                        <a href="index.php?action=monteradd">Добавить работника</a><br>
                        <a href="index.php?action=monteredit">Изменить данные работника</a><br>
                        <a href="index.php?action=monterdel">Удалить работника</a><br>
                        <a href="index.php?action=boxadd">Добавить шкаф</a><br>
                        <a href="index.php?action=boxedit">Изменить данные шкафа</a><br>
                        <a href="index.php?action=boxdel">Удалить шкаф</a><br>
                        <a href="index.php?action=boxnull">Неназначенные шкафы</a><br>
                        <a href="index.php?action=stats">Статистика посещений</a><br>
                        <a href="index.php?action=useradd">Добавить нового пользователя</a><br>
        </div>
    </div> 
        <footer>
    <p>ЦАБР<br>Copyright
        &copy; 2015</p>
    </footer>
</body>

</html>

  