<?php
    session_start();
    include("sql_connect.php");

    $username = $_POST["username"];
    $pass = $_POST["pass"];

    $result = mysql_query("SELECT * FROM users WHERE username= '$username' AND password= '$pass'");
    if (mysql_num_rows($result) == 1) {
        $username = mysql_fetch_assoc($result);
        $_SESSION['userid'] = $username['user_id'];
        header("location: ../home_user.php");
    } else {
        $_SESSION['error'] = 0;
        header('location: ../index.php');
    }

    include("sql_close.php");
?>