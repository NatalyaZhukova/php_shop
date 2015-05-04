<?php
$cat0 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover,
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="сёдзё" OR genre2 ="сёдзё" OR genre3="сёдзё") GROUP BY books.isbn ORDER BY';
$cat1 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="сёнэн" OR genre2 ="сёнэн" OR genre3="сёнэн") 
GROUP BY books.isbn ORDER BY';
$cat2 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="комедия" OR genre2 ="комедия" OR genre3="комедия") 
GROUP BY books.isbn ORDER BY';
$cat3 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="приключения" OR genre2 ="приключения" OR genre3="приключения") GROUP BY books.isbn ORDER BY';
$cat4 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
GROUP_CONCAT( DISTINCT author_name_rus SEPARATOR ", ") AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="детектив" OR genre2 ="детектив" OR genre3="детектив") GROUP BY books.isbn ORDER BY';
$cat5 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
 GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND (genre1="фэнтези" OR genre2 ="фэнтези" OR genre3="фэнтези") GROUP BY books.isbn ORDER BY';
$cat6 = 'SELECT books.isbn, series, title, p_year, price, added_date, cover, 
GROUP_CONCAT( DISTINCT author_name_rus) AS aut
FROM authors, authors_books, books 
WHERE authors_books.isbn=books.isbn 
AND authors_books.author_name_eng=authors.author_name_eng 
AND
((genre1!="сёдзё" AND genre1!="сёнэн" AND genre1!="%комедия" AND genre1!="приключения" AND genre1!="детектив" AND genre1!="фэнтези")
AND (genre2!="сёдзё" AND genre2!="сёнэн" AND genre2!="%комедия" AND genre2!="приключения" AND genre2!="детектив" AND genre2!="фэнтези")
AND (genre3!="сёдзё" AND genre3!="сёнэн" AND genre3!="%комедия" AND genre3!="приключения" AND genre3!="детектив" AND genre3!="фэнтези"))
GROUP BY books.isbn ORDER BY';
?>
