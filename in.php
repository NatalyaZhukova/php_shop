<?php session_start(); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<center>
<div  id="maindiv">
<?php
include ('header.php');
include ('menu.tpl');
?>
<div id="contentblock">
<?php //if ($_POST['nw']!='y') { ?>
<form method="post" action="login.php">
Имя пользователя:<br>
<input name="login" type="text" size="30" style="width:200px"><br>
Пароль:<br>
<input name="pass" type="password" size="15" style="width: 200px"><br>
<input name="nw" type="hidden" value="y">
<input type="submit" value="Войти на сайт">
</form>
<?php 

/*
 echo '
Неправильный логин или пароль
<form method="post" action="in.php">
Имя пользователя:<br>
<input name="login" type="text" size="30" style="width:200px"><br>
Пароль:<br>
<input name="pass" type="password" size="15" style="width: 200px"><br>
<input name="nw" type="hidden" value="y">
<input type="submit" value="Войти на сайт">
</form>     
';        
}*/
?>    
</div>    
<?php
include ('footer.tpl');
?>
</div>
<center>

</body>
</html>