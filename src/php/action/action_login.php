<?php
	include 'database.php';

	$email = $_POST['email'];
    $password = $_POST['password'];

    $user_db = new database();
    if ($user_db->login($email,$password)){

    	header('location:/homepage');
    } else{

    	setcookie('login', '2', time() +  (3000), '/');

   		header('location:/login');
    }
   
?>