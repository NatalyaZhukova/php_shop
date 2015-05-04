<?php 
session_start();
include_once 'adar/db.php';
$id = $_REQUEST['id'];
if (empty($_REQUEST['id'])){
header("Location: http://mangamag/");}
else {
$shablon ='/^[0-9]{3}[-]{1}[0-9]{1,}[-]{1}[0-9]{1,}[-]{1}[0-9]{1,}[-]{1}[0-9X]{1}/';
if (!preg_match($shablon, $id)) {header("Location: http://mangamag/");}
else {
$item=mysql_query('SELECT * FROM books WHERE isbn="'. $id.'"');
if (!mysql_num_rows($item)) {//сделать редирект  
header("Location: http://mangamag/"); }
else {
$authors = mysql_query('SELECT author_name_rus FROM authors, authors_books WHERE authors_books.isbn="'. $id .'" AND
authors_books.author_name_eng=authors.author_name_eng');
$phouse = mysql_query('SELECT phouse_name FROM pub_house, books WHERE isbn="'. $id .'" AND books.pubhouse_id=pub_house.id_pub_house');
//mysql_num_rows($authors);
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
<div id="information" style="float:left; width:100%; padding-top: 20px">
<img id="cover" src="adar/<?php echo mysql_result($item,0,'cover');?>" align="left">    
<H2 class="title"><?php echo mysql_result($item,0,'series').'. '. mysql_result($item,0,'title');?></H2>
<div align='left' style="float:left; width:155px; height:150px; padding-left:5px">
<i class="titles" >
Серия: <br>
Автор:<br>
Издательство:<br>
Год издания:<br>
Количество страниц:<br>
Жанры:<br>
</i>
</div>
<div align="left" style="float:left; height: 150px">

<font class="title"><?php echo mysql_result($item,0,'series').';'; ?><br>
<?php for($i=0; $i<mysql_num_rows($authors); $i++) {echo mysql_result($authors, $i, 'author_name_rus').'; ';}   ?><br>
<?php echo mysql_result($phouse,0,'phouse_name').';'; ?><br>
<?php echo mysql_result($item,0,'p_year').';'; ?><br>
 <?php echo mysql_result($item,0,'kolvo_stranic').';'; ?><br> 
 <?php echo mysql_result($item,0,'genre1').', '. mysql_result($item,0,'genre2').', '.mysql_result($item,0,'genre3').';'; ?></font><br>
</div>
<center><div style="width:300px; height: 120px; border: 3px double darkorange" align="center">
<p class="price"> <b class="price"><?php echo mysql_result($item,0,'price') ?> </b> рублей</p>
 
<a class="order" href="korzina.php?id=<?php echo $id; ?>&amp;back_uri">Добавить в корзину</a>
</div></center>
<div id="summary" style="float:left; padding-top:10px" align="left"><?php echo mysql_result($item,0,'annotation'); ?> <br> </div>
</div>    
<div style="height: 200px; width:100%; float:left"></div>
</div>
   
<?php
include ('footer.tpl');
?>
</div>
<center>

</body>
</html>
<?php }}}
?>