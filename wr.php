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
<H3>������������ ��� ������������ �\��� ������!</H3>
 <form method="post" action="login.php">
��� ������������:<br>
<input name="login" type="text" size="30" style="width:200px"><br>
������:<br>
<input name="pass" type="password" size="15" style="width: 200px"><br>
<input type="submit" value="����� �� ����">
</form>
</div>

<?php
include ('footer.tpl');
?>
</div>
<center>

</body>
</html>