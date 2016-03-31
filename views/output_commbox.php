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
        <h1><a href="index.php">ЦАБР</a></h1>
        <a href="admin">Панель администратора</a>
              <form name="search" method="post" action="search.php">
            <input type="search" name="query" placeholder="Номер шкафа">
                 <input type="search" name="address" placeholder="Улица"><br>
                <button type="submit">Найти</button> 
            <input type="button" onclick="history.back(-1);" value="Назад"/>
                 </form>
        <div>
            <table border="1" width="100%" cellpadding="5">
                <div class="art">
                 <tr>
                        <th>Шкаф</th>   
                        <th>Участок</th>
                        <th>Тип</th>
                        <th>Адресс</th>
                        <th>Примечание</th>
                        <th>Монтер</th>
                        <th>телефон</th>
                        <th>Был</th>
                        <th>удалить</th>
                        <th>Редактировать</th>
                        
                </tr>
                <tr>
            <?php foreach($box as $a): ?>
                    <td><?=$a['number']?></td>
                    <td><?=$a['ltunum']?></td>
                    <td><?=$a['type']?></td>
                    <td><?=$a['address']?></td>
                    <td><?=$a['note']?></td>
                    <td><?=$a['firstname']?>  <?=$a['secondname']?></td>
                    <td><?=$a['phone'] ?></td>
                    <td><?=$a['name_lost'] ?></td>
                    <td><a href="index.php?action=boxdel&id=<?php echo $a['id']; ?>">delete</td>
                    <td><a href="index.php?action=boxedit&id=<?php echo $a['id']; ?>">edit</td>
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
    