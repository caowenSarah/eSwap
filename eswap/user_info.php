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
	$user_info = getUserInfo($user, $con);
	$nickname = $user_info[2];
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
		<form method="post" action="php/change_user_info.php" class="form_style">
			<hr />
			<div>Change your infomation</div>
			<label for="email">E-mail</label><textarea rows="1" cols="43" readonly="readonly"><?= $user_info[0] ?></textarea><br />
			<!-- <label for="email">E-mail</label><input type="text" name="email" pattern="^[a-zA-Z_\-]+@(([a-zA-Z_\-])+\.)+[a-zA-Z]{2,4}$" title="An e-mail address" required="required" value="<?= $user_info[0] ?>" /><br /> -->
			<label for="password">Password</label><input type="password" name="password" pattern="[a-zA-Z_0-9]{6,}" title="Only a-z, A-Z, 0-9 and '_' allowed and at least 6 characters" /><br />
			<label for="nickname">Nickname</label><input type="text" name="nickname" pattern="[a-zA-Z_0-9]+" title="Only a-z, A-Z, 0-9 and '_' allowed" value="<?= $nickname ?>" /><br />
			<label for="firstname">First name</label><input type="text" name="firstname" pattern="[a-z A-Z]+" title="Your first name" value="<?= $user_info[3] ?>" /><br />
			<label for="lastname">Last name</label><input type="text" name="lastname" pattern="[a-z A-Z]+" title="Your last name" value="<?= $user_info[4] ?>" /><br />
			<label for="region">Region</label><input type="text" name="region" value="<?= $user_info[5] ?>" /><br />
			<label for="mobilenum">Mobile number</label><input type="text" name="mobilenum" pattern="[0-9]{11}" title="For example:13900000000" value="<?= $user_info[6] ?>" /><br />

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