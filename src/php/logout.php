<?php
include './action/database.php';

$user_db = new database();
if ($user_db->logout($_COOKIE['username'])){
	header("location:/");

} else {
	echo '<script language="javascript">';
	echo 'alert("Error Occured!")';
	echo '</script>';
	header("location:/homepage");
}
?>