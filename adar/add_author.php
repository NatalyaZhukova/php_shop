<?php
include_once 'db.php'; // ������������ � ���� ������ 
if (!isset($_REQUEST['sf'])){ // ���������, ���������� �� �����.{
echo '
<form action="add_author.php" method="post" enctype="multipart/form-data">
    <pre>
   ��� ������ �� �������:   <input type="text" name="author_name_rus" size="40">
��� ������ �� ����������:   <input type="text" name="author_name_eng" size="40">
               ���������:   <textarea rows="10" cols="70" name="bio"></textarea>
              ����������:   <input type="file" name="photo">
 <input type="hidden" name="sf" value="y">
                            <input type="submit" value="�������� � ����"><input type="reset">
    </pre>   
    
</form>';}
else
if (isset($_POST['author_name_rus']) &&
 isset($_POST['author_name_eng'])) {
 $author_name_rus = $_POST['author_name_rus'];
 $author_name_eng = $_POST['author_name_eng'];
 $bio = $_POST['bio'];
   if (isset($_FILES)){
    $name=$_FILES['photo']['name'];
    switch ($_FILES['photo']['type']) {
        case 'image/jpeg': $ext='jpg'; break;
        case 'image/gif': $ext='gif'; break;
        case 'image/png': $ext='png'; break;
        default: $ext=''; break; }
         if (isset($ext)){
             $dirname = "photos/";
       $n = "$author_name_eng.$ext"; 
       move_uploaded_file($_FILES['photo']['tmp_name'], $dirname.$n);
       $photo=$dirname.$n;
                           }
 else  echo "������������ ��� �����";
   }   else {$photo="�� ������";  }
 $query = "INSERT INTO authors (author_name_rus, author_name_eng, biography, photo) VALUES ('$author_name_rus', '$author_name_eng', '$bio', '$photo')";
 if (!mysql_query($query)){echo mysql_error();}
  }
?>