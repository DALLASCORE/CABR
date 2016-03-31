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
        <h3><a href="index.php">Линейно-абонентский участок (ЛАУ)</a></h3>
        <div align="right"><?php echo $user['name'];?>  <?php echo $user['secondname']; ?></div>
        <div align="right">IP адрес<?php echo $_SERVER['REMOTE_ADDR']; ?></div>
        <div align="right">Online пользователей <?php echo $login_users; ?></div>
        <div align="right"><?php echo $admin; ?></div>
        <div align="right"><a href="auth/exit.php">Выйти</a></div>
            <form name="search" method="post" action="search.php">
            <input type="search" name="query" placeholder="Номер шкафа">
                 <input type="search" name="address" placeholder="Улица"><br>
                <button type="submit">Найти</button> 
            <input type="button" onclick="history.back(-1);" value="Назад"/>
                 </form>
        <div>
            <div align="right"><?php echo $date;?></div>
                    
            <table border="1" width="100%" cellpadding="5">
                <div class="art">
                 <tr>
                        <th>№</th>   
                        <th>Участок</th>
                        <th>Руководитель</th>  
                        <th>Телефон</th>
                        <th>Оператор</th>
                        
                </tr>
                <tr>
            <?php foreach($cabr_info as $a): ?>
                    
                    <td><?php  
                        if ($i) {
                            echo $i; 
                            $i++;
                        };
                        ?></td>
                    <td><a href="monters.php?id=<?=$a['id']?>"><?=$a['ltunum']?></a></td>
                    <td><?=$a['firstname']?> <?=$a['secondname']?></td>
                    <td><?=$a['phone']?></td>
                    <td><?=$a['operator']?></td>
                </tr>
                    <?php endforeach ?> 
                </div>
            </table>
        </div>
    </div> 
        <footer>
    <p>ЦАБР<br>Copyright
        &copy; 2015</p>
    </footer>
</body>

</html>
    