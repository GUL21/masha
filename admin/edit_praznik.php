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

      if(isset($_POST['save']))
      {

        mysql_query("UPDATE celebrations SET img='{$_POST['form_img']}', celebration='{$_POST['form_celebration']}', music='{$_POST['form_music']}', basket='{$_POST['form_basket']}', cel_visible='{$_POST['chk_visible']}' WHERE id='$id'");
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

                  echo '
          <li>
            <label>Изображение</label>
              <input type="text" name="form_img" id="number" value="'.$row["img"].'"><br><br>
              <input type="file" name="form_img_new">
          </li>
          <li>
            <label>Вид корзины</label>
              <input type="text" name="form_basket" id="number" value="'.$row["basket"].'">
              <br><br>
              <input type="file" name="form_basket_new">
          </li>
          <li>
            <label>Музыка</label>
              <input type="text" name="form_music" id="number" value="'.$row["music"].'">
              <br><br>
              <input type="file" name="form_music_new" value="'.$row["music"].'">
          </li>
</ul>   
<ul id="chkbox">
  <li>
    <input type="checkbox" name="cel_visible" id="chk_visible" '.$checked1.' value="1"><label for="cel_visible">Видимый праздник</label>
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