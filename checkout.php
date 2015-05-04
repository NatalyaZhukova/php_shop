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
 <div id="zakaz" align="center">    
        <H4>Вы заказали:</H4><br>
<?php for ($i=0; $i<count($_SESSION['order']); $i++) {
echo mysql_result($korzina, $i, 'series').', ' . mysql_result($korzina, $i, 'title'). ' - '. $_SESSION['kolvo'][$i]. ' шт.<br>';}
?>
на сумму <?php echo $_SESSION['sum']; ?> рублей</div><br>
<form action="process.php" method="post">
Выберите способ доставки:<br>
<input type="radio" name="dost" value="0" checked >Курьером по Минску<br>
<input type="radio" name="dost" value="1"> Наложенным платежом по почте<br>
<br>
<div align="right" style="width:50%">Ваш контактный телефон: <input type="text" name="phone"><br>
Адрес для доставки:<br>
Почтовый индекс: <input type="text" name="zipcode"><br>
Область: <select name="area">
    <option>Минская</option>    
    <option>Витебская</option> 
    <option>Гродненская</option>
    <option>Могилевская</option>
    <option>Гомельская</option>
    <option>Брестская</option> 
</select><br>
Район(если необходимо):<input type="text" name="district"><br>
Город\городской поселок\деревня: <input type="text" name="city"><br>
Адрес: <input type="text" name="address" size="30"><br>
<input type="submit" value="Подтвердить заказ">
</div>
</form>   
    
    
    
</div>

<?php
include ('footer.tpl');
?>
</div>
<center>

</body>
</html>