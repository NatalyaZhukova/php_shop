<?php session_start();
include_once 'adar/db.php'; // ����������� � ���� ������
$shablon ='/^[0-9]{1,}/'; //������ 
if (
        (!preg_match($shablon, $_REQUEST['id'])) || // �������� �� ������������ ������������� �������� �������
        (empty($_REQUEST['id'])) ||  
        (!isset($_REQUEST['id']))
  ) {
    header("Location: http://mangamag/"); 
  }
  else{
  $news=  mysql_query('SELECT * FROM news WHERE id_news="'.$_REQUEST['id'].'"');   
  $date=mysql_query('SELECT UNIX_TIMESTAMP(date) AS timestamp FROM news WHERE id_news="'.$_REQUEST['id'].'"');
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<center>
<div  id="maindiv">
<?php
include ('header.php');
include ('menu.tpl');
?>
<div id="contentblock">
    <H2 class="title"><?php echo mysql_result($news, 0, 'title');?></H2>
    <i><?php echo  date('j-m-Y', mysql_result($date, 0, 'timestamp')); ?></i><br><br>
<?php echo mysql_result($news, 0, 'text');?>
</div>

<?php
include ('footer.tpl');
?>
</div>
<center>

</body>
</html>
<?php } ?>