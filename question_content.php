<?php
		session_start();
	include("process/sql_connect.php");
	include("process/common.php");

	$user_id = $_SESSION['userid'];

	if (!isset($user_id)) {
		header("location: index.php");
	}

	$question_id = $_GET['question_id'];
	$question = mysql_query(
		"SELECT questions.ask_date, 
				questions.question_id, 
				questions.content, 
				users.user_id,
				users.username,
				user_profiles.prof_pic,
				user_profiles.firstname,
				user_profiles.lastname
		FROM questions 
		INNER JOIN users
		INNER JOIN user_profiles
		ON questions.user_id = users.user_id AND users.user_id = user_profiles.user_id
		WHERE questions.question_id = '$question_id'");
	$question = mysql_fetch_array($question);

	$answers_result = mysql_query(
		"SELECT answers.answer_date,
				answers.answer_id, 
				answers.content,
				answers.average,
				users.user_id,
				users.username,
				user_profiles.prof_pic,
				user_profiles.firstname,
				user_profiles.lastname
		FROM answers 
		INNER JOIN users 
		INNER JOIN user_profiles
		ON answers.user_id = users.user_id AND users.user_id = user_profiles.user_id
		WHERE answers.question_id = '$question_id'
		ORDER BY answers.answer_id DESC");
	
	$answers = array();
	while ($answer = mysql_fetch_array($answers_result)) {
		array_push($answers, $answer);
	}

	$user = mysql_query("SELECT * FROM users WHERE user_id = '$user_id'");
	$user = mysql_fetch_array($user);

?>

<?php include('fronts/header.php'); ?>
		<div class="wrapper">
			<div class="content">
				<div class="container0" style="border-radius: 0px 20px 20px 20px;">
					<div class="question">
						<div id="profile_picture" style="background: url('images/prof_pics/<?= $question['prof_pic']; ?>') no-repeat; background-size: 60px 60px"></div>
						<div class="question_content"> 
							<div id="question_main"><a href="<?php echo 'user_profile.php?profile_id='.$question['user_id']; ?>"><?php echo ucfirst($question['firstname']) . ' ' . ucfirst($question['lastname']); ?></a> asked
								<br>"<?php echo nl2br(formatizeHashTags($question['content'])); ?>"</div>
							<p class="question_info"  p align="center"><?php echo formatizeTime($question['ask_date']); ?></p>
							<div id="question_text"></div>
							<?php
								if ($question['user_id'] != $user_id) {
									$question_id = $question['question_id'];
									$hasFollowed = mysql_query("SELECT COUNT(*) FROM question_follow WHERE question_id = '$question_id' AND user_id = '$user_id'");
									if ($hasFollowed[0] == 1) {
										echo '<span id="follow_question_btn" class="question_buttons">You followed this!</span>';
									} else {
										echo '<a id="follow_question_btn" class="question_buttons" style="cursor: pointer; font-size: 12px" onclick="followQuestion('.$user_id.', '.$question_id.', \'follow_question_btn\')">Follow Question</a>';
									}
								}
							?>
							<form action="process/answer.php" method="POST">
								<input type="hidden" name="question_id" value="<?php echo $question['question_id']; ?>" />
								<textarea id="answer" name="content" placeholder="Answer this question..."></textarea>
								<input type="submit" id="answer_button" value="answer"/>
							</form>
							<?php 
								$answerCtr = 0;
								foreach ($answers as $answer) : ?>
								<div id="pp" style="background: url('images/prof_pics/<?= $answer['prof_pic']; ?>') no-repeat; background-size: 40px 40px"></div>
								<div id="username"><a href="<?php echo 'user_profile.php?profile_id='.$answer['user_id']; ?>"><?php echo $answer['username']; ?></a></div>
								<div class="question_info"><?php echo formatizeTime($answer['answer_date']); ?></div>
								<div id="answer_content"><?php echo nl2br($answer['content']); ?><br/>

									<span>Rating: <?= $answer['average']; ?>%</span>
										<?php
											$answer_id = $answer['answer_id'];
											$hasRated = mysql_query("SELECT level_ratings FROM ratings WHERE user_id = '$user_id' AND answer_id = '$answer_id'");
											if (mysql_num_rows($hasRated) > 0) {
												$hasRated = mysql_fetch_array($hasRated);
												echo '<div>You rated this answer as '.$hasRated['level_ratings'].'.</div>';
											} else {
										?>
										<div id="direct_rate_<?= $answerCtr; ?>">
											<input id="user_id" type="hidden" value="<?= $user_id; ?>"/>
											<input id="question_id" type="hidden" value="<?= $question['question_id']; ?>" />
											<input id="answer_id" type="hidden" value="<?= $answer['answer_id']; ?>" />
											<input id="rating" type="hidden" value="0"/>
											<input type="radio" name="rating" onclick="passToHidden(1, 'rate_btn_<?= $answerCtr; ?>', '#direct_rate_<?= $answerCtr; ?> #rating')"/> 1&nbsp&nbsp&nbsp
											<input type="radio" name="rating" onclick="passToHidden(2, 'rate_btn_<?= $answerCtr; ?>', '#direct_rate_<?= $answerCtr; ?> #rating')"/> 2&nbsp&nbsp&nbsp
											<input type="radio" name="rating" onclick="passToHidden(3, 'rate_btn_<?= $answerCtr; ?>', '#direct_rate_<?= $answerCtr; ?> #rating')"/> 3&nbsp&nbsp&nbsp
											<input type="radio" name="rating" onclick="passToHidden(4, 'rate_btn_<?= $answerCtr; ?>', '#direct_rate_<?= $answerCtr; ?> #rating')"/> 4&nbsp&nbsp&nbsp
											<input type="radio" name="rating" onclick="passToHidden(5, 'rate_btn_<?= $answerCtr; ?>', '#direct_rate_<?= $answerCtr; ?> #rating')"/> 5 
											<input type="submit" id="answer_button" class="rate_btn_<?= $answerCtr; ?>" style="visibility: collapse" value="Rate" 
											onclick="processRating($('#direct_rate_<?= $answerCtr; ?> #user_id').val(), $('#direct_rate_<?= $answerCtr; ?> #question_id').val(), $('#direct_rate_<?= $answerCtr; ?> #answer_id').val(), $('#direct_rate_<?= $answerCtr; ?> #rating').val(), 'direct_rate_<?= $answerCtr; ?>')"/>
										</div>

									<?php } ?>

									<form action="process/comment.php" method="POST">
										<input type="hidden" name="question_id" value="<?php echo $question['question_id']; ?>" />
										<input type="hidden" name="answer_id" value="<?php echo $answer['answer_id']; ?>" />
										<textarea id="commentbox" name="content" placeholder="Write a comment..."></textarea>
										<input type="submit" id="answer_button" value="answer"/>
									</form>
									<?php
										$answer_id = $answer['answer_id'];
										$comments_result = mysql_query(
												"SELECT comments.comment_date,
														comments.comment_id, 
														comments.content, 
														users.user_id,
														users.username,
														user_profiles.prof_pic,
														user_profiles.firstname,
														user_profiles.lastname
												FROM comments
												INNER JOIN users
												INNER JOIN user_profiles
												ON comments.user_id = users.user_id AND users.user_id = user_profiles.user_id
												WHERE comments.answer_id = '$answer_id'
												ORDER BY comments.answer_id DESC");
										
										$comments = array();
										while ($comment = mysql_fetch_array($comments_result)) {
											array_push($comments, $comment);
										}

										foreach ($comments as $comment) :
									?>
										<div id="pp" style="background: url('images/prof_pics/<?= $comment['prof_pic']; ?>') no-repeat; background-size: 40px 40px"></div>
										<div id="username"><a href="<?php echo 'user_profile.php?profile_id='.$answer['user_id']; ?>"><?php echo $comment['username']; ?></a></div>
										<div class="question_info"><?php echo formatizeTime($comment['comment_date']); ?></div>
										<div id="comment_content"><?php echo nl2br($comment['content']); ?></div>
									<?php endforeach; ?>
								</div>
							<?php $answerCtr++; endforeach; ?>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<script src="scripts/jquery-1.9.1.js"></script>
		<script src="scripts/scripts.js"></script>
<?php include('fronts/footer.php'); ?>