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
         <h1><a href="index.php">ЦАБР</a></h1>
        <div>
    
            <form method="post" action="index.php?action=<?=$_GET['action']?>&id=<?php echo $_GET['id']; ?>">
        <label>
                Номер шкафа<br>
            <input type="text" name="number"  value="<?php echo $box['number']; ?>" class="form-item" autofocus required>
        </label><br>
                 <label>
                Тип<br>
                <select class="form-item" name="type" size=1 value="">
                <option value="РШ">РШ</option> 
                <option value="ТКШ">ТКШ</option> 
                </select><br>
                </label><br>
        
                <label>
            Адрес<br>
            <input type="text"  name="address"  value="<?php  echo $box['address']; ?>" class="form-item" autofocus required>
             </label><br>
               <label> 
                Примечание<br>
                <input type="text" name="note"  value="<?php  echo $box['note']; ?>" class="form-item" autofocus required>
             </label><br>
            
                <label>
            Участок<br>     
            <select class="form-item" name="id_ltu" size=1>
                    <option selected value = ""></option>
            <?php foreach($ltu as $a): ?>   
                    <option value="<?=$a['id'] ?>"><?=$a['ltunum'] ?></option> 
             <?php endforeach ?> 
                 </select>
        </label><br>
                    
        <label>
            Монтер<br>     
            <select class="form-item" name="id_monter" size=1>
                    <option selected value = ""></option>
                            <?php foreach($monters as $b): ?>   
                    <option value="<?=$b['id'] ?>"><?=$b['firstname'] ?></option> 
                            <?php endforeach ?> 
            </select>
        </label><br>
        
        
        
        <input type="submit" value="Сохранить" class="btn">
        <input type="reset" name="Reset" value="Очистить форму" class="btn">
    </form> <br>
            
            Номер: <?php  echo $box['number']; ?><br>
            Адресс: <?php  echo $box['address']; ?><br>
            Примечание: <?php  echo $box['note']; ?><br>
            Участок <?php  echo $box['ltunum']; ?><br>  
            Монтер <?php  echo $box['firstname'];?> <?php  echo $box['secondname']; ?><br>
            <a href="index.php?action=boxdel&id=<?php echo $box['id']; ?>">удалить</a><br>
            <a href="index.php?action=boxclear&id=<?php echo $box['id']; ?>">освободить</a><br>
        </div>
         <footer><br><br>
    <p>Мой первый блог<br>Copyright
        &copy; 2015</p>
    </footer>
</body>

</html>