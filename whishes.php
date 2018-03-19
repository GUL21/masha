<?php
  define('myeshop', true);
  include("include/db_connect.php");
  include("functions/functions.php");

  $celebration = clear_string($_GET["celebration"]);
  $type = clear_string($_GET["type"]);
  $id = clear_string($_GET["id"]);
  $action = clear_string($_GET["action"]);
    
  
  if (isset($_POST["submitdata"]))
{

$_SESSION["order_delivery"] = $_POST["order_delivery"];
$_SESSION["order_fio"] = $_POST["order_fio"];
$_SESSION["order_email"] = $_POST["order_email"];
$_SESSION["order_phone"] = $_POST["order_phone"];
$_SESSION["order_address"] = $_POST["order_address"];
$_SESSION["order_note"] = $_POST["order_note"];

    mysql_query("INSERT INTO orders(order_datetime,order_dostavka,order_fio,order_address,order_phone,order_note,order_email)
            VALUES( 
                             NOW(),
                            '".clear_string($_POST["order_delivery"])."',         
              '".clear_string($_POST["order_fio"])."',
                            '".clear_string($_POST["order_address"])."',
                            '".clear_string($_POST["order_phone"])."',
                            '".clear_string($_POST["order_note"])."',
                            '".clear_string($_POST["order_email"])."'                   
                )",$link);    

                          
 $_SESSION["order_id"] = mysql_insert_id();                          
                            
                            
header("Location: whishes.php?action=completion");
  
}      
?>
<!DOCTYPE html>
<html>
<head>
  <title>MASHA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/reset.css">
  <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
    <div id="index-body">
      <div id="header">
        <?php 
          include "include/header.php";
        ?>
      </div>
      <div id="left">
        <?php 
          include "include/left.php";
        ?>
      </div>
      <a href="cart.php?action=oneclick">
          <img src="img/mashka.png" id="korz">  
      </a>
      <div id="right">
        <?php 
          include "include/right.php";
        ?>
      </div>
      <div id="content">
          <?php
            $action = clear_string($_GET["action"]);
            switch ($action) {

                case 'confirm':
                  echo '
                    <div id="block-step">
                      <div id="name-step">
                        <ul>
                          <li><a class="active">1. Контактная информация</a></li>
                          <li><span>&rarr;</span></li>
                          <li><a>2. Завершение</a></li>
                        </ul>
                      </div>
                      <p>шаг 1 из 2</p>
                    </div>
                  ';
                  if ($_SESSION['order_delivery'] == "Курьером") $chck1 = "checked";
        if ($_SESSION['order_delivery'] == "НОВА ПОШТА") $chck2 = "checked";
 
          echo '
            <h3 class="title-h3" >Способ доставки:</h3>
            <form method="post" id="#form">
              <ul id="info-radio">
                <li>
                  <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery1" value="Курьером" '.$chck1.'>
                  <label class="label_delivery" for="order_delivery1">Курьером</label>
                </li>
                <li>
                  <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery2" value="НОВА ПОШТА" '.$chck2.'>
                  <label class="label_delivery" for="order_delivery2">НОВА ПОШТА</label>
                </li>              
              </ul>
              <h3 class="title-h3" >Информация для доставки:</h3>   
              ';
          echo '
              <ul id="info-order">
              <li><label for="order_fio"><span>*</span>ФИО</label><input type="text" name="order_fio" id="order_fio" value="'.$_SESSION["order_fio"].'" /></li>
              <li><label for="order_email"><span>*</span>E-mail</label><input type="text" name="order_email" id="order_email" value="'.$_SESSION["order_email"].'" /></li>
              <li><label for="order_phone"><span>*</span>Телефон</label><input type="text" name="order_phone" id="order_phone" value="'.$_SESSION["order_phone"].'" /></li>
              <li><label class="order_label_style" for="order_address"><span>*</span>Адрес<br /> доставки</label><input type="text" name="order_address" id="order_address" value="'.$_SESSION["order_address"].'" /></li>
            <li><label class="order_label_style" for="order_note"><span>*</span>Примечание</label><textarea name="order_note" placeholder="Подробно опишите вещь, которую хотите заказать">'.$_SESSION["order_note"].'</textarea></li>
              </ul>
          <p align="right"><input type="submit" name="submitdata" id="butto" value="Заказать"></p>
          </form>
          ';      
                break;

                case 'completion':
                  echo '
                    <div id="block-step">
                      <div id="name-step">
                        <ul>
                          <li><a href="whishes.php?action=confirm">1. Контактная информация</a></li>
                          <li><span>&rarr;</span></li>
                          <li><a class="active">2. Завершение</a></li>
                        </ul>
                      </div>
                      <p>шаг 2 из 2</p>
                    </div>
                  ';
                  echo '
                    <audio src="sound/prihodi.wav" autoplay></audio>
                    <div id="comp">
                      <img src="img/maria.png">
                      <p>Наш мастер ознакомится с вашим пожеланием и перезвонит в ближайшее время</p>
                    </div>
                  ';
                break;

                default:
                 case 'confirm':
        echo '
          <div id="block-step">
            <div id="name-step">
              <ul>
                <li><a class="active">1. Контактная информация</a></li>
                <li><span>&rarr;</span></li>
                <li><a>2. Завершение</a></li>
              </ul>
            </div>
            <p>шаг 1 из 2</p>
          </div>
        ';
      break;

      case 'completion':
        echo '
          <div id="block-step">
            <div id="name-step">
              <ul>
                <li><a>1. Контактная информация</a></li>
                <li><span>&rarr;</span></li>
                <li><a class="active">2. Завершение</a></li>
              </ul>
            </div>
            <p>шаг 2 из 2</p>
          </div>';
          break;
        }
        ?>
      </div>

      <div id="footer">
        <?php 
          include "include/footer.php";
        ?>
      </div>
    </div>
</body>
</html>