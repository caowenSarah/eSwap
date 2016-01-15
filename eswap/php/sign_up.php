<?php
	include("../include/util.php");
	# Input checking 
	$names = array("email", "password", "nickname", "firstname", "lastname", "region", "mobilenum");
	$paras = array();
	for ($i=0; $i < count($names); $i++) { 
		$paras[$i] = trim(str_replace("\n", " ", $_POST[$names[$i]]));
		if(empty($paras[$i])){
			header("Location: /eSwap/error.php?type=$names[$i]");
			die();
		}
	}

	$con = connect_db();
	mysql_select_db("eswap", $con);
	# Check whether the email has been registered
	$sql = "SELECT * FROM users WHERE Email='$paras[0]'";
	$emails = mysql_query($sql, $con);
	if (mysql_num_rows($emails) == '1') {
		header("Location: /eSwap/error.php?type=registered");
		die();
	}
	# Insert an user info into table users
	$info = "'$paras[0]'";
	for ($i=1; $i < count($names); $i++) { 
		$info = $info.", '$paras[$i]'";
	}

	$sql = "INSERT INTO users (Email, Password, NickName, FirstName, LastName, Region, MobileNumber)
	VALUES (".$info.")";
	mysql_query($sql, $con);
	mysql_close($con);

	header("Location: /eSwap/index.php");
?>