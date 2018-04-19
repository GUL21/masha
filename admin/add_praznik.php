<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth")
{
  define('myeshop', true);
       
       if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }
  $_SESSION['urlpage'] = "<a href='index.php'>Главная</a><span id='slash'> \ </span><a href='tovar.php'>Праздники</a><span id='slash'> \ </span><a>Добавить праздник</a>";
  
  include("include/db_connect.php");
  include("include/functions.php");

      if(isset($_POST['submit_add_praz']))
      {
        $celebration = $_POST['form_celebration'];
        $vis = $_POST['vis'];

        mysql_query("INSERT INTO celebrations 
                     (celebration, cel_visible)
                     VALUES('$celebration', '$vis')");
      }

      $id = mysql_insert_id();
      if(empty($_POST["form_img"]))
      {
        include("actions/upload-logos.php");
        unset($_POST["form_img"]);
      }

      if(empty($_POST["form_basket"]))
      {
        include("actions/upload-basket.php");
        unset($_POST["form_basket"]);
      }

       if(empty($_POST["form_music"]))
      {
        include("actions/upload-music.php");
        unset($_POST["form_music"]);
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
        <span id="all_goods">ДОБАВЛЕНИЕ ПРАЗДНИКА</span>
      </div>
      <form method="POST" action="add_praznik.php" enctype="multipart/form-data">
        <ul id="edit-tovar">
          <li>
            <label>Название праздника</label>
              <input type="text" name="form_celebration">
          </li>
          <li>
            <label>Изображение</label>
              <div id="img-upload">
                <input type="file" name="form_img">
            </div>
          </li>
          <li>
            <label>Вид корзины</label>
              <div id="img-upload">
                <input type="file" name="form_basket">
            </div>
          </li>
          <li>
            <label>Музыка</label>
              <div id="img-upload">
                <input type="file" name="form_music">
            </div>
          </li>
</ul>   
<ul id="chkbox">
  <li>
    <input type="checkbox" name="vis" id="chk_visible" value="1"><label for="chk_visible">Видимый праздник</label>
  </li>
</ul> 
    <p align="right"><input type="submit" id="submit_form" name="submit_add_praz" value="Добавить праздник"/></p>     
</form>
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