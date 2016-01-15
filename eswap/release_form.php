<?php 
	session_start();
	if(isset($_SESSION["user"])){
		$user = $_SESSION["user"];
	}else{
		header("Location: /eSwap/error.php?type=release");
		die();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/sign_up.css" />
	<title>Sign up</title>
</head>
<body>
	<div class="form_style">
		<form method="post" action="php/release.php" class="form_style" enctype="multipart/form-data">
			<hr />
			<div>Propose a barter</div>
			<label for="name">Item name</label><input id="name" type="text" name="name" required="required" /><br />
			<label for="category">Category</label><input id="category" type="text" name="category" pattern="[a-z A-Z]+" title="Category" required="required" /><br />
			<label for="description">Description</label><input id="description" type="text" name="description" required="required" /><br />
			<label for="swapfor">Swap for</label><input id="swapfor" type="text" name="swapfor" required="required" /><br />
			<label for="image">Image</label><input id="image" name="image" type="file" accept=".jpg" required="required"/><br />

			<div class="submit"><input type="submit" name="submit" value="Submit" /></div>
		</form>
	</div>
</body>
</html>
