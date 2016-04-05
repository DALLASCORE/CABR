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
        <?php $i=0 ?>
        <h1><a href="index.php">ЦАБР</a></h1>
          <form name="search" method="post" action="search.php">
            <input type="search" name="query" placeholder="Поиск шкафа или монтера">
                 <input type="search" name="address" placeholder="Улица"><br>
                <button type="submit">Найти</button> 
            <input type="button" onclick="history.back(-1);" value="Назад"/>
                 </form>
        <div>
            <table border="1" width="100%" cellpadding="5">
                <div class="art">
                 <tr>
                        <th>№</th>   
                        <th>ШКАФ</th>
                        <th>ТИП</th>
                        <th>АДРЕСС</th>
                        <th>ПРИМЕЧАНИЕ</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                </tr>
                <tr>
            <?php foreach($commbox as $a): ?>
                    
                    <td><?php  
                        if ($i) {
                            echo $i; 
                            $i++;
                        };
                        ?>
                    </td>
                    <td><a href="index.php?action=boxshow&id=<?php echo $a['id']; ?>"><?=$a['number']?></a></td>
                    <td><?=$a['type']?></td>
                    <td><?=$a['address']?></td> 
                    <td><?=$a['note']?></td>
                    <td><?=$a['firstname']?></td>
                    <td><?=$commbox['secondname']?></td>
                    
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
    