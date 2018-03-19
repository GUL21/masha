<?php
require ("libs/rb.php");
defined('myeshop') or die('Нет контакта!');
$db_host		= 'localhost';
$db_user		= 'voldemar';
$db_pass		= 'vova2102';
$db_database	= 'MASHA'; 

$link = mysql_connect($db_host,$db_user,$db_pass);

mysql_select_db($db_database,$link) or die("Нет контакта".mysql_error());
?>