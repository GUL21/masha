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
  $_SESSION['urlpage'] = "<a href='index.php'>Главная</a><span id='slash'> \ </span><a href='tovar.php'>Товары</a><span id='slash'> \ </span><a>Добавить товар</a>";
  
  include("include/db_connect.php");
  include("include/functions.php");

  

      if(isset($_POST['submit_add']))
      {
        $type = $_POST['form_category'];
        $title = $_POST['form_title'];
        $price = $_POST['form_price'];
        $visible = $_POST["chk_visible"];

        mysql_query("INSERT INTO table_products 
                     (title, price, visible, type_tovara)
                     VALUES('$title', '$price', '$visible', '$type')");
      }
      
      $id = mysql_insert_id();
      if(empty($_POST["upload_image"]))
      {
        include("actions/upload-image.php");
        unset($_POST["upload_image"]);
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
        <span id="all_goods">ДОБАВЛЕНИЕ ТОВАРА</span>
      </div>
      <form enctype="multipart/form-data" method="POST" action="add_product.php">
        <ul id="edit-tovar">
          <li>
            <label>Название товара</label>
              <input type="text" name="form_title">
          </li>
          <li>
            <label>Цена</label>
              <input type="number" name="form_price" id="number">
          </li>
          <li>
            <label>Тип товара</label>
              <select name="form_category" size="1">
                <?php
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
                ?> 
              </select><br>
          <li>
            <label>Изображение</label>
            <div id="img-upload">
              <input type="file" name="upload_image">
            </div>
          </li>
</ul>   
<ul id="chkbox">
  <li>
    <input type="checkbox" name="chk_visible" id="chk_visible" value="1"><label for="chk_visible">Видимый товар</label>
  </li>
</ul> 


    <p align="right"><input type="submit" id="submit_form" name="submit_add" value="Добавить товар"/></p>     
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