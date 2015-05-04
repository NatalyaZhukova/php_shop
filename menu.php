<?php
$cat0 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="���" OR genre2="���" OR genre3="���" ORDER BY p_year DESC;';
$cat1 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="����" OR genre2="����" OR genre3="����" ORDER BY p_year DESC;';
$cat2 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1 LIKE "%�������" OR genre2 LIKE "%�������" OR genre3 LIKE "%�������" ORDER BY p_year DESC;';
$cat3 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="�����������" OR genre2="�����������" OR genre3="�����������" ORDER BY p_year DESC;';
$cat4 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="��������" OR genre2="��������" OR genre3="��������" ORDER BY p_year DESC;';
$cat5 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND genre1="�������" OR genre2="�������" OR genre3="�������" ORDER BY p_year DESC;';
$cat6 = 'SELECT author_name_rus, series, title, p_year, price, added_date 
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND
((genre1!="���" AND genre1!="����" AND genre1!="%�������" AND genre1!="�����������" AND genre1!="��������" AND genre1!="�������")
OR (genre2!="���" AND genre2!="����" AND genre2!="%�������" AND genre2!="�����������" AND genre2!="��������" AND genre2!="�������")
OR (genre3!="���" AND genre3!="����" AND genre3!="%�������" AND genre3!="�����������" AND genre3!="��������" AND genre3!="�������"))
ORDER BY p_year DESC;';
?>

<html>
<body>
<center>
<div id="menu2" align="left">
<ul> 
<li><a href="genres.php?g=0">Ѹ��</a></li>
<li><a href="genres.php?g=1">Ѹ���</a></li>
<li><a href="genres.php?g=2">�������</a></li>
<li><a href="genres.php?g=3">�����������</a></li>
<li><a href="genres.php?g=4">��������</a></li>
<li><a href="genres.php?g=5">�������</a></li>
<li><a href="genres.php?g=6">������ �����</a></li>
</ul>
</div>
</center>
</body>
</html>
