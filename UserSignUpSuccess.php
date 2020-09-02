<?php
	session_start();
	require("accessDB.php");
	require("CheckField.php");
	
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
			Store_User_data($db);
		?>
	</body>
</html>

<?php

	function Store_User_data($db)
	{
		//$db= connect_to_DB();
		
		$account= $_POST['account'];
		$password= $_POST['password'];
		$education= $_POST['education'];
		$expected_salary= $_POST['expected_salary'];
		$phone= $_POST['phone'];
		$gender= $_POST['gender'];
		$age= $_POST['age'];
		$email= $_POST['email'];
		$checkbox= $_POST['chk'];
		$table= "user";
		//$max= 20;
		
		$account_legal= $password_legal= $expected_salary_legal= 1;
		$phone_legal= $age_legal= $email_legal= 1;
		$edu_legal= $gender_legal= 1;
		
		$account_null= $password_null= $expected_salary_null= 1;
		$phone_null= $age_null= $email_null= 1;
		$input_legal= 0;
		//$salt= "serect";
		
		if(!CheckEducation($education))
		{
			$edu_legal= 0;
		}
		if(!CheckGender($gender))
		{
			$gender_legal= 0;
		}
		
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
		
		if(empty($expected_salary))
		{
			$expected_salary_null= 0;
		}
		else
		{
			if(!preg_match("/^([0-9]+)$/", $expected_salary) 
				|| $expected_salary < 0
				|| $expected_salary > 2147483647)
			{
				$expected_salary_legal= 0;
			}
		}
		
		if(empty($age))
		{
			$age_null= 0;
		}
		else
		{
			if(!preg_match("/^([0-9]+)$/", $age) 
				|| $age < 0
				|| $age > 2147483647)
			{
				$age_legal= 0;
			}
		}
		if(empty($phone))
		{
			$phone_null= 0;
		}
		else
		{
			if(!preg_match("/^([0-9]+)$/", $phone))
			{
				$phone_legal= 0;
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
		
		if($account_legal && $password_legal && $email_legal &&
			$expected_salary_legal && $phone_legal && $age_legal &&
			$account_null && $password_null && $email_null &&
			$expected_salary_null && $phone_null && $age_null && $edu_legal && $gender_legal)
			{
				$input_legal = 1;
			}
		
		if(!checkDup($db, $account, $table) && $input_legal=== 1)
		{
			$sql= "INSERT INTO user(account, password, education, "
				  ."expected_salary, phone, gender, age, email)"
				  ."VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
			$sth= $db->prepare($sql);
			$sth->execute(array($account, sha1($password), $education, $expected_salary, $phone, $gender, $age, $email));
            
			$user_id = accessRow($db, "user", "account", $account)[0]['id'];
            
            if(isset($checkbox))
            {
                $sql= "INSERT INTO user_specialty(user_id, specialty_id) VALUES(?, ?)";
                $sth= $db->prepare($sql);
                for($i= 0; $i < sizeof($checkbox); $i++)
                    $sth->execute(array($user_id, $checkbox[$i]));
            }
            
			echo "Sign up success!<br>";
			
			$_SESSION['login_as'] = "user";
			$_SESSION['account'] = $account;
			$_SESSION['id'] = $user_id;
			

			echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage. \" /></a><br>";
		}
		else if(!checkDup($db, $account, $table) && $input_legal=== 0)
		{
			if(!$account_legal)
			{
				echo "Account is illegal! <br>";
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
			if(!$edu_legal)
			{
				echo "Education is illegal! <br>";
				echo "不要亂改啦!<br><br>";
			}
			if(!$expected_salary_null)
			{
				echo "Expected salary is empty! <br><br>";
			}
			if(!$expected_salary_legal)
			{
				echo "Expected salary must be an integer between 0 and 2147483647!<br><br>";
			}
			if(!$phone_null)
			{
				echo "Phone is empty! <br><br>";
			}
			if(!$phone_legal)
			{
				echo "Phone is illegal! <br><br>";
			}
			if(!$age_null)
			{
				echo "Age is empty! <br><br>";
			}
			if(!$age_legal)
			{
				echo "Age is illegal! <br><br>";
			}
			if(!$email_legal)
			{
				echo "Email is illegal! <br><br>";
			}
			if(!$email_null)
			{
				echo "Email is empty! <br><br>";
			}
			if(!$gender_legal)
			{
				echo "gender is illegal! <br>";
				echo "不要亂改啦!<br><br>";
			}
			echo "<br><a href=\"SignUpUser.php\"><input type=\"button\" value=\"Back. \" /></a><br>";
		}
		else
		{
			echo "User already exists!<br>";
			echo "<br><a href=\"SignUpUser.php\"><input type=\"button\" value=\"Back. \" /></a><br>";
		}
	}
	
	function checkDup($db, $account, $table)
	{
		$temp = accessRow($db, $table, "account", $account);
		return isset($temp[0]);
	}
?>