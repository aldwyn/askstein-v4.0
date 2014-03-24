<?php

	session_start();
	include("sql_connect.php");

    $content = str_replace('\'', '\\\'', $_POST['content']);;
    $question_id = $_POST['question_id'];
    $answer_id = $_POST['answer_id'];
    $user_id = $_SESSION['userid'];

	if (str_word_count($content) != 0 && trim($content) != '') {
    	mysql_query("INSERT INTO comments (answer_id, content, user_id) VALUES ('$answer_id', '$content', '$user_id')");
    } else {
    	$_SESSION['error'] = 3;
    }
    
    header("location: ../question_content.php?question_id=" . $question_id);
?>