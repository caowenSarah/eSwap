<?php
	session_start();
	if (isset($_SESSION["user"])){
		$user = $_SESSION["user"];
	}else{
		$user = "";
	}
	include("../include/util.php");
	# Input checking 
	$names = array("password", "nickname", "firstname", "lastname", "region", "mobilenum");
	$paras = array();
	$is_pw_changed = true;
	for ($i=0; $i < count($names); $i++) { 
		$paras[$i] = trim(str_replace("\n", " ", $_POST[$names[$i]]));
		if(empty($paras[$i])){
			if ($names[$i] == "password") {
				$is_pw_changed = false;
			}else{
				header("Location: /eSwap/error.php?type=$names[$i]");
				die();	
			}
		}
	}

	$con = connect_db();
	mysql_select_db("eswap", $con);
	# Check whether the password is changed
	if ($is_pw_changed) {
		$sql = "UPDATE users SET Password='$paras[0]', NickName='$paras[1]', FirstName='$paras[2]', LastName='$paras[3]', Region='$paras[4]', MobileNumber='$paras[5]' WHERE Email='$user'";
	}else{
		$sql = "UPDATE users SET NickName='$paras[1]', FirstName='$paras[2]', LastName='$paras[3]', Region='$paras[4]', MobileNumber='$paras[5]' WHERE Email='$user'";
	}
	mysql_query($sql, $con);
	mysql_close($con);

	header("Location: /eSwap/home.php");
?>