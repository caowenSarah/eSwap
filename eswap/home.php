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
	$cat_result = mysql_query("SELECT DISTINCT Category FROM items", $con);
	$sql_result = mysql_query("SELECT * FROM items WHERE Swaped='no' ORDER BY _id DESC LIMIT 0,6", $con);
	$nickname = getNickname($user, $con);
	$items_array = getItemsArray($sql_result, $con);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>eSwap</title>
	<link rel="stylesheet" href="/eSwap/css/footer.css" type="text/css" />
	<link rel="stylesheet" href="/eSwap/css/banner.css" type="text/css" />
	<link rel="stylesheet" href="/eSwap/css/home.css" type="text/css" />
  <script src="js/simpleajax.js" type="text/javascript"></script>	
  <script src="js/load_more.js" type="text/javascript"></script>
  <script src="js/nav_display.js" type="text/javascript"></script>
</head>
<body>
	<?php include("include/banner.php") ?>
	<div id="content">
		<h1 id="heading">eSwap</h1>
		<div id="category">
			<ul>Category
				<?php while ($row = mysql_fetch_array($cat_result)) {
					echo "<li id=$row[0] class='cat_item'><a href='javascript:void(0)'>$row[0]</a></li>";
				} ?>
			</ul>
		</div>
		<div id="items">
			<div id="left_col" class="single_col"><?= $items_array[0]?></div>
			<div id="mid_col" class="single_col"><?= $items_array[1]?></div>
			<div id="right_col" class="single_col"><?= $items_array[2]?></div>
		</div>
		<a href="javascript:void(0)"><div id="more">Click for more</div></a>
	</div>
	<?php mysql_close($con);
	include("include/footer.html"); ?>
</body>
</html>
