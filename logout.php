<?php
	session_start();
	if (isset($_SESSION["username"])){
		session_unset();
		session_destroy();
		header("Location: log-in.html");
		exit();
	}
	else {
		echo " No session exists or session is expired. Please log in again";
		echo "<br>Click <a href='log-in.html'> here </a> to Login again.";
	}
?>
