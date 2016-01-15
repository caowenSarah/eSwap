<?php
	session_start();
	if(isset($_SESSION["user"])){
		$user = $_SESSION["user"];
	}else{
		$user = "";
	}
	include("include/util.php");
	
	$type = $_GET["type"];
	if ( $type === "nodb" ) {
		$message = "Please sign up for eSwap!";
		$action = "index.php";
	} elseif ( $type === "wrongpw" ) {
		$message = "Password is incorrect";
		$action = "index.php";		
	} elseif ( $type === "registered") {
		$message = "This email has been registered!";
		$action = "sign_up_form.php";
	} elseif ( $type === "release") {
		$message = "You must sign in before you propose a barter!";
		$action = "index.php";
	} elseif ( $type === "name" || $type === "category" || $type === "description" || $type === "swapfor") {
		$message = "Release error: $type is empty!";
		$action = "release_form.php";
	}
	else {
		$message = "Sign up error: $type is empty!";
		$action = "sign_up_form.php";
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>2DO</title>
    <meta charset="utf-8" />
    <link href="css/error.css" type="text/css" rel="stylesheet" />
  </head>
<body>
	<div id="top_banner">

	</div>
	
	<div id="content">
		<form method="get" action="<?=$action?>" class="form_style">
			<div id="message"><?= $message ?></div>
			<input class="button" type="submit" value="OK" />
		</form>
	</div>
</body>
</html>