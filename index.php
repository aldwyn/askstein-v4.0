<?php
	session_start();
	include("process/sql_connect.php");

	if (isset($_SESSION['userid'])) {
		header("location: home_user.php");
	}

	$questions_result = mysql_query(
		"SELECT questions.ask_date, 
				questions.question_id, 
				questions.content, 
				users.user_id,
				users.username
		FROM questions 
		INNER JOIN users 
		ON questions.user_id = users.user_id
		ORDER BY question_id DESC LIMIT 20");
	
	$question_list = array();
	while ($question = mysql_fetch_array($questions_result)) {
		array_push($question_list, $question);
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title> Askstein </title>
		<link rel="shortcut icon" href="images/logo.jpg">
		<link type="text/css" rel="stylesheet" href="styles.css" />
		<link type="text/css" rel="stylesheet" href="fonts.css" />
	</head>
	
	<body>
		<div class="wrapper">
			<header>
				<div class="container">
					<div class="title">
						<a href="index.php"><div id="logo"></div>
						<div id="site_name"> ASKSTEIN. </div>
						<div id="slogan"> Ask and you shall be answered. </div></a>
					</div>
				</div>
			</header>
			
			<div class="content">
				<!-- <div class="menu">
					<a href="#"><li><div id="selected">RECENT</div></li></a>
					<a href="index_popular.php"><li>POPULAR</li></a>
					<a href="#"><li>CHORVA</li></a>
				</div> -->
				<div class="container0">
					<?php foreach ($question_list as $question) : ?>
						<div class="question">
							<div id="profile_picture"></div>
							<div class="question_content"> 
								<div id="username"><a href="<?php echo 'user_profile.php?profile_id='.$question['user_id']; ?>"><?php echo $question['username']; ?></a></div>
								<div class="question_info"><?= $question['ask_date']; ?></div>
								<div id="question_text"><?= nl2br($question['content']); ?></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
					
				<div class="container1">
					<div id="text">Already a member?</div>
					<form action="process/login.php" method="POST" id="text">
						<div class="form_div">
							<div id="label">Username</div>
							<input type="text" id="loginform" name="username"/>
						</div>

						<div class="form_div">
							<div id="label">Password</div>
							<input type="password" id="loginform" name="pass"/>
						</div>
						<input type="submit" id="signup_button" value="LOGIN">
					</form>
				</div>

				<div class="container2">
					<div id="sign_up">LITTLE STEINS</div>
					<div class="contain">
						<div class="little_steins">
							<img src="images/background/bg21.jpg" id="pp">
							<div id="name">Aria Montgomery
								<div id="bio">Iskolar ng Bayan. Iskolar ng Bayan.</div>
								<div id="level">Level: Beginner</div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="little_steins">
							<img src="images/background/bg21.jpg" id="pp">
							<div id="name">Aria Montgomery
								<div id="bio">Iskolar ng Bayan. Iskolar ng Bayan.</div>
								<div id="level">Level: Beginner</div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="little_steins">
							<img src="images/background/bg21.jpg" id="pp">
							<div id="name">Aria Montgomery
								<div id="bio">Iskolar ng Bayan. Iskolar ng Bayan. Iskolar ng Bayan. Iskolar ng Bayan.</div>
								<div id="level">Level: Beginner</div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				
				<div class="container3">
					<div id="text">Doesn't have an account? </div>
					<div id="sign_up">SIGNUP now</div>
					<form action="process/sign_up.php" method="POST" id="text">
						<div class="form_div">
							<div id="label">Username</div>
							<input type="text" id="loginform" name="username"/>
						</div>

						<div class="form_div">
							<div id="label">Email Address</div>
							<input type="email" id="loginform" name="email"/>
						</div>

						<div class="form_div">
							<div id="label">Password</div>
							<input type="password" id="loginform" name="password"/>
						</div>

						<div class="form_div">
							<div id="label">Confirm Password</div>
							<input type="password" id="loginform" name="confirmpassword"/>
						</div>
						<input type="submit" id="signup_button" value="SIGNUP">
					</form>
				</div>

				<div class="container2">
					<div id="sign_up">CATEGORIES</div>
					<div class="contain">
						<div class="little_steins">
							<img src="thumbnail/arts.jpg" id="pp">
							<div id="name">Arts and Literature
								<div id="category_info">1000 Questions</div>
								<a id="category_info" href="javascript:hideshow(document.getElementById('subtopic1'))">3 Sub-topics</a>
								<div class="subtopics" id="subtopic1">

									<div id="subtopic">
										<img src="thumbnail/dance.jpg" id="pp">
										<div id="name" style="width: 170px">Dance
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
									<div id="subtopic">
										<img src="thumbnail/music.jpg" id="pp">
										<div id="name" style="width: 170px">Music
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
									<div id="subtopic">
										<img src="thumbnail/book.jpg" id="pp">
										<div id="name" style="width: 170px">Book
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="little_steins">
							<img src="thumbnail/computer.jpg" id="pp">
							<div id="name">Computers
								<div id="category_info">1000 Questions</div>
								<a id="category_info" href="javascript:hideshow(document.getElementById('subtopic2'))">3 Sub-topics</a>
								<div class="subtopics" id="subtopic2">
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Programming
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Software and Hardware
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Troubleshooting
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="little_steins">
							<img src="thumbnail/education.jpg" id="pp">
							<div id="name">Education
								<div id="category_info">1000 Questions</div>
								<a id="category_info" href="javascript:hideshow(document.getElementById('subtopic3'))">3 Sub-topics</a>
								<div class="subtopics" id="subtopic3">
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Homework
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Project
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Exam
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>	

						<div class="little_steins">
							<img src="thumbnail/electronics.jpg" id="pp">
							<div id="name">Electronics
								<div id="category_info">1000 Questions</div>
								<a id="category_info" href="javascript:hideshow(document.getElementById('subtopic4'))">3 Sub-topics</a>
								<div class="subtopics" id="subtopic4">
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Technology
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Device
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Invention
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>	

						<div class="little_steins">
							<img src="thumbnail/entertainment.jpg" id="pp">
							<div id="name">Entertainment
								<div id="category_info">1000 Questions</div>
								<a id="category_info" href="javascript:hideshow(document.getElementById('subtopic5'))">3 Sub-topics</a>
								<div class="subtopics" id="subtopic5">
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Games
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Hobbies
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Movie/Television
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>	

						<div class="little_steins">
							<img src="thumbnail/fashion.jpg" id="pp">
							<div id="name">Fashion and Beauty
								<div id="category_info">1000 Questions</div>
								<a id="category_info" href="javascript:hideshow(document.getElementById('subtopic6'))">3 Sub-topics</a>
								<div class="subtopics" id="subtopic6">
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Beauty and Skin Care
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Hair Styles
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Fashion
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>	

						<div class="little_steins">
							<img src="thumbnail/health.jpg" id="pp">
							<div id="name">Health
								<div id="category_info">1000 Questions</div>
								<a id="category_info" href="javascript:hideshow(document.getElementById('subtopic7'))">3 Sub-topics</a>
								<div class="subtopics" id="subtopic7">
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Medical Conditions and Procedures
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Drugs and Medicines
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Health Care Systems
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>	

						<div class="little_steins">
							<img src="thumbnail/politics.jpg" id="pp">
							<div id="name">Politics
								<div id="category_info">1000 Questions</div>
								<a id="category_info" href="javascript:hideshow(document.getElementById('subtopic8'))">3 Sub-topics</a>
								<div class="subtopics" id="subtopic8">
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Government
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Current Issue
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Law
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>	

						<div class="little_steins">
							<img src="thumbnail/science.jpg" id="pp">
							<div id="name">Science
								<div id="category_info">1000 Questions</div>
								<a id="category_info" href="javascript:hideshow(document.getElementById('subtopic9'))">3 Sub-topics</a>
								<div class="subtopics" id="subtopic9">
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Biology
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Math
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Engineering
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>	

						<div class="little_steins">
							<img src="thumbnail/travel.jpg" id="pp">
							<div id="name">Travel
								<div id="category_info">1000 Questions</div>
								<a id="category_info" href="javascript:hideshow(document.getElementById('subtopic10'))">3 Sub-topics</a>
								<div class="subtopics" id="subtopic10">
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Travel and Vacation Planning
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>

									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Tourism
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
									<div id="subtopic">
										<img src="images/background/bg21.jpg" id="pp">
										<div id="name" style="width: 170px">Road Trips
											<div id="category_info" style="width: 170px">1000 Questions</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="little_steins">
							<img src="thumbnail/uncategorized.jpg" id="pp">
							<div id="name">Uncategorized
								<div id="category_info">1000 Questions</div>
							</div>
							<div class="clear"></div>
						</div>					
						
					</div>
				</div>

				<div class="clear"></div>
			</div>

		<script src="scripts/jquery-1.3.2.min"></script>
		<script src="scripts/scripts.js"></script>
		
<?php include('fronts/footer.php'); ?>