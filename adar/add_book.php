<?php
include_once 'db.php'; // Подключаемся к базе данных 
if (!isset($_REQUEST['sf'])){ // Проверяем, показывали ли форму.
echo '
<form method="post" action="add_book.php" enctype="multipart/form-data">
<pre>
                ISBN:  <input type="text" name="isbn">
   Автор(английский):  <input type="text" name="author"> и <input type="text" name="author2"> 
        Издательство:  <select name="phouse">'; 
        //$phouses = array();
 $r = mysql_query("SELECT * FROM pub_house");
 if(mysql_num_rows($r)>0){
     for ($i=0; $i<mysql_num_rows($r); $i++) { 
        echo "<option value='",mysql_result($r, $i, 'id_pub_house'),"'>",mysql_result($r, $i, 'phouse_name'),"</option>";
    }}     
echo '</select> или добавить новое: <input type="text" name="phouse_n">
    Серия(если есть):  <input type="text" name="series">
Название(номер тома):  <input type="text" name="title">
         Год издания:  <input type="text" size="4" name="year">
  Количество страниц:  <input type="text" size="4" name="pages">
               Жанры:  <input type="text" name="genre1"> 
                       <input type="text" name="genre2">
                       <input type="text" name="genre3">
             Обложка:  <input type="file" name="cover" size="20">
           Аннотация:  <textarea rows="10" cols="50" name="summary"></textarea>
                Цена:  <input type="text" size="6" name="price">рублей<br>
       <input type="hidden" name="sf" value="y">
       <input type="submit" value="Добавить в базу"> <input type="reset">
    </pre>
</form>';}
else {
 if (isset($_POST['isbn']) &&
   isset($_POST['author']) &&
   isset($_POST['phouse']) &&      
    isset($_POST['title']) &&     
    isset($_POST['year']) &&
     isset($_POST['pages']) &&
      isset($_POST['genre1']) &&
      isset($_POST['summary']) &&  // Проверка, заполнены ли эти поля.
        isset($_POST['price'])){
     $isbn=$_POST['isbn'];
     $series=$_POST['series'];
     $title=$_POST['title'];
     $year=$_POST['year'];
     $annotation=$_POST['summary'];
     $price=$_POST['price'];
     $kolvo_stranic=$_POST['pages'];
     $genre1=$_POST['genre1'];
     $genre2=$_POST['genre2'];
     $genre3=$_POST['genre3'];
     $author=$_POST['author'];// Вытаскиваем введенные значения
    if (empty($_POST['phouse_n'])){
     $p_id=$_POST['phouse'];}
     else {$phouse=$_POST['phouse_n'];}
     
     if (isset($_FILES)){
        switch ($_FILES['cover']['type']) {
        case 'image/jpeg': $ext='jpg'; break;
        case 'image/gif': $ext='gif'; break;
        case 'image/png': $ext='png'; break;
        default: $ext=''; break; }
         if (isset($ext)){
             $dirname = "covers/";
       $n = "$isbn.$ext"; 
       move_uploaded_file($_FILES['cover']['tmp_name'], $dirname.$n);
       $cover=$dirname.$n;
                           }
 else  echo "Неприемлемый тип файла";
   }   else {$cover="не задана";  }

if (!empty($_POST['phouse_n'])) {    
mysql_query("INSERT INTO pub_house (phouse_name) VALUES ('$phouse')");
$p_id=  mysql_insert_id();
}} // Уже существующее в базе или новое издательство
        
     $query1 = "INSERT INTO books(isbn, pubhouse_id,  series, title, year, cover, annotation, price, kolvo_stranic, genre1, genre2, genre3) VALUES".
         "('$isbn','$p_id', '$series', '$title', '$year','$cover', '$annotation', '$price', '$kolvo_stranic', '$genre1', '$genre2','$genre3')";
  if(!mysql_query($query1)) {echo  mysql_error();}
  $query2 = "INSERT  INTO authors(author_name_eng) VALUES ('$author') ON DUPLICATE KEY UPDATE author_name_eng=author_name_eng";
   if(!mysql_query($query2)) echo  mysql_error();
   $query3 = "INSERT INTO authors_books(author_name_eng, isbn) VALUES ('$author','$isbn')";
  if(!mysql_query($query3)) echo  mysql_error();
$query4 = "INSERT INTO pubhouses_books(isbn, phouse_name) VALUES ('$isbn', '$phouse')";
if (!mysql_query($query4)){echo mysql_error();}
if (!empty($_POST['author2'])){
    $author2 = $_POST['author2'];
    $query5="INSERT  INTO authors(author_name_eng) VALUES ('$author2') ON DUPLICATE KEY UPDATE author_name_eng=author_name_eng";
    $query6 = "INSERT INTO authors_books(author_name_eng, isbn) VALUES ('$author2','$isbn')";
     if(!mysql_query($query5)) {echo  mysql_error();}
      if(!mysql_query($query6)) {echo  mysql_error();}
    }
 
    echo "Книга успешно добавлена";
    
    
    
}
?>