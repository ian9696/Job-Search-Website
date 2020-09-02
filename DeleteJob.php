<?php
	session_start();
	require("accessDB.php");

	if(!isset($_SESSION['login_as']))
	{
		echo "Please log in as employer first.<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
	else if($_SESSION['login_as'] !== "employer")
	{
		echo "You are not employer!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
	else if(!isset($_POST['jobID']))
	{
		echo "Please choose a job to delete!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
	else if(!jobEmployerMatch($_POST['jobID'], $_SESSION['id']))
	{
		echo "That's not your job!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
	
	$id= $_POST['jobID'];
	
	$db= connectToDB();
	$table= "recruit";
	
	$sql= "DELETE FROM $table WHERE id='$id'";
	$sth= $db->prepare($sql);
	$sth->execute();
	
	header("Location: HomePage.php"); 
?>