<?php
	include_once 'database.php';
	// $url = "http://localhost:3000/bahan/";
	$id = $_POST['idChoco'];
    $jumlah = $_POST['jumlah'];
    $db = new Database();
    $db->addStock($id,$jumlah);

	// $data = [
	//     'idcoklat'  => $nama,
	//     'jumlah' => $jumlah,
	//     'status' => $status
	// ];

	// echo 'New stock has been requested';
    
	// $db = new database();
	// if ($db->httpPost($url,$data)){
	// 	echo $url;
	// } else{
	// 	echo FALSE;
	// }
  	

?>