<?php
	include_once 'database.php';
	// $url = "http://localhost:3000/bahan/";
	$id = $_POST['id'];
	$jumlah = $_POST['jumlah'];
	$status = "pending";

	$data = [
	    'idcoklat'  => $nama,
	    'jumlah' => $jumlah,
	    'status' => $status
	];

	echo 'New stock has been requested';

	// $db = new database();
	// if ($db->httpPost($url,$data)){
	// 	echo $url;
	// } else{
	// 	echo FALSE;
	// }
  	

?>