<?php
	session_start();
	if(isset($_SESSION["user"])){
		$user = $_SESSION["user"];
	}
	
	# recieve input variables
	include("../include/util.php");
	$datapath = itemdbpath();
	# check input error
	$items_array = array("name", "category", "description", "swapfor");
	$paras = array();
	for ($i=0; $i < count($items_array); $i++) { 
		$paras[$i] = trim(str_replace("\n", " ", $_POST[$items_array[$i]]));
		if (empty($paras[$i])) {
			header("Location: /eSwap/error.php?type=$items_array[$i]");
			die();
		}
	}

	// $name = trim(str_replace("\n", " ", $_POST["name"]));
	// $category = trim(str_replace("\n", " ", $_POST["category"]));
	// $description = trim(str_replace("\n", " ", $_POST["description"]));
	// $swapfor = trim(str_replace("\n", " ", $_POST["swapfor"]));
	// # check input error
	// if (empty($name) || empty($category) || empty($description) || empty($swapfor)) {
	// 	header("Location: error.php?type=release");
	// 	break;
	// }

	# recieve image file and move it to database floder
	if(is_uploaded_file($_FILES["image"]["tmp_name"])){
		$images = glob("../$datapath/images/$paras[1]*");
		$num_images = count($images) + 1;
		$image_name = $paras[1] . $num_images . ".jpg";
		move_uploaded_file($_FILES["image"]["tmp_name"], "../$datapath/images/$image_name");
	}
	# insert into database
	$all_images = glob("../$datapath/images/*.jpg");
	$insert_id = count($all_images)-1;
	$date = date("Y m d h:i");
	$con = connect_db();
	mysql_select_db("eswap", $con);
	$sql = "INSERT INTO items (_id, Image, Category, ItemName, Description, Wantfor, Email, UpdateDate, Swaped) 
	VALUES ('$insert_id', '$datapath/images/$image_name', '$paras[1]', '$paras[0]', '$paras[2]', '$paras[3]', '$user', '$date', 'no')";
	mysql_query($sql, $con);
	mysql_close($con);
	header("Location: /eSwap/home.php");
?>