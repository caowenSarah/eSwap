<?php 
	$skip = $_GET["skip"];
	$num = $_GET["number"];
	$cat = $_GET["cat"];
	$is_idx_page = $_GET["is_idx_page"];

	include("../include/util.php");
	$con = connect_db();
	mysql_select_db("eswap", $con);
	if ($cat == "") {
		$sql_result = mysql_query("SELECT * FROM items WHERE Swaped='no' ORDER BY _id DESC LIMIT $skip,$num", $con);
	}else{
		$sql_result = mysql_query("SELECT * FROM items WHERE Category='$cat' && Swaped='no' ORDER BY _id DESC LIMIT $skip,$num ", $con);
	}

	if ($is_idx_page == 1) {
		$result = getItemsJSONStr($sql_result, $con, 2);
	}else{
		$result = getItemsJSONStr($sql_result, $con);
	}
	echo "$result";

	// $fichier = fopen("test.json","w");
 //  	fwrite($fichier, $result);
 //  	fclose($fichier);

	mysql_close($con);
?>