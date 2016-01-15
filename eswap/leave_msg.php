<?php
	session_start();
	if (isset($_SESSION["user"])){
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
	$proposer_name = getNickName($item_info["Email"], $con);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/eSwap/css/banner.css" type="text/css">
	<link rel="stylesheet" href="/eSwap/css/footer.css" type="text/css">
	<link rel="stylesheet" href="/eSwap/css/sign_up.css" type="text/css">
  <script src="js/nav_display.js" type="text/javascript"></script>
  <script src="js/mail.js" type="text/javascript"></script>
  <script src="js/simpleajax.js" type="text/javascript"></script>
	<title>eSwap</title>
</head>
<body>
	<?php include("include/banner.php") ?>
	<div class="form_style">
		<form method="post" action="javascript:void(0)" class="form_style">
			<hr />
			<div>Leave Your Message to <?= $proposer_name ?></div>
			<label for="msg">Message</label><textarea name="msg" id="msg" cols="30" rows="10">I am interested in your <?= $item_info['ItemName'] ?>...</textarea><br />
			<input id="proposer_email" type="hidden" name="proposer_email" value="<?= $item_info['Email']?>" />
			<input id="proposer_name" type="hidden" name="proposer_name" value="<?= $proposer_name ?>" />
			<input id="visitor_name" type="hidden" name="visitor_name" value="<?= $nickname ?>" />
			<input id="visitor_email" type="hidden" name="visitor_email" value="<?= $user ?>" />
			
			<div id="submit" class="submit"><input type="submit" class="button" value="Submit" /></div>
			<hr />
		</form>
	</div>
	<?php mysql_close($con);
	include("include/footer.html"); ?>
</body>
</html>