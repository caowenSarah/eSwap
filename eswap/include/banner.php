

<div id="banner">
	<div id="logo"><a href="/eSwap/home.php" alt="eSwap">eSwap</a></div>

	<ul id="nav">
	
	
		<li id="release"><a href="release_form.php">Release</a></li>
		<?php if ($user == "") {
			echo "<li id='login'><a href='index.php' alt='login'>Login</a></li>";
		}else{
			echo "<li id='user_name' onmouseover=show_list('user_nav') onmouseout=hide_list('user_nav')><a href='javascript:void(0)'>$nickname</a>
			<ul id='user_nav'>
				<li><a href='user_info.php'>Info</a></li>
				<li><a href='user_released.php'>Released</a></li>
			</ul>
		</li>";
		} ?>
		
	<li id="logout"><a href="php/logout.php">Logout</a></li>
	</ul>
</div>