<?php

  include_once 'src/php/action/database.php';

  if(isset($_COOKIE['username'])) {
    $user_db = new database();
    if($user_db->relogin($_COOKIE['username'])){
      header('location:/homepage');
    }
  } else if (isset($_COOKIE['login'])) {
      echo '<script language="javascript">';

      if ($_COOKIE['login'] === '1'){
        echo 'alert("You  have to login first")';
      } else if ($_COOKIE['login']==='2') {
        echo 'alert("Username or password does not match")';

      } else if($_COOKIE['login']==='3'){
        echo 'alert("Register completed!")';
      }
      echo '</script>';

      setcookie('login','',0,'/');


    }

  
    
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/">
    <link rel="stylesheet" href="src/css/form.css">
    <link rel="stylesheet" href="src/css/app.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body class="center-screen">
    <div class="title">Willy Wangko Choco Factory</div>
    <div class="form">
      <form action="src/php/action/action_login.php" method="post">
       
        <input type="text" id="email" name="email" placeholder="EMAIL" required><br><br>
  
        <input type="password" id="password" name="password" placeholder="PASSWORD" required><br><br>
          <br>
        <div style="text-align: center;">      
          <input type="submit" value="Login">
          <br>
          <a href="/register">
            New user?
            <span style="text-decoration: underline;">
              Create an account
            </span>
          </a>
        </div>
    </form>
  </div>
</body>
</html>