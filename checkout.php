<?php session_start(); 
 include_once 'adar/db.php';
 if (empty($_SESSION['order'])) {
header("Location: http://mangamag/");  
}
$order=join('","', $_SESSION['order']);
$korzina=mysql_query('SELECT * FROM books WHERE books.isbn IN ("'. $order . '")');
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
 <div id="zakaz" align="center">    
        <H4>�� ��������:</H4><br>
<?php for ($i=0; $i<count($_SESSION['order']); $i++) {
echo mysql_result($korzina, $i, 'series').', ' . mysql_result($korzina, $i, 'title'). ' - '. $_SESSION['kolvo'][$i]. ' ��.<br>';}
?>
�� ����� <?php echo $_SESSION['sum']; ?> ������</div><br>
<form action="process.php" method="post">
�������� ������ ��������:<br>
<input type="radio" name="dost" value="0" checked >�������� �� ������<br>
<input type="radio" name="dost" value="1"> ���������� �������� �� �����<br>
<br>
<div align="right" style="width:50%">��� ���������� �������: <input type="text" name="phone"><br>
����� ��� ��������:<br>
�������� ������: <input type="text" name="zipcode"><br>
�������: <select name="area">
    <option>�������</option>    
    <option>���������</option> 
    <option>�����������</option>
    <option>�����������</option>
    <option>����������</option>
    <option>���������</option> 
</select><br>
�����(���� ����������):<input type="text" name="district"><br>
�����\��������� �������\�������: <input type="text" name="city"><br>
�����: <input type="text" name="address" size="30"><br>
<input type="submit" value="����������� �����">
</div>
</form>   
    
    
    
</div>

<?php
include ('footer.tpl');
?>
</div>
<center>

</body>
</html>