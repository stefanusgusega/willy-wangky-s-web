<?php
	include 'database.php';
	include 'bahan.php';

	

	$array = array();
	$jumlah = $_POST['input'];
	$id = $_POST['idlist'];
	for ($i=0 ; $i < count($jumlah) ;$i++){
		$bhn = new bahan();
		if ($jumlah[$i] != 0){
			$bhn->id = (int)$id[$i];
			$bhn->jumlah = (int)$jumlah[$i];
			array_push($array, $bhn);
		}

		
	}
	
	$name = $_POST['name'];
	$price = $_POST['price'];
	$amount = $_POST['amount'];
	$desc = $_POST['desc'];

	// $data = json_encode($array);

	
	$file_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/';
	$filetype = strtolower(pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION));

	$product_db = new database();
	$id = $product_db->countId();

	$cokelat->idcokelat = $id;
	$cokelat->listbahan = $array;
	$data = json_encode($cokelat);
	
	setcookie('array',json_encode($cokelat), time() + (86400 * 30), "/"); // 86400 = 1 day
	phpinfo();
	// isi $data, idcokelat = id cokelat, per bahan dengan id dan jumlah


	$path = $id . '.' . $filetype;
	$fullpath = $file_path . $path;
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $fullpath)) {
		
		if ($filename = $product_db->addChocolate($name,$price,$amount,$desc,$path)) {
   	 	setcookie('add', '1', time() +  (3000), '/');

   	 	header("location:/add");
	  	} else {
			setcookie('add', '0', time() +  (3000), '/');

	    	header("location:/add");
	  	}
	} else {
		setcookie('add', '2', time() +  (3000), '/');
	    	header("location:/add");
	}
  	

?>