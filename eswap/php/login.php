<?php
	session_start();
	
	include '../include/util.php';
	$email = trim(str_replace("\n", " ", $_POST["email"]));
	$password  = trim(str_replace("\n", " ", $_POST["pw"]));
	
	$con = connect_db();
	if(!check_db_is_exist("eswap")){
		header("Location: /eSwap/error.php?type=nodb");
		die();
	}
	mysql_select_db("eswap", $con);
	$pw = mysql_query("SELECT Password FROM users WHERE Email='$email'", $con);
	while ($row = mysql_fetch_array($pw)) {
		if ($row[0] == $password) {
			$_SESSION['user'] = $email;
			header("Location: /eSwap/home.php");
			break;
		}else{
			header("Location: /eSwap/error.php?type=wrongpw");
		}
	}
	
?>