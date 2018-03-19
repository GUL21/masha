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

      if(isset($_POST['submit_save_cat']))
      {

        mysql_query("UPDATE category SET picture='{$_POST['form_picture']}', type='{$_POST['form_type']}', praznik='{$_POST['form_praznik']}', cat_visible='{$_POST['chk_visible']}' WHERE id='$id'");
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
              <select name="form_praznik" size="1">
              ';
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
                  echo '
                  </select><br><br>
              ';

                  if ($row["cat_visible"] == '1') $checked1 = "checked";

                  echo '
                  </select>
          </li>
          <li>
            <label>Изображение</label>
              <input type="text" name="form_picture" id="number" value="'.$row["picture"].'">
              <br><br>
              <input type="file" name="form_picture_new">
          </li>
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