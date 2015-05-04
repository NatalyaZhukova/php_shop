<?php 
session_start();
$log=strip_tags(htmlentities(stripslashes(mysql_real_escape_string($_POST['login']))));
$pass=strip_tags(htmlentities(stripslashes(mysql_real_escape_string($_POST['pass'])))); 
require_once 'adar/db.php';
$res=mysql_query('SELECT username FROM users WHERE username="'.$log.'" AND password="'.$pass.'"');
if (mysql_num_rows($res)!=0) {
$_SESSION['name']=$log;

if (empty($_SESSION['order'])) {
 $korzina=mysql_query('SELECT * FROM korzina WHERE username="'.$log. '" GROUP BY isbn');
if (mysql_num_rows($korzina)!=0) {
for ($i=0; $i<mysql_num_rows($korzina); $i++){
    $_SESSION['order'][$i]=mysql_result($korzina, $i, 'isbn');
    $_SESSION['kolvo'][$i]=mysql_result($korzina, $i, 'number_books');
    }
    header("Location: http://localhost/bookshop/korzina.php");
}
else { header("Location: http://localhost/bookshop/");}
}
else {
for ($i=0; $i<count($_SESSION['order']); $i++){
$query1="INSERT INTO korzina(username, isbn, number_books) VALUES('".$log."', '".$_SESSION['order'][$i]."','".$_SESSION['kolvo'][$i]."')";
mysql_query($query1) or die(mysql_error());    
    }
unset ($_SESSION['order']); unset($_SESSION['kolvo']);
$korzina=mysql_query('SELECT * FROM korzina WHERE username="'.$log. '" GROUP BY isbn');
 for ($i=0; $i<mysql_num_rows($korzina); $i++){
    $_SESSION['order'][$i]=mysql_result($korzina, $i, 'isbn');
    $_SESSION['kolvo'][$i]=mysql_result($korzina, $i, 'number_books');
    }
    header("Location: http://localhost/bookshop/korzina.php");   
    }
 }
else header("Location: http://localhost/bookshop/wr.php"); 

//if (!empty($_POST['login'])){
//$_SESSION['name']=$_POST['login'];
//$SESSION['order']=array(); }
//header("Location:".$_SERVER['HTTP_REFERER']);}
if (isset($_GET['id']) && $_GET['id']=='out'){
unset($SESSION['name']);
session_destroy(); 
header("Location:".$_SERVER['HTTP_REFERER']);}
?>