<?php
$cat0 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="сёдзё" OR genre2="сёдзё" OR genre3="сёдзё" ORDER BY p_year DESC;';
$cat1 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="сёнэн" OR genre2="сёнэн" OR genre3="сёнэн" ORDER BY p_year DESC;';
$cat2 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1 LIKE "%комедия" OR genre2 LIKE "%комедия" OR genre3 LIKE "%комедия" ORDER BY p_year DESC;';
$cat3 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="приключения" OR genre2="приключения" OR genre3="приключения" ORDER BY p_year DESC;';
$cat4 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="детектив" OR genre2="детектив" OR genre3="детектив" ORDER BY p_year DESC;';
$cat5 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="фэнтези" OR genre2="фэнтези" OR genre3="фэнтези" ORDER BY p_year DESC;';
$cat6 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND
((genre1!="сёдзё" AND genre1!="сёнэн" AND genre1!="%комедия" AND genre1!="приключения" AND genre1!="детектив" AND genre1!="фэнтези")
OR (genre2!="сёдзё" AND genre2!="сёнэн" AND genre2!="%комедия" AND genre2!="приключения" AND genre2!="детектив" AND genre2!="фэнтези")
OR (genre3!="сёдзё" AND genre3!="сёнэн" AND genre3!="%комедия" AND genre3!="приключения" AND genre3!="детектив" AND genre3!="фэнтези"))
ORDER BY p_year DESC;';
?>

<html>
<body>
<center>
<div id="menu2" align="left">
<ul> 
<li><a href="genres.php?g=0">Сёдзё</a></li>
<li><a href="genres.php?g=1">Сёнэн</a></li>
<li><a href="genres.php?g=2">Комедия</a></li>
<li><a href="genres.php?g=3">Приключения</a></li>
<li><a href="genres.php?g=4">Детектив</a></li>
<li><a href="genres.php?g=5">Фэнтези</a></li>
<li><a href="genres.php?g=6">Другие жанры</a></li>
</ul>
</div>
</center>
</body>
</html>
