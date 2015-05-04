<?php session_start(); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<center>
<div  id="maindiv">
<?php
include ('header.php');
include ('poisk.tpl');
include ('menu.tpl');
?>
<div id="contentblock">
 Манга - это японские комиксы, по которым собственно и снимают аниме.
 Манга пользуется огромной популярностью во всем мире и читают ее практически в каждой стране. 
 В нашем магазине представлена манга, лицензированная и переведенная на русский язык.
</div>
<?php
include ('footer.tpl');
?>
</div>
<center>

</body>
</html>
