<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth")
{
  define('myeshop', true);
       
       if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
        header("Cache-Control: no-store,no-cache,mustrevalidate");
    }
  $_SESSION['urlpage'] = "<a href='index.php'>Главная</a><span id='slash'> \ </span><a href='category.php'>Категории</a><span id='slash'> \ </span><a>Изменить категорию</a>";
  
  include("include/db_connect.php");
  include("include/functions.php");
    $id = clear_string($_GET["id"]);
  $action = clear_string($_GET["action"]);

  if (isset($action))
{
   switch ($action) 
   {

      case 'delete':
         
         if (file_exists("../category/".$_GET["img"]))
        {
          unlink("../category/".$_GET["img"]);  
        }
            
      break;

  } 
}

  if (empty($_POST["cat_image"]))
      {        
      include("actions/upload-category.php");
      unset($_POST["cat_image"]);           
      } 

      if(isset($_POST['submit_save_cat']))
      {

        mysql_query("UPDATE category SET type='{$_POST['form_type']}', praznik='{$_POST['form_praznik']}', cat_visible='{$_POST['chk_visible']}' WHERE id='$id'");
      }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Панель управления</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/reset.css">
  <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
  <div id="block-body">
    <?php
      include("include/block-header.php");
    ?>
    <div id="block-content">
      <div id="block-parameters">
        <span id="all_goods">ИЗМЕНЕНИЕ КАТЕГОРИИ</span>
      </div>
      <?php
        $result = mysql_query("SELECT * FROM category WHERE id='$id'", $link);
        if (mysql_num_rows($result) > 0)
        {
          $row = mysql_fetch_array($result);
          do
          {
              echo '
                <form method="POST" enctype="multipart/form-data">
        <ul id="edit-tovar">
          <li>
            <label>Название категории</label>
              <input type="text" name="form_type" value="'.$row["type"].'">
          </li>
          <li>
            <label>Праздник</label>
            <input type="text" name="form_praznik" id="number" value="'.$row["praznik"].'">
          </li>
          <li>
              <select name="form_praznik" size="5">
              ';
                  $praznik = mysql_query("SELECT celebration FROM celebrations WHERE celebration != ''",$link);
                  if (mysql_num_rows($praznik) > 0)
                  {
                    $praz = mysql_fetch_array($praznik);
                    do
                    {
                      echo '
                        <option value="'.$praz["celebration"].'">'.$praz["celebration"].'</option>
                           ';    
                    }
                    while ($praz = mysql_fetch_array($praznik));
                  }
                  echo '
                  </select><br><br>
              ';

                  if ($row["cat_visible"] == '1') $checked1 = "checked";

if  (strlen($row["picture"]) > 0 && file_exists("../category/".$row["picture"]))
{
$img_path = '../category/'.$row["picture"];
$max_width = 110; 
$max_height = 110; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
// New dimensions 
$width = intval($ratio*$width); 
$height = intval($ratio*$height); 

echo '
</li>
<label class="stylelabel" >Изображение</label>
<div id="baseimg">
<img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
<a href="edit_category.php?id='.$row["id"].'&img='.$row["picture"].'&action=delete" ></a>
</div>

';
   
}else
{  
echo '
<label class="stylelabel" >Изображение</label>

<div id="baseimg-upload">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
<input type="file" name="cat_image" />

</div>
';
}
echo'
</ul>   
<ul id="chkbox">
  <li>
    <input type="checkbox" name="chk_visible" id="chk_visible" '.$checked1.' value="1"><label for="chk_visible">Видимая категория</label>
  </li>
</ul> 
    <p><input type="submit" id="submit_save" name="submit_save_cat" value="Сохранить"/></p>     
</form>
';
                   } while ($row = mysql_fetch_array($result));
                  }
                ?> 
              
    </div>  
  </div>
</body>
</html>
<?php
}else
{
    header("Location: login.php");
}
?>