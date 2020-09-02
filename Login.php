<?php

	session_start();
	
	require("accessDB.php");
	
	//header('Location: HomePage.php');
	
	$db = connectToDB();
	
	if(!isset($_SESSION['account']) && isset($_POST['account_employer']))
	{
		$account = $_POST['account_employer'];
		$password = sha1($_POST['password_employer']);
		
		$temp = accessRow2($db, "employer", "account", $account, "password", $password);
		if(count($temp)>0)
		{
			$_SESSION['login_as'] = "employer";
			$_SESSION['account'] = $account;
			$_SESSION['id'] = $temp[0]['id'];
			echo "employer logged in<br>";
		}
		else
		{
			echo "account and/or password incorrect!<br>";
		}
	}
	else if(!isset($_SESSION['account']) && isset($_POST['account_user']))
	{
		$account = $_POST['account_user'];
		$password = sha1($_POST['password_user']);
		
		$temp = accessRow2($db, "user", "account", $account, "password", $password);
		if(count($temp)>0)
		{
			$_SESSION['login_as'] = "user";
			$_SESSION['account'] = $account;
			$_SESSION['id'] = $temp[0]['id'];
			echo "seeker logged in<br>";
		}
		else
		{
			echo "account and/or password incorrect!<br>";
		}
	}
	
	if(isset($_SESSION['account']))
	{
		$account = $_SESSION['account'];
		echo "Hello! $account<br>";
		echo '<a href="Logout.php"><input type="button" value="Log out" /></a><br>';
	}
	else
	{
		echo "not logged in<br>";
	}
	
	echo '<a href="HomePage.php"><input type="button" value="Back to Home Page" /></a><br>';
	

	/*
	//INSERT INTO 'user' (id, username, password, gender)
	//VALUES(123, 'Hi', 'Yo', 'male')
	
	$sql = "INSERT INTO user(id, username, password, gender)"."VALUES(?, ?, ?, ?)";
	$sth = $db->prepare($sql);
	$sth->execute(array($id, $username, $password, $gender));
	*/
	
	echo "The time is: ".date("Y-m-d H:i:s")."<br>";
	
?>
