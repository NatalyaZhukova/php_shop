<?php 
session_start(); 
include_once 'adar/db.php';
include_once 'cat.php';
define(ONPAGE, 9);
$g=$_REQUEST['g'];
$p=$_REQUEST['p'];
$s=$_REQUEST['s'];
if (empty($_REQUEST['p'])) $p=1;
if(empty($_REQUEST['g'])) $g=0;
if (empty($_REQUEST['s'])) $s=0;
switch ($g){
case 0: $temp = $cat0; $text="Ѹ��"; break;
case 1: $temp = $cat1; $text="Ѹ���"; break;
case 2: $temp = $cat2; $text="�������"; break;
case 3: $temp = $cat3; $text="�����������"; break;
case 4: $temp = $cat4; $text="��������"; break;
case 5: $temp = $cat5; $text="�������"; break;
case 6: $temp = $cat6; $text="������ �����"; break;
default : $temp = $cat0; $text="Ѹ���"; break;}
switch ($s){
case 2: $genre = mysql_query($temp . " price DESC"); break;
case 1: $genre = mysql_query($temp . ' price'); break;
case 0: $genre = mysql_query($temp . ' added_date DESC'); break;
case 3: $genre = mysql_query($temp . ' added_date'); break;
default: $genre = mysql_query($temp . 'price DESC'); break;}
$rows= mysql_num_rows($genre);
if($rows%ONPAGE!=0){$numpage=(int)($rows/ONPAGE)+1;}
else {$numpage=(int)($rows/ONPAGE);}
if (($p>$numpage) || ($p<1)) $p=1;
if ($rows<ONPAGE) $opage=$rows; else $opage=$p*ONPAGE;
if (($p==$numpage)&& ($rows%ONPAGE>0)) $opage=($p-1)*ONPAGE+$rows%ONPAGE;
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
    <div align="center" style="float:left; width:100%"> �� ����������: ������� ->> <?php echo $text; ?><br><br></div>
<div id="sort" style="float:left; width:100%">
����������� �� ����: <a class="down" href="genres.php?g=<?php echo $g; ?>&s=2">�� ��������</a> <a class="up" href="genres.php?g=<?php echo $g; ?>&s=1">�� �����������</a> <br>
����������� �� �������: <a class="down" href="genres.php?g=<?php echo $g; ?>&s=0"> ����� �����</a> <a class="up" href="genres.php?g=<?php echo $g; ?>&s=3">����� ������</a> <br>
<br>
</div>
<div id="items" style="float:left; width:100%; border:1px dotted lightcoral" >
<?php for ($i=($p-1)*ONPAGE;$i<$opage;$i++){ ?>
<div style="width: 233.3px; height:280px; float:left; border:double whitesmoke">
<center> <b> <a class="titles" href="item.php?id=<?php echo mysql_result($genre,$i,'isbn') ?>"><?php echo mysql_result($genre,$i,'series').'. '. mysql_result($genre,$i,'title'); ?></a> </b><br>
<i class="titles"><?php echo mysql_result($genre, $i, 'aut'); ?></i> <br>
<img src="adar/<?php echo mysql_result($genre,$i,'cover'); ?>" width="100" height="150"><br>
<b> <?php echo mysql_result($genre,$i,'price'); ?></b> ������<br>
 <a  class="order" href="korzina.php?id=<?php echo mysql_result($genre,$i,'isbn');?>">� �������</a><br>	 
	 </center>
	 </div>
     	 <?php } ?>
     <br> 
</div>
<div id="pages">
<center>
  <?php for ($j=1; $j<$numpage+1;$j++) { 
  echo '<a class="page" href="genres.php?g=', $g,'&amp;p=', $j,'&amp;s=', $s,'">', $j,'</a>';
  echo ' '; }
  ?>
</center>
</div>  
</div>
<?php
include ('footer.tpl');
?>
<center>

</body>
</html>