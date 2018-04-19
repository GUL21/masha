<?php
	define('myeshop', true);
	include("include/db_connect.php");
	include("functions/functions.php");

	$celebration = clear_string($_GET["celebration"]);
	$type = clear_string($_GET["type"]);
?>
<!DOCTYPE html>
<html>
<head>
	<title>MASHA</title>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
		<div id="index-body">
			<div id="header">
				<?php 
					include "include/header.php";
				?>
			</div>
			<div id="left">
				<?php 
					include "include/left.php";
				?>
			</div>
			<a href="cart.php?action=oneclick">
				<?php
				$result = mysql_query("SELECT * FROM celebrations WHERE celebration='$celebration' AND cel_visible='1'",$link);  

if (mysql_num_rows($result) > 0)
{
 $row = mysql_fetch_array($result); 
 
 do
 {

  echo '
  <audio src="sound/'.$row["music"].'" autoplay></audio>
  <img src="basket/'.$row["basket"].'" class="korzina">  
  ';     
 }
    while ($row = mysql_fetch_array($result));
} 
				?>
			</a>
			<div id="right">
				<?php 
					include "include/right.php";
				?>
			</div>
			<div id="content">
				<center>
					<h2>КАТЕГОРИИ</h2>
				</center>
<ul class="categoria">

<?php
  $result = mysql_query("SELECT * FROM category WHERE cat_visible='1' AND praznik='$celebration'",$link);  

if (mysql_num_rows($result) > 0)
{
 $row = mysql_fetch_array($result); 
 
 do
 {

if  ($row["picture"] != "" && file_exists("category/".$row["picture"]))
{
$img_path = 'category/'.$row["picture"];
$max_width = 150; 
$max_height = 150; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
$width = intval($ratio*$width); 
$height = intval($ratio*$height);    
}
  
  echo '
  <a href="view_tovar.php?celebration='.$celebration.'&type='.$row["type"].'">
  <li>
    <div>
    <center>
      <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'">
      <p>'.$row["type"].'</p>
    </center>
  </div>
  </li>
  </a>
  ';
  
    
 }
    while ($row = mysql_fetch_array($result));
} 

?>
</ul>
			</div>

			<div id="footer">
				<?php 
					include "include/footer.php";
				?>
			</div>
		</div>
</body>
</html>