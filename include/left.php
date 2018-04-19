<?php
	define('myeshop', true);
	include("include/db_connect.php");
?>
<ul id="list">
	<?php
  		$result = mysql_query("SELECT * FROM celebrations",$link);  
		if (mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_array($result); 
			do
			{ 
				  echo '
				  <li>
				  	<a href="view_content.php?celebration='.$row["celebration"].'">
				  		<img src="logos/'.$row["img"].'" width="300" height="60">
				  	</a>
				  </li>
				  ';
  
    
 }
    while ($row = mysql_fetch_array($result));
} 

?>
</ul>