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
  // isChecking = false;

  window.onload = function() {
    var i = 0
	  // checkPending();

  
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
    // while (true) {
      
    //   sleep(10000).then(() => { checkPending(); });
      
    // }

    
  };

  checkPending();

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
    checkStock();
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

  function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }

  function checkPending() {
    console.log("ngecek di sini");
    var url = "http://localhost:8080/ws-factory/ws/server?wsdl";
        var msgCheckPendings = `<?xml version='1.0' encoding='UTF-8'?>
                                      <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                          <soap:Body>
                                                
                                              <ns2:isThereAnyPending xmlns:ns2="http://factory/">
                                                    
                                              </ns2:isThereAnyPending>
                                                
                                          </soap:Body>
                                      </soap:Envelope>`;
        var xmlDetectPendingsReq = new XMLHttpRequest();
        xmlDetectPendingsReq.onreadystatechange = function() {
          console.log("readystate: "+this.readyState+" status:"+this.statusText);
          if (this.readyState==4 && this.status==200) {
            detectionParser = new DOMParser();
            detectionParsed = detectionParser.parseFromString(this.responseText,"text/xml");
            console.log(this.responseText);
            isThereAnyPending = detectionParsed.getElementsByTagName("return")[0].childNodes[0].nodeValue;
            // check = true;
            // if (isThereAnyPending) {
            //   console.log("ini lho masuk true");
            //   isCheck = false;
            //   console.log(isCheck);
            //   checkStock();
            // }
            // else {
            //   // console.log("false");
            //   isCheck = true;

            // }
            if (isThereAnyPending) {
              checkStock();
            }
            
            
             
          }
        };
        xmlDetectPendingsReq.open('POST',url,true);
        xmlDetectPendingsReq.setRequestHeader("Content-type","text/xml");
        xmlDetectPendingsReq.send(msgCheckPendings);
        
  }
  function checkStock() {
      // isChecking = true;
  	  // isChecking = true; // buat flag aja ada loop lgi ongoing

        console.log('coba dulu');
        var url = "http://localhost:8080/ws-factory/ws/server?wsdl";
        var arrayOfDeliveredReq = `<?xml version='1.0' encoding='UTF-8'?>
                                      <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                          <soap:Body>
                                              
                                              <ns2:getArrayOfIDStockDelivered xmlns:ns2="http://factory/">
                                                  
                                              </ns2:getArrayOfIDStockDelivered>
                                              
                                          </soap:Body>
                                      </soap:Envelope>`; 
        var xmlHttpDelivReq = new XMLHttpRequest();
          
          // while (isChecking) {
        xmlHttpDelivReq.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // checkPending();
            // console.log(isCheck);
            requestParser = new DOMParser();
            requestXMLParsed = requestParser.parseFromString(this.responseText,"text/xml");
            arrayLength = requestXMLParsed.getElementsByTagName("item").length;
              // kalau gaada yang delivered
              

            console.log("sebelum masuk if arrlength");
            if (arrayLength != 0) {
              console.log("sesudah masuk if arrlength");

              for (var i = 0 ; i < arrayLength; i++) {
                isi = requestXMLParsed.getElementsByTagName("item")[i].childNodes[0].nodeValue;
                  // Ajax lagi buat ngambil id_coklat sama jumlah
                var addStockInfoReq = `<?xml version='1.0' encoding='UTF-8'?>
                                          <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                              <soap:Body>
                                                  
                                                  <ns2:getFullAddStockElmt xmlns:ns2="http://factory/">
                                                      <arg0>`+isi+`</arg0>
                                                  </ns2:getFullAddStockElmt>
                                                  
                                              </soap:Body>
                                          </soap:Envelope>`; 
                var xmlHttpInfoAddStock = new XMLHttpRequest();
                console.log("masuk ajax kedua");
                    
                xmlHttpInfoAddStock.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    infoParser = new DOMParser();
                    infoParsed = infoParser.parseFromString(this.responseText,"text/xml");
                    idChoco = infoParsed.getElementsByTagName("chocoID")[0].childNodes[0].nodeValue;
                    jumlah = infoParsed.getElementsByTagName("jumlah")[0].childNodes[0].nodeValue;
                    chocoName = infoParsed.getElementsByTagName("chocoName")[0].childNodes[0].nodeValue;
                        // update di db
                        // nambah coklat di db wwweb
                        // GIMANA NGAMBIL IDCHOCO SM JUMLAH KE PHP
                    var xmlForPHP = new XMLHttpRequest();
                    var msg = "idChoco="+idChoco+"&jumlah="+jumlah;
                    xmlForPHP.open("POST","/src/php/action/action_delivered.php",true);
                    xmlForPHP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlForPHP.send(msg);
                        // ngurangin coklat di db factory

                    var msgToChangeToReceived = `<?xml version='1.0' encoding='UTF-8'?>
                                          <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                                              <soap:Body>
                                                  
                                                  <ns2:changeStatusAddStockToReceived xmlns:ns2="http://factory/">
                                                      <arg0>`+isi+`</arg0>
                                                  </ns2:changeStatusAddStockToReceived>
                                                  
                                              </soap:Body>
                                          </soap:Envelope>`;
                    var xmlChangeToReceived = new XMLHttpRequest();
                        // check masi ada yg pending/ nggak
                        // kalo masi masuk ke checkstock() lagi (paling dikasi waktu jeda 10 detik gitu si biar ga langsung), kalo nggak berhenti
                        ///
                        
                    xmlChangeToReceived.onreadystatechange = function() {
                      if (this.readyState==4 && this.status == 200) {
                        console.log(this.responseText);
                            

                      }
                    };
                    xmlChangeToReceived.open('POST',url,true);
                    xmlChangeToReceived.setRequestHeader("Content-type", "text/xml");
                    xmlChangeToReceived.send(msgToChangeToReceived);
                    
                    var xmlViewingName = new XMLHttpRequest();
                    var msgView = "idChoco="+idChoco;
                    xmlViewingName.open("POST","/src/php/action/database.php",true);
                    xmlViewingName.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlViewingName.send(msgView);
                   <?php
                      include_once 'src/php/action/database.php';
                      $db = new Database();
                      $id = $_GET["id"];
                      $var = $db->getChocDetails($id,"amountRemaining");
                      echo "var newAmt = '$var';";

                      ?>
                    console.log(newAmt);
                    alert(chocoName + "'s "+ jumlah+" addition stock request has been accepted!");
                    document.getElementById('details-amount').innerHTML = newAmt;
                    document.getElementById('details-amount').style.color = "green";
                  }

                };
                xmlHttpInfoAddStock.open('POST',url,true);
                xmlHttpInfoAddStock.setRequestHeader("Content-type","text/xml");
                xmlHttpInfoAddStock.send(addStockInfoReq);
              }
            } // check masi ada yang pending / nggak
                  // kalo masi masuk ke checkstock lagi ( i guess dibikin function aja)
            // isChecking = checkPending();

          } 
        };
        xmlHttpDelivReq.open("POST",url,true);
        xmlHttpDelivReq.setRequestHeader("Content-type","text/xml");
        xmlHttpDelivReq.send(arrayOfDeliveredReq);
        // console.log("readySTateDelivreq:"+xmlHttpDelivReq.readyState+" status delivreq:"+xmlHttpDelivReq.status);
        
            
          
        // }
  }


</script>
</html>