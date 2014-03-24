<?php
	session_start();
	include("process/sql_connect.php");
	include("process/common.php");

	$user_id = $_SESSION['userid'];
	$category = (isset($_GET['category'])) ? $_GET['category'] : '';
	$hashtag = (isset($_GET['hashtag'])) ? $_GET['hashtag'] : '';
	$question_result;

	if (!isset($user_id)) {
		header("location: index.php");
	}

	if ($category != '' && $hashtag != '') {

	} else if ($category == '' && $hashtag != '') {
		$questions_result = mysql_query(
			"SELECT users.username, 
					users.user_id,
					user_profiles.prof_pic,
					user_profiles.firstname,
					user_profiles.lastname,
					questions.content, 
					questions.question_id, 
					questions.ask_date 
			FROM questions 
			INNER JOIN users
			INNER JOIN user_profiles
			INNER JOIN question_hashtags
			INNER JOIN hashtags
			ON questions.user_id = users.user_id
			AND users.user_id = user_profiles.user_id
			AND questions.question_id = question_hashtags.question_id
			AND question_hashtags.hashtag_id = hashtags.hashtag_id
			AND hashtags.hashtag = '$hashtag'
			ORDER BY questions.question_id DESC");
		
		$question_list = array();
		while ($question = mysql_fetch_assoc($questions_result)) {
			array_push($question_list, $question);
		}
	} else if ($category != '' && $hashtag == '') {

	} else {

	}

	$user = mysql_query(
		"SELECT users.user_id,
				users.username,
				user_profiles.prof_pic
		FROM users
		INNER JOIN user_profiles
		ON users.user_id = user_profiles.user_id
		WHERE users.user_id = '$user_id'");
	$user = mysql_fetch_assoc($user);
	
	$sub_categories = mysql_query("SELECT * FROM sub_categories");
	
	$sub_category_list = array();
	while ($sub_category = mysql_fetch_assoc($sub_categories)) {
		array_push($sub_category_list, $sub_category);
	}
?>
<html>
	<head>
		<title><?= ucfirst($user['username']); ?></title>

<?php include('fronts/header.php'); ?>
		<div class="wrapper">	
			<div class="content">
				<div class="ask">
					<img src="images/prof_pics/<?= $user['prof_pic']; ?>" class="prof_pic"/>
					<div class="field">
						<form action="process/question.php" method="POST">
							<!-- <input type="textarea" id="textarea" name="question"/> -->
							<textarea id="textarea" name="question" placeholder="Are you curious of something? Don't hesitate to tweak me here! (Add with hashtags or mentions)"></textarea>
							<div class="below_question">
								<select id="tag" name="category">
									<?php foreach ($sub_category_list as $subCategory) : ?>
										<option value="<?= $subCategory['sub_category_id'] * 100 + $subCategory['category_id']; ?>"><?= $subCategory['name']; ?></option>
									<?php endforeach; ?>
									<option value="1100" selected>Uncategorized</option>
								</select>
								<!-- <input type="textarea" id="tag" placeholder="#tags (separated by commas)"/> -->
								<input type="submit" id="post_button" value="Post"/>
							</div>
						</form>
					</div>
				</div>
								
				<div class="container0" style="border-radius: 0px 20px 20px 20px;">
					<?php 
						$questionCtr = 0;
						foreach ($question_list as $question) : ?>
						<div class="question">
							<div id="profile_picture" style="background: url('images/prof_pics/<?= $question['prof_pic']; ?>') no-repeat; background-size: 60px 60px"></div>
							<div class="question_content"> 
								<div id="username"><a href="<?php echo 'user_profile.php?profile_id='.$question['user_id']; ?>"><?php echo ucfirst($question['firstname']) . ' ' . ucfirst($question['lastname']); ?></a></div>
								<div class="question_info"><?php echo formatizeTime($question['ask_date']); ?></div>
								<div id="question_text"><?php echo nl2br(formatizeHashTags($question['content'])); ?></div>
								<?php
									if ($question['user_id'] != $user_id) {
										$question_id = $question['question_id'];
										$hasFollowed = mysql_query("SELECT COUNT(*) FROM question_follow WHERE question_id = '$question_id' AND user_id = '$user_id'");
										if ($hasFollowed[0] == 1) {
											echo '<span id="follow_question_btn_'.$questionCtr.'" class="question_buttons">You followed this!</span> |';
										} else {
											echo '<a id="follow_question_btn_'.$questionCtr.'" class="question_buttons" style="cursor: pointer; font-size: 12px" onclick="followQuestion('.$user_id.', '.$question_id.', \'follow_question_btn_'.$questionCtr.'\')">Follow Question</a> |';
										}
									}
								?>
								<a href="<?php echo 'question_content.php?question_id=' . $question['question_id']; ?>" type="button" class="question_buttons" name="follow_question">Expand</a><br>
								<form action="process/answer.php" method="POST">
									<input type="hidden" name="question_id" value="<?php echo $question['question_id']; ?>" />
									<textarea id="answer" name="content" placeholder="Answer this question..."></textarea>
									<input type="submit" id="answer_button" value="answer"/>
								</form>
							</div>
						</div>
					<?php $questionCtr++; endforeach; ?>
				</div>
				
				<div class="container2" style="margin-top: -193px">
					<div style="font-size: 20px; text-align: center; font-family: 'Scribble Box'">Trending</div>
					<div class="contain">
						<?php
							$allHashtags = mysql_query("SELECT hashtag_id, hashtag FROM hashtags");
							$hashtags = array();
							while ($aHashtag = mysql_fetch_assoc($allHashtags)) {
								$hId = $aHashtag['hashtag_id'];
								$tmpCount = mysql_query("SELECT COUNT(*) FROM question_hashtags WHERE hashtag_id = '$hId'");
								$tmpCount = mysql_fetch_array($tmpCount);
								array_push($hashtags, array('counts' => $tmpCount[0], 'hashtag'=> $aHashtag['hashtag']));
							}
							usort($hashtags, "cmp");
							$size = (sizeof($hashtags) < 10) ? sizeof($hashtags) : 10;

							for ($i = 0; $i < $size; $i++) : ?>
								<div class="little_steins">
									<a href="filtered.php?hashtag=<?= $hashtags[$i]['hashtag']; ?>" style="font-family: sans-serif; color: #fff">#<?= $hashtags[$i]['hashtag']; ?></a>
								</div>
							<?php endfor;
						?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		<script src="scripts/jquery-1.9.1.js"></script>
		<script src="scripts/scripts.js"></script>
<?php include('fronts/footer.php'); ?>