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
if (empty($_POST['phone'])) {$err1="Вы не ввели номер телефона"; $ok='n';}
else if (!preg_match('/^[0-9\+]{10,12}/', $_POST['phone'])) {$err1="Номер введен в неверном формате"; $ok='n';}
if (empty($_POST['zipcode'])) {$err2="Вы не ввели индекс"; $ok='n';}
else if (!preg_match('/^[0-9]{6}/', $_POST['zipcode'])) {$err2="Индекс введен в неверном формате"; $ok='n';}
if ((!empty($_POST['district'])) && (!preg_match('/^[А-Яа-я\-]{1,}/', $_POST['district']))) {$ok='n';} 
if ((empty($_POST['city'])) || (!preg_match('/^[А-Яа-я\-]{1,}/', $_POST['city']))) {$err3="Вы не ввели название города"; $ok='n';}
if ((empty($_POST['address']))|| (!preg_match('/^[А-Яа-я0-9\-\,\.]{1,}/', $_POST['address']))) {$err4="Вы не ввели адрес"; $ok='n';}
echo '<div id="zakaz" align="center">';
echo '<H4>Вы заказали:</H4><br>';
for ($i=0; $i<count($_SESSION['order']); $i++) {
echo mysql_result($korzina, $i, 'series').', ' . mysql_result($korzina, $i, 'title'). ' - '. $_SESSION['kolvo'][$i]. ' шт.<br>';}
echo 'на сумму ', $_SESSION['sum'],' рублей<br> </div>';
if ($ok!='y'){ 
echo <<<END
<form action="process.php" method="post">
Выберите способ доставки:<br>
<input type="radio" name="dost" checked>Курьером по Минску<br>
<input type="radio" name="dost"> Наложенным платежом по почте<br>
<div align="right" style="width:50%">Ваш контактный телефон: <input type="text" name="phone">$err1 <br> 
Адрес для доставки:<br>
Почтовый индекс: <input type="text" name="zipcode">$err2<br> 
Область: <select name="area">
    <option>Минская</option>    
    <option>Витебская</option> 
    <option>Гродненская</option>
    <option>Могилевская</option>
    <option>Гомельская</option>
    <option>Брестская</option> 
</select><br>
Район(если необходимо):<input type="text" name="district"><br>
Город\городской поселок\деревня: <input type="text" name="city">$err3<br>
Адрес: <input type="text" name="address">$err4<br>
<input type="submit" value="Подтвердить заказ"></div>
<input type="hidden" name="nw" value="y">
</form> 
END;
}
 else {
 if ($_POST['dost'] == 0) {$dost="Курьером";} 
 else {$dost="Почтой";}
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
echo "<br>Спасибо за заказ. Наш менеджер свяжется с вами в ближайшее время";
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