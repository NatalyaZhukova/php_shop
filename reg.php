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
<?php if ($_POST['nw']!='y'){ ?>
   
<center>Регистрация</center>
<form align="left" action="reg.php" method="post" style="padding-left: 20px" name="reg" onSubmit="return check_it()">
Имя пользователя:<br>
<input name="username" type="text" size="30" style="width: 200px" maxlength="30" onBlur="heck_it()"><br>
Пароль:<br>
<input name="pass" type="password" size="15" style="width: 200px" maxlength="30"><br>
Подтвердите пароль:<br>
<input name="confpass" type="password" size="15" style="width: 200px" maxlength="30"><br>
<input name="nw" type="hidden" value="y">
<input name="reg" type="submit" value="Зарегистрироваться" ></form>
<br>
<?php 
} 
else{
$ok='y';
if (empty($_POST['username'])) {$err1="Имя пользователя не введено"; $ok='n';}
else if (!preg_match('/^[A-za-z0-9\-\_]{1,}$/', $_POST['username'])) {$err1="Имя пользователя содержит недопустимые символы";
$ok='n';}
else {
include_once 'adar/db.php';   
$uname=strip_tags(htmlentities(stripslashes(mysql_real_escape_string($_POST['username']))));
$res=mysql_query('SELECT username FROM users WHERE username="'.$uname.'"');
if (mysql_num_rows($res)!=0) {$err1= 'Пользователь с таким именем уже зарегистрирован'; $ok='n';}

}
if ( (empty($_POST['pass']) || (empty($_POST['confpass'])) || ($_POST['pass']!=$_POST['confpass']))){ 
    $err2="Введенные пароли не совпадают"; $ok='n';}
if ($ok!='y') {
echo '    
<center>Регистрация</center>
<form align="left" action="reg.php" method="post">
Имя пользователя:<br>
<input name="username" type="text" size="30" style="width: 200px" maxlength="30" value=',$uname,'>',$err1,'<br>
Пароль:<br>
<input name="pass" type="password" size="15" style="width: 200px" maxlength="30"><br>
Подтвердите пароль:<br>
<input name="confpass" type="password" size="15" style="width: 200px" maxlength="30">',$err2,'<br>
<input name="nw" type="hidden" value="y">
<input name="reg" type="submit" value="Зарегистрироваться"></form>
<br>';    
}
else {
$pass=strip_tags(htmlentities(stripslashes(mysql_real_escape_string($_POST['pass']))));
if (!mysql_query("INSERT INTO users(username, password) VALUES('$uname','$pass')")) {echo mysql_error();};
echo 'Спасибо за регистрацию!';
}

 }
?>
</div>
<?php
include ('footer.tpl');
?>
</div>    
<center>
</body>
</html>