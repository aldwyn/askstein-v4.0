<?php
	include('sql_connect.php');

	$user_id = $_GET['user_id'];
	$question_id = $_GET['question_id'];
	$answer_id = $_GET['answer_id'];
	$rating = $_GET['rating'];

	mysql_query("INSERT INTO ratings VALUES ('$answer_id', '$question_id', '$user_id', '$rating')");

	$count = mysql_query("SELECT COUNT(*) FROM ratings WHERE answer_id = '$answer_id'");
	$count = mysql_fetch_array($count);
	
	$sum = mysql_query("SELECT SUM(level_ratings) FROM ratings WHERE answer_id = '$answer_id'");
	$sum = mysql_fetch_array($sum);
	
	$partialRating = ($sum[0] / $count[0]) / 5 * 100;

	mysql_query("UPDATE answers SET average = '$partialRating' WHERE answer_id = '$answer_id'");
	echo 'You rated this answer as '.$rating.'.';
?>