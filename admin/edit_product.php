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
  $_SESSION['urlpage'] = "<a href='index.php'>Главная</a><span id='slash'> \ </span><a href='tovar.php'>Товары</a><span id='slash'> \ </span><a>Изменить товар</a>";
  
  include("include/db_connect.php");
  include("include/functions.php");
  $id = clear_string($_GET["id"]);

      if(isset($_POST['submit_save']))
      {

        mysql_query("UPDATE table_products SET image='{$_POST['form_picture']}', title='{$_POST['form_title']}', price='{$_POST['form_price']}', type_tovara='{$_POST['form_category']}', visible='{$_POST['chk_visible']}' WHERE products_id='$id'");
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
        <span id="all_goods">ИЗМЕНЕНИЕ ТОВАРА</span>
      </div>
      <?php
        $result = mysql_query("SELECT * FROM table_products WHERE products_id='$id'", $link);
        if (mysql_num_rows($result) > 0)
        {
          $row = mysql_fetch_array($result);
          do
          {
              echo '
                <form method="POST" enctype="multipart/form-data">
        <ul id="edit-tovar">
          <li>
            <label>Название товара</label>
              <input type="text" name="form_title" value="'.$row["title"].'">
          </li>
          <li>
            <label>Цена</label>
              <input type="number" name="form_price" id="number" value="'.$row["price"].'">
          </li>
          <li>
            <label>Категория</label>
            <input type="text" name="form_category" id="number" value="'.$row["type_tovara"].'">
              <select name="form_category" size="1">
              ';
                  $category = mysql_query("SELECT type FROM category WHERE type != ''",$link);
                  if (mysql_num_rows($category) > 0)
                  {
                    $result_category = mysql_fetch_array($category);
                    do
                    {
                      echo '
                        <option>'.$result_category["type"].'</option>
                           ';    
                    }
                    while ($result_category = mysql_fetch_array($category));
                  }
                  echo '
                  </select><br><br>
              ';

                  if ($row["visible"] == '1') $checked1 = "checked";

                  echo '
                  </select>
          </li>
          <li>
            <label>Изображение</label>
              <input type="text" name="form_picture" id="number" value="'.$row["image"].'">
          </li>
</ul>   
<ul id="chkbox">
  <li>
    <input type="checkbox" name="chk_visible" id="chk_visible" '.$checked1.' value="1"><label for="chk_visible">Видимый товар</label>
  </li>
</ul> 
    <p><input type="submit" id="submit_save" name="submit_save" value="Сохранить"/></p>     
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