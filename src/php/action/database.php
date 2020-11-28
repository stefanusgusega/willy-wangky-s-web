<?php 
class database{
	public $host = "localhost";
	public $username = "root";
	public $password = "";
	public $database = "wbd";
	public $connection;
 
	function __construct(){
		$this->connection = mysqli_connect($this->host, $this->username, $this->password,$this->database);
	}
 	
 	function httpPost($url, $data)
	{
	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    return $response;
	}

	// USER 

	function generateCookie($length = 10) {
		$char = '0123456789asqwedrftghyujkiolpzxcvbnm,.;[]./]=-@#$%^&*!~"';
		$random ='';


		for ($i = 0; $i<$length;$i++){
			$id = rand(0, strlen($char) -1);
			$random .= $char[$id];
		}
		return $random;
	}

	function register($username,$email,$password)
	{	
		$result = $this->connection->query("insert into user values ('$username','$email','$password','0',NULL)");

		return $result;
	}
 
	function login($email,$password)
	{
		$result = $this->connection->query("select * from user where email='$email' and password='$password'");
		if($result->num_rows >0){
			while (True){
				$cookie = $this->generateCookie();
				$query = mysqli_query($this->connection,"update user set cookie='$cookie' where email='$email'");
				if (query){
					break;
				} else {
					continue;
				}
			}
			
			$row =$result->fetch_assoc();
			if($row["superuser"] == 1){
				setcookie('superuser',1,time() + (86400 * 30), '/' );
			}

			else {
				setcookie('superuser',0,time() + (86400 * 30), '/' );
			}

			setcookie('username', $cookie, time() + (86400 * 30), '/');

			return TRUE;
		} else {
				return FALSE;
		}	
	}

	function getUsername($cookie) {
		$search = $this->connection->query("select username from user where cookie='$cookie'");
		$result = $search->fetch_array()[0];
		return $result;
	}

	function relogin($cookie){

		$result = $this->connection->query("select * from user where cookie='$cookie'");

		if ($result->num_rows > 0){
			setcookie('username', $cookie, time() + (86400 * 30), '/');
			return TRUE;
		} else {
			return FALSE;
		}
		
	}
	function logout($cookie){
		$sql =  mysqli_query($this->connection,"update user set cookie=NULL where cookie='$cookie'");
		if($sql){
			setcookie('username','',0,'/');
			setcookie('superuser','',0, '/' );
			return TRUE;
		} else{
			return FALSE;
		}
	}
	function checkUsername($username){
		$result = $this->connection->query("select * from user where username='$username'");
		if ($result->num_rows===0){
			return TRUE;
		} else{
			return FALSE;
		}

	}

	function checkEmail($email){
		$result = $this->connection->query("select * from user where email='$email'");
		if ($result->num_rows===0){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	// CHOCOLATE
	function addStock($id,$stock){
		$sql =  mysqli_query($this->connection,"update product set amountRemaining=amountRemaining+'$stock' where id='$id'");
		if ($sql){
			return TRUE;
		} else{
			return FALSE;
		}

	}
	function countId(){
		$result = $this->connection->query("select * from product");
		$id = $result->num_rows + 1;
		return $id;
	}
	function getId($name){
		$result=$this->connection->query("select id from product where name ='$name'");
		$res=$result->fetch_array()[0];
		return $res;
	}
	function addChocolate($name,$price,$amount,$desc,$path){
		$query = mysqli_query($this->connection,"insert into product values (NULL,'$name',0,'$price','$amount','$desc','$path')");
		if ($query) {
			return true;
		}
		else{
			return false;
		}
	}

	function getDataChocolate($keysearch_name){
		$result = $this->connection->query("select * from product where name like '%$keysearch_name%'");
		return $result;
	}

	function getHistory($username){
		$result = $this->connection->query("select transactionID, productID, name, amount, total, timestamp, address from transaction, product where username = '$username' and id = productID");
		return $result;
	}

	// HOMEPAGE

	function showChoc($viewAll) {
		if ($viewAll) {
			$sort = $this->connection->query("select * from product where amountRemaining > 0 order by amountRemaining desc");
		}
		else {
			$sort = $this->connection->query("select * from product where amountRemaining > 0 order by amountRemaining desc limit 10");
		}
		// $sorted_arr = $sort->fetch_array();
		$name_arr = array();
		$innerHTML ='<div class="row">';
		while ($row = $sort->fetch_array()) {
			// array_push($name_arr,$row["name"]);
			// $innerHTML .= '<a href=details.php?id=';
			$innerHTML .= '<a href=./details/';
			$innerHTML .= urlencode($row["id"]);
			$innerHTML .= '>';
			$innerHTML .= '<div class="col-1 menu choco">';
			$innerHTML .= '<ul>';
			$innerHTML .= '<li>';
			$innerHTML .= '<img src=assets/images/';
			$innerHTML .= $row["path"];
			$innerHTML .= ' class=img alt=photo>';
			$innerHTML .= '</li>';
			$innerHTML .= '<li id="name">';
			$innerHTML .= $row["name"];
			$innerHTML .= '</li>';
			$innerHTML .= '<li id="amount-sold"> Amount sold: ';
			$innerHTML .= $row["amountSold"];
			$innerHTML .= '</li>';
			$innerHTML .= '<li id="price"> Price: ';
			$innerHTML .= $row["price"];
			$innerHTML .= '</li>';
			$innerHTML .= '</ul>';
			$innerHTML .= '</div>';
		}
		$innerHTML .= '</div></a>';
		return $innerHTML;
		
	}

	function getChocDetails($id, $attr) {
		$table = $this->connection->query("select $attr from product where id=$id");
		$res=$table->fetch_array()[0];
		return $res;
	}

	function buyItem($productID,$username,$amount,$total,$timestamp,$address) {
		// $last_transactionID_table=$this->connection->query("select transactionID from transaction order by transactionID desc limit 1");
		// $last_transactionID = $last_transactionID_table->fetch_array()[0];
		$query = $this->connection->query("insert into transaction values (NULL,'$productID','$username','$amount','$total',CURRENT_TIMESTAMP, '$address' )");
		$decreasestock = $this->connection->query("update product set amountRemaining=amountRemaining-'$amount' where id='$productID'");
		$increaseamountsold=$this->connection->query("update product set amountSold=amountSold+'$amount' where id='$productID'");
		if ($query && $decreasestock && $increaseamountsold) {
			return true;
		} else {
			return false;
		}
	}
	
} 

?>