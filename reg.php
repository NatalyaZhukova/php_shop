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
   
<center>�����������</center>
<form align="left" action="reg.php" method="post" style="padding-left: 20px" name="reg" onSubmit="return check_it()">
��� ������������:<br>
<input name="username" type="text" size="30" style="width: 200px" maxlength="30" onBlur="heck_it()"><br>
������:<br>
<input name="pass" type="password" size="15" style="width: 200px" maxlength="30"><br>
����������� ������:<br>
<input name="confpass" type="password" size="15" style="width: 200px" maxlength="30"><br>
<input name="nw" type="hidden" value="y">
<input name="reg" type="submit" value="������������������" ></form>
<br>
<?php 
} 
else{
$ok='y';
if (empty($_POST['username'])) {$err1="��� ������������ �� �������"; $ok='n';}
else if (!preg_match('/^[A-za-z0-9\-\_]{1,}$/', $_POST['username'])) {$err1="��� ������������ �������� ������������ �������";
$ok='n';}
else {
include_once 'adar/db.php';   
$uname=strip_tags(htmlentities(stripslashes(mysql_real_escape_string($_POST['username']))));
$res=mysql_query('SELECT username FROM users WHERE username="'.$uname.'"');
if (mysql_num_rows($res)!=0) {$err1= '������������ � ����� ������ ��� ���������������'; $ok='n';}

}
if ( (empty($_POST['pass']) || (empty($_POST['confpass'])) || ($_POST['pass']!=$_POST['confpass']))){ 
    $err2="��������� ������ �� ���������"; $ok='n';}
if ($ok!='y') {
echo '    
<center>�����������</center>
<form align="left" action="reg.php" method="post">
��� ������������:<br>
<input name="username" type="text" size="30" style="width: 200px" maxlength="30" value=',$uname,'>',$err1,'<br>
������:<br>
<input name="pass" type="password" size="15" style="width: 200px" maxlength="30"><br>
����������� ������:<br>
<input name="confpass" type="password" size="15" style="width: 200px" maxlength="30">',$err2,'<br>
<input name="nw" type="hidden" value="y">
<input name="reg" type="submit" value="������������������"></form>
<br>';    
}
else {
$pass=strip_tags(htmlentities(stripslashes(mysql_real_escape_string($_POST['pass']))));
if (!mysql_query("INSERT INTO users(username, password) VALUES('$uname','$pass')")) {echo mysql_error();};
echo '������� �� �����������!';
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