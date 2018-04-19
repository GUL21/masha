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
  $_SESSION['urlpage'] = "<a href='index.php'>Главная</a><span id='slash'> \ </span><a href='praznik.php'>Праздники</a><span id='slash'> \ </span><a>Изменить праздник</a>";
  
  include("include/db_connect.php");
  include("include/functions.php");
  $id = clear_string($_GET["id"]);
  $action = clear_string($_GET["action"]);
  if (isset($action))
{
   switch ($action) 
   {

      case 'delete':
         
          if (file_exists("../sound/".$_GET["audio"]))
        {
          unlink("../sound/".$_GET["audio"]);  
        }

        break;

      case 'delete_1':
         
          if (file_exists("../basket/".$_GET["img"]))
        {
          unlink("../basket/".$_GET["img"]);  
        }

        break;

      case 'delete_2':
          
          if (file_exists("../logos/".$_GET["img"]))
        {
          unlink("../logos/".$_GET["img"]);  
        }
        
      break;

  }  
}

        if (empty($_POST["form_music"]))
        {        
          include("actions/upload-music.php");
          unset($_POST["form_music"]);           
        }

        if (empty($_POST["form_img"]))
        {        
        include("actions/upload-logos.php");
        unset($_POST["form_img"]);           
        } 

        if (empty($_POST["form_img"]))
        {        
          include("actions/upload-basket.php");
          unset($_POST["form_basket"]);           
        } 


      if(isset($_POST['save']))
      {

        mysql_query("UPDATE celebrations SET celebration='{$_POST['form_celebration']}', cel_visible='{$_POST['cel_visible']}' WHERE cel_id='$id'");
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
        <span id="all_goods">ИЗМЕНЕНИЕ ПРАЗДНИКА</span>
      </div>
      <?php
        $result = mysql_query("SELECT * FROM celebrations WHERE cel_id='$id'", $link);
        if (mysql_num_rows($result) > 0)
        {
          $row = mysql_fetch_array($result);
          do
          {
              echo '
                <form method="POST" enctype="multipart/form-data">
        <ul id="edit-tovar">
          <li>
            <label>Название праздника</label>
              <input type="text" name="form_celebration" value="'.$row["celebration"].'">
          </li>
              ';

                  if ($row["cel_visible"] == '1') $checked1 = "checked";
if  (strlen($row["img"]) > 0 && file_exists("../logos/".$row["img"]))
{
$img_path = '../logos/'.$row["img"];
$max_width = 300; 
$max_height = 110; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
// New dimensions 
$width = intval($ratio*$width); 
$height = intval($ratio*$height);
                  echo '
          <li>
            <label>Изображение</label>
              <div id="baseimg">
                <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
                <a href="edit_praznik.php?id='.$row["cel_id"].'&img='.$row["img"].'&action=delete_2" ></a>
              </div>
          </li>';
        }
        else
        {
          echo '
<label class="stylelabel" >Изображение</label>

<div id="baseimg-upload">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
<input type="file" name="form_img" />

</div>
';
        }
        if  (strlen($row["basket"]) > 0 && file_exists("../basket/".$row["basket"]))
{
$img_path = '../basket/'.$row["basket"];
$max_width = 110; 
$max_height = 110; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
// New dimensions 
$width = intval($ratio*$width); 
$height = intval($ratio*$height);
        echo'
          <li>
            <label>Вид корзины</label>
              <div id="baseimg">
                <img src="../basket/'.$row["basket"].'" width="110" height="110" />
                <a href="edit_praznik.php?id='.$row["cel_id"].'&img='.$row["basket"].'&action=delete_1" ></a>
              </div>
          </li>';
        }
        else
        {
          echo '
<label class="stylelabel" >Вид корзины</label>

<div id="baseimg-upload">
<input type="hidden" name="MAX_FILE_SIZE" value="900000000"/>
<input type="file" name="form_basket" />

</div>
';
        }
        if  (strlen($row["music"]) > 0 && file_exists("../sound/".$row["music"]))
        {
        echo '
          <li>
            <label>Музыка</label>
          </li>
          <li>
              <div id="baseimg">
                <audio controls="controls">
                    <source src="../sound/'.$row["music"].'" type="audio/ogg; codecs=vorbis">
                </audio>
                <a href="edit_praznik.php?id='.$row["cel_id"].'&audio='.$row["music"].'&action=delete" ></a>
              </div>
          </li>';
        }
        else
        {
          echo '
<label class="stylelabel" >Музыка</label>

<div id="baseimg-upload">
<input type="hidden" name="MAX_FILE_SIZE" value="900000000000000"/>
<input type="file" name="form_music" />

</div>
';
        }
        echo'

</ul>   
<ul id="chkbox">
  <li>
    <input type="checkbox" name="cel_visible" id="chk_visible" '.$checked1.' value="1"><label for="chk_visible">Видимый праздник</label>
  </li>
</ul> 
    <p><input type="submit" id="submit_save" name="save" value="Сохранить"/></p>     
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