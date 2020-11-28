<?php
	include 'database.php';
	
	$jumlah = $_POST['input'];
	$nama = $_POST['idlist'];
	
	
	$name = $_POST['name'];
	$price = $_POST['price'];
	$amount = $_POST['amount'];
	$desc = $_POST['desc'];
	

	
	$file_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/';
	$filetype = strtolower(pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION));

	$product_db = new database();
	
	
	$objresep = "<chocoID>" . $product_db->countId() ."</chocoID>";
	for ($i = 0 ; $i< count($nama) ; $i++){
		if((int)$jumlah[$i] != 0) {
			$objresep .= "<bahanList><idBahan> 0 </idBahan><namaBahan>".$nama[$i]." </namaBahan><jumlah>".(int)$jumlah[$i]."</jumlah><tanggalExp> x </tanggalExp></bahanList>";
		}
	}
	$soapmessage= "<?xml version='1.0' encoding='UTF-8'?>
                                <soap:Envelope xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
                                    <soap:Body>
                                        
                                        <ns2:addNewChocolate xmlns:ns2='http://factory/'>
						<arg0>
                                      	".$objresep."</arg0>
                                        </ns2:addNewChocolate>
                                        
                                    </soap:Body>
                                </soap:Envelope>";
	
	
	
	
	
	$id = $product_db->countId();
	$path = $id . '.' . $filetype;
	$fullpath = $file_path . $path;
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $fullpath)) {
		
		if ($filename = $product_db->addChocolate($name,$price,$amount,$desc,$path)) {
   	 	$id = $product_db->getId($name);
		$soapmessage2 = "<?xml version='1.0' encoding='UTF-8'?>
                                <soap:Envelope xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
                                    <soap:Body>
                                        
                                        <ns2:addGudang xmlns:ns2='http://factory/'>
						<arg0>".$id."</arg0>
						<arg1>".$name."</arg1>
						<arg2>".$amount."</arg2>
                                        </ns2:addGudang>
                                        
                                    </soap:Body>
                                </soap:Envelope>";
		$url = "http://localhost:8080/ws-factory/ws/server?wsdl";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $soapmessage);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		$ch2 = curl_init($url);
		curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch2, CURLOPT_POST, 1);
		curl_setopt($ch2, CURLOPT_POSTFIELDS, $soapmessage2);
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch2);
		curl_close($ch2);
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