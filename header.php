<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<center>
<div>
<div id="header" align="left">
<div style="width:85%; float:left; color: bisque" align="left;">
<?php 
if (empty($_SESSION['ord'])) {$_SESSION['ord']=0;}
if (empty($_SESSION['name'])){   
echo '
<a class="header" href="in.php">�������</a> ��� <a class="header" href="reg.php">�����������������</a>';}
else {
$log=$_SESSION['name'];
if ($log=='admin') {$pers="/adar/";}
else {$pers="personal.php";}
echo "����� ����������, <a class='title' href='$pers'>",$_SESSION['name']; echo'</a>  <a class="header" href="login.php?id=out">�����</a>';}
?>
</div>
<div style="float:left"><a  class="header" href="korzina.php">���� �������:<?php echo $_SESSION['ord']; ?></a></div>
</div>
<div id="headline">
<a href="index.php"><img src="logo.png" border="0"></a>
</div>
</center>
<body>
</html>