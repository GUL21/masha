<?php
	defined('myeshop');

	$result1 = mysql_query("SELECT * FROM orders WHERE order_confirmed=''",$link);
    $count1 = mysql_num_rows($result1);
    
    if ($count1 > 0) { $count_str1 = '<p>+'.$count1.'</p>'; } else { $count_str1 = ''; }
?>
<div id="block-header">
	<div id="block-header1">
		<img src="images/MAS.png" width="200" height="60">
		<p id="link-nav"><?php echo $_SESSION['urlpage'] ?></p>
		<img src="images/panel.gif" id="panel">	
	</div>
	<div id="block-header2">
		<p align="right">Здравствуйте!</p>
		<p align="right"><a href="?logout">Выход</a></p>
		
	</div>
</div>
<div id="left-nav">
	<ul>
		<li>
			<a href="orders.php">Заказы</a>
			<p><?php echo $count_str1; ?></p>
		</li>
		<li><a href="tovar.php">Товары</a></li>
		<li><a href="cat.php">Категории</a></li>
		<li><a href="praznik.php">Праздники</a></li>
	</ul>
	<img src="images/ma.png" width="130" height="200" id="ma">
</div>