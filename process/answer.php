<?php

	session_start();
	include("sql_connect.php");

    $content = str_replace('\'', '\\\'', $_POST['content']);
    $question_id = $_POST['question_id'];
    $user_id = $_SESSION['userid'];

    if (str_word_count($content) != 0 && trim($content) != '') {
    	mysql_query("INSERT INTO answers (question_id, content, user_id) VALUES ('$question_id', '$content', '$user_id')");
    } else {
    	$_SESSION['error'] = 3;
    }

    header("location: ../question_content.php?question_id=" . $question_id);
?>