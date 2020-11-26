<?php
// include_once 'src/php/action/database.php';
include_once 'src/php/action/database.php'; // root nya jd details.php
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
    <link rel="stylesheet" href="/src/css/app.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
  <?php //include_once 'src/php/template/navbar.php'?>
  <?php include_once 'src/php/template/navbar.php'?>
  <br><br><br>
  <br>
  <br>
  <div class="desc">
    <div id = "details-name">
        
    </div>
    <hr>
    <div class="row">
      <div class="col">
        <div id = details-img>
              
        </div>
      </div>
      <div class="col details">
        <div class="row det">
          <div class="col-4 title-desc">
            <div> AMOUNT SOLD</div>
          </div>
          <div class="col-4">
            <div id = 'details-amountsold' >
            </div>
          </div>
        </div>
        <div class="row det">
          <div class="col-4 title-desc">
            <div> PRICE</div>
          </div>
          <div class="col-4">
            <div id = 'details-price' >
            </div>
          </div>
        </div>
        <div class="row det">
          <div class="col-4 title-desc">
            <div> AMOUNT</div>
          </div>
          <div class="col-4">
            <div id = 'details-amount' >
            </div>
          </div>
        </div>
        <div class="det">
            <div class="col-s"> 
              <div class="title-desc">DESCRIPTION
              </div>
            <div style="padding:10% 0"id = 'details-desc' >
            </div>

            <div id="plus-minus" style="display: none;position: absolute;width: 15%;text-align: center" class="row ">
              <div id="textAmount" style="text-align: left;padding-bottom: 5%">
              </div>
              <div class="col-3 box"  onclick="addStock()">
                +
              </div>
              <div id="amount-to-action" class="col-3">
                0
              </div>
              <div class="col-3 box" onclick="minusStock()">
                -
              </div>
              
          </div>
        </div>
      </div>
          
       <br><br>
        <br><br><br><br>
        
    </div>
    
         <div>
        <button id="cancel" onclick="cancel()" style="display: none">
          Cancel
        </button>
      
        <button id="add-stock-1">

        </button>

        <button id="buy-now">

        </button>
     </div>
  </div><br><br>
 
   
  <div class="address" id="adr" style="display:none">
    <div id="total-price">
    </div>
    <br>
  Address
   <form method="post">
        <input type="text" name="address" id="address" placeholder="Input your address here">
    </form>
  </div>

