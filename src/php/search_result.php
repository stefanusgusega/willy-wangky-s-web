<?php
  include_once 'src/php/action/database.php';
  if(!isset($_COOKIE['username'])) {
    setcookie('login', '1', time() +  (3000), '/');

    header('location:login.php');
  } else {
    $user_db = new database();
    if(!$user_db->relogin($_COOKIE['username'])){
      header('location:login.php');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="src/css/app.css">
    <link rel="stylesheet" href="src/css/search_res.css">   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Result</title>
</head>
<body>
  <div class="page-title">
    <h2>Result</h2>
  </div>
  <div class="results">
    <?php
      $input = $_POST['search'];
      if(empty($input)){
        echo "<h4>Anda harus mengetikkan sesuatu untuk mencari</h4>";
      } else {
        $user_db = new database();
        $result = $user_db->getDataChocolate($input);
        $queryResult = mysqli_num_rows($result);
        if ($queryResult > 0){
          while ($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $name = $row['name'];
            $amountSold = $row['amountSold'];
            $price = $row['price'];
            $amountRemaining = $row['amountRemaining'];
            $description = $row['description'];
            $image_path = $row['path'];
            $details = "/details/" . $id;
            echo
            "<div class=\"result-container\" id=\"result-container-$id\">
            <div class=\"row\">
            <div class=\"col-search-1\">
            <a href=$details class=\"item-image-container name\">
              <img class=\"item-image\" src=\"../../assets/images/$image_path\">
            </a>
            </div>
            <div class=\"col-search-2 item-detail\">
            <a class=\"name\" href=$details>
              <div class=\"item-name\">$name</div>
              </a> 
              <div class=\"item-amount-sold\">Amount sold: $amountSold</div>
              <div class=\"item-price\">Price: Rp $price</div>
              <div class=\"item-amount-remaining\">Amount remaining: $amountRemaining</div>
              <div class=\"item-description\">
                <p>Description</p>
                <div class=\"item-description\">$description</div>
              </div>
              </a>
            </div>
            <br>
            </div>
            
            </div>";
          }
        } else {
          echo'<h4>Tidak ada hasil yang cocok</h4>';
        }
        mysqli_free_result($result);
      }
    ?>
  </div>
  <div id="navbar">
    <?php include_once 'src/php/template/navbar.php'?>
    <br><br><br>
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
    ?>    
  };
  function goTo(page){
    location.replace("buy/"+page);
  }

</script>
</html>