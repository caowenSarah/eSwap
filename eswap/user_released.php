<?php
	session_start();
	if (isset($_SESSION["user"])){
		$user = $_SESSION["user"];
	}else{
		$user = "";
	}
	include("include/util.php");
	$con = connect_db();
	mysql_select_db("eswap", $con);
	$sql_result = mysql_query("SELECT * FROM items WHERE Email='$user'", $con);
	$released_items = getItemsArray($sql_result, $con, 1, true);
	// $user_info = getUserInfo($user, $con);
	$nickname = getNickname($user, $con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>eSwap</title>
	<link rel="stylesheet" href="/eSwap/css/footer.css" type="text/css" />
	<link rel="stylesheet" href="/eSwap/css/banner.css" type="text/css" />
	<link rel="stylesheet" href="/eSwap/css/released.css" type="text/css" />
  <script src="js/nav_display.js" type="text/javascript"></script>
</head>
<body>
	<?php include("include/banner.php"); ?>
	<div id="container">
		<div class="single_col" id="first_col"><?= $released_items[0] ?></div>
	</div>
	<?php mysql_close($con);
	include("include/footer.html"); ?>
</body>
</html>