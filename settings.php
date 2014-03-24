<?php
	session_start();
	include("process/sql_connect.php");

	$user_id = $_SESSION['userid'];

	if (!isset($user_id)) {
		header("location: index.php");
	}

	$user = mysql_query("SELECT * FROM users WHERE user_id = '$user_id'");
	$user = mysql_fetch_array($user);

	$user_profile = mysql_query("SELECT * FROM user_profiles WHERE user_id = '$user_id'");
	if (mysql_num_rows($user_profile) != 0) {
		$user_profile = mysql_fetch_array($user_profile);

	}

?>

<?php include('fronts/header.php'); ?>
		<div class="wrapper">
			<div class="sign_up_complete">
				<div id="header"> <font size="6px">Welcome, <?php echo $user['username']; ?>!</font><br></div>

				<p align="center" style="font-size: 12px; font-family: sans-serif;">This information appears on your public profile, search results, and beyond.</p>
				<form action="process/set_profile.php" method="POST" enctype="multipart/form-data">
					<div class="form_wrapper">
						<div class="form">
							<div id="label">Username</div>
							<input type="text" id="textarea_1" name="username" value="<?php echo $user['username']; ?>"/>
						</div>

						<div class="form">
							<div id="label">First Name</div>
							<input type="text" id="textarea_1" name="firstname" <?php
								if (sizeof($user_profile) != 0) {
									echo 'value="'.$user_profile['firstname'].'"';
								} else {
									echo 'placeholder=". . ."';
								}
							?> />
						</div>

						<div class="form">
							<div id="label">Last Name</div>
							<input type="text" id="textarea_1" name="lastname" <?php
								if (sizeof($user_profile) != 0) {
									echo 'value="'.$user_profile['lastname'].'"';
								} else {
									echo 'placeholder=". . ."';
								}
							?> />
						</div>

						<div class="form">
							<div id="label">Address</div>
							<input type="text" id="textarea_1" name="location" <?php
								if (sizeof($user_profile) != 0) {
									echo 'value="'.$user_profile['location'].'"';
								} else {
									echo 'placeholder=". . ."';
								}
							?> />
						</div>

						<div class="form">
							<div id="label">Birthdate</div>
							<input type="date" id="textarea_1" name="birthdate" <?php
								if (sizeof($user_profile) != 0) {
									echo 'value="'.$user_profile['birthdate'].'"';
								}
							?> />
						</div>

						<div class="form" style="height: 40px;">
							<div id="label">Description</div>
							<textarea id="textarea_1" style="padding-top:7px; height: 40px; max-height: 40px;" name="bio" <?php
								if (sizeof($user_profile) != 0) {
									echo '>'.$user_profile['bio'].'</textarea>';
								} else {
									echo 'placeholder="Tell us about yourself. Be expressive." ></textarea>';
								}
							?>
						</div>

						<div class="form">
							<div id="label">Gender</div>
							<input type="radio" id="button" name="gender" value="MALE" <?= ($user_profile['gender'] == 'MALE') ? 'checked' : ''; ?>/>Male
							<input type="radio" id="button" name="gender" value="FEMALE" <?= ($user_profile['gender'] != 'MALE') ? 'checked' : ''; ?> style="margin-left: 30px"/>Female
						</div>
					</div>
					
					<div id="set_picture">
						<p style="font-size: 12px; float:left; margin-top: 35px; font-family: Sans-serif">Photo</p>
						<div class="pp" style="background: url('images/prof_pics/<?= $user_profile['prof_pic']; ?>') no-repeat"></div>
						<input type="file" name="prof_pic" accept="image/*"><br>
						<p id="label_2">This photo is your identity on Askstein and appears with your questions.</p>
					</div>

					<div id="set_picture">
						<p style="font-size: 12px; float:left; margin-top: 35px; font-family: Sans-serif">Cover</p>
						<div class="pp" style="background: url('images/cover_pics/<?= $user_profile['cover_pic']; ?>') no-repeat"></div>
						<input type="file" name="cover_pic" accept="image/*"><br>
						<p id="label_2">This photo is your identity on Askstein and appears with your questions.</p>
					</div>	

					

					<input type="submit" id="submit" value="SUBMIT"/>
				</form>
				<div class="clear"></div>
			</div>
		</div>
<?php include('fronts/footer.php'); ?>