<?php
	include('sql_connect.php');
	
	$user_id = $_GET['user_id'];
	$question_id = $_GET['question_id'];

	mysql_query("INSERT INTO question_follow (user_id, question_id) VALUES ('$user_id', '$question_id')");
	echo 'You followed this!';
?>
