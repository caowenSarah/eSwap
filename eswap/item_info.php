<?php
	session_start();
	if (isset($_SESSION["user"])){
		$user = $_SESSION["user"];
	}else{
		$user = "";
	}
	include("include/util.php");
	$id = $_GET["id"];
	$con = connect_db();
	mysql_select_db("eswap", $con);
	$item_info = getItemInfo($id, $con);
	$nickname = getNickName($user, $con);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/eSwap/css/banner.css" type="text/css">
	<link rel="stylesheet" href="/eSwap/css/footer.css" type="text/css">
	<link rel="stylesheet" href="/eSwap/css/sign_up.css" type="text/css">
  	<script src="js/nav_display.js" type="text/javascript"></script>
	<title>eSwap</title>
</head>
<body>
	<?php include("include/banner.php") ?>
	<div class="form_style">
		<form method="post" action="php/change_item_info.php?id=<?= $id ?>" class="form_style">
			<hr />
			<div>Change your barter infomation</div>
			<label for="category">Category</label><input type="text" name="category" pattern="[a-zA-Z 0-9]+" title="Only a-z, A-Z and whitespace allowed" value="<?= $item_info[2] ?>" /><br />
			<label for="itemname">Item Name</label><input type="text" name="itemname" pattern="[a-z A-Z0-9]+" title="Item name" value="<?= $item_info[3] ?>" /><br />
			<label for="description">Description</label><input type="text" name="description" value="<?= $item_info[4] ?>" /><br />
			<label for="exchange">Exchange</label><input type="text" name="exchange" value="<?= $item_info[5] ?>" /><br />
			<label for="swaped">Swaped</label><input class="radio" type="radio" name="swaped" value="yes" />Yes
			<input class="radio" type="radio" name="swaped" value="no" checked="checked" />No <br/>

			<div class="submit">
				<input type="submit" class="button" value="Submit" />
				<input type="reset" class="button" value="Reset" />
			</div>
			<hr />
		</form>
	</div>
	<?php mysql_close($con);
	include("include/footer.html"); ?>
</body>
</html>