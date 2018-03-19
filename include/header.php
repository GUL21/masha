<div id="logo">
	<img src="img/MAS.png" id="img-logo">
</div>
<ul align="right" id="whish">
	<li><a href="index.php">Главная</a></li>
	<li><a href="whishes.php?action=confirm">Пожелания</a></li>
	<li>
		<div id="block-search">
			<form method="GET" action="search.php?q=">
				<img src="img/search.ico"><input type="text" name="q" placeholder="Поиск среди более 100 000 товаров" value="<?php echo $search; ?>" id="input-search">
				<input type="submit" id="button-search" value="Найти">
			</form>
		</div>
	</li>
</ul>