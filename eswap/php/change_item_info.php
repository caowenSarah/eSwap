<?php
	session_start();
	if (isset($_SESSION["user"])){
		$user = $_SESSION["user"];
	}else{
		$user = "";
	}
	include("../include/util.php");
	$id = $_GET["id"];
	# Input checking 
	$names = array("category", "itemname", "description", "exchange", "swaped");
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
	date_default_timezone_set('Asia/Shanghai');
	$date = date("Y m d H:i");
	$sql = "UPDATE items SET Category='$paras[0]', ItemName='$paras[1]', Description='$paras[2]', Wantfor='$paras[3]', UpdateDate='$date', Swaped='$paras[4]' WHERE _id='$id'";
	mysql_query($sql, $con);
	mysql_close($con);

	header("Location: /eSwap/home.php");
?>