<!DOCTYPE HTML>
<link rel="shortcut icon" href="images/logo.jpg">
		<link type="text/css" rel="stylesheet" href="fonts.css" />
		<link type="text/css" rel="stylesheet" href="styles.css" />
	</head>
	
	<body>
		<header>
			<div class="container">
				<div class="title">
					<a href="index.php"><div id="logo"></div>
					<div id="site_name">askstein.</div>
					<div id="slogan">Ask and you shall be answered.</div></a>
				</div>
				
				<nav><ul>
					<li><a href="home_user.php"><img src="images/home.png" id="image"><br>home</a></li>
					<li><a href="<?php echo 'user_profile.php?profile_id='.$user_id; ?>"><img src="images/login.png" id="image"><br>profile</a></li>
					<li><a href="settings.php"><img src="images/settings.png" id="image"><br>settings</a></li>
					<li><a href="process/logout.php"><img src="images/logout.png" id="image"><br>logout</a></li>
				</nav>

				<div class="search">
					<form action="search.php" method="get">
						<input type="search" id="searchbar" name="query" placeholder="Search for questions."/>
						<input id="submit_button" type="submit" value=""/>
					</form>
					<div id="searchbar"></div>
				</div>
			</div>
		</header>
			