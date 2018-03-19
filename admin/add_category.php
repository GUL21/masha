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
  $_SESSION['urlpage'] = "<a href='index.php'>Главная</a><span id='slash'> \ </span><a href='tovar.php'>Товары</a><span id='slash'> \ </span><a>Добавить категорию</a>";
  
  include("include/db_connect.php");
  // include("include/functions.php");
  // require "libs/DB.php";

  //     if (isset($_POST['submit_add']))
  //     {
  //       $good = R::dispen

  //     }
  //   }
      if(isset($_POST['submit_add_cat']))
      {
        $picture = $_POST['form_picture'];
        $praznik = $_POST['form_praznik'];
        $type = $_POST['form_type'];
        $visible = $_POST["chk_visible"];

        mysql_query("INSERT INTO category 
                     (picture, type, praznik, cat_visible)
                     VALUES('$picture', '$type', '$praznik', '$visible')");
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
        <span id="all_goods">ДОБАВЛЕНИЕ КАТЕГОРИИ</span>
      </div>
      <form method="POST" action="add_category.php">
        <ul id="edit-tovar">
          <li>
            <label>Название категории</label>
              <input type="text" name="form_praznik">
          </li>
          <li>
            <label>Праздник</label>
              <select name="form_praznik" size="1">
                <?php
                  $praznik = mysql_query("SELECT celebration FROM celebrations WHERE celebration != ''",$link);
                  if (mysql_num_rows($praznik) > 0)
                  {
                    $praz = mysql_fetch_array($praznik);
                    do
                    {
                      echo '
                        <option>'.$praz["celebration"].'</option>
                           ';    
                    }
                    while ($praz = mysql_fetch_array($praznik));
                  }
                ?> 
              </select><br>
          <li>
            <label>Изображение</label>
              <input type="file" name="form_picture" id="picture">
          </li>
</ul>   
<ul id="chkbox">
  <li>
    <input type="checkbox" name="chk_visible" id="chk_visible" value="1"><label for="chk_visible">Видимая категория</label>
  </li>
</ul> 
    <p align="right"><input type="submit" id="submit_form" name="submit_add_cat" value="Добавить категорию"/></p>     
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