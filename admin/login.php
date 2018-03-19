<?php
    session_start();
    define("myeshop", true);
    include("include/db_connect.php");
    include("include/functions.php");

    

    if (isset($_POST['submit_enter']))
 {
 
    $login = $_POST["input_login"];
    $pass  = $_POST["input_pass"];
    
  
 if ($login && $pass)
  {   
   $result = mysql_query("SELECT * FROM reg_admin WHERE login = '$login' AND pass = '$pass'",$link);
   
 If (mysql_num_rows($result) > 0)
  {
    $row = mysql_fetch_array($result);

    $_SESSION['auth_admin'] = 'yes_auth'; 
    
    header("Location: index.php");
  }else
  {
        $msgerror = "Неверный Логин и(или) Пароль."; 
  }

        
    }else
    {
        $msgerror = "Заполните все поля!";
    }
 }
 
?>﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta charset="utf-8">
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style-login.css" rel="stylesheet" type="text/css" />

  <title>Панель управления - Вход</title>
</head>
<body>

<div id="block-pass-login" >
<?php
  
    if ($msgerror)
    {
        echo '<p id="msgerror" >'.$msgerror.'</p>';
        
    }
    
?>
<form method="post" >
<ul id="pass-login">
<li><label>Логин</label><input type="text" name="input_login" /></li>
<li><label>Пароль</label><input type="password" name="input_pass" /></li>
</ul>
<p align="right"><input type="submit" name="submit_enter" id="submit_enter" value="Вход" /></p>
</form>

</div>


</body>
</html>