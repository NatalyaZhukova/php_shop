<?php
include_once 'adar/db.php';

$a = mysql_query('SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="ñ¸äç¸" OR genre2="ñ¸äç¸" OR genre3="ñ¸äç¸" ORDER BY p_year DESC;
');
$rows = mysql_num_rows($a);
echo $rows.'<br>';
for ($i=0; $i<$rows; $i++) {
  //echo mysql_result($a, $i, 'author_name_rus'). ' ';
  echo mysql_result($a, $i, 'series').'. ';  
  echo mysql_result($a, $i, 'title'). '<br>';}

//SELECT author_name_rus FROM authors, authors_books, 
// WHERE authors_books.author_name_eng=authors.author_name_eng AND authors_books.isbn IN 
 //(SELECT isbn, series, title, year  FROM books WHERE genre1="ñ¸äç¸" OR genre2="ñ¸äç¸" OR genre3="ñ¸äç¸")
  ?>