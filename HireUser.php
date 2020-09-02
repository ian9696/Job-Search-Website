<?php
	session_start();
	require("accessDB.php");

	if(!isset($_SESSION['login_as']))
	{
		echo "Please log in as employer first!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
	else if($_SESSION['login_as'] !== "employer")
	{
		echo "Please log in as employer first!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
	else if(!isset($_POST['jobID']) || !isset($_POST['userID']))
	{
		echo "Please choose a job seeker to hire!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
	else if(!jobEmployerMatch($_POST['jobID'], $_SESSION['id']))
	{
		echo "That's not your job!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
	else if(!jobUserApplicationMatch($_POST['jobID'], $_POST['userID']))
	{
		echo "The job seeker did not apply for the job!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
	
	$id = $_POST['jobID'];
	
	$db = connectToDB();
	$table = "recruit";
	
	$sql = "DELETE FROM $table WHERE id='$id'";
	$sth = $db->prepare($sql);
	$sth->execute();
	
	header("Location: JobApplicationList.php"); 
?>