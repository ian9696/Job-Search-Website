<?php

	session_start();

	require("accessDB.php");

	if(isset($_SESSION['login_as']) && $_SESSION['login_as']=="user" && isset($_POST['jobID']))
	{
		$db = connectToDB();
		$sql = "INSERT INTO application(user_id, recruit_id)"
				  ."VALUES(?, ?)";
		$sth = $db->prepare($sql);
		$sth->execute(array($_SESSION['id'], $_POST['jobID']));

		header('Location: HomePage.php');
	}
	
	echo "invalid access!<br>";
	
	echo '<a href="HomePage.php"><input type="button" value="Back to Home Page" /></a><br>';
	
?>