<?php
	session_start();
	include("sql_connect.php");
	include("common.php");

	$user_id = $_SESSION['userid'];
	$question = str_replace('\'', '\\\'', $_POST['question']);
	$category = $_POST['category'];
	
	if (str_word_count($question) != 0 && trim($question) != '') {
		mysql_query("INSERT INTO questions (user_id, content) VALUES ('$user_id', '$question')");
		$question_id = mysql_insert_id();

		$tmpQuestionId = mysql_insert_id();
		$tmpCategoryId1 = $category / 100;
		$tmpCategoryId2 = $category % 100;
		mysql_query("INSERT INTO question_categories VALUES ('$tmpQuestionId', '$tmpCategoryId1', '$tmpCategoryId2')");

		if (sizeof(explode('#', $question)) > 1) {
			$tmpVarForTags = preg_split('/(\r\n)|\n|\r/', $question);
			$tmpArrayForTags = array();
			$tagIds = array();
			
			foreach ($tmpVarForTags as $candidate) {
				$tmp = multiexplode($candidate);
				foreach ($tmp as $tmpBit) {
					if (!in_array($tmpBit, $tmpArrayForTags) && $tmpBit != '' && $tmpBit[0] == '#') {
						array_push($tmpArrayForTags, substr($tmpBit, 1));
					}
				}
			}

			foreach ($tmpArrayForTags as $tagBit) {
				$searchTag = mysql_query("SELECT hashtag_id FROM hashtags WHERE hashtag = '$tagBit'");
				$tagId = 0;
				if (mysql_num_rows($searchTag) == 1) {
					$searchTag_1 = mysql_fetch_array($searchTag);
					$tagId = $searchTag_1['hashtag_id'];
				} else {
					mysql_query("INSERT INTO hashtags (hashtag, creator) VALUES ('$tagBit', '$user_id')");
					$tagId = mysql_insert_id();
				}
				mysql_query("INSERT INTO question_hashtags VALUES ('$tmpQuestionId', '$tagId')");
			}
		}

		header('location: ../question_content.php?question_id='.$question_id);
	} else {
		$_SESSION['error'] = 3;
		header("location: ../home_user.php");
	}

	include("sql_close.php");
?>