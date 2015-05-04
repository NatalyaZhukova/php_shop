<?php
$db_hostname="localhost";
$db_user="shopbase";
$db_password="17011992";
$db_database = "shopbase";
$db_server = mysql_connect($db_hostname, $db_user, $db_password);
mysql_query("SET NAMES 'cp1251';");

if (!$db_server) die("Невозможно подключиться к MySQL". mysql_error ());
mysql_select_db($db_database);
?>
