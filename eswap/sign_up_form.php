<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/sign_up.css" />
	<title>Sign up</title>
</head>
<body>
	<div class="form_style">
		<form method="post" action="php/sign_up.php" class="form_style">
			<hr />
			<div>Sign up for eSwap</div>
			<label for="email">E-mail</label><input type="text" name="email" pattern="^[a-zA-Z_\-0-9]+@(([a-zA-Z_\-])+\.)+[a-zA-Z]{2,4}$" title="An e-mail address" required="required" /><br />
			<label for="password">Password</label><input type="password" name="password" pattern="[a-zA-Z_0-9]{6,}" title="Only a-z, A-Z, 0-9 and '_' allowed and at least 6 characters" required="required" /><br />
			<label for="nickname">Nickname</label><input type="text" name="nickname" pattern="[a-zA-Z_0-9]+" title="Only a-z, A-Z, 0-9 and '_' allowed" required="required" value="test" /><br />
			<label for="firstname">First name</label><input type="text" name="firstname" pattern="[a-z A-Z]+" title="Your first name" required="required" /><br />
			<label for="lastname">Last name</label><input type="text" name="lastname" pattern="[a-z A-Z]+" title="Your last name" required="required" /><br />
			<label for="region">Region</label><input type="text" name="region" required="required" /><br />
			<label for="mobilenum">Mobile number</label><input type="text" name="mobilenum" pattern="[0-9]{11}" title="For example:13900000000" required="required" /><br />

			<div class="submit"><input type="submit" class="button" value="Sign up" /></div>
			<hr />
			<p id="signin"><a href="index.php">Sign in</a></p>
		</form>
	</div>
</body>
</html>