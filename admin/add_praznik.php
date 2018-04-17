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
  // include("include/functions.php");
  // require "libs/DB.php";

  //     if (isset($_POST['submit_add']))
  //     {
  //       $good = R::dispen

  //     }
  //   }
      if(isset($_POST['submit_add_praz']))
      {
        $img = $_POST['form_img'];
        $celebration = $_POST['form_celebration'];
        $music = $_POST['form_music'];
        $basket = $_POST['form_basket'];
        $vis = $_POST['vis'];

        mysql_query("INSERT INTO celebrations 
                     (img, celebration, music, basket, cel_visible)
                     VALUES('$img', '$celebration', '$music', '$basket', '$vis')");
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
      <form method="POST" action="add_praznik.php">
        <ul id="edit-tovar">
          <li>
            <label>Название праздника</label>
              <input type="text" name="form_celebration">
          </li>
          <li>
            <label>Изображение</label>
              <input type="file" name="form_img" id="picture">
          </li>
          <li>
            <label>Вид корзины</label>
              <input type="file" name="form_basket" id="picture">
          </li>
          <li>
            <label>Музыка</label>
              <input type="file" name="form_music" id="picture">
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