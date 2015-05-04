<?php
$cat0 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover,
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="���" OR genre2 ="���" OR genre3="���") GROUP BY books.isbn ORDER BY';
$cat1 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="����" OR genre2 ="����" OR genre3="����") 
GROUP BY books.isbn ORDER BY';
$cat2 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="�������" OR genre2 ="�������" OR genre3="�������") 
GROUP BY books.isbn ORDER BY';
$cat3 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="�����������" OR genre2 ="�����������" OR genre3="�����������") GROUP BY books.isbn ORDER BY';
$cat4 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
GROUP_CONCAT( DISTINCT author_name_rus SEPARATOR ", ") AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="��������" OR genre2 ="��������" OR genre3="��������") GROUP BY books.isbn ORDER BY';
$cat5 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
 GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="�������" OR genre2 ="�������" OR genre3="�������") GROUP BY books.isbn ORDER BY';
$cat6 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND
((genre1!="���" AND genre1!="����" AND genre1!="%�������" AND genre1!="�����������" AND genre1!="��������" AND genre1!="�������")
AND (genre2!="���" AND genre2!="����" AND genre2!="%�������" AND genre2!="�����������" AND genre2!="��������" AND genre2!="�������")
AND (genre3!="���" AND genre3!="����" AND genre3!="%�������" AND genre3!="�����������" AND genre3!="��������" AND genre3!="�������"))
GROUP BY books.isbn ORDER BY';
?>
