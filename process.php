<?php session_start(); 
 include_once 'adar/db.php';
 if (empty($_SESSION['order'])) {
header("Location: http://mangamag/");  
}
$order=join('","', $_SESSION['order']);
$korzina=mysql_query('SELECT * FROM books WHERE books.isbn IN ("'. $order . '")');
?>
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
 <?php
$ok='y';
if (empty($_POST['phone'])) {$err1="�� �� ����� ����� ��������"; $ok='n';}
else if (!preg_match('/^[0-9\+]{10,12}/', $_POST['phone'])) {$err1="����� ������ � �������� �������"; $ok='n';}
if (empty($_POST['zipcode'])) {$err2="�� �� ����� ������"; $ok='n';}
else if (!preg_match('/^[0-9]{6}/', $_POST['zipcode'])) {$err2="������ ������ � �������� �������"; $ok='n';}
if ((!empty($_POST['district'])) && (!preg_match('/^[�-��-�\-]{1,}/', $_POST['district']))) {$ok='n';} 
if ((empty($_POST['city'])) || (!preg_match('/^[�-��-�\-]{1,}/', $_POST['city']))) {$err3="�� �� ����� �������� ������"; $ok='n';}
if ((empty($_POST['address']))|| (!preg_match('/^[�-��-�0-9\-\,\.]{1,}/', $_POST['address']))) {$err4="�� �� ����� �����"; $ok='n';}
echo '<div id="zakaz" align="center">';
echo '<H4>�� ��������:</H4><br>';
for ($i=0; $i<count($_SESSION['order']); $i++) {
echo mysql_result($korzina, $i, 'series').', ' . mysql_result($korzina, $i, 'title'). ' - '. $_SESSION['kolvo'][$i]. ' ��.<br>';}
echo '�� ����� ', $_SESSION['sum'],' ������<br> </div>';
if ($ok!='y'){ 
echo <<<END
<form action="process.php" method="post">
�������� ������ ��������:<br>
<input type="radio" name="dost" checked>�������� �� ������<br>
<input type="radio" name="dost"> ���������� �������� �� �����<br>
<div align="right" style="width:50%">��� ���������� �������: <input type="text" name="phone">$err1 <br> 
����� ��� ��������:<br>
�������� ������: <input type="text" name="zipcode">$err2<br> 
�������: <select name="area">
    <option>�������</option>    
    <option>���������</option> 
    <option>�����������</option>
    <option>�����������</option>
    <option>����������</option>
    <option>���������</option> 
</select><br>
�����(���� ����������):<input type="text" name="district"><br>
�����\��������� �������\�������: <input type="text" name="city">$err3<br>
�����: <input type="text" name="address">$err4<br>
<input type="submit" value="����������� �����"></div>
<input type="hidden" name="nw" value="y">
</form> 
END;
}
 else {
 if ($_POST['dost'] == 0) {$dost="��������";} 
 else {$dost="������";}
$sum=$_SESSION['sum'];
$area=$_POST['area'];
$phone=strip_tags(htmlentities(stripslashes(mysql_real_escape_string($_POST['phone']))));
$zipcode=strip_tags(htmlentities(stripslashes(mysql_real_escape_string($_POST['zipcode']))));
$district=$_POST['district'];
$city=$_POST['city'];
$address=$_POST['address'];
$log=$_SESSION['name'];
mysql_query("UPDATE  users SET phone='".$phone. "', zipcode='$zipcode', province='$area', region='$district', place='$city', address='$address',
    dostavka='".$dost."' WHERE username='".$log."'") or die(mysql_error());  

mysql_query("INSERT INTO orders(username, sum) VALUES ('$log','$sum')") or die(mysql_error());
$order=mysql_insert_id();
for ($j=0; $j<count($_SESSION['order']); $j++){
    $query="INSERT INTO orders_books(id_order, isbn, number_books) VALUES ('".$order."', '".$_SESSION['order'][$j]."','".$_SESSION['kolvo'][$j]."')";
 mysql_query($query);   
}
echo "<br>������� �� �����. ��� �������� �������� � ���� � ��������� �����";
unset($_SESSION["order"]);
unset($_SESSION['kolvo']);
unset($_SESSION['sum']);
unset($_SESSION['ord']);
$query0="DELETE FROM korzina WHERE username='".$_SESSION['name']."'";
mysql_query($query0) or die(mysql_error());

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