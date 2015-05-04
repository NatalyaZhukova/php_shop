<?php session_start();
 include_once 'adar/db.php';
 $news=mysql_query('SELECT * FROM news  ORDER BY date DESC');
 $date=mysql_query('SELECT UNIX_TIMESTAMP(date) AS timestamp FROM news ORDER BY date DESC;');
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
    <div id="news" align="left">
        <H2 align="center">Новости</H2><br>
   <?php 
   if (mysql_num_rows($news)<3) {$numnews=mysql_num_rows($news);}
   else {$numnews=3;}
    for ($i=0; $i<$numnews; $i++){
    echo
      " <span style='padding-left: 20px'>",   
        date('j-m-Y', mysql_result($date, $i, 'timestamp')),"
            <a class='news' href='news.php?id=", mysql_result($news, $i, 'id_news'), "'>",
           mysql_result($news, $i, 'title'), "      
            </a><br><br>";    }
           ?>     </span>  </div>

    <div id="novinki">
        <H2>Новинки</H2>
  <?php 
  $genre=mysql_query('SELECT books.isbn, series, title, p_year, price, added_date, cover,
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
 GROUP BY books.isbn
ORDER BY added_date DESC LIMIT 0,6') or die(mysql_error());
  
  for($i=0; $i<mysql_num_rows($genre); $i++){
  ?>         
   <div style="width: 233.3px; height:280px; float:left; border:double whitesmoke">
<center> <b> <a class="titles" href="item.php?id=<?php echo mysql_result($genre,$i,'isbn') ?>"><?php echo mysql_result($genre,$i,'series').'. '. mysql_result($genre,$i,'title'); ?></a> </b><br>
<i class="titles"><?php echo mysql_result($genre, $i, 'aut'); ?></i> <br>
<img src="adar/<?php echo mysql_result($genre,$i,'cover'); ?>" width="100" height="150"><br>
<b> <?php echo mysql_result($genre,$i,'price'); ?></b> рублей<br>
 <a  class="order" href="korzina.php?id=<?php echo mysql_result($genre,$i,'isbn');?>">В корзину</a><br>	 
	 </center>
	 </div> 
        <?php } ?>
    </div>
</div>
<?php
include ('footer.tpl');
?>
</div>
<center>

</body>
</html>