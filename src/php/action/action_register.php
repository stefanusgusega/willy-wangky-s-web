<?php


	include_once 'database.php';
	// $username = isset($_POST['username']) ? $_POST['username'] : '';
	// $email = isset($_POST['email']) ? $_POST['email'] : '';
 //    $password = isset($_POST['password']) ? $_POST['password'] : '';
 //    $confirmation = isset($_POST['confpassword']) ? $_POST['confpassword'] : '';
 //    $uname = isset($_POST['uname']) ? $_POST['uname'] : '';
 //    $em = isset($_POST['em']) ? $_POST['em'] : '';
   	$user_db = new database();
    $boolean = $_POST['boolean'];

    if ($boolean == "0"){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmation = $_POST['confpassword'];
    // if (!($uname) && !($em)){

	    if($user_db->register($username,$email,$password)){
	    	setcookie('login', '3', time() +  (3000), '/');

	   		header('location:/login');
	    
	    } else {
            header('location:/register');
        }
    } else if ($boolean == "1"){
        $uname =  $_POST['username'];
//     } else if (($uname)){
// >>>>>>> b8cce4159d6caa0dd6660e80bc3640b6efae36bf

    	if ($user_db->checkUsername($uname)){
    		echo 1;
    	} else{
    		echo 0;
    	}

    } else {
        $em = $_POST['email'];

    	if ($user_db->checkEmail($em)){
    		echo 1;
    	} else {
    		echo 0;
    	}
    }
    
    
?>

