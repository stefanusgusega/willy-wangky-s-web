
// window.onload = function() {
//     <?php
//     //   include_once 'src/php/action/database.php';
//       include_once './action/database.php';
//       if ($_COOKIE['superuser']==1) {
//         echo 'document.getElementById("add").innerHTML = "Add Chocolate";';
//         echo 'document.getElementById("add").href = "/add";';
//         echo 'document.getElementById("add-stock").innerHTML = "Add Stock";';
//         echo 'document.getElementById("history").style.display = "none";';
//         echo 'document.getElementById("buy-now").style.display = "none";';
//       }
//       else{
//         echo 'document.getElementById("history").innerHTML = "History";';
//         echo 'document.getElementById("history").href = "/history";';
//         echo 'document.getElementById("add").style.display = "none";';
//         echo 'document.getElementById("buy-now").innerHTML = "Add Stock";';
//         echo 'document.getElementById("add-stock").style.display = "none";';
//       }
//       $db = new database();
//       $id = $_GET["id"];
//       $name = $db->getChocDetails($id,"name");
//       $img = $db->getChocDetails($id, "path");
//       $amountsold = $db->getChocDetails($id, "amountSold");
//       $price = $db->getChocDetails($id, "price");
//       $amount = $db->getChocDetails($id, "amountRemaining");
//       $desc = $db->getChocDetails($id, "description");
      
//       echo "document.title='Chocolate Detail : $name';";
//       echo "document.getElementById(\"details-name\").innerHTML = '$name';";
//       echo "document.getElementById(\"details-img\").innerHTML += 
//             '<img src=\"../../assets/images/$img\" alt=photo>';";
//         echo "document.getElementById(\"details-amountsold\").innerHTML += '$amountsold';";
//         echo "document.getElementById(\"details-price\").innerHTML += '$price';";
//         echo "document.getElementById(\"details-amount\").innerHTML += '$amount';";
//         echo "document.getElementById(\"details-desc\").innerHTML += '$desc';";
//     ?>    
//   };
