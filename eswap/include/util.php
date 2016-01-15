<?php

# returns the relative path of the item database folder
function itemdbpath(){
	return "eSwapItemDB";
}

# Connect database root
function connect_db(){
	$con = mysql_connect("localhost", "root", "");
	if(!$con){
		die('Could not connect: ' . mysql_error());
	}
	return $con;
}

# judge whether the given table is exist in the database
function check_db_is_exist($db_name) {
    $row=mysql_query('show databases;');
    $database=array();
    while ($result=mysql_fetch_array($row,MYSQL_ASSOC)){
        $database[]=$result['Database'];
    }
    unset($result,$row);
    mysql_close();
    
    if(in_array(strtolower($db_name),$database)){
        return true;
    }else{
        return false;
    }
}

function getNickname($email, $con){
	$nick_result = mysql_query("SELECT Nickname FROM users WHERE Email='$email'", $con);
	$nickname = mysql_fetch_row($nick_result)[0];
	return $nickname;
}

function getUserInfo($email, $con){
	$sql_result = mysql_query("SELECT * FROM users WHERE Email='$email'", $con);
	$user_info = mysql_fetch_array($sql_result);
	return $user_info;
}

function getItemInfo($id, $con){
	$sql_result = mysql_query("SELECT * FROM items WHERE _id='$id'", $con);
	$item_info = mysql_fetch_array($sql_result);
	return $item_info;
}

// get JSON string showing items in column
function getItemsJSONStr($sql_result, $con, $num_col = 3){
	$array = getItemsArray($sql_result, $con, $num_col);

	for ($i=0; $i < $num_col; $i++) { 
		$strs[$i] = "\"" . $array[$i] . "\"";
	}
	if ($num_col == 2) {
		$json_str = '{"left":' . $strs[0] . ',' . 
		'"right":' . $strs[1] . '}';
	}else{
		$json_str = '{"left":' . $strs[0] . ',' . 
		'"middle":' . $strs[1] . ',' . 
		'"right":' . $strs[2] . '}';
	}
	return $json_str;
}

// get HTML string array showing items in column for home page
function getItemsArray($sql_result, $con, $array_len = 3, $is_refine = false){
	// initialize items array
	for ($i=0; $i < $array_len; $i++) { 
		$strs[$i] = "";
	}
	$idx = 0;
	while ($row = mysql_fetch_array($sql_result)) {
		$nickname = getNickname($row['Email'], $con);
		$strs[$idx % $array_len] = $strs[$idx % $array_len] . "<div class='item'>" .
		"<div class='item_image'><a href='/eSwap/item.php?id=" . $row['_id'] . "'><img src='" . $row['Image']."' /></a></div>" .
		"<div class='item_detail'>" .
		"<div class='item_name'>" . $row['ItemName'] . "</div>" .
		"<div class='item_category'>Category: <span>" . $row['Category'] . "</span></div>" .
		"<div class='item_desc'>Description: <span>" . $row['Description'] . "</span></div>" .
		"<div class='item_want'>Exchange: <span>" . $row['Wantfor'] . "</span></div>" .
		"<div class='item_want'>Poster: <span>" . $nickname."</span></div>" .
		"<div class='item_date'>Post date: <span>" . $row['UpdateDate'] . "</span></div>" .
		"</div>";
		if ($is_refine) {
			$strs[$idx % $array_len] = $strs[$idx % $array_len] . "<p class='refine_btn'><a href='/eSwap/item_info.php?id=$row[_id]' alt='refine'>Refine</a></p>";
		}
		$strs[$idx % $array_len] = $strs[$idx % $array_len] . "<hr />" . "</div>";
		$idx += 1;
	}
	return $strs;
}

// get HTML string array showing items in column for index page
function getItemsArrayForIdx($sql_result, $con, $array_len = 3){
	// initialize items array
	for ($i=0; $i < $array_len; $i++) { 
		$strs[$i] = "";
	}
	$idx = 0;
	while ($row = mysql_fetch_array($sql_result)) {
		$nickname = getNickname($row['Email'], $con);
		$strs[$idx % $array_len] = $strs[$idx % $array_len] . "<div class='item'>" .
		"<div class='item_image'><img src='" . $row['Image'] . "' /></div>" .
		"<div class='item_detail'>" .
		"<div class='item_name'>" . $row['ItemName'] . "</div>" .
		"<div class='item_category'>Category: <span>" . $row['Category'] . "</span></div>" .
		"<div class='item_desc'>Description: <span>" . $row['Description'] . "</span></div>" .
		"<div class='item_want'>Exchange: <span>" . $row['Wantfor'] . "</span></div>" .
		"<div class='item_want'>Poster: <span>" . $nickname."</span></div>" .
		"<div class='item_date'>Post date: <span>" . $row['UpdateDate'] . "</span></div>" .
		"</div>" .
		"<hr />" .
		"</div>";
		$idx += 1;
	}
	return $strs;
}
?>

