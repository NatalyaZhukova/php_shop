<?php 
session_start();
if (empty($_SESSION['name'])){
header('Location: http://mangamag/');    
}
include_once 'adar/db.php';
$log=$_SESSION['name'];
$orders=mysql_query("SELECT id_order, sum, UNIX_TIMESTAMP(date) as timestamp  FROM orders
    WHERE username='".$log."' ORDER by date DESC") or die(mysql_error()); 
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
?>
<div id="contentblockall" width="100%" align="left">
<H1 align="center" style="font-family: Georgia; color: darkred">История заказов</H1> 
<?php if (mysql_num_rows($orders)==0)
{echo "Вы не делали покупок в этом магазине";}
else {
echo'<div style="padding:20px">';
for ($i=0; $i<mysql_num_rows($orders);$i++){
echo '<i class="titles">'. date('j-m-Y', mysql_result($orders, $i, 'timestamp')).'</i>';
echo " - №". mysql_result($orders, $i, 'id_order'). " на сумму <b >". mysql_result($orders, $i, 'sum'). "</b> рублей<br>";
echo '<ul>';
$books = mysql_query('SELECT  series, title, number_books  
FROM orders_books, books WHERE id_order='.mysql_result($orders, $i, 'id_order').' AND orders_books.isbn=books.isbn');
for ($j=0; $j<mysql_num_rows($books); $j++) {
    echo '<li><font class="title">'. mysql_result($books, $j, 'series'). '. '. mysql_result($books, $j, 'title').'</font>
             - '.mysql_result($books, $j, 'number_books').' шт.</li><br>';}
echo '</ul>';
            }
      echo '</div>';       
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