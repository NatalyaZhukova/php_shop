<?php session_start(); // Стартует сессия
include_once 'adar/db.php'; // Подключение к базе данных

$shablon ='/^[0-9]{3}[-]{1}[0-9]{1,}[-]{1}[0-9]{1,}[-]{1}[0-9]{1,}[-]{1}[0-9X]{1}/'; //шаблон для isbn
if (
        (!preg_match($shablon, $_REQUEST['id'])) || // Проверка на соответствие передаваемого значения шаблону
        (empty($_REQUEST['id'])) ||  
        (!isset($_REQUEST['id']))
  ) {}
  else { $id=$_REQUEST['id']; // Запись полученного id в переменную
 if (empty($_SESSION['order'])) {$_SESSION['order'][0]=$id;}

 else if (!in_array($id, $_SESSION['order'])) { 
    $_SESSION['order'][count($_SESSION['order'])] = $id; }}// Добавление элемента в общий заказ
  if (!empty($_SESSION['order'])) {sort($_SESSION['order']); }// Сортировка нужна, чтобы установить соответствие между товаром и полем количества(т.к. 
  //сортировка по умолчанию в MySQL - по возрастанию id
$shablon2='/^[1-9]{1}[0-9]{0,}/';
   
if (!empty($_SESSION['order'])) { // Заполняем массив с количеством
                for ($i=0; $i<count($_SESSION['order']);$i++){  
     if (empty($_SESSION['kolvo'][$i])) { $_SESSION['kolvo'][$i]=1;}
     if ((!empty($_REQUEST['kolvo']))&& (preg_match($shablon2, $_REQUEST['kolvo'][$i]))){
         $_SESSION['kolvo'][$i]=$_REQUEST['kolvo'][$i];}}
            
    if (!empty($_REQUEST['kolvo'])){ // Считаем общее количество товаров.
   $_SESSION['ord']=array_sum($_SESSION['kolvo']);}
   else { if ((!empty($id)) && (!in_array($id, $_SESSION['order']))) {$_SESSION['ord']=array_sum($_SESSION['kolvo'])+1;}
   else { $_SESSION['ord']=array_sum($_SESSION['kolvo']);}}}     
                        
  if (($_POST['selection']=='delete') && (!empty($_POST['checks']))) { // Удаление элементов из корзины
   for ($i=0; $i<count($_SESSION['order']);$i++){
       for ($a=0; $a<count($_POST['checks']); $a++){
            if ($_SESSION['order'][$i]==$_POST['checks'][$a]){
     unset($_SESSION['order'][$i]);
     unset($_SESSION['kolvo'][$i]);
     sort($_SESSION['order']);
     }
    $_SESSION['ord']=array_sum($_SESSION['kolvo']); // Подсчет общего количества товаров, если было удаление.
    }}
        $_SESSION['order']=array_values($_SESSION['order']); // Переиндексация массивов
    $_SESSION['kolvo']=array_values($_SESSION['kolvo']);
    
     }
if (!empty($_SESSION['order'])) {$order=join('","', $_SESSION['order']); // Проверка, есть ли в заказе элементы. Если есть, то выполняется запрос в базу 
$korzina=  mysql_query('SELECT books.isbn, series, title, cover, price, GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng  
AND books.isbn IN ("'. $order . '") GROUP BY books.isbn');
if (!empty($_SESSION['name'])){
$query0="DELETE FROM korzina WHERE username='".$_SESSION['name']."'";
mysql_query($query0) or die(mysql_error());
for ($i=0; $i<count($_SESSION['order']); $i++){
$query1="INSERT INTO korzina(username, isbn, number_books) VALUES('".$_SESSION['name']."', '".$_SESSION['order'][$i]."','".$_SESSION['kolvo'][$i]."')";
mysql_query($query1) or die(mysql_error()); 
}

}}
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
<div id="contentblockkorzina" style="width:100%">
<?php 
if (empty($_SESSION['order'])){ echo "Вы пока ничего не добавили в корзину";}
else { ?>
    <form action="korzina.php" method="post">
<?php   
$sum = 0;
for($i=0; $i<mysql_num_rows($korzina); $i++){  
$st = mysql_result($korzina,$i,'price') * $_SESSION['kolvo'][$i]; // Подсчет стоимости одной позиции
$sum+=$st; //Подсчет общей суммы заказа
?>
<div style="width:100%; height:170px; border-bottom: 2px double black; border-bottom: 1px double black">
<div style="width:50%; float:left" align="left"> 
<img style="width:100px; height:150px; padding-left:15px; padding-top:15px" 
     width="100" height="150" src="adar/<?php echo mysql_result($korzina,$i,'cover');?> " align="left">
<div style="padding-top:15px; padding-left:5px">
<a href="item.php?id=<?php echo mysql_result($korzina, $i, 'isbn') ?>" class="titles">
    <?php echo mysql_result($korzina,$i,'series').'. '. mysql_result($korzina, $i, 'title'); ?></a><br>
    <i><?php echo mysql_result($korzina, $i, 'aut')?></i>
</div>

</div>
<div style="width:10%; padding-top:80px; float:left" align="center">
<input type="text" size="3" value="<?php echo $_SESSION['kolvo'][$i] ?>" name="kolvo[]">
</div>
<div style="float:left; width:20%; padding-top:80px" align="center"><b><?php echo mysql_result($korzina,$i,'price'); ?></b> рублей <br></div>
<div style="float:left; width:20%; padding-top:80px" align="center">
    <input type="checkbox" name="checks[]" value="<?php echo mysql_result($korzina,$i,'isbn') ?>"></div>
</div>
 <?php }
    ?>
    <div align="right"><select name="selection">
 <option value="nothing">Ничего не делать</option>
 <option value="delete">Удалить выбранные</option>
 </select></div>
<center>
    <i>Итого:</i> <?php echo $_SESSION['ord'].' '; 
if ($_SESSION['ord']==1) {echo 'товар.';}
else if (($_SESSION['ord']>1) && ($_SESSION['ord']<5)){ echo 'товара.';}
else if ( ($_SESSION['ord']>4) && ($_SESSION['ord']<21) ) {echo 'товаров';}
else if ($_SESSION['ord']%10==1) {echo 'товар.';}
else if (($_SESSION['ord']%10>1) && ($_SESSION['ord']%10<5)){ echo 'товара.';}
else {echo 'товаров.';} 
echo '<br>';
?>
  <H4>Общая сумма заказа: <?php 
  $_SESSION['sum']=$sum;
  echo $sum; ?> рублей  </H4> <input type="submit" value="Пересчитать"></center>
  </form>
    <H4 align="center"> <a class="titles" href="
    <?php if(!empty($_SESSION['name'])) {echo 'checkout.php';}
    else echo 'in.php';
    ?>                       
                           ">Перейти к оформлению заказа</a></H4><br><br>
    <?php }?>
               
 </div>
<?php
include ('footer.tpl');
 ?>
<center>

</div>
</body>
</html>

