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
include ('poisk.tpl');
include ('menu.tpl');
?>
<div id="contentblock">
 Оплата осуществляется 2 способами: наличными при передаче курьеру и наложенным платежом по почте.<br>
 Доставка курьером осуществляется по городу Минску. Ее стоимость составляет:<br>
 - если сумма покупки не превышает 100 000, - 10000 рублей; <br>
 - если сумма покупки превышает 100 000, - бесплатно;<br>
 Также возможна отправка заказа по почте наложенным платежом. В этом случае дополнительно к сумме заказа нужно будет оплатить тарифы почты.
 
</div>

<?php
include ('footer.tpl');
?>
</div>
<center>

</body>
</html>