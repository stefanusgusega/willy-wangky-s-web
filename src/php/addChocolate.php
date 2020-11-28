<?php

	if(!isset($_COOKIE['superuser'])){
		header('location:/homepage');
	}
echo '<script language="javascript">';
if($_COOKIE['add'] == '1'){
	echo 'alert("Chocolate has been added!");';
} else if ($_COOKIE['add'] == '0'){
	echo 'alert("Error occured");';
}
echo '</script>';
setcookie('add', '', 0, '/');
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="src/css/app.css">
	<link rel="stylesheet" href="src/css/form.css">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title >Add Chocolate</title>
</head>
<body>
	  <?php include_once 'src/php/template/navbar.php'?>

 	<br><br>
 	<div class="center-screen">

 	<div class="title" id="request" >
 		Add New Chocolate
 	</div>
 	<div class="form">
 		<form action="src/php/action/action_add.php" method="post"  enctype="multipart/form-data" onsubmit="return validateFile()">
 			<input type="text" id="name" name="name" placeholder="Chocolate Name"required>
 			<input type="number" id="price" name="price" placeholder="Price" min=0 required>
 			<input type="number" id="amount" name="amount" placeholder="Amount" min=0 required>
 			<textarea id="desc" name="desc" placeholder="Description" required></textarea>
 			<br/><br/>
 			 <div style="font-size:1vw">Total harga</div>
 			 <div id="totalprice"> Rp. 0</div>
 			 <div id="ingredients"></div><br/>
 			<div style="text-align: center">
 				<label class="custom-file-upload">
			    <input type="file" id="file" name="file" onchange="return uploadFile()" accept=".jpg,.png,.jpeg"  required>
			    Image Upload
				</label>
				<div class="infos" id="info">
					Only .jpg and .png file allowed.
				</div>
 			</div>
 			<br>
 			<input type="submit" value="Add">
 			

 		</form>
 	</div>
 </div>
	
</body>

<script type="text/javascript">

	fetch('http://localhost:4000/bahan')
		.then((res) => res.json())
		  .then((data) => {

		  		bahanName = document.getElementById('ingredients');
				data.forEach((bahan,i) => {
		  			rowElements = document.createElement("div");
		  			rowElements.setAttribute("class","row");
		  			col1 = document.createElement("div");
		  			col1.setAttribute("class","col-bahan");
		  			col3 = document.createElement("div");
		  			col3.setAttribute("class","col-bahan");
		  			col1.innerText = `${bahan.nama_bahan}`;
		  			span = document.createElement("span");
		  			span.innerText="Rp. ";
		  			col3.appendChild(span);
		  			harga = document.createElement("span");
		  			harga.setAttribute("id","harga-"+i);

		  			harga.innerText = `${bahan.harga_bahan}`;
		  			col3.appendChild(harga);
		  			rowElements.appendChild(col1);
		  			col2 = document.createElement("div");
		  			col2.setAttribute("class","col-bahan");
				    var x = document.createElement("INPUT");
				   	x.setAttribute("min",0);

				    var id = document.createElement("INPUT");
				    id.setAttribute("type","hidden");
				    id.setAttribute("name","idlist[]");
				    id.setAttribute("value",`${bahan.nama_bahan}`)

					x.setAttribute("type", "number");
					x.setAttribute("class","special");
					x.setAttribute("required",true);
					x.setAttribute("name","input[]");
					x.setAttribute("id","total-" +i);
					x.setAttribute("value",0);
					x.setAttribute("oninput","countPrice()");
					col2.appendChild(x);
					col2.appendChild(id);
					rowElements.appendChild(col2);
					rowElements.appendChild(col3);
					bahanName.appendChild(rowElements);


			});
		  })

		  .catch((error) => console.log(error));

	

	<?php
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

	window.onload = function() {

		<?php


		if (($_COOKIE['superuser'])==1){
		  echo 'document.getElementById("addChocolate").innerHTML = "Add Chocolate"';
		}

		?>
	}

	
	function countPrice(){
		var i =0;
		var box = document.getElementById("total-"+i);
		var total = 0;
		while (box != null){
			var value = box.value;
			var jumlah;
			if (value == ""){
				jumlah = 0;
			} else {
				jumlah = parseInt(value);
			}
			var price = parseInt(document.getElementById("harga-"+i).innerHTML);
			total+=jumlah*price;
			i+=1;
			var box = document.getElementById("total-"+i);

		}
		document.getElementById("totalprice").innerHTML = "Rp. "+total;

	}

	function getFilename(fullpath){
	    var filename = fullpath.split(/(\\|\/)/g).pop()
	    return filename;

		
	}

	function uploadFile(){
		var path = document.getElementById("file").value;
		var filename = getFilename(path);
		document.getElementById("info").innerHTML = filename;
	}

	function validateFile(){
		var path = document.getElementById("file").value;
		var filename = getFilename(path);
		var ext = filename.split('.')[1];
		if (ext != "jpg" && ext != "png" && ext !="jpeg"){
			alert("File is not supported");
			location.reload();
			return false;
		}
	}
	

	
</script>
</html>