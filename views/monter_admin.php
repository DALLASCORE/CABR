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
            Фамилия<br>
            <input type="text" name="firstname"  value="<?php echo $monter['firstname']; ?>" class="form-item" autofocus required>
        </label><br>
                
        <label>
            Имя<br>
            <input type="text"  name="secondname"  value="<?php  echo $monter['secondname']; ?>" class="form-item" autofocus required>
             </label><br>
            
        <label>
            
                Телефон  в формате (375xx) xxx-xxxx:<br>
                <select class="form-item" name="operator" size=1 value="">
                <option value="МТС">МТС</option> 
                <option value="ВЕЛКОМ">ВЕЛКОМ</option> 
                <option value="life:)">life:)</option> 
                </select>
             
            <input  class="form-item" name="phone"  maxlength="16"  pattern="\(\d{5}\)\ \d{3}-\d{4}" value="<?php echo $monter['phone']; ?>"  autofocus required >
        </label><br>
        
        <label>
            Участок<br>     
            <select class="form-item" name="id_ltu" size=1>
                 <?php foreach($ltu as $a): ?>   
            <option value="<?=$a['id'] ?>"><?=$a['ltunum'] ?></option> 
             <?php endforeach ?> 
                 </select>
        </label><br>
        
        <input type="submit" value="Сохранить" class="btn">
        <input type="reset" name="Reset" value="Очистить форму" class="btn">
    </form>
            <a href="index.php?action=boxapp&id=<?php echo $_GET['id']; ?>">Назначить шкаф</a>
        </div>
         <footer><br><br>
    <p>Мой первый блог<br>Copyright
        &copy; 2015</p>
    </footer>
</body>

</html>