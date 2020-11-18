<?php
  include_once 'src/php/action/database.php';
  // include_once 'src/php/template/navbar.php';
  if(!isset($_COOKIE['username'])) {
    setcookie('login', '1', time() +  (3000), '/');

    header('location:/login');
  } else {
    $user_db = new database();
    if(!$user_db->relogin($_COOKIE['username'])){
      header('location:/login');
    }
  }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="src/css/app.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
</head>
<body>
  <?php include_once 'src/php/template/navbar.php'?>
  <br><br><br><br>
  <div class="after-navbar-body">
    <div id = "hello">
      Hello,
    </div>
    <a href="#viewAll" onclick="viewAll()" id = "view-all-choco">
      View all chocolates
    </a>
    <div id = "menus">
      <div class="row">
      
      </div>
    </div>
  </div>

</body>
<script type="text/javascript">

  window.onload = function() {
    <?php
      include_once 'src/php/action/database.php';
      if ($_COOKIE['superuser']==1) {
        echo 'document.getElementById("add").innerHTML = "Add Chocolate";';
        echo 'document.getElementById("add").href = "/add";';
        echo 'document.getElementById("history").style.display = "none";';
      }
      else{
        echo 'document.getElementById("history").innerHTML = "History";';
        echo 'document.getElementById("history").href = "/history";';
        echo 'document.getElementById("add").style.display = "none";';
        
      }
      $db = new database();
      // show username
      $username = $db->getUsername($_COOKIE['username']);
      $contents = $db->showChoc(FALSE);
      // $username = $_COOKIE['username'];
      echo "document.getElementById(\"hello\").innerHTML += '$username';"; 
      echo "document.getElementById(\"menus\").innerHTML = '$contents';";
    ?>
    
    // var cred = "viewall=" + 
    // var xmlhttp = new XMLHttpRequest() ;
    // xmlhttp.onreadystatechange = function() {
    //   if (this.readyState == 4 && this.status == 200) {

    //   }
    // }

  

    
  };

  function viewAll() {
    <?php 
      $db = new database();
      $contents = $db->showChoc(TRUE);  
      echo "document.getElementById(\"menus\").innerHTML = '$contents';";
      
    ?>
  }

</script>
</html>