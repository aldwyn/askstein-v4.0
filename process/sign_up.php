<?php

	session_start();
  	include("sql_connect.php");

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];

	if ($password == $confirmpassword) {
		$usernamechecker = mysql_query("SELECT* FROM users WHERE username = '$username' OR email_address = '$email'");
		if (mysql_num_rows($usernamechecker) == 0) {
			mysql_query("INSERT INTO users (email_address, username, password) VALUES ('$email', '$username', '$password')");
			$userid = mysql_insert_id();
			$_SESSION['userid'] = $userid;
			header('location: ../settings.php');
		} else {
			$_SESSION['error'] = 1;
			header('location: ../index.php');
		}
	} else {
		$_SESSION['error'] = 2;
		header('location: ../index.php');
	}

	include("sql_close.php");

?>



