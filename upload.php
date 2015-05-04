<?php
echo date(" j F, t ", time());

echo <<< _END
<form method='post' action='upload.php' enctype='multipart/form-data'>
<input type="file" name='filename' size='20'>
<input type="submit"></form>
_END;

if ($_FILES){
    $name=$_FILES['filename']['name'];
    switch ($_FILES['filename']['type']) {
        case 'image/jpeg': $ext='jpg'; break;
        case 'image/gif': $ext='gif'; break;
        case 'image/png': $ext='png'; break;
        default: $ext=''; break; }
    if ($ext){
       $n = "image.$ext"; 
       move_uploaded_file($_FILES['filename']['tmp_name'], $n);
       echo $name,'<br>';
       echo '<img src="',$n,'">';}
 else  echo "Неприемлемый тип файла";
   }     
  
              
    
    

    
?>
