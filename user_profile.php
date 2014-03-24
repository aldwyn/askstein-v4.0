<?php
	session_start();
	include("process/sql_connect.php");
	include('process/common.php');

	$user_id = $_SESSION['userid'];
	$profile_id = $_GET['profile_id'];

	if (!isset($user_id)) {
		header("location: index.php");
	}

	$user = mysql_query("SELECT * FROM users WHERE user_id = '$user_id'");
	$user = mysql_fetch_array($user);

	$user_profile = mysql_query("SELECT * FROM user_profiles WHERE user_id = '$profile_id'");
	$user_profile = mysql_fetch_array($user_profile);

	$questions_result = mysql_query(
		"SELECT users.user_id,
				questions.content,
				questions.ask_date,
				questions.question_id,
				user_profiles.firstname,
				user_profiles.lastname,
				user_profiles.prof_pic
		FROM users
		INNER JOIN user_profiles
		INNER JOIN questions 
		ON users.user_id = user_profiles.user_id
		AND questions.user_id = users.user_id
		WHERE users.user_id = '$profile_id'
		ORDER BY questions.question_id DESC");
	
	$question_list = array();
	while ($question = mysql_fetch_array($questions_result)) {
		array_push($question_list, $question);
	}

?>

<?php include('fronts/header.php'); ?>
		<div class="wrapper">
			<div class="cover">
				<div class="cover_info" style="background: url('images/cover_pics/<?= $user_profile['cover_pic']; ?>')"></div>
				<div class="user_info_container">
					<?php
						if ($profile_id != $user_id) {
							$hasFollowed = mysql_query("SELECT * FROM user_follow WHERE follower_id = '$user_id' AND follow_id = '$profile_id'");
							if (mysql_num_rows($hasFollowed) == 0) {
								echo '<a href="process/follow_user.php?toBeFollowed='.$profile_id.'"><input type="button" id="follow_button" value="FOLLOW"/></a>';
							} else {
								echo '<a href="process/follow_user.php?toBeUnfollowed='.$profile_id.'"><input type="button" id="follow_button" value="UNFOLLOW"/></a>';
							}
						} else {
							echo '<a href="settings.php?"><input type="button" id="follow_button" value="SETTINGS"/></a>';
						}
					?>
					<img src="images/prof_pics/<?= $user_profile['prof_pic']; ?>" class="prof_pic"/>
					<div class="user_info"><a href="#"><?php echo $user_profile['firstname'] . ' ' . $user_profile['lastname']; ?></a></div>
					<div class="user_description"><?php echo $user_profile['bio']; ?></div>
				</div>
			</div>
			
			<div class="content">								
				<div class="container0" style="border-radius: 0px 20px 20px 20px;">
					<?php foreach ($question_list as $question) : ?>
						<div class="question">
							<div id="profile_picture" style="background: url('images/prof_pics/<?= $question['prof_pic']; ?>') no-repeat; background-size: 60px 60px"></div>
							<div class="question_content"> 
								<div id="username"><a href="#"><?php echo $question['firstname'] . ' ' . $question['lastname']; ?></a></div>
								<div class="question_info"><?= formatizeTime($question['ask_date']); ?></div>
								<div id="question_text"><?php echo nl2br($question['content']); ?></div>
								<a href="<?php echo 'question_content.php?question_id=' . $question['question_id']; ?>" type="button" class="question_buttons" name="follow_question">Expand</a><br>
								<form action="#" method="POST">
									<input type="textarea" id="answer" placeholder="Answer this question..."/>
									<input type="submit" id="answer_button" value="answer">
								</form>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="container1" style="height: 300px"></div>

				<div class="clear"></div>
			</div>
		</div>
<?php include('fronts/footer.php'); ?>