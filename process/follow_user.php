<?php
	session_start();
	include("sql_connect.php");

	$follower = $_SESSION['userid'];
	$followed = $_GET['toBeFollowed'];

	if ($follower != $followed) {
		mysql_query("INSERT INTO user_follow (follower_id, follow_id) VALUES ('$follower', '$followed')");
	}

	header("location: ../user_profile.php?profile_id=".$followed);
?>