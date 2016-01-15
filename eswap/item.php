<?php
	session_start();
	if (isset($_SESSION["user"])) {
		$user = $_SESSION["user"];
	}else{
		$user = "";
	}
	$id = $_GET["id"];
	include("include/util.php");
	$con = connect_db();
	mysql_select_db("eswap", $con);
	$nickname = getNickName($user, $con);
	$item_info = getItemInfo($id, $con);
	$user_info = getUserInfo($item_info["Email"], $con);
	$proposer = $user_info[2];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/eSwap/css/banner.css" type="text/css">
	<link rel="stylesheet" href="/eSwap/css/footer.css" type="text/css">
	<link rel="stylesheet" href="/eSwap/css/item.css" type="text/css">
  	<script src="js/nav_display.js" type="text/javascript"></script>
	<title>eSwap</title>
</head>
<body>
	<?php include("include/banner.php") ?>
	<div id="content">
		<div id="above">
			<div id="img"><img src="<?= $item_info['Image']?>" alt="image" /></div>
			<div id="info">
				<div id="name" class="info">Item Name: <span><?= $item_info["ItemName"] ?></span></div>
				<div id="category" class="info">Category: <span><?= $item_info["Category"] ?></span></div>
				<div id="exchange" class="info">Exchange: <span><?= $item_info["Wantfor"] ?></span></div>
				<div id="poster" class="info">Poster: <span><?= $proposer ?></span></div>
				<div id="region" class="info">Region: <span><?= $user_info[5] ?></span></div>
				<div id="date" class="info">Update Date: <span><?= $item_info["UpdateDate"] ?></span></div>
				<div id="wantit"><a href="leave_msg.php?id=<?= $id ?>">I want it!</a></div>
			</div>
		</div>
		<div id="below">
			<div id="description" class="info">Description: <span><?= $item_info["Description"] ?></span></div>
		</div>
	</div>
	<?php mysql_close($con);
	include("include/footer.html"); ?>
</body>
</html>
