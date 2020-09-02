<?php
	session_start();
	require("accessDB.php");
	
	if(isset($_SESSION['account']))
	{
		echo "You have already logged in!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
?>
	
<html>
	<body>
		<?php 
			$db= connectToDB();
			Store_Employer($db);
		?>
	</body>
</html>

<?php

	function Store_Employer($db)
	{
		//$db= connect_to_DB();
		
		$account= $_POST['account'];
		$password= $_POST['password'];
		$phone= $_POST['phone'];
		$email= $_POST['email'];
		$table= "employer";
		//$max= 20;
		$account_legal= $password_legal= $phone_legal= $email_legal= 1;
		$account_null= $password_null= $phone_null= $email_null= 1;
		$input_legal= 0;
		//$salt= "serect";
		
		if(!isset($account))
		{
			echo "invalid access!<br>";
			echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
			exit;	
		}
		
		if(empty($account))
		{
			$account_null= 0;
		}
		else
		{
			if(preg_match('/\s/', $account))
			{
				$account_legal= 0;
			}
		}
		
		if(empty($password))
		{
			$password_null= 0;
		}
		else
		{
			if(preg_match('/\s/', $password))
			{
				$password_legal= 0;
			}
		}
		
		if(empty($email))
		{
			$email_null= 0;
		}
		else
		{
			if(!preg_match("/^([\w\-]+\@[a-zA-Z]+\.[a-zA-Z]+(\.[a-zA-Z]+)*)$/",$email))
			{
				$email_legal= 0;
			}
		}
		
		if(empty($phone))
		{
			$phone_null= 0;
		}
		else
			if(!preg_match("/^([0-9]+)$/", $phone))
			{
				$phone_legal= 0;
			}
		
		if($account_legal && $password_legal && $email_legal && $phone_legal &&
			$account_null && $password_null && $email_null && $phone_null)
			{
				$input_legal = 1;
			}
		
		if(!checkDup($db, $account, $table) && $input_legal=== 1)
		{
			$sql= "INSERT INTO employer(account, password, phone, mail)"
				  ."VALUES(?, ?, ?, ?)";
			$sth= $db->prepare($sql);
			$sth->execute(array($account, sha1($password), $phone, $email));
			
			echo "Sign up success!<br>";
			
			$_SESSION['login_as'] = "employer";
			$_SESSION['account'] = $account;
			$temp = accessRow($db, "employer", "account", $account);
			$_SESSION['id'] = $temp[0]['id'];
			
			echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		}
		else if(!checkDup($db, $account, $table) && $input_legal=== 0)
		{
			if(!$account_legal)
			{
				echo "Account is illegal! <br><br>";
				echo "Acoount shouldn't contain whitespaces. <br><br>";
			}
			if(!$account_null)
			{
				echo "Account is empty! <br><br>";
			}
			if(!$password_legal)
			{
				echo "Password is illegal! <br>";
				echo "Password shouldn't contain whitespaces. <br><br>";
			}
			if(!$password_null)
			{
				echo "Password is empty! <br><br>";
			}
			if(!$phone_legal)
			{
				echo "Phone is illegal! <br><br>";
			}
			if(!$phone_null)
			{
				echo "Phone is empty! <br><br>";
			}
			if(!$email_legal)
			{
				echo "Email is illegal! <br>";
			}
			if(!$email_null)
			{
				echo "Email is empty! <br>";
			}
			echo "<br><a href=\"SignUpEmployer.php\"><input type=\"button\" value=\"Back.\" /></a><br>";
		}
		else
		{
			echo "Employer already exists!<br>";
			echo "<br><a href=\"SignUpEmployer.php\"><input type=\"button\" value=\"Back. \" /></a><br>";
		}
	}
	
	function checkDup($db, $account, $table)
	{
		$temp = accessRow($db, $table, "account", $account);
		return isset($temp[0]);
	}

?>