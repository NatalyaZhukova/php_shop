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
 ������ �������������� 2 ���������: ��������� ��� �������� ������� � ���������� �������� �� �����.<br>
 �������� �������� �������������� �� ������ ������. �� ��������� ����������:<br>
 - ���� ����� ������� �� ��������� 100 000, - 10000 ������; <br>
 - ���� ����� ������� ��������� 100 000, - ���������;<br>
 ����� �������� �������� ������ �� ����� ���������� ��������. � ���� ������ ������������� � ����� ������ ����� ����� �������� ������ �����.
 
</div>

<?php
include ('footer.tpl');
?>
</div>
<center>

</body>
</html>