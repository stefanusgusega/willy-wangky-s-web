<?php
	include_once 'database.php';
	// $id = $_POST['id'];
	// $stock = $_POST['stock'];
    // $transactionID = $_POST[]
    // $productID
    // $username
    // $amount
    // $total
    // $timestamp
	// $address
	
	
	$productID = $_POST['id'];
	$username = $_POST['uname'];
	$amount = $_POST['stock'];
	$total = $_POST['total'];
	$timestamp = $_POST['tstamp'];
	$address = $_POST["address"];
	
	// echo $username;
	$db = new database();
	if ($db->buyItem($productID,$username,$amount,$total,$timestamp,$address)){
		echo TRUE;
	} else{
		echo FALSE;
	}
  	

?>