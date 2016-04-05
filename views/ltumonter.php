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
                        <th>№</th>   
                      <th>ID</th>   
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Оператор</th>
                        <th>Телефон</th>
                        <th>ЛТУ</th>
                        <th>Обслуживаемые шкафы</th>
                        <th>modify</th>
                
                        
                </tr>
                <tr>
            <?php foreach($monters as $a): ?>
                    
                    <td><?php  
                        if ($i) {
                            echo $i; 
                            $i++;
                        };
                        ?></td>
                    <td><?=$a['id']?></td>
                    <td><?=$a['firstname']?></td>
                    <td><?=$a['secondname']?></td>
                    <td><?=$a['operator']?></td>
                    <td><?=$a['phone']?></td>
                    <td><?=$a['ltunum']?></td>
                    <td><a href="index.php?action=boxmontershow&id=<?=$a['id']?>">ШКАФЫ</a></td>
                    <td><a href="index.php?action=monterdel&id=<?php echo $a['id']; ?>">delete</a></td>
                    <td><a href="index.php?action=monteredit&id=<?php echo $a['id']; ?>">edit</a></td>
                        
                    
                </tr>
                    <?php endforeach ?> 
                </div>
            </table>
        </div>
    </div> 
    <footer,,,
    <p>ЦАБР<br>Copyright
        &copy; 2015</p>
    </footer>
</body>

</html>
    