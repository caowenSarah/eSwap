<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>eSwap</title>
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<script src="js/simpleajax.js" type="text/javascript"></script>	
  <script src="js/display.js" type="text/javascript"></script>
</head>
<body>
	<?php 
	include 'include/util.php';
	$con = connect_db();
	# Check whether database eswap is exist
	if(!check_db_is_exist("eswap")){
		mysql_query("CREATE DATABASE eswap", $con);
		mysql_select_db("eswap", $con);
		# Create table users in database eswap
		$sql = "CREATE TABLE users
		(
		Email varchar(25) NOT NUlL,
		PRIMARY KEY(Email),
		Password varchar(15),
		NickName varchar(15),
		FirstName varchar(15),
		LastName varchar(15),
		Region varchar(15),
		MobileNumber varchar(11)
		)";
		mysql_query($sql, $con);

		# Create table items in database eswap
		$sql1 = "CREATE TABLE items
		(
		_id int NOT NUlL AUTO_INCREMENT,
		PRIMARY KEY(_id),
		Image varchar(63),
		Category varchar(15),
		ItemName varchar(31),
		Description varchar(127),
		Wantfor varchar(127),
		Email varchar(31),
		UpdateDate varchar(16),
		Swaped varchar(3)
		)";
		mysql_query($sql1, $con);
		# Insert data
		$data = file(itemdbpath()."/data");
		$images = glob(itemdbpath()."/images/*.jpg");
		$users = file(itemdbpath()."/users");
		$sql_items = "INSERT INTO items (_id, Image, Category, ItemName, Description, Wantfor, Email, UpdateDate, Swaped) VALUES (";
		$sql_users = "INSERT INTO users (Email, Password, NickName, FirstName, LastName, Region, MobileNumber) VALUES (";
		for ($i=0; $i < count($data)-1; $i++) { 
			$tem_id = $i + 1;
			$sql_insert = $sql_items."'$tem_id', '$images[$i]', $data[$i])";
			mysql_query($sql_insert, $con);
		}
		for ($i=0; $i < count($users); $i++) { 
			$sql = $sql_users . "$users[$i])";
			mysql_query($sql, $con);
		}
	}
	mysql_select_db("eswap", $con);
	$query_result = mysql_query("SELECT * FROM items WHERE Swaped='no' ORDER BY _id DESC LIMIT 6", $con);
	$items_array = getItemsArrayForIdx($query_result, $con, 2);
	?>
	<div id="container">
		<div id="left_part">
			<a href="home.php" alt="check more">
				<div class="single_col" id="first_col"><?= $items_array[0] ?></div>
				<div class="single_col" id="sec_col"><?= $items_array[1] ?></div>
			</a>
		</div>
		<div id="right_part">
			<div class="form_style">
				<form method="post" action="php/login.php" class="form_style">
				<hr />
				<div id="form_title">Sign in to eSwap</div>
					<label for="email">E-mail</label><input type="text" name="email" pattern="^[a-zA-Z_\-0-9]+@(([a-zA-Z_\-])+\.)+[a-zA-Z]{2,4}$" title="an e-mail address" required="required" /><br />
					<label for="pw">Password</label><input type="password" name="pw" required="required" /><br />
				<div class="submit">
					<input type="submit" id="submit" name="submit" value="Sign in" />
				</div>
				<hr />
				<p id="signup"><a href="sign_up_form.php" alt="signup">Sign up</a></p>
				</form>
			</div>			
		</div>
	</div>
	

</body>
</html>
<?php mysql_close($con); ?>