</body>
<script type="text/javascript">

  window.onload = function() {
    <?php
      include_once 'src/php/action/database.php';
      // include_once './action/database.php';
      
      $db = new database();
      $id = $_GET["id"];
      $name = $db->getChocDetails($id,"name");
      $img = $db->getChocDetails($id, "path");
      $amountsold = $db->getChocDetails($id, "amountSold");
      $price = $db->getChocDetails($id, "price");
      $amount = $db->getChocDetails($id, "amountRemaining");
      $desc = $db->getChocDetails($id, "description");
      
      echo "document.title='Chocolate Detail : $name';";
      echo "document.getElementById(\"details-name\").innerHTML = '$name';";
      echo "document.getElementById(\"details-img\").innerHTML += 
            '<img src=\"../../assets/images/$img\" class=image alt=photo>';";
        echo "document.getElementById(\"details-amountsold\").innerHTML += '$amountsold';";
        echo "document.getElementById(\"details-price\").innerHTML += '$price';";
        echo "document.getElementById(\"details-amount\").innerHTML += '$amount';";
        echo "document.getElementById(\"details-desc\").innerHTML += '$desc';";

      if ($_COOKIE['superuser']==1) {
        echo 'document.getElementById("add").innerHTML = "Add Chocolate";';
        echo 'document.getElementById("add").href = "/add";';
        echo 'document.getElementById("history").style.display = "none";';
        echo 'document.getElementById("add-stock-1").onclick = function(){loadStock()};';
        echo 'document.getElementById("add-stock-1").innerHTML = "Add Stock";';
        echo 'document.getElementById("buy-now").style.display = "none";';

      }
      else{
        echo 'document.getElementById("history").innerHTML = "History";';
        echo 'document.getElementById("history").href = "/history";';
        echo 'document.getElementById("add").style.display = "none";';
        echo 'document.getElementById("buy-now").innerHTML = "Buy Now";';
        echo 'document.getElementById("add-stock-1").style.display = "none";';
        echo 'document.getElementById("buy-now").onclick = function(){loadBuy()};';
      }
    ?>
   

    
  };

   function loadStock(){
        document.getElementById("plus-minus").style.display ="block";
        document.getElementById("plus-minus").style.float ="block";
        document.getElementById("cancel").style.display ="inline-block";
        document.getElementById("cancel").style.float = "right";
        document.getElementById("add-stock-1").onclick = function(){add()};
        document.getElementById("textAmount").innerHTML = "Amount to add";

      }
  function loadBuy() {
    document.getElementById("plus-minus").style.display ="block";
        document.getElementById("plus-minus").style.float ="block";
        document.getElementById("cancel").style.display ="inline-block";
        document.getElementById("cancel").style.float = "right";
        document.getElementById("buy-now").onclick = function(){buy()};
        document.getElementById("adr").style.display = "block";
        document.getElementById("address").style.display = "block";
        document.getElementById("textAmount").innerHTML = "Amount to buy";

  }
  function add(){
    var x = parseInt(document.getElementById("amount-to-action").innerHTML);
    if (x == 0){
      alert("Cannot add 0 stock!");
      return false;
    }
    <?php 
    echo'var id='. $_GET['id'] .';';
    ?>
    var jumlah = parseInt(document.getElementById("amount-to-action").innerHTML);

    var cred = `<?xml version='1.0' encoding='UTF-8'?> <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"> <soap:Body> <ns2:insertNewAddStockRequest xmlns:ns2="http://factory/"> <arg0>`+id+`</arg0> <arg1>`+jumlah+`</arg1> </ns2:insertNewAddStockRequest> </soap:Body> </soap:Envelope>`;

    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
   	    alert("Request berhasil dikirim ke pabrik!");
     
            location.reload();
          }
        };
    xmlhttp.open("POST", "http://localhost:8080/ws-factory/ws/server?wsdl", true);
    xmlhttp.setRequestHeader("Content-type", "text/xml");
    xmlhttp.send(cred);  
  }
  function buy(){
    // x itu amount
    var x = parseInt(document.getElementById("amount-to-action").innerHTML);
    if (x == 0){
      alert("Cannot buy 0 chocolate!");
      return false;
    }
    // productID
    <?php 
    echo'var id='. $_GET['id'] .';';
    ?>
    console.log(id);
    console.log(x);
    // username, price satuan, tstamp, addr
    <?php
      $db = new database();
      $id = $_GET['id'];
      $uname = $db->getUsername($_COOKIE['username']);
      echo'var uname='. "'$uname'" .';';
      $price = $db->getChocDetails($id, "price");
      echo'var price=' . $price.';';
      $timestamp = date('Y-m-d H:i:s');
      echo'var tstamp='."'$timestamp'".';';
      

    ?>
    var tot = price*x;
    var cred = "id=" + id + "&stock=" + x + "&uname="+uname+"&total="+tot+"&tstamp="+tstamp + "&address=" + document.getElementById("address").value;
    console.log(cred);
    var xmlhttp = new XMLHttpRequest();
    var addsaldo = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if(this.responseText) {
              alert("Chocolate has been bought!"); 
            }else{
              alert("Error occured!");
            }
          }
        };
   
    xmlhttp.open("POST", "/src/php/action/action_buy.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(cred);  
 	var soapMessage = `<?xml version='1.0' encoding='UTF-8'?>
                                <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                    <soap:Body>
                                        
                                        <ns2:addSaldo xmlns:ns2="http://factory/">
                                            <arg0>`+tot+`</arg0>
                                        </ns2:addSaldo>
                                        
                                    </soap:Body>
                                </soap:Envelope>`;
 	addsaldo.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
	   
            location.reload();
          }
        };
    addsaldo.open("POST", "http://localhost:8080/ws-factory/ws/server?wsdl", true);
    addsaldo.setRequestHeader("Content-type", "text/xml");
    addsaldo.send(soapMessage);
  }
  function cancel(){
    document.getElementById("cancel").style.display ="none";
    document.getElementById("plus-minus").style.display ="none";
    document.getElementById("buy-now").onclick = function(){loadBuy()};
    document.getElementById("add-stock-1").onclick = function(){loadStock()};
    document.getElementById("adr").style.display = "none";


  }
  function addStock(){
      var x = parseInt(document.getElementById("amount-to-action").innerHTML);
      document.getElementById("amount-to-action").innerHTML = x+1;
      var y = parseInt(document.getElementById("amount-to-action").innerHTML);
      var tot = parseInt(document.getElementById("details-price").innerHTML)*y;
      document.getElementById("total-price").innerHTML = "Total price: Rp "+tot;
    }

  function minusStock(){
    var x= parseInt(document.getElementById("amount-to-action").innerHTML);
    if (x!= 0){
    document.getElementById("amount-to-action").innerHTML = x-1;
    }
    var y = parseInt(document.getElementById("amount-to-action").innerHTML);
    var tot = parseInt(document.getElementById("details-price").innerHTML)*y;
    document.getElementById("total-price").innerHTML = "Total price: Rp "+tot;
  }

</script>
</html>