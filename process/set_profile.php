<?php
	session_start();
	include("sql_connect.php");

	$user_id = $_SESSION['userid'];
	$bio = str_replace('\'', '\\\'', $_POST['bio']);
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$gender = $_POST['gender'];
	$location = $_POST['location'];
	$birthdate = $_POST['birthdate'];
	$photo1 = $_FILES['prof_pic'];
	$photo2 = $_FILES['cover_pic'];

	$prof_pic = 'default.gif';
	if ($photo1['error'] == 0) {
		$prof_pic = uniqid();
		$extension = '';
		if ($photo1['type'] == 'image/jpeg') {
		  	$extension = '.jpg';
		} else if ($photo1['type'] == 'image/png') {
		  	$extension = '.png';
		} else if ($photo1['type'] == 'image/gif') {
			$extension = '.gif';
		}
		$prof_pic .= $extension;
		while (file_exists('../images/prof_pics/' . $prof_pic)) {
		  	$prof_pic = uniqid() . $extension;
		}
		move_uploaded_file($photo1['tmp_name'], '../images/prof_pics/' . $prof_pic);
	}

	$cover_pic = 'default.jpg';
	if ($photo2['error'] == 0) {
		$cover_pic = uniqid();
		$extension = '';
		if ($photo2['type'] == 'image/jpeg') {
		  	$extension = '.jpg';
		} else if ($photo2['type'] == 'image/png') {
		  	$extension = '.png';
		} else if ($photo2['type'] == 'image/gif') {
			$extension = '.gif';
		}
		$cover_pic .= $extension;
		while (file_exists('../images/cover_pics/' . $cover_pic)) {
		  	$cover_pic = uniqid() . $extension;
		}
		move_uploaded_file($photo2['tmp_name'], '../images/cover_pics/' . $cover_pic);
	}

	$user_profile = mysql_query("SELECT prof_pic, cover_pic FROM user_profiles WHERE user_id = '$user_id'");

	if (mysql_num_rows($user_profile) > 0) {
		$user_profile = mysql_fetch_assoc($user_profile);
		$prof_pic = ($user_profile['prof_pic'] != 'default.gif' && $prof_pic == 'default.gif') ? $user_profile['prof_pic'] : $prof_pic;
		$cover_pic = ($user_profile['cover_pic'] != 'default.jpg' && $cover_pic == 'default.jpg') ? $user_profile['cover_pic'] : $cover_pic;
		mysql_query(
			"UPDATE user_profiles SET
				firstname = '$firstname',
				lastname = '$lastname',
				bio = '$bio',
				gender = '$gender',
				location = '$location',
				birthdate = '$birthdate',
				prof_pic = '$prof_pic',
				cover_pic = '$cover_pic'
			WHERE user_id = '$user_id'");
	} else {
		mysql_query("INSERT INTO user_profiles VALUES ('$user_id', '$firstname', '$lastname', '$bio', '$gender', '$location', '$birthdate', '$prof_pic', '$cover_pic')");
	}

	header("location: ../user_profile.php?profile_id=".$user_id);
	include("sql_close.php");
?>