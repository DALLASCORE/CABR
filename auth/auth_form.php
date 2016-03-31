<html>
<head>
<title>Авторизация</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta name="keywords" content="Ключевые слова для поисковиков">
    <meta name="description" content="Описание сайта">
</head>
    
<body>
    <link rel="stylesheet" href="style.css">
    <br><div align="center"> <h2><a href="" style="text-decoration: none">Линейно-абонентский участок (ЛАУ)</a></h2></div>
    <form action="proverca.php" method="post" class="form-1">
    <p class="field">
        <input type="text" name="login" placeholder="Логин">
        <i class="icon-user icon-large"></i>
    </p>
        <p class="field">
        <input type="password" name="password" placeholder="Пароль">
        <i class="icon-lock icon-large"></i>
    </p>       
    <p class="submit">
        <button type="submit" name="submit"><i class="icon-arrow-right icon-large">LogIn</i></button>
    </p>
    <?php echo $a ?>
  
</form>

    </body>
</html>

